<table>
    <thead>
        <tr>
            <td colspan="2" rowspan="3" width="100" height="80" style="vertical-align: top;">&nbsp;</td>
            <td colspan="4" style="background-color: #f8f9fa; font-weight: bold; font-size: 9pt; color: #1a5f3f;">Republic of the Philippines</td>
            <td rowspan="3" width="120" height="120" style="vertical-align: top; text-align: center;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" style="background-color: #f8f9fa; font-weight: bold; font-size: 12pt; color: #1a5f3f;">Registry System for Basic Sectors in Agriculture</td>
        </tr>
        <tr>
            <td colspan="4" style="background-color: #f8f9fa; font-size: 9pt;">Department of Agriculture - Claveria, Cagayan</td>
        </tr>
        <tr>
            <td colspan="5" style="font-size: 8pt; font-style: italic; color: #666;">Farmer/Fisherfolk Enrollment Form</td>
            <td colspan="2" style="text-align: right;">
                @if($enrollment->rsbsa_reference_number)
                <span style="background-color: #1a5f3f; color: white; padding: 4px 8px; font-weight: bold;">RSBSA No: {{ $enrollment->rsbsa_reference_number }}</span>
                @endif
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="7" bgcolor="#1a5f3f" style="color: white; font-weight: bold; padding: 6px;">I. Personal Information</td>
        </tr>
        <tr>
            <td style="font-weight: bold; width: 140px;">Full Name:</td>
            <td colspan="6">{{ $enrollment->surname }}, {{ $enrollment->first_name }} {{ $enrollment->middle_name }} {{ $enrollment->extension_name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Sex:</td>
            <td>{{ ucfirst($enrollment->sex) }}</td>
            <td style="font-weight: bold;">Date of Birth:</td>
            <td>{{ $enrollment->date_of_birth ? $enrollment->date_of_birth->format('F d, Y') : 'N/A' }}</td>
            <td style="font-weight: bold;">Place of Birth:</td>
            <td colspan="2">{{ $enrollment->place_of_birth ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td colspan="7" bgcolor="#1a5f3f" style="color: white; font-weight: bold; padding: 6px;">II. Address &amp; Contact Information</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Complete Address:</td>
            <td colspan="6">{{ $enrollment->address_house_lot }} {{ $enrollment->address_street }}, {{ $enrollment->address_barangay }}, {{ $enrollment->address_municipality_city }}, {{ $enrollment->address_province }}, {{ $enrollment->address_region }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Mobile:</td>
            <td>{{ $enrollment->mobile_number ?? 'N/A' }}</td>
            <td style="font-weight: bold;">Landline:</td>
            <td colspan="4">{{ $enrollment->landline_number ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td colspan="7" bgcolor="#1a5f3f" style="color: white; font-weight: bold; padding: 6px;">III. Personal Details</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Education:</td>
            <td>{{ $enrollment->highest_formal_education ?? 'N/A' }}</td>
            <td style="font-weight: bold;">Religion:</td>
            <td>{{ $enrollment->religion ?? 'N/A' }}</td>
            <td style="font-weight: bold;">Civil Status:</td>
            <td colspan="2">{{ ucfirst($enrollment->civil_status ?? 'N/A') }}</td>
        </tr>
        @if($enrollment->name_of_spouse)
        <tr>
            <td style="font-weight: bold;">Spouse Name:</td>
            <td colspan="6">{{ $enrollment->name_of_spouse }}</td>
        </tr>
        @endif
        <tr>
            <td style="font-weight: bold;">Mother's Maiden Name:</td>
            <td colspan="6">{{ $enrollment->mothers_maiden_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td colspan="7" bgcolor="#1a5f3f" style="color: white; font-weight: bold; padding: 6px;">IV. Household Information</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Household Head:</td>
            <td colspan="6">
                @if($enrollment->household_head)
                YES - This person is the household head
                @else
                {{ $enrollment->household_head_name ?? 'N/A' }}@if($enrollment->relationship_to_head) ({{ $enrollment->relationship_to_head }})@endif
                @endif
            </td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Total Members:</td>
            <td>{{ $enrollment->household_members_total }}</td>
            <td style="font-weight: bold;">Male:</td>
            <td>{{ $enrollment->household_members_male }}</td>
            <td style="font-weight: bold;">Female:</td>
            <td colspan="2">{{ $enrollment->household_members_female }}</td>
        </tr>
        @if($enrollment->is_pwd || $enrollment->is_four_ps_beneficiary || $enrollment->is_indigenous_group_member)
        <tr>
            <td style="font-weight: bold;">Special Status:</td>
            <td colspan="6">
                @if($enrollment->is_pwd) PWD @endif
                @if($enrollment->is_four_ps_beneficiary) 4P's Beneficiary @endif
                @if($enrollment->is_indigenous_group_member) {{ $enrollment->indigenous_group_specify }} @endif
            </td>
        </tr>
        @endif
        @if($enrollment->has_government_id)
        <tr>
            <td style="font-weight: bold;">Government ID:</td>
            <td colspan="6">{{ $enrollment->government_id_type }} - {{ $enrollment->government_id_number }}</td>
        </tr>
        @endif
        <tr>
            <td colspan="7" bgcolor="#1a5f3f" style="color: white; font-weight: bold; padding: 6px;">V. Emergency Contact</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Contact Person:</td>
            <td colspan="3">{{ $enrollment->emergency_contact_name ?? 'N/A' }}</td>
            <td style="font-weight: bold;">Contact Number:</td>
            <td colspan="2">{{ $enrollment->emergency_contact_number ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td colspan="7" bgcolor="#1a5f3f" style="color: white; font-weight: bold; padding: 6px;">VI. Livelihood &amp; Farm Profile</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Main Livelihood:</td>
            <td colspan="6">{{ str_replace('_', ' ', $enrollment->main_livelihood) }}</td>
        </tr>
        @if($enrollment->main_livelihood === 'farmer' && $enrollment->farming_activities && count($enrollment->farming_activities) > 0)
        <tr>
            <td style="font-weight: bold;">Farming Activities:</td>
            <td colspan="6">{{ implode(', ', array_map('ucfirst', $enrollment->farming_activities)) }}</td>
        </tr>
        @endif
        @if($enrollment->other_crop_specify)
        <tr>
            <td style="font-weight: bold;">Other Crops:</td>
            <td colspan="6">{{ $enrollment->other_crop_specify }}</td>
        </tr>
        @endif
        @if($enrollment->livestock_type_specify)
        <tr>
            <td style="font-weight: bold;">Livestock Types:</td>
            <td colspan="6">{{ $enrollment->livestock_type_specify }}</td>
        </tr>
        @endif
        @if($enrollment->poultry_type_specify)
        <tr>
            <td style="font-weight: bold;">Poultry Types:</td>
            <td colspan="6">{{ $enrollment->poultry_type_specify }}</td>
        </tr>
        @endif
        <tr>
            <td colspan="2" style="font-weight: bold; background-color: #f8f9fa;">Farming Income</td>
            <td colspan="2" style="font-weight: bold; color: #1a5f3f;">₱{{ number_format($enrollment->gross_income_farming ?? 0, 2) }}</td>
            <td style="font-weight: bold; background-color: #f8f9fa;">Non-Farming Income</td>
            <td colspan="2" style="font-weight: bold; color: #1a5f3f;">₱{{ number_format($enrollment->gross_income_non_farming ?? 0, 2) }}</td>
        </tr>
        @if($enrollment->farmParcels && $enrollment->farmParcels->count() > 0)
        <tr>
            <td colspan="7" bgcolor="#1a5f3f" style="color: white; font-weight: bold; padding: 6px;">VII. Farm Parcels ({{ $enrollment->farmParcels->count() }} Total)</td>
        </tr>
        @foreach($enrollment->farmParcels as $parcel)
        <tr>
            <td colspan="7" style="font-weight: bold; background-color: #f5f5f5; color: #1a5f3f;">Parcel #{{ $loop->iteration }}: {{ $parcel->barangay }}, {{ $parcel->municipality }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Total Farm Area:</td>
            <td>{{ $parcel->total_farm_area_ha }} hectares</td>
            <td style="font-weight: bold;">Ownership:</td>
            <td>{{ ucfirst(str_replace('_', ' ', $parcel->ownership_type ?? 'N/A')) }}</td>
            @if($parcel->ownership_document_no)
            <td style="font-weight: bold;">Document No:</td>
            <td colspan="2">{{ $parcel->ownership_document_no }}</td>
            @else
            <td colspan="3"></td>
            @endif
        </tr>
        @if($parcel->items && $parcel->items->count() > 0)
        @foreach($parcel->items as $item)
        <tr>
            <td style="font-weight: bold; color: #1a5f3f;">{{ $item->name }}</td>
            <td colspan="6">({{ ucfirst($item->kind) }}) @if($item->size_ha){{ $item->size_ha }} ha @endif @if($item->num_of_head && $item->kind !== 'crop'){{ $item->num_of_head }} heads @endif @if($item->farm_type){{ $item->farm_type }} @endif @if($item->is_organic_practitioner)Organic Practitioner @endif @if($item->remarks) - {{ $item->remarks }}@endif</td>
        </tr>
        @endforeach
        @endif
        @endforeach
        @endif
        <tr>
            <td colspan="7" style="border-top: 2px solid #1a5f3f; padding-top: 12px; text-align: center; font-size: 8pt; color: #666;">
                <strong style="color: #1a5f3f;">Department of Agriculture - Claveria, Cagayan</strong><br>
                Registry System for Basic Sectors in Agriculture (RSBSA)<br>
                Document generated on {{ now()->format('F d, Y') }} at {{ now()->format('g:i A') }}
            </td>
        </tr>
    </tbody>
</table>
