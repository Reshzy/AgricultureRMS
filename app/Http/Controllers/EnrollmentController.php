<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Enrollment;
use App\Models\FarmParcel;
use App\Models\FarmParcelHistory;
use App\Models\FarmParcelItemHistory;
use App\Models\User;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $name = trim((string) $request->input('q'));
        $barangay = trim((string) $request->input('barangay'));
        $livelihood = $request->input('livelihood');
        $status = $request->input('status');
        $parcel = trim((string) $request->input('parcel'));
        $perPage = (int) $request->input('per_page', 15);
        if (! in_array($perPage, [10, 15, 25, 50, 100])) {
            $perPage = 15;
        }

        $query = Enrollment::query();
        if ($name !== '') {
            $query->where(function ($q) use ($name) {
                $q->where('surname', 'like', "%{$name}%")
                    ->orWhere('first_name', 'like', "%{$name}%")
                    ->orWhere('middle_name', 'like', "%{$name}%")
                    ->orWhere('rsbsa_reference_number', 'like', "%{$name}%")
                    ->orWhereRaw("CONCAT(surname, ', ', first_name) like ?", ["%{$name}%"]);
            });
        }
        if ($barangay !== '') {
            $query->where('address_barangay', $barangay);
        }
        if ($livelihood) {
            $query->where('main_livelihood', $livelihood);
        }
        if ($status) {
            $query->where('status', $status);
        }
        if ($parcel !== '') {
            $query->whereHas('farmParcels.items', function ($q) use ($parcel) {
                $q->where('kind', 'like', "%{$parcel}%")
                    ->orWhere('name', 'like', "%{$parcel}%")
                    ->orWhere('farm_type', 'like', "%{$parcel}%");
            });
        }

        $enrollments = $query->orderByDesc('created_at')->paginate($perPage)->appends($request->except('page'));

        // Get distinct barangays for dropdown
        $barangays = Enrollment::whereNotNull('address_barangay')
            ->where('address_barangay', '!=', '')
            ->distinct()
            ->orderBy('address_barangay')
            ->pluck('address_barangay')
            ->toArray();

        if ($request->ajax()) {
            return view('admin.enrollments.partials.table', compact('enrollments'));
        }

        return view('admin.enrollments.index', compact('enrollments', 'name', 'barangay', 'livelihood', 'status', 'parcel', 'perPage', 'barangays'));
    }

    public function create()
    {
        return view('admin.enrollments.create');
    }

    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['farmParcels.items', 'parcelHistories.changedBy', 'parcelHistories.itemHistories']);
        $histories = $enrollment->parcelHistories()
            ->with(['changedBy', 'itemHistories'])
            ->orderByDesc('changed_at')
            ->get()
            ->groupBy(function ($history) {
                return $history->changed_at->format('Y-m-d H:i:s');
            });
        return view('admin.enrollments.show', compact('enrollment', 'histories'));
    }

    public function edit(Enrollment $enrollment)
    {
        $enrollment->load(['farmParcels.items']);
        return view('admin.enrollments.edit', compact('enrollment'));
    }

    /**
     * Normalize parcel data for comparison
     */
    private function normalizeParcelData($parcels): array
    {
        $normalized = [];
        foreach ($parcels as $parcel) {
            $p = [
                'barangay' => $parcel['barangay'] ?? null,
                'municipality' => $parcel['municipality'] ?? null,
                'total_farm_area_ha' => $parcel['total_farm_area_ha'] ?? null,
                'ownership_document_no' => $parcel['ownership_document_no'] ?? null,
                'within_ancestral_domain' => (bool) ($parcel['within_ancestral_domain'] ?? false),
                'is_agrarian_reform_beneficiary' => (bool) ($parcel['is_agrarian_reform_beneficiary'] ?? false),
                'ownership_type' => $parcel['ownership_type'] ?? null,
                'land_owner_name' => $parcel['land_owner_name'] ?? null,
                'ownership_other_specify' => $parcel['ownership_other_specify'] ?? null,
                'crop_commodity' => $parcel['crop_commodity'] ?? null,
                'livestock_poultry_type' => $parcel['livestock_poultry_type'] ?? null,
                'size_ha' => $parcel['size_ha'] ?? null,
                'num_of_head' => $parcel['num_of_head'] ?? null,
                'farm_type' => $parcel['farm_type'] ?? null,
                'is_organic_practitioner' => (bool) ($parcel['is_organic_practitioner'] ?? false),
                'remarks' => $parcel['remarks'] ?? null,
                'items' => [],
            ];
            
            foreach (($parcel['items'] ?? []) as $item) {
                $p['items'][] = [
                    'kind' => $item['kind'] ?? null,
                    'name' => $item['name'] ?? null,
                    'size_ha' => $item['size_ha'] ?? null,
                    'num_of_head' => $item['num_of_head'] ?? null,
                    'farm_type' => $item['farm_type'] ?? null,
                    'is_organic_practitioner' => (bool) ($item['is_organic_practitioner'] ?? false),
                    'remarks' => $item['remarks'] ?? null,
                ];
            }
            $normalized[] = $p;
        }
        return $normalized;
    }

    /**
     * Compare two normalized parcel arrays and detect changes
     */
    private function compareParcelData(array $oldParcels, array $newParcels): ?array
    {
        $oldJson = json_encode($oldParcels, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $newJson = json_encode($newParcels, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        
        if ($oldJson === $newJson) {
            return null; // No changes
        }

        $changes = [];
        
        // Compare parcel count
        if (count($oldParcels) !== count($newParcels)) {
            $changes[] = [
                'type' => 'parcel_count',
                'field' => 'parcel_count',
                'old' => count($oldParcels),
                'new' => count($newParcels),
            ];
        }

        // Compare each parcel field
        $maxCount = max(count($oldParcels), count($newParcels));
        for ($i = 0; $i < $maxCount; $i++) {
            $oldParcel = $oldParcels[$i] ?? null;
            $newParcel = $newParcels[$i] ?? null;
            
            if ($oldParcel === null) {
                $changes[] = [
                    'type' => 'parcel_added',
                    'parcel_index' => $i,
                    'field' => 'parcel',
                    'old' => null,
                    'new' => 'New parcel added',
                ];
                continue;
            }
            
            if ($newParcel === null) {
                $changes[] = [
                    'type' => 'parcel_removed',
                    'parcel_index' => $i,
                    'field' => 'parcel',
                    'old' => 'Parcel removed',
                    'new' => null,
                ];
                continue;
            }

            // Compare parcel fields
            $parcelFields = [
                'barangay', 'municipality', 'total_farm_area_ha', 'ownership_document_no',
                'within_ancestral_domain', 'is_agrarian_reform_beneficiary', 'ownership_type',
                'land_owner_name', 'ownership_other_specify', 'crop_commodity',
                'livestock_poultry_type', 'size_ha', 'num_of_head', 'farm_type',
                'is_organic_practitioner', 'remarks',
            ];

            foreach ($parcelFields as $field) {
                $oldVal = $oldParcel[$field] ?? null;
                $newVal = $newParcel[$field] ?? null;
                
                // Normalize for comparison
                if (is_numeric($oldVal)) $oldVal = (float) $oldVal;
                if (is_numeric($newVal)) $newVal = (float) $newVal;
                if (is_bool($oldVal)) $oldVal = $oldVal ? 1 : 0;
                if (is_bool($newVal)) $newVal = $newVal ? 1 : 0;
                
                if ($oldVal !== $newVal) {
                    $changes[] = [
                        'type' => 'field_change',
                        'parcel_index' => $i,
                        'field' => $field,
                        'old' => $oldParcel[$field] ?? null,
                        'new' => $newParcel[$field] ?? null,
                    ];
                }
            }

            // Compare items
            $oldItems = $oldParcel['items'] ?? [];
            $newItems = $newParcel['items'] ?? [];
            
            if (count($oldItems) !== count($newItems)) {
                $changes[] = [
                    'type' => 'item_count',
                    'parcel_index' => $i,
                    'field' => 'item_count',
                    'old' => count($oldItems),
                    'new' => count($newItems),
                ];
            }

            $itemMaxCount = max(count($oldItems), count($newItems));
            for ($j = 0; $j < $itemMaxCount; $j++) {
                $oldItem = $oldItems[$j] ?? null;
                $newItem = $newItems[$j] ?? null;
                
                if ($oldItem === null || $newItem === null) {
                    continue; // Item added/removed, already tracked by count
                }

                $itemFields = ['kind', 'name', 'size_ha', 'num_of_head', 'farm_type', 'is_organic_practitioner', 'remarks'];
                foreach ($itemFields as $field) {
                    $oldVal = $oldItem[$field] ?? null;
                    $newVal = $newItem[$field] ?? null;
                    
                    if (is_numeric($oldVal)) $oldVal = (float) $oldVal;
                    if (is_numeric($newVal)) $newVal = (float) $newVal;
                    if (is_bool($oldVal)) $oldVal = $oldVal ? 1 : 0;
                    if (is_bool($newVal)) $newVal = $newVal ? 1 : 0;
                    
                    if ($oldVal !== $newVal) {
                        $changes[] = [
                            'type' => 'item_field_change',
                            'parcel_index' => $i,
                            'item_index' => $j,
                            'field' => $field,
                            'old' => $oldItem[$field] ?? null,
                            'new' => $newItem[$field] ?? null,
                        ];
                    }
                }
            }
        }

        return $changes;
    }

    /**
     * Save parcel history before update
     */
    private function saveParcelHistory(Enrollment $enrollment, array $changeSummary): void
    {
        $enrollment->load('farmParcels.items');
        $changedAt = now();
        $changedByUserId = Auth::id();

        foreach ($enrollment->farmParcels as $parcel) {
            $parcelData = $parcel->toArray();
            unset($parcelData['id'], $parcelData['enrollment_id'], $parcelData['created_at'], $parcelData['updated_at']);
            
            $history = FarmParcelHistory::create([
                'farm_parcel_id' => $parcel->id,
                'enrollment_id' => $enrollment->id,
                'barangay' => $parcel->barangay,
                'municipality' => $parcel->municipality,
                'total_farm_area_ha' => $parcel->total_farm_area_ha,
                'ownership_document_no' => $parcel->ownership_document_no,
                'within_ancestral_domain' => $parcel->within_ancestral_domain,
                'is_agrarian_reform_beneficiary' => $parcel->is_agrarian_reform_beneficiary,
                'ownership_type' => $parcel->ownership_type,
                'land_owner_name' => $parcel->land_owner_name,
                'ownership_other_specify' => $parcel->ownership_other_specify,
                'crop_commodity' => $parcel->crop_commodity,
                'livestock_poultry_type' => $parcel->livestock_poultry_type,
                'size_ha' => $parcel->size_ha,
                'num_of_head' => $parcel->num_of_head,
                'farm_type' => $parcel->farm_type,
                'is_organic_practitioner' => $parcel->is_organic_practitioner,
                'remarks' => $parcel->remarks,
                'changed_by_user_id' => $changedByUserId,
                'changed_at' => $changedAt,
                'change_summary' => $changeSummary,
            ]);

            foreach ($parcel->items as $item) {
                FarmParcelItemHistory::create([
                    'farm_parcel_item_id' => $item->id,
                    'farm_parcel_history_id' => $history->id,
                    'kind' => $item->kind,
                    'name' => $item->name,
                    'size_ha' => $item->size_ha,
                    'num_of_head' => $item->num_of_head,
                    'farm_type' => $item->farm_type,
                    'is_organic_practitioner' => $item->is_organic_practitioner,
                    'remarks' => $item->remarks,
                    'changed_by_user_id' => $changedByUserId,
                    'changed_at' => $changedAt,
                ]);
            }
        }
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        // Merge split place of birth inputs into single field (server-side safety)
        if ($request->filled('pob_municipality') || $request->filled('pob_province') || $request->filled('pob_country')) {
            $pobParts = collect([
                trim((string) $request->input('pob_municipality')),
                trim((string) $request->input('pob_province')),
                trim((string) $request->input('pob_country')),
            ])->filter()->implode(', ');
            $request->merge(['place_of_birth' => $pobParts]);
        }

        // Build validator to allow custom after() checks (same as store)
        $validator = Validator::make($request->all(), [
            // Photo
            'photo' => ['nullable', 'image', 'max:2048'],

            // Personal
            'rsbsa_reference_number' => ['nullable', 'string', 'max:17'],
            'surname' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'extension_name' => ['nullable', 'string', 'max:255'],
            'sex' => ['required', Rule::in(['male', 'female'])],

            // Address
            'address_house_lot' => ['nullable', 'string', 'max:255'],
            'address_street' => ['nullable', 'string', 'max:255'],
            'address_barangay' => ['nullable', 'string', 'max:255'],
            'address_municipality_city' => ['nullable', 'string', 'max:255'],
            'address_province' => ['nullable', 'string', 'max:255'],
            'address_region' => ['nullable', 'string', 'max:255'],

            // Contact & birth
            'mobile_number' => ['nullable', 'regex:/^\d{4}\s\d{3}\s\d{4}$/'],
            'landline_number' => ['nullable', 'string', 'max:50'],
            'date_of_birth' => ['nullable', 'date'],
            'place_of_birth' => ['nullable', 'string', 'max:255'],

            // Education & status
            'highest_formal_education' => ['nullable', 'string', 'max:255'],
            'religion' => ['nullable', 'string', 'max:255'],
            'civil_status' => ['nullable', Rule::in(['single', 'married', 'widowed', 'separated'])],
            'name_of_spouse' => ['nullable', 'string', 'max:255'],
            'mothers_maiden_name' => ['nullable', 'string', 'max:255'],

            // Household
            'household_head' => ['nullable', 'boolean'],
            'household_head_name' => ['nullable', 'string', 'max:255'],
            'relationship_to_head' => ['nullable', 'string', 'max:255'],
            'household_members_total' => ['nullable', 'integer', 'min:0'],
            'household_members_male' => ['nullable', 'integer', 'min:0'],
            'household_members_female' => ['nullable', 'integer', 'min:0'],

            // Special statuses
            'is_pwd' => ['nullable', 'boolean'],
            'is_four_ps_beneficiary' => ['nullable', 'boolean'],
            'is_indigenous_group_member' => ['nullable', 'boolean'],
            'indigenous_group_specify' => ['nullable', 'string', 'max:255', 'required_if:is_indigenous_group_member,1'],
            'has_government_id' => ['nullable', 'boolean'],
            'government_id_type' => ['nullable', 'string', 'max:255'],
            'government_id_number' => ['nullable', 'string', 'max:255'],
            'has_insurance_registered' => ['nullable', 'boolean'],

            // Emergency
            'emergency_contact_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_number' => ['nullable', 'string', 'max:50'],

            // Livelihood
            'main_livelihood' => ['required', Rule::in(['farmer', 'farmworker', 'fisherfolk', 'agri_youth'])],
            'farming_activities' => ['nullable', 'array'],
            'other_crop_specify' => ['nullable', 'string', 'max:255'],
            'livestock_type_specify' => ['nullable', 'string', 'max:255'],
            'poultry_type_specify' => ['nullable', 'string', 'max:255'],
            'farmworker_kinds_of_work' => ['nullable', 'array'],
            'farmworker_other_work' => ['nullable', 'string', 'max:255'],
            'fishing_activities' => ['nullable', 'array'],
            'fishing_other_activity' => ['nullable', 'string', 'max:255'],
            'agriyouth_involvements' => ['nullable', 'array'],
            'agriyouth_other_involvement' => ['nullable', 'string', 'max:255'],

            // Income
            'gross_income_farming' => ['nullable', 'numeric', 'min:0'],
            'gross_income_non_farming' => ['nullable', 'numeric', 'min:0'],

            // Rotation
            'rotation_farmers_p1' => ['nullable', 'string', 'max:255'],
            'rotation_farmers_p2' => ['nullable', 'string', 'max:255'],
            'rotation_farmers_p3' => ['nullable', 'string', 'max:255'],

            // Parcels
            'parcels' => ['nullable', 'array'],
            'parcels.*.barangay' => ['nullable', 'string', 'max:255'],
            'parcels.*.municipality' => ['nullable', 'string', 'max:255'],
            'parcels.*.total_farm_area_ha' => ['nullable', 'numeric', 'min:0'],
            'parcels.*.ownership_document_no' => ['nullable', 'string', 'max:255'],
            'parcels.*.within_ancestral_domain' => ['nullable', 'boolean'],
            'parcels.*.is_agrarian_reform_beneficiary' => ['nullable', 'boolean'],
            'parcels.*.ownership_type' => ['nullable', Rule::in(['registered_owner', 'tenant', 'lessee', 'others'])],
            'parcels.*.land_owner_name' => ['nullable', 'string', 'max:255'],
            'parcels.*.ownership_other_specify' => ['nullable', 'string', 'max:255'],
            'parcels.*.crop_commodity' => ['nullable', 'string', 'max:255'],
            'parcels.*.livestock_poultry_type' => ['nullable', 'string', 'max:255'],
            'parcels.*.size_ha' => ['nullable', 'numeric', 'min:0'],
            'parcels.*.num_of_head' => ['nullable', 'integer', 'min:0'],
            'parcels.*.farm_type' => ['nullable', 'string', 'max:255'],
            'parcels.*.is_organic_practitioner' => ['nullable', 'boolean'],
            'parcels.*.remarks' => ['nullable', 'string'],
            // Parcel items
            'parcels.*.items' => ['nullable', 'array'],
            'parcels.*.items.*.kind' => ['required_with:parcels.*.items', 'in:crop,livestock,poultry'],
            'parcels.*.items.*.name' => ['required_with:parcels.*.items', 'string', 'max:255'],
            'parcels.*.items.*.size_ha' => ['nullable', 'numeric', 'min:0'],
            'parcels.*.items.*.num_of_head' => ['nullable', 'integer', 'min:0'],
            'parcels.*.items.*.farm_type' => ['nullable', 'string', 'max:255'],
            'parcels.*.items.*.is_organic_practitioner' => ['nullable', 'boolean'],
            'parcels.*.items.*.remarks' => ['nullable', 'string', 'max:255'],
        ]);

        // Custom validation: members total must equal male + female when provided
        $validator->after(function ($validator) use ($request) {
            $t = $request->integer('household_members_total');
            $m = $request->integer('household_members_male');
            $f = $request->integer('household_members_female');
            if (!is_null($t) && (!is_null($m) || !is_null($f))) {
                if ($t !== (($m ?? 0) + ($f ?? 0))) {
                    $validator->errors()->add('household_members_total', 'Total members must equal male + female.');
                }
            }
        });

        $validated = $validator->validate();

        // Ensure unchecked checkboxes become false on update
        foreach (['household_head', 'is_pwd', 'is_four_ps_beneficiary', 'is_indigenous_group_member', 'has_government_id', 'has_insurance_registered'] as $bf) {
            $validated[$bf] = $request->boolean($bf);
        }

        // Ensure numeric member counts default to 0 when omitted
        foreach (['household_members_total', 'household_members_male', 'household_members_female'] as $numField) {
            if (!array_key_exists($numField, $validated) || is_null($validated[$numField])) {
                $validated[$numField] = 0;
            }
        }

        // Photo handling: keep old unless a new one uploaded
        $photoPath = $enrollment->photo_path;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('enrollments', 'public');
        }

        // Merge chips arrays into single comma-separated strings
        $toTitleCase = function (?string $v) {
            return $v === null ? null : ucwords(strtolower(trim($v)));
        };
        $mergeChips = function (string $itemsKey) use ($request, $toTitleCase): ?string {
            $items = (array) $request->input($itemsKey, []);
            $items = array_values(array_unique(array_filter(array_map(function ($v) use ($toTitleCase) {
                return $toTitleCase((string) $v);
            }, $items))));
            return count($items) ? implode(', ', $items) : null;
        };

        $validated['other_crop_specify'] = $mergeChips('other_crop_specify_items');
        $validated['livestock_type_specify'] = $mergeChips('livestock_type_specify_items');
        $validated['poultry_type_specify'] = $mergeChips('poultry_type_specify_items');
        $validated['farmworker_other_work'] = $mergeChips('farmworker_other_work_items');
        $validated['fishing_other_activity'] = $mergeChips('fishing_other_activity_items');
        $validated['agriyouth_other_involvement'] = $mergeChips('agriyouth_other_involvement_items');

        // If indigenous checkbox not checked, do not save specify text
        if (empty($validated['is_indigenous_group_member'])) {
            $validated['indigenous_group_specify'] = null;
        }

        // If government ID not checked, clear related fields
        if (empty($validated['has_government_id'])) {
            $validated['government_id_type'] = null;
            $validated['government_id_number'] = null;
        }

        // Sanitize and normalize some text fields (trim & title case)
        foreach (
            [
                'surname',
                'first_name',
                'middle_name',
                'extension_name',
                'address_house_lot',
                'address_street',
                'address_barangay',
                'address_municipality_city',
                'address_province',
                'address_region',
                'place_of_birth',
                'religion',
                'name_of_spouse',
                'mothers_maiden_name',
                'household_head_name',
                'relationship_to_head',
                'indigenous_group_specify',
                'government_id_type',
                'emergency_contact_name',
                'rotation_farmers_p1',
                'rotation_farmers_p2',
                'rotation_farmers_p3',
            ] as $field
        ) {
            if (array_key_exists($field, $validated)) {
                $validated[$field] = $toTitleCase($validated[$field]);
            }
        }

        DB::transaction(function () use ($request, $enrollment, $validated, $photoPath) {
            // Update main enrollment
            $enrollment->update(array_merge(
                collect($validated)->except(['photo', 'parcels'])->toArray(),
                [
                    'photo_path' => $photoPath,
                    'status' => $request->input('status') === 'draft' ? 'draft' : 'submitted',
                ]
            ));

            // Check if parcel data has changed and save history if needed
            $enrollment->load('farmParcels.items');
            $oldParcels = $this->normalizeParcelData(
                $enrollment->farmParcels->map(function ($parcel) {
                    $parcelData = $parcel->toArray();
                    $parcelData['items'] = $parcel->items->map(function ($item) {
                        return $item->toArray();
                    })->toArray();
                    return $parcelData;
                })->toArray()
            );
            
            $newParcels = $this->normalizeParcelData($validated['parcels'] ?? []);
            $changes = $this->compareParcelData($oldParcels, $newParcels);
            
            // Save history if parcel data changed
            if ($changes !== null && count($changes) > 0 && $enrollment->farmParcels->count() > 0) {
                $this->saveParcelHistory($enrollment, $changes);
            }

            // Replace related parcels and items
            foreach ($enrollment->farmParcels as $parcel) {
                $parcel->items()->delete();
                $parcel->delete();
            }

            foreach (($validated['parcels'] ?? []) as $parcel) {
                $items = $parcel['items'] ?? [];
                unset($parcel['items']);
                $parcelModel = $enrollment->farmParcels()->create($parcel);
                foreach ($items as $it) {
                    if (($it['kind'] ?? null) === 'crop') {
                        $it['num_of_head'] = null; // not applicable
                    }
                    $parcelModel->items()->create($it);
                }
            }
        });

        return redirect()->route('admin.enrollments.index')->with('status', 'Enrollment updated');
    }

    public function exportPdf(Enrollment $enrollment)
    {
        $enrollment->load(['farmParcels.items']);

        $pdf = PDF::loadView('admin.enrollments.pdf', compact('enrollment'));

        $filename = 'enrollment_' . $enrollment->surname . '_' . $enrollment->first_name . '_' . now()->format('Ymd') . '.pdf';

        return $pdf->download($filename);
    }

    public function store(Request $request)
    {
        // Merge split place of birth inputs into single field (server-side safety)
        if ($request->filled('pob_municipality') || $request->filled('pob_province') || $request->filled('pob_country')) {
            $pobParts = collect([
                trim((string) $request->input('pob_municipality')),
                trim((string) $request->input('pob_province')),
                trim((string) $request->input('pob_country')),
            ])->filter()->implode(', ');
            $request->merge(['place_of_birth' => $pobParts]);
        }

        // Build validator to allow custom after() checks
        $validator = Validator::make($request->all(), [
            // Photo
            'photo' => ['nullable', 'image', 'max:2048'],

            // Personal
            'rsbsa_reference_number' => ['nullable', 'string', 'max:17'],
            'surname' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'extension_name' => ['nullable', 'string', 'max:255'],
            'sex' => ['required', Rule::in(['male', 'female'])],

            // Address
            'address_house_lot' => ['nullable', 'string', 'max:255'],
            'address_street' => ['nullable', 'string', 'max:255'],
            'address_barangay' => ['nullable', 'string', 'max:255'],
            'address_municipality_city' => ['nullable', 'string', 'max:255'],
            'address_province' => ['nullable', 'string', 'max:255'],
            'address_region' => ['nullable', 'string', 'max:255'],

            // Contact & birth
            // Enforce format: 4 digits, space, 3 digits, space, 4 digits (e.g., 0912 345 6789)
            'mobile_number' => ['nullable', 'regex:/^\d{4}\s\d{3}\s\d{4}$/'],
            'landline_number' => ['nullable', 'string', 'max:50'],
            'date_of_birth' => ['nullable', 'date'],
            'place_of_birth' => ['nullable', 'string', 'max:255'],

            // Education & status
            'highest_formal_education' => ['nullable', 'string', 'max:255'],
            'religion' => ['nullable', 'string', 'max:255'],
            'civil_status' => ['nullable', Rule::in(['single', 'married', 'widowed', 'separated'])],
            'name_of_spouse' => ['nullable', 'string', 'max:255'],
            'mothers_maiden_name' => ['nullable', 'string', 'max:255'],

            // Household
            'household_head' => ['nullable', 'boolean'],
            'household_head_name' => ['nullable', 'string', 'max:255'],
            'relationship_to_head' => ['nullable', 'string', 'max:255'],
            'household_members_total' => ['nullable', 'integer', 'min:0'],
            'household_members_male' => ['nullable', 'integer', 'min:0'],
            'household_members_female' => ['nullable', 'integer', 'min:0'],

            // Special statuses
            'is_pwd' => ['nullable', 'boolean'],
            'is_four_ps_beneficiary' => ['nullable', 'boolean'],
            'is_indigenous_group_member' => ['nullable', 'boolean'],
            'indigenous_group_specify' => ['nullable', 'string', 'max:255', 'required_if:is_indigenous_group_member,1'],
            'has_government_id' => ['nullable', 'boolean'],
            'government_id_type' => ['nullable', 'string', 'max:255'],
            'government_id_number' => ['nullable', 'string', 'max:255'],
            'has_insurance_registered' => ['nullable', 'boolean'],

            // Emergency
            'emergency_contact_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_number' => ['nullable', 'string', 'max:50'],

            // Livelihood
            'main_livelihood' => ['required', Rule::in(['farmer', 'farmworker', 'fisherfolk', 'agri_youth'])],
            'farming_activities' => ['nullable', 'array'],
            'other_crop_specify' => ['nullable', 'string', 'max:255'],
            'livestock_type_specify' => ['nullable', 'string', 'max:255'],
            'poultry_type_specify' => ['nullable', 'string', 'max:255'],
            'farmworker_kinds_of_work' => ['nullable', 'array'],
            'farmworker_other_work' => ['nullable', 'string', 'max:255'],
            'fishing_activities' => ['nullable', 'array'],
            'fishing_other_activity' => ['nullable', 'string', 'max:255'],
            'agriyouth_involvements' => ['nullable', 'array'],
            'agriyouth_other_involvement' => ['nullable', 'string', 'max:255'],

            // Income
            'gross_income_farming' => ['nullable', 'numeric', 'min:0'],
            'gross_income_non_farming' => ['nullable', 'numeric', 'min:0'],

            // Rotation
            'rotation_farmers_p1' => ['nullable', 'string', 'max:255'],
            'rotation_farmers_p2' => ['nullable', 'string', 'max:255'],
            'rotation_farmers_p3' => ['nullable', 'string', 'max:255'],

            // Parcels
            'parcels' => ['nullable', 'array'],
            'parcels.*.barangay' => ['nullable', 'string', 'max:255'],
            'parcels.*.municipality' => ['nullable', 'string', 'max:255'],
            'parcels.*.total_farm_area_ha' => ['nullable', 'numeric', 'min:0'],
            'parcels.*.ownership_document_no' => ['nullable', 'string', 'max:255'],
            'parcels.*.within_ancestral_domain' => ['nullable', 'boolean'],
            'parcels.*.is_agrarian_reform_beneficiary' => ['nullable', 'boolean'],
            'parcels.*.ownership_type' => ['nullable', Rule::in(['registered_owner', 'tenant', 'lessee', 'others'])],
            'parcels.*.land_owner_name' => ['nullable', 'string', 'max:255'],
            'parcels.*.ownership_other_specify' => ['nullable', 'string', 'max:255'],
            'parcels.*.crop_commodity' => ['nullable', 'string', 'max:255'],
            'parcels.*.livestock_poultry_type' => ['nullable', 'string', 'max:255'],
            'parcels.*.size_ha' => ['nullable', 'numeric', 'min:0'],
            'parcels.*.num_of_head' => ['nullable', 'integer', 'min:0'],
            'parcels.*.farm_type' => ['nullable', 'string', 'max:255'],
            'parcels.*.is_organic_practitioner' => ['nullable', 'boolean'],
            'parcels.*.remarks' => ['nullable', 'string'],
            // Parcel items
            'parcels.*.items' => ['nullable', 'array'],
            'parcels.*.items.*.kind' => ['required_with:parcels.*.items', 'in:crop,livestock,poultry'],
            'parcels.*.items.*.name' => ['required_with:parcels.*.items', 'string', 'max:255'],
            'parcels.*.items.*.size_ha' => ['nullable', 'numeric', 'min:0'],
            'parcels.*.items.*.num_of_head' => ['nullable', 'integer', 'min:0'],
            'parcels.*.items.*.farm_type' => ['nullable', 'string', 'max:255'],
            'parcels.*.items.*.is_organic_practitioner' => ['nullable', 'boolean'],
            'parcels.*.items.*.remarks' => ['nullable', 'string', 'max:255'],
        ]);

        // Custom validation: members total must equal male + female when provided
        $validator->after(function ($validator) use ($request) {
            $t = $request->integer('household_members_total');
            $m = $request->integer('household_members_male');
            $f = $request->integer('household_members_female');
            if (!is_null($t) && (!is_null($m) || !is_null($f))) {
                if ($t !== (($m ?? 0) + ($f ?? 0))) {
                    $validator->errors()->add('household_members_total', 'Total members must equal male + female.');
                }
            }
        });

        $validated = $validator->validate();

        // Ensure unchecked checkboxes become false
        foreach (['household_head', 'is_pwd', 'is_four_ps_beneficiary', 'is_indigenous_group_member', 'has_government_id', 'has_insurance_registered'] as $bf) {
            $validated[$bf] = $request->boolean($bf);
        }

        // Ensure numeric member counts default to 0 when omitted
        foreach (['household_members_total', 'household_members_male', 'household_members_female'] as $numField) {
            if (!array_key_exists($numField, $validated) || is_null($validated[$numField])) {
                $validated[$numField] = 0;
            }
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('enrollments', 'public');
        }

        // Merge chips arrays into single comma-separated strings
        $toTitleCase = function (?string $v) {
            return $v === null ? null : ucwords(strtolower(trim($v)));
        };
        $mergeChips = function (string $itemsKey) use ($request, $toTitleCase): ?string {
            $items = (array) $request->input($itemsKey, []);
            $items = array_values(array_unique(array_filter(array_map(function ($v) use ($toTitleCase) {
                return $toTitleCase((string) $v);
            }, $items))));
            return count($items) ? implode(', ', $items) : null;
        };

        $validated['other_crop_specify'] = $mergeChips('other_crop_specify_items');
        $validated['livestock_type_specify'] = $mergeChips('livestock_type_specify_items');
        $validated['poultry_type_specify'] = $mergeChips('poultry_type_specify_items');
        $validated['farmworker_other_work'] = $mergeChips('farmworker_other_work_items');
        $validated['fishing_other_activity'] = $mergeChips('fishing_other_activity_items');
        $validated['agriyouth_other_involvement'] = $mergeChips('agriyouth_other_involvement_items');

        // If indigenous checkbox not checked, do not save specify text
        if (empty($validated['is_indigenous_group_member'])) {
            $validated['indigenous_group_specify'] = null;
        }

        // If government ID not checked, clear related fields
        if (empty($validated['has_government_id'])) {
            $validated['government_id_type'] = null;
            $validated['government_id_number'] = null;
        }

        // Sanitize and normalize some text fields (trim & title case)
        foreach (
            [
                'surname',
                'first_name',
                'middle_name',
                'extension_name',
                'address_house_lot',
                'address_street',
                'address_barangay',
                'address_municipality_city',
                'address_province',
                'address_region',
                'place_of_birth',
                'religion',
                'name_of_spouse',
                'mothers_maiden_name',
                'household_head_name',
                'relationship_to_head',
                'indigenous_group_specify',
                'government_id_type',
                'emergency_contact_name',
                'rotation_farmers_p1',
                'rotation_farmers_p2',
                'rotation_farmers_p3',
            ] as $field
        ) {
            if (array_key_exists($field, $validated)) {
                $validated[$field] = $toTitleCase($validated[$field]);
            }
        }

        $enrollment = Enrollment::create(array_merge(
            collect($validated)->except(['photo', 'parcels'])->toArray(),
            [
                'photo_path' => $photoPath,
                'status' => $request->input('status') === 'draft' ? 'draft' : 'submitted',
            ]
        ));

        foreach (($validated['parcels'] ?? []) as $parcel) {
            $items = $parcel['items'] ?? [];
            unset($parcel['items']);
            $parcelModel = $enrollment->farmParcels()->create($parcel);
            foreach ($items as $it) {
                if (($it['kind'] ?? null) === 'crop') {
                    $it['num_of_head'] = null; // not applicable
                }
                $parcelModel->items()->create($it);
            }
        }

        return redirect()->route('admin.enrollments.index')->with('status', 'Enrollment created');
    }
}
