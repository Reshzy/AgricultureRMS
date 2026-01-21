<div class="space-y-6">
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
    <!-- Personal Info -->
    <section>
        <div class="h-1 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-sky-500 rounded"></div>
        <h4 class="mt-3 font-semibold text-emerald-900">Personal Information</h4>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm mt-2">
            <div><span class="text-emerald-700">Name:</span> {{ $enrollment->surname }}, {{ $enrollment->first_name }}</div>
            <div><span class="text-emerald-700">Sex:</span> {{ ucfirst($enrollment->sex) }}</div>
            <div><span class="text-emerald-700">DOB:</span> {{ $enrollment->date_of_birth?->format('Y-m-d') }}</div>
            <div class="md:col-span-3"><span class="text-emerald-700">Place of Birth:</span> {{ $enrollment->place_of_birth }}</div>
        </div>
    </section>

    <!-- Address -->
    <section>
        <div class="h-1 w-full bg-gradient-to-r from-sky-500 via-indigo-500 to-fuchsia-500 rounded"></div>
        <h4 class="mt-3 font-semibold text-emerald-900">Address</h4>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-3 text-sm mt-2">
            <div class="md:col-span-2"><span class="text-emerald-700">Street:</span> {{ $enrollment->address_house_lot }} {{ $enrollment->address_street }}</div>
            <div><span class="text-emerald-700">Barangay:</span> {{ $enrollment->address_barangay }}</div>
            <div><span class="text-emerald-700">City/Municipality:</span> {{ $enrollment->address_municipality_city }}</div>
            <div><span class="text-emerald-700">Province:</span> {{ $enrollment->address_province }}</div>
            <div><span class="text-emerald-700">Region:</span> {{ $enrollment->address_region }}</div>
        </div>
    </section>

    <!-- Farm Profile -->
    <section>
        <div class="h-1 w-full bg-gradient-to-r from-amber-500 via-orange-500 to-rose-500 rounded"></div>
        <h4 class="mt-3 font-semibold text-emerald-900">Farm Profile</h4>
        <div class="text-sm mt-2">
            <div><span class="text-emerald-700">Livelihood:</span> {{ ucfirst(str_replace('_',' ', $enrollment->main_livelihood)) }}</div>
        </div>
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