<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Enrollment Form - {{ $enrollment->surname }}, {{ $enrollment->first_name }}</title>
    <style>
        /* Increased page margins for proper padding from paper edges */
        @page {
            /* margin: 25mm 25mm 20mm 25mm; */
            /* top right bottom left */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Improved typography with Georgia for headings and Helvetica for body */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            line-height: 1.6;
            color: #1f2937;
            padding: 10mm;
        }

        /* Enhanced header typography with Georgia serif font */
        .header {
            position: relative;
            margin-bottom: 28px;
            padding-bottom: 18px;
            border-bottom: 4px solid #065f46;
            min-height: 210px;
            /* Adjusted for 2x2 inch photo */
        }

        .header-text {
            text-align: center;
            margin-right: 210px;
            /* Adjusted for 2x2 inch photo */
        }

        .header h1 {
            font-family: 'Georgia', 'Times New Roman', serif;
            font-size: 22pt;
            color: #065f46;
            margin-bottom: 8px;
            font-weight: bold;
            letter-spacing: 0.8px;
            line-height: 1.3;
        }

        .header .subtitle {
            font-family: 'Georgia', 'Times New Roman', serif;
            font-size: 12pt;
            color: #374151;
            font-weight: 600;
            margin-bottom: 4px;
            letter-spacing: 0.3px;
        }

        .header .form-type {
            font-size: 9.5pt;
            color: #6b7280;
            margin-top: 6px;
            font-style: italic;
            letter-spacing: 0.2px;
        }

        /* Improved section spacing and typography */
        .section {
            margin-bottom: 24px;
            page-break-inside: avoid;
        }

        .section-title {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: #065f46;
            color: white;
            padding: 10px 14px;
            font-size: 11.5pt;
            font-weight: bold;
            margin-bottom: 14px;
            border-radius: 2px;
            letter-spacing: 0.5px;
        }

        .personal-info-wrapper {
            position: relative;
            min-height: 140px;
        }

        .photo-container {
            z-index: 100;
            position: absolute;
            top: 0;
            right: 0;
            text-align: center;
            width: 2in;
            /* 2 inches at 96 DPI */
        }

        .rsbsa-badge {
            background: #ecfdf5;
            border: 2px solid #065f46;
            color: #065f46;
            padding: 7px 11px;
            font-size: 9pt;
            font-weight: bold;
            margin-bottom: 10px;
            border-radius: 3px;
            word-wrap: break-word;
            letter-spacing: 0.3px;
        }

        .photo {
            width: 192px;
            /* 2 inches at 96 DPI */
            height: 192px;
            /* 2 inches at 96 DPI */
            object-fit: cover;
            object-position: center;
            border: 3px solid #065f46;
            border-radius: 4px;
            display: block;
        }

        .photo-placeholder {
            width: 192px;
            /* 2 inches at 96 DPI */
            height: 192px;
            /* 2 inches at 96 DPI */
            background: #f3f4f6;
            border: 3px dashed #d1d5db;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-size: 9pt;
            text-align: center;
            padding: 10px;
        }

        .info-content {
            margin-right: 145px;
        }

        /* Enhanced info grid typography with better spacing */
        .info-grid {
            width: 100%;
        }

        .info-row {
            margin-bottom: 10px;
            line-height: 1.7;
        }

        .info-label {
            display: inline-block;
            width: 170px;
            font-weight: 600;
            color: #065f46;
            vertical-align: top;
            letter-spacing: 0.2px;
        }

        .info-value {
            display: inline;
            color: #374151;
            line-height: 1.7;
        }

        /* Improved badge typography */
        .badge {
            display: inline-block;
            padding: 5px 11px;
            background: #d1fae5;
            color: #065f46;
            border-radius: 3px;
            font-size: 9pt;
            font-weight: 600;
            margin-right: 6px;
            margin-bottom: 4px;
            white-space: nowrap;
            letter-spacing: 0.2px;
        }

        .badge-primary {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        /* Enhanced parcel card spacing and typography */
        .parcel-card {
            border: 2px solid #e5e7eb;
            padding: 14px;
            margin-bottom: 14px;
            background: #f9fafb;
            border-radius: 4px;
            page-break-inside: avoid;
        }

        .parcel-header {
            font-family: 'Georgia', 'Times New Roman', serif;
            font-weight: bold;
            color: #065f46;
            margin-bottom: 10px;
            font-size: 11pt;
            padding-bottom: 8px;
            border-bottom: 2px solid #d1fae5;
            letter-spacing: 0.3px;
        }

        .parcel-item {
            border-left: 4px solid #10b981;
            padding: 10px 12px;
            margin: 10px 0;
            background: white;
            border-radius: 2px;
            font-size: 9.5pt;
            line-height: 1.6;
        }

        .parcel-item strong {
            color: #065f46;
            font-size: 10pt;
            font-weight: 600;
            letter-spacing: 0.2px;
        }

        .parcel-item em {
            font-size: 9pt;
            color: #6b7280;
            font-style: italic;
            line-height: 1.5;
        }

        .parcel-meta {
            font-size: 9.5pt;
            color: #6b7280;
            margin-top: 8px;
        }

        /* Improved address block line height */
        .address-block {
            line-height: 1.8;
            color: #374151;
        }

        /* Enhanced income display typography */
        .income-item {
            display: inline-block;
            margin-right: 24px;
            white-space: nowrap;
        }

        .income-label {
            font-weight: 600;
            color: #065f46;
            letter-spacing: 0.2px;
        }

        .income-value {
            font-weight: bold;
            color: #1f2937;
            letter-spacing: 0.3px;
        }

        /* Improved footer spacing and typography */
        .footer {
            margin-top: 36px;
            padding-top: 18px;
            border-top: 3px solid #e5e7eb;
            text-align: center;
            font-size: 9pt;
            color: #6b7280;
            line-height: 1.6;
        }

        .footer strong {
            font-family: 'Georgia', 'Times New Roman', serif;
            color: #065f46;
            font-size: 10pt;
            letter-spacing: 0.3px;
        }

        .footer p {
            margin: 4px 0;
        }

        .text-muted {
            color: #6b7280;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .mb-small {
            margin-bottom: 6px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <!-- Photo and RSBSA (Right Side) -->
        <div class="photo-container">
            @if($enrollment->rsbsa_reference_number)
            <div class="rsbsa-badge">
                RSBSA<br>{{ $enrollment->rsbsa_reference_number }}
            </div>
            @endif

            @if($enrollment->photo_path)
            <img src="{{ public_path('storage/' . $enrollment->photo_path) }}" class="photo" alt="Enrollee Photo">
            @else
            <div class="photo-placeholder">No Photo Available</div>
            @endif
        </div>

        <div class="header-text">
            <h1>REGISTRY SYSTEM FOR BASIC SECTORS IN AGRICULTURE</h1>
            <p class="subtitle">Department of Agriculture - Claveria, Cagayan</p>
            <p class="form-type">Enrollment Form</p>
        </div>

    </div>

    <!-- Personal Information Section -->
    <div class="section">
        <div class="section-title">PERSONAL INFORMATION</div>

        <div class="info-content">
            <div class="info-grid">
                <div class="info-row">
                    <span class="info-label">Full Name:</span>
                    <span class="info-value">{{ $enrollment->surname }}, {{ $enrollment->first_name }} {{ $enrollment->middle_name }} {{ $enrollment->extension_name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Sex:</span>
                    <span class="info-value">{{ ucfirst($enrollment->sex) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Date of Birth:</span>
                    <span class="info-value">{{ $enrollment->date_of_birth ? $enrollment->date_of_birth->format('F d, Y') : 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Place of Birth:</span>
                    <span class="info-value">{{ $enrollment->place_of_birth ?? 'N/A' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Address Section -->
    <div class="section">
        <div class="section-title">ADDRESS & CONTACT INFORMATION</div>
        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Complete Address:</span>
                <span class="info-value">
                    <div class="address-block">
                        {{ $enrollment->address_house_lot }} {{ $enrollment->address_street }}<br>
                        {{ $enrollment->address_barangay }}, {{ $enrollment->address_municipality_city }}<br>
                        {{ $enrollment->address_province }}, {{ $enrollment->address_region }}
                    </div>
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Mobile Number:</span>
                <span class="info-value">{{ $enrollment->mobile_number ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Landline:</span>
                <span class="info-value">{{ $enrollment->landline_number ?? 'N/A' }}</span>
            </div>
        </div>
    </div>

    <!-- Personal Details Section -->
    <div class="section">
        <div class="section-title">PERSONAL DETAILS</div>
        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Highest Education:</span>
                <span class="info-value">{{ $enrollment->highest_formal_education ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Religion:</span>
                <span class="info-value">{{ $enrollment->religion ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Civil Status:</span>
                <span class="info-value">{{ ucfirst($enrollment->civil_status ?? 'N/A') }}</span>
            </div>
            @if($enrollment->name_of_spouse)
            <div class="info-row">
                <span class="info-label">Spouse Name:</span>
                <span class="info-value">{{ $enrollment->name_of_spouse }}</span>
            </div>
            @endif
            <div class="info-row">
                <span class="info-label">Mother's Maiden Name:</span>
                <span class="info-value">{{ $enrollment->mothers_maiden_name ?? 'N/A' }}</span>
            </div>
        </div>
    </div>

    <!-- Household Information Section -->
    <div class="section">
        <div class="section-title">HOUSEHOLD INFORMATION</div>
        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Household Head:</span>
                <span class="info-value">
                    @if($enrollment->household_head)
                    <span class="badge badge-success">YES</span> This person is the household head
                    @else
                    {{ $enrollment->household_head_name ?? 'N/A' }}
                    @if($enrollment->relationship_to_head)
                    ({{ $enrollment->relationship_to_head }})
                    @endif
                    @endif
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Household Members:</span>
                <span class="info-value">
                    <strong>Total:</strong> {{ $enrollment->household_members_total }},
                    <strong>Male:</strong> {{ $enrollment->household_members_male }},
                    <strong>Female:</strong> {{ $enrollment->household_members_female }}
                </span>
            </div>
            @if($enrollment->is_pwd || $enrollment->is_four_ps_beneficiary || $enrollment->is_indigenous_group_member)
            <div class="info-row">
                <span class="info-label">Special Status:</span>
                <span class="info-value">
                    @if($enrollment->is_pwd) <span class="badge badge-primary">PWD</span> @endif
                    @if($enrollment->is_four_ps_beneficiary) <span class="badge badge-primary">4P's Beneficiary</span> @endif
                    @if($enrollment->is_indigenous_group_member) <span class="badge badge-primary">{{ $enrollment->indigenous_group_specify }}</span> @endif
                </span>
            </div>
            @endif
            @if($enrollment->has_government_id)
            <div class="info-row">
                <span class="info-label">Government ID:</span>
                <span class="info-value">{{ $enrollment->government_id_type }} - {{ $enrollment->government_id_number }}</span>
            </div>
            @endif
        </div>
    </div>

    <!-- Emergency Contact Section -->
    <div class="section">
        <div class="section-title">EMERGENCY CONTACT</div>
        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Contact Person:</span>
                <span class="info-value">{{ $enrollment->emergency_contact_name ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Contact Number:</span>
                <span class="info-value">{{ $enrollment->emergency_contact_number ?? 'N/A' }}</span>
            </div>
        </div>
    </div>

    <!-- Livelihood & Farm Profile Section -->
    <div class="section">
        <div class="section-title">LIVELIHOOD & FARM PROFILE</div>
        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Main Livelihood:</span>
                <span class="info-value">
                    <span class="badge badge-success text-uppercase">{{ str_replace('_', ' ', $enrollment->main_livelihood) }}</span>
                </span>
            </div>

            @if($enrollment->main_livelihood === 'farmer')
            @if($enrollment->farming_activities && count($enrollment->farming_activities) > 0)
            <div class="info-row">
                <span class="info-label">Farming Activities:</span>
                <span class="info-value">
                    @foreach($enrollment->farming_activities as $activity)
                    <span class="badge badge-warning">{{ ucfirst($activity) }}</span>
                    @endforeach
                </span>
            </div>
            @endif

            @if($enrollment->other_crop_specify)
            <div class="info-row">
                <span class="info-label">Other Crops:</span>
                <span class="info-value">{{ $enrollment->other_crop_specify }}</span>
            </div>
            @endif

            @if($enrollment->livestock_type_specify)
            <div class="info-row">
                <span class="info-label">Livestock Types:</span>
                <span class="info-value">{{ $enrollment->livestock_type_specify }}</span>
            </div>
            @endif

            @if($enrollment->poultry_type_specify)
            <div class="info-row">
                <span class="info-label">Poultry Types:</span>
                <span class="info-value">{{ $enrollment->poultry_type_specify }}</span>
            </div>
            @endif
            @endif

            <div class="info-row">
                <span class="info-label">Gross Annual Income:</span>
                <span class="info-value">
                    <div class="income-item">
                        <span class="income-label">Farming:</span>
                        <span class="income-value">₱{{ number_format($enrollment->gross_income_farming ?? 0, 2) }}</span>
                    </div>
                    <div class="income-item">
                        <span class="income-label">Non-Farming:</span>
                        <span class="income-value">₱{{ number_format($enrollment->gross_income_non_farming ?? 0, 2) }}</span>
                    </div>
                </span>
            </div>
        </div>
    </div>

    <!-- Farm Parcels Section -->
    @if($enrollment->farmParcels && $enrollment->farmParcels->count() > 0)
    <div class="section">
        <div class="section-title">FARM PARCELS ({{ $enrollment->farmParcels->count() }} Total)</div>

        @foreach($enrollment->farmParcels as $parcel)
        <div class="parcel-card">
            <div class="parcel-header">
                Parcel #{{ $loop->iteration }}: {{ $parcel->barangay }}, {{ $parcel->municipality }}
            </div>

            <div class="info-grid">
                <div class="info-row">
                    <span class="info-label" style="width: 140px;">Total Farm Area:</span>
                    <span class="info-value"><strong>{{ $parcel->total_farm_area_ha }} hectares</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label" style="width: 140px;">Ownership Type:</span>
                    <span class="info-value">{{ ucfirst(str_replace('_', ' ', $parcel->ownership_type ?? 'N/A')) }}</span>
                </div>
                @if($parcel->ownership_document_no)
                <div class="info-row">
                    <span class="info-label" style="width: 140px;">Document Number:</span>
                    <span class="info-value">{{ $parcel->ownership_document_no }}</span>
                </div>
                @endif
            </div>

            @if($parcel->items && $parcel->items->count() > 0)
            <div style="margin-top: 10px;">
                <strong style="font-size: 9.5pt; color: #065f46;">Crops & Commodities:</strong>
            </div>
            @foreach($parcel->items as $item)
            <div class="parcel-item">
                <strong>{{ $item->name }}</strong>
                <span class="text-muted">({{ ucfirst($item->kind) }})</span>

                @if($item->size_ha || $item->num_of_head || $item->farm_type || $item->is_organic_practitioner)
                <div class="parcel-meta">
                    @if($item->size_ha)
                    <span class="badge">{{ $item->size_ha }} ha</span>
                    @endif
                    @if($item->num_of_head && $item->kind !== 'crop')
                    <span class="badge">{{ $item->num_of_head }} heads</span>
                    @endif
                    @if($item->farm_type)
                    <span class="badge badge-warning">{{ $item->farm_type }}</span>
                    @endif
                    @if($item->is_organic_practitioner)
                    <span class="badge badge-success">Organic Practitioner</span>
                    @endif
                </div>
                @endif

                @if($item->remarks)
                <div style="margin-top: 4px;">
                    <em>{{ $item->remarks }}</em>
                </div>
                @endif
            </div>
            @endforeach
            @endif
        </div>
        @endforeach
    </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p><strong>Department of Agriculture - Claveria, Cagayan</strong></p>
        <p>Registry System for Basic Sectors in Agriculture (RSBSA)</p>
        <p>Document generated on {{ now()->format('F d, Y \a\t g:i A') }}</p>
    </div>
</body>

</html>