<div class="space-y-6">
    @php
        $display = static fn ($value) => filled($value) ? $value : 'N/A';
        $yesNo = static fn ($value) => is_null($value) ? 'N/A' : ((bool) $value ? 'Yes' : 'No');
        $displayList = static fn ($value) => is_array($value) && count($value) > 0 ? implode(', ', $value) : 'N/A';
    @endphp

    <div class="flex items-center justify-between gap-6">
        @if ($enrollment->rsbsa_reference_number)
        <div class="flex-1">
            <div class="inline-block px-4 py-2 bg-emerald-50 border border-emerald-200 rounded-lg">
                <span class="text-xs text-emerald-700 font-medium">RSBSA Reference Number</span>
                <div class="text-lg font-bold text-emerald-900 mt-1">{{ $enrollment->rsbsa_reference_number }}</div>
            </div>
        </div>
        @endif
        @if ($enrollment->photo_path)
        <div class="flex-shrink-0 flex justify-end">
            <img src="{{ asset('storage/' . $enrollment->photo_path) }}" alt="2x2 Photo" class="w-24 h-24 object-cover rounded border border-emerald-900/10 shadow-sm">
        </div>
        @endif
    </div>

    @include('admin.enrollments.partials.form_tabs_nav')

    <section id="tab-personal-panel" role="tabpanel" aria-labelledby="tab-personal-trigger" data-tab-panel="personal" class="space-y-6">
        <!-- Personal Info -->
        <section>
            <div class="h-1 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-sky-500 rounded"></div>
            <h4 class="mt-3 font-semibold text-emerald-900">Personal Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm mt-2">
                <div><span class="text-emerald-700">Surname:</span> {{ $display($enrollment->surname) }}</div>
                <div><span class="text-emerald-700">First Name:</span> {{ $display($enrollment->first_name) }}</div>
                <div><span class="text-emerald-700">Middle Name:</span> {{ $display($enrollment->middle_name) }}</div>
                <div><span class="text-emerald-700">Extension Name:</span> {{ $display($enrollment->extension_name) }}</div>
                <div><span class="text-emerald-700">Sex:</span> {{ $display(ucfirst((string) $enrollment->sex)) }}</div>
                <div><span class="text-emerald-700">Date of Birth:</span> {{ $display($enrollment->date_of_birth?->format('Y-m-d')) }}</div>
                <div class="md:col-span-3"><span class="text-emerald-700">Place of Birth:</span> {{ $display($enrollment->place_of_birth) }}</div>
            </div>
        </section>

        <!-- Address -->
        <section>
            <div class="h-1 w-full bg-gradient-to-r from-sky-500 via-indigo-500 to-fuchsia-500 rounded"></div>
            <h4 class="mt-3 font-semibold text-emerald-900">Address</h4>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3 text-sm mt-2">
                <div class="md:col-span-2"><span class="text-emerald-700">Street:</span> {{ $display(trim((string) ($enrollment->address_house_lot.' '.$enrollment->address_street))) }}</div>
                <div><span class="text-emerald-700">Barangay:</span> {{ $display($enrollment->address_barangay) }}</div>
                <div><span class="text-emerald-700">City/Municipality:</span> {{ $display($enrollment->address_municipality_city) }}</div>
                <div><span class="text-emerald-700">Province:</span> {{ $display($enrollment->address_province) }}</div>
                <div><span class="text-emerald-700">Region:</span> {{ $display($enrollment->address_region) }}</div>
            </div>
        </section>

        <!-- Contact and Family -->
        <section>
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 via-purple-500 to-pink-500 rounded"></div>
            <h4 class="mt-3 font-semibold text-emerald-900">Contact, Education and Family</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm mt-2">
                <div><span class="text-emerald-700">Mobile Number:</span> {{ $display($enrollment->mobile_number) }}</div>
                <div><span class="text-emerald-700">Landline Number:</span> {{ $display($enrollment->landline_number) }}</div>
                <div><span class="text-emerald-700">Highest Formal Education:</span> {{ $display($enrollment->highest_formal_education) }}</div>
                <div><span class="text-emerald-700">Religion:</span> {{ $display($enrollment->religion) }}</div>
                <div><span class="text-emerald-700">Civil Status:</span> {{ $display(ucfirst((string) $enrollment->civil_status)) }}</div>
                <div><span class="text-emerald-700">Name of Spouse:</span> {{ $display($enrollment->name_of_spouse) }}</div>
                <div class="md:col-span-2"><span class="text-emerald-700">Mother's Maiden Name:</span> {{ $display($enrollment->mothers_maiden_name) }}</div>
            </div>
        </section>

        <!-- Household and Identifiers -->
        <section>
            <div class="h-1 w-full bg-gradient-to-r from-cyan-500 via-sky-500 to-blue-500 rounded"></div>
            <h4 class="mt-3 font-semibold text-emerald-900">Household, IDs and Assistance</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm mt-2">
                <div><span class="text-emerald-700">Household Head:</span> {{ $yesNo($enrollment->household_head) }}</div>
                <div><span class="text-emerald-700">Household Head Name:</span> {{ $display($enrollment->household_head_name) }}</div>
                <div><span class="text-emerald-700">Relationship to Head:</span> {{ $display($enrollment->relationship_to_head) }}</div>
                <div><span class="text-emerald-700">Total Household Members:</span> {{ $display($enrollment->household_members_total) }}</div>
                <div><span class="text-emerald-700">Male Members:</span> {{ $display($enrollment->household_members_male) }}</div>
                <div><span class="text-emerald-700">Female Members:</span> {{ $display($enrollment->household_members_female) }}</div>
                <div><span class="text-emerald-700">PWD:</span> {{ $yesNo($enrollment->is_pwd) }}</div>
                <div><span class="text-emerald-700">4P's Beneficiary:</span> {{ $yesNo($enrollment->is_four_ps_beneficiary) }}</div>
                <div><span class="text-emerald-700">Indigenous Group Member:</span> {{ $yesNo($enrollment->is_indigenous_group_member) }}</div>
                <div><span class="text-emerald-700">Indigenous Group:</span> {{ $display($enrollment->indigenous_group_specify) }}</div>
                <div><span class="text-emerald-700">Has Government ID:</span> {{ $yesNo($enrollment->has_government_id) }}</div>
                <div><span class="text-emerald-700">Government ID Type:</span> {{ $display($enrollment->government_id_type) }}</div>
                <div><span class="text-emerald-700">Government ID Number:</span> {{ $display($enrollment->government_id_number) }}</div>
                <div><span class="text-emerald-700">Insurance Registered:</span> {{ $yesNo($enrollment->has_insurance_registered) }}</div>
                <div><span class="text-emerald-700">Emergency Contact Name:</span> {{ $display($enrollment->emergency_contact_name) }}</div>
                <div><span class="text-emerald-700">Emergency Contact Number:</span> {{ $display($enrollment->emergency_contact_number) }}</div>
                <div><span class="text-emerald-700">Enrollment Status:</span> {{ $display(ucfirst((string) $enrollment->status)) }}</div>
            </div>
        </section>
    </section>

    <section id="tab-farm-panel" role="tabpanel" aria-labelledby="tab-farm-trigger" data-tab-panel="farm" class="space-y-6 hidden">
        <!-- Livelihood -->
        <section>
            <div class="h-1 w-full bg-gradient-to-r from-amber-500 via-orange-500 to-rose-500 rounded"></div>
            <h4 class="mt-3 font-semibold text-emerald-900">Livelihood and Income</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm mt-2">
                <div><span class="text-emerald-700">Main Livelihood:</span> {{ $display(ucfirst(str_replace('_', ' ', (string) $enrollment->main_livelihood))) }}</div>
                <div><span class="text-emerald-700">Farming Activities:</span> {{ $displayList($enrollment->farming_activities) }}</div>
                <div><span class="text-emerald-700">Other Crops:</span> {{ $display($enrollment->other_crop_specify) }}</div>
                <div><span class="text-emerald-700">Livestock Type:</span> {{ $display($enrollment->livestock_type_specify) }}</div>
                <div><span class="text-emerald-700">Poultry Type:</span> {{ $display($enrollment->poultry_type_specify) }}</div>
                <div><span class="text-emerald-700">Farmworker Work Types:</span> {{ $displayList($enrollment->farmworker_kinds_of_work) }}</div>
                <div><span class="text-emerald-700">Farmworker Other Work:</span> {{ $display($enrollment->farmworker_other_work) }}</div>
                <div><span class="text-emerald-700">Fishing Activities:</span> {{ $displayList($enrollment->fishing_activities) }}</div>
                <div><span class="text-emerald-700">Fishing Other Activity:</span> {{ $display($enrollment->fishing_other_activity) }}</div>
                <div><span class="text-emerald-700">Agri Youth Involvements:</span> {{ $displayList($enrollment->agriyouth_involvements) }}</div>
                <div><span class="text-emerald-700">Agri Youth Other Involvement:</span> {{ $display($enrollment->agriyouth_other_involvement) }}</div>
                <div><span class="text-emerald-700">Gross Income (Farming):</span> {{ $display($enrollment->gross_income_farming) }}</div>
                <div><span class="text-emerald-700">Gross Income (Non-Farming):</span> {{ $display($enrollment->gross_income_non_farming) }}</div>
                <div><span class="text-emerald-700">Rotation Farmer P1:</span> {{ $display($enrollment->rotation_farmers_p1) }}</div>
                <div><span class="text-emerald-700">Rotation Farmer P2:</span> {{ $display($enrollment->rotation_farmers_p2) }}</div>
                <div><span class="text-emerald-700">Rotation Farmer P3:</span> {{ $display($enrollment->rotation_farmers_p3) }}</div>
            </div>
        </section>
    </section>

    <section id="tab-parcels-panel" role="tabpanel" aria-labelledby="tab-parcels-trigger" data-tab-panel="parcels" class="space-y-6 hidden">
        <!-- Farm Profile -->
        <section>
            <div class="h-1 w-full bg-gradient-to-r from-amber-500 via-orange-500 to-rose-500 rounded"></div>
            <h4 class="mt-3 font-semibold text-emerald-900">Farm Parcels</h4>
        @foreach($enrollment->farmParcels as $parcel)
        <div class="mt-3 p-3 rounded border">
            <div class="font-medium text-emerald-900">Parcel #{{ $loop->iteration }}</div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 text-sm mt-2">
                <div><span class="text-emerald-700">Barangay:</span> {{ $parcel->barangay }}</div>
                <div><span class="text-emerald-700">Municipality:</span> {{ $parcel->municipality }}</div>
                <div><span class="text-emerald-700">Total Area (ha):</span> {{ $parcel->total_farm_area_ha }}</div>
                <div class="md:col-span-3"><span class="text-emerald-700">Ownership:</span> {{ ucfirst(str_replace('_',' ',$parcel->ownership_type)) }} {{ $parcel->land_owner_name ? '• '.$parcel->land_owner_name : '' }}</div>
            </div>
            @if($parcel->items->count())
            <div class="mt-3">
                <div class="text-emerald-900 font-medium mb-1">Items</div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-emerald-50/70 text-emerald-900">
                            <tr>
                                <th class="px-3 py-2 text-left">Kind</th>
                                <th class="px-3 py-2 text-left">Name</th>
                                <th class="px-3 py-2 text-left">Size (ha)</th>
                                <th class="px-3 py-2 text-left"># Head</th>
                                <th class="px-3 py-2 text-left">Farm Type</th>
                                <th class="px-3 py-2 text-left">Organic</th>
                                <th class="px-3 py-2 text-left">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($parcel->items as $it)
                            <tr>
                                <td class="px-3 py-2">{{ ucfirst($it->kind) }}</td>
                                <td class="px-3 py-2">{{ $it->name }}</td>
                                <td class="px-3 py-2">{{ $it->size_ha }}</td>
                                <td class="px-3 py-2">{{ $it->num_of_head }}</td>
                                <td class="px-3 py-2">{{ $it->farm_type }}</td>
                                <td class="px-3 py-2">{{ $it->is_organic_practitioner ? 'Yes' : 'No' }}</td>
                                <td class="px-3 py-2">{{ $it->remarks }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
        @endforeach
        </section>
    </section>

    <!-- Parcel History -->
    @if(isset($histories) && $histories->count() > 0)
    <section>
        <div class="h-1 w-full bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 rounded"></div>
        <h4 class="mt-3 font-semibold text-emerald-900">Parcel History</h4>
        <div class="mt-3 space-y-3">
            @foreach($histories as $timestamp => $historyGroup)
            @php
                $historyId = 'history-' . str_replace([' ', ':'], ['-', ''], $timestamp) . '-' . $loop->index;
            @endphp
            <div class="border rounded-lg overflow-hidden mb-3">
                <button 
                    type="button"
                    class="history-toggle-btn w-full px-4 py-3 bg-gray-50 hover:bg-gray-100 text-left flex items-center justify-between transition-colors cursor-pointer"
                    data-history-id="{{ $historyId }}"
                    aria-expanded="false"
                    aria-controls="{{ $historyId }}"
                >
                    <div class="flex-1">
                        <div class="font-medium text-emerald-900">
                            {{ \Carbon\Carbon::parse($timestamp)->format('F j, Y g:i A') }}
                        </div>
                        <div class="text-sm text-gray-600 mt-1">
                            Changed by: {{ $historyGroup->first()->changedBy->name ?? 'Unknown' }} ({{ $historyGroup->first()->changedBy->email ?? 'N/A' }})
                        </div>
                        @if($historyGroup->first()->change_summary)
                        <div class="flex flex-wrap gap-2 mt-2">
                            @php
                                $summary = $historyGroup->first()->change_summary;
                                $changedFields = collect($summary)->pluck('field')->unique()->take(5);
                            @endphp
                            @foreach($changedFields as $field)
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-amber-100 text-amber-800">
                                {{ ucfirst(str_replace('_', ' ', $field)) }}
                            </span>
                            @endforeach
                            @if(count($summary) > 5)
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-600">
                                +{{ count($summary) - 5 }} more
                            </span>
                            @endif
                        </div>
                        @endif
                        <div class="text-xs text-gray-500 mt-2 italic">Click to view full details</div>
                    </div>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform flex-shrink-0 ml-2" id="icon-{{ $historyId }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="{{ $historyId }}" class="hidden px-4 py-4 bg-white border-t">
                    @if($historyGroup->first()->change_summary)
                    <div class="mb-4">
                        <h5 class="font-medium text-emerald-900 mb-2">Changes Summary</h5>
                        <div class="space-y-2 text-sm">
                            @foreach($historyGroup->first()->change_summary as $change)
                            <div class="flex items-start gap-2 p-2 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">{{ ucfirst(str_replace('_', ' ', $change['field'])) }}:</span>
                                <span class="text-red-600 line-through">{{ $change['old'] ?? 'N/A' }}</span>
                                <span class="text-gray-400">→</span>
                                <span class="text-green-600 font-medium">{{ $change['new'] ?? 'N/A' }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <h5 class="font-medium text-emerald-900 mb-3">Previous Parcel Data (Complete Snapshot)</h5>
                    <div class="space-y-3">
                        @foreach($historyGroup as $history)
                        <div class="p-3 rounded border border-gray-200 bg-gray-50">
                            <div class="font-medium text-emerald-900">Parcel #{{ $loop->iteration }}</div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 text-sm mt-2">
                                <div><span class="text-emerald-700">Barangay:</span> {{ $history->barangay ?? 'N/A' }}</div>
                                <div><span class="text-emerald-700">Municipality:</span> {{ $history->municipality ?? 'N/A' }}</div>
                                <div><span class="text-emerald-700">Total Area (ha):</span> {{ $history->total_farm_area_ha ?? 'N/A' }}</div>
                                <div><span class="text-emerald-700">Ownership Document No:</span> {{ $history->ownership_document_no ?? 'N/A' }}</div>
                                <div><span class="text-emerald-700">Ownership Type:</span> {{ $history->ownership_type ? ucfirst(str_replace('_',' ',$history->ownership_type)) : 'N/A' }}</div>
                                <div><span class="text-emerald-700">Land Owner Name:</span> {{ $history->land_owner_name ?? 'N/A' }}</div>
                                @if($history->ownership_other_specify)
                                <div><span class="text-emerald-700">Ownership Other:</span> {{ $history->ownership_other_specify }}</div>
                                @endif
                                <div><span class="text-emerald-700">Within Ancestral Domain:</span> {{ $history->within_ancestral_domain ? 'Yes' : 'No' }}</div>
                                <div><span class="text-emerald-700">Agrarian Reform Beneficiary:</span> {{ $history->is_agrarian_reform_beneficiary ? 'Yes' : 'No' }}</div>
                                <div><span class="text-emerald-700">Crop Commodity:</span> {{ $history->crop_commodity ?? 'N/A' }}</div>
                                <div><span class="text-emerald-700">Livestock/Poultry Type:</span> {{ $history->livestock_poultry_type ?? 'N/A' }}</div>
                                <div><span class="text-emerald-700">Size (ha):</span> {{ $history->size_ha ?? 'N/A' }}</div>
                                <div><span class="text-emerald-700">Number of Head:</span> {{ $history->num_of_head ?? 'N/A' }}</div>
                                <div><span class="text-emerald-700">Farm Type:</span> {{ $history->farm_type ?? 'N/A' }}</div>
                                <div><span class="text-emerald-700">Organic Practitioner:</span> {{ $history->is_organic_practitioner ? 'Yes' : 'No' }}</div>
                                @if($history->remarks)
                                <div class="md:col-span-3"><span class="text-emerald-700">Remarks:</span> {{ $history->remarks }}</div>
                                @endif
                            </div>
                            @if($history->itemHistories->count())
                            <div class="mt-3">
                                <div class="text-emerald-900 font-medium mb-1">Items</div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full text-sm">
                                        <thead class="bg-emerald-50/70 text-emerald-900">
                                            <tr>
                                                <th class="px-3 py-2 text-left">Kind</th>
                                                <th class="px-3 py-2 text-left">Name</th>
                                                <th class="px-3 py-2 text-left">Size (ha)</th>
                                                <th class="px-3 py-2 text-left"># Head</th>
                                                <th class="px-3 py-2 text-left">Farm Type</th>
                                                <th class="px-3 py-2 text-left">Organic</th>
                                                <th class="px-3 py-2 text-left">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y">
                                            @foreach($history->itemHistories as $it)
                                            <tr>
                                                <td class="px-3 py-2">{{ ucfirst($it->kind) }}</td>
                                                <td class="px-3 py-2">{{ $it->name }}</td>
                                                <td class="px-3 py-2">{{ $it->size_ha ?? 'N/A' }}</td>
                                                <td class="px-3 py-2">{{ $it->num_of_head ?? 'N/A' }}</td>
                                                <td class="px-3 py-2">{{ $it->farm_type ?? 'N/A' }}</td>
                                                <td class="px-3 py-2">{{ $it->is_organic_practitioner ? 'Yes' : 'No' }}</td>
                                                <td class="px-3 py-2">{{ $it->remarks ?? 'N/A' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>