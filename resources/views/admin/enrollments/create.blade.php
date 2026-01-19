@extends('layouts.admin')
@section('title', 'New Enrollment • Admin')
@section('header', 'New Enrollment')
@section('content')

<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white/90 overflow-hidden shadow-xl sm:rounded-2xl p-6 space-y-10 border border-emerald-900/5">
            <form method="POST" action="{{ route('admin.enrollments.store') }}" enctype="multipart/form-data" class="space-y-6" id="enrollmentForm">
                @csrf
                <div>
                    <div class="h-1 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-sky-500 rounded"></div>
                    <h3 class="mt-3 text-lg font-semibold text-emerald-900">Part I: Personal Information</h3>
                </div>

                <div>
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        <div class="flex-1">
                            <x-label value="RSBSA Reference Number" />
                            <x-input name="rsbsa_reference_number" class="mt-1 w-full js-rsbsa" maxlength="17" placeholder="00-00-00-000-000000" />
                        </div>
                        <div>
                            <x-label value="2x2 Picture" />
                            <input type="file" name="photo" accept="image/*" class="mt-1 block" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div><x-label value="Surname" /><x-input name="surname" class="mt-1 w-full js-clean" required /></div>
                    <div><x-label value="First Name" /><x-input name="first_name" class="mt-1 w-full js-clean" required /></div>
                    <div><x-label value="Middle Name" /><x-input name="middle_name" class="mt-1 w-full js-clean" /></div>
                    <div><x-label value="Extension" /><x-input name="extension_name" class="mt-1 w-full js-clean" /></div>
                </div>

                <div>
                    <x-label value="Sex" />
                    <div class="flex gap-6 mt-1">
                        <label class="inline-flex items-center"><input type="radio" name="sex" value="male" required class="text-emerald-600"><span class="ml-2">Male</span></label>
                        <label class="inline-flex items-center"><input type="radio" name="sex" value="female" class="text-emerald-600"><span class="ml-2">Female</span></label>
                    </div>
                </div>

                <div>
                    <x-label value="Address" />
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-1 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
                        <x-input name="address_house_lot" class="js-clean" placeholder="House/lot/bldg.no./purok" />
                        <div class="md:col-span-2">
                            <x-label value="Street/Sitio/Subdv." />
                            <x-input name="address_street" class="js-clean w-full" placeholder="Street/Sitio/Subdv." list="streetDatalist" />
                            <datalist id="streetDatalist"></datalist>
                        </div>
                        <div>
                            <x-label value="Region" />
                            <select id="psgcRegion" class="w-full border-gray-300 rounded-md opacity-60" disabled></select>
                            <input type="hidden" name="address_region" />
                        </div>
                        <div>
                            <x-label value="Province" />
                            <select id="psgcProvince" class="w-full border-gray-300 rounded-md opacity-60" disabled></select>
                            <input type="hidden" name="address_province" />
                        </div>
                        <div>
                            <x-label value="Municipality/City" />
                            <select id="psgcCityMun" class="w-full border-gray-300 rounded-md opacity-60" disabled></select>
                            <input type="hidden" name="address_municipality_city" />
                        </div>
                        <div>
                            <x-label value="Barangay" />
                            <select id="psgcBarangay" class="w-full border-gray-300 rounded-md"></select>
                            <input type="hidden" name="address_barangay" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div><x-label value="Mobile Number" /><x-input name="mobile_number" class="mt-1 w-full js-mobile" maxlength="14" placeholder="0912 345 6789" /></div>
                    <div><x-label value="Landline Number" /><x-input name="landline_number" class="mt-1 w-full" /></div>
                    <div><x-label value="Date of Birth" /><x-input type="date" name="date_of_birth" class="mt-1 w-full" /></div>
                </div>
                <div>
                    <x-label value="Place of Birth" />
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-1">
                        <div>
                            <x-label value="Region" />
                            <select id="pobRegion" class="w-full border-gray-300 rounded-md"></select>
                        </div>
                        <div>
                            <x-label value="Province/State" />
                            <select id="pobProvince" class="w-full border-gray-300 rounded-md"></select>
                        </div>
                        <div>
                            <x-label value="Municipality/City" />
                            <select id="pobCityMun" class="w-full border-gray-300 rounded-md"></select>
                        </div>
                        <div>
                            <x-label value="Country" />
                            <x-input id="pobCountry" class="js-clean w-full" value="Philippines" />
                        </div>
                    </div>
                    <input type="hidden" name="place_of_birth" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-label value="Highest Formal Education" />
                        <select name="highest_formal_education" class="mt-1 w-full border-gray-300 rounded-md">
                            <option value="">--</option>
                            <option>Pre-school</option>
                            <option>Elementary</option>
                            <option>High school (non-K-12)</option>
                            <option>Junior High school (K-12)</option>
                            <option>Senior High school (K-12)</option>
                            <option>College</option>
                            <option>Vocational</option>
                            <option>Post graduate</option>
                            <option>None</option>
                        </select>
                    </div>
                    <div>
                        <x-label value="Religion" />
                        <div class="flex items-center gap-4 mt-1">
                            <label class="inline-flex items-center"><input type="checkbox" class="text-emerald-600 js-religion" value="Christianity"><span class="ml-2">Christianity</span></label>
                            <label class="inline-flex items-center"><input type="checkbox" class="text-emerald-600 js-religion" value="Islam"><span class="ml-2">Islam</span></label>
                            <label class="inline-flex items-center"><input type="checkbox" id="rel_other_chk" class="text-emerald-600 js-religion" value="Others"><span class="ml-2">Others</span></label>
                        </div>
                        <x-input id="rel_other_text" class="mt-2 w-full" placeholder="Specify religion" disabled />
                        <input type="hidden" name="religion" />
                    </div>
                    <div>
                        <x-label value="Civil Status" />
                        <select name="civil_status" class="mt-1 w-full border-gray-300 rounded-md">
                            <option value="">--</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="widowed">Widowed</option>
                            <option value="separated">Separated</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><x-label value="Name of Spouse" /><x-input name="name_of_spouse" class="mt-1 w-full js-clean" placeholder="Surname, Firstname Middlename" /></div>
                    <div><x-label value="Mother's Maiden Name" /><x-input name="mothers_maiden_name" class="mt-1 w-full js-clean" placeholder="Surname, Firstname Middlename" /></div>
                </div>

                <div class="mt-4">
                    <div class="h-1 w-full bg-gradient-to-r from-sky-500 via-indigo-500 to-fuchsia-500 rounded"></div>
                    <h3 class="mt-3 text-lg font-semibold text-emerald-900">Household & IDs</h3>
                </div>

                <div>
                    <x-label value="Household" />
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-1 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
                        <label class="inline-flex items-center"><input type="checkbox" name="household_head" id="householdHeadChk" value="1" class="text-emerald-600"><span class="ml-2">Household Head</span></label>
                        <div id="householdDependentFields" class="contents md:block md:col-span-2">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-input name="household_head_name" id="householdHeadName" class="js-clean" placeholder="If no, name of household head" />
                                <x-input name="relationship_to_head" id="relationshipToHead" class="js-clean" placeholder="Relationship" />
                            </div>
                        </div>
                        <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <x-input name="household_members_total" id="membersTotal" placeholder="Total Members" />
                            <x-input name="household_members_male" id="membersMale" placeholder="No. of Male" />
                            <x-input name="household_members_female" id="membersFemale" placeholder="No. of Female" />
                        </div>
                        <p id="membersWarning" class="md:col-span-3 text-sm text-amber-600 hidden">Warning: Male + Female does not equal Total members.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="inline-flex items-center"><input type="checkbox" name="is_pwd" value="1" class="text-emerald-600"><span class="ml-2">Person with disability (PWD)</span></label>
                    <label class="inline-flex items-center"><input type="checkbox" name="is_four_ps_beneficiary" value="1" class="text-emerald-600"><span class="ml-2">4P's Beneficiary</span></label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-center gap-3">
                        <label class="inline-flex items-center"><input type="checkbox" name="is_indigenous_group_member" id="indigenousChk" value="1" class="text-emerald-600"><span class="ml-2">Member of an indigenous group</span></label>
                    </div>
                    <div class="md:col-span-2">
                        <x-input name="indigenous_group_specify" id="indigenousText" class="js-clean w-full" placeholder="If yes, specify" disabled />
                    </div>
                    <label class="inline-flex items-center"><input type="checkbox" name="has_government_id" id="govIdChk" value="1" class="text-emerald-600"><span class="ml-2">With Government ID</span></label>
                    <x-input name="government_id_type" id="govIdType" placeholder="ID Type" disabled />
                    <x-input name="government_id_number" id="govIdNumber" placeholder="ID Number" disabled />
                </div>

                <div class="mt-4">
                    <div class="h-1 w-full bg-gradient-to-r from-amber-500 via-orange-500 to-rose-500 rounded"></div>
                    <h3 class="mt-3 text-lg font-semibold text-emerald-900">Emergency Contact</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
                    <div><x-label value="Emergency Contact" /><x-input name="emergency_contact_name" class="mt-1 w-full js-clean" placeholder="Surname, Firstname Middlename" /></div>
                    <div><x-label value="Emergency Contact Number" /><x-input name="emergency_contact_number" class="mt-1 w-full" /></div>
                </div>

                <div class="mt-4">
                    <div class="h-1 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-sky-500 rounded"></div>
                    <h3 class="mt-3 text-lg font-semibold text-emerald-900">Part II: Farm Profile</h3>
                </div>
                <div>
                    <x-label value="Main livelihood" />
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-1">
                        <label class="inline-flex items-center"><input type="radio" name="main_livelihood" value="farmer" required class="text-emerald-600"><span class="ml-2">Farmer</span></label>
                        <label class="inline-flex items-center"><input type="radio" name="main_livelihood" value="farmworker" class="text-emerald-600"><span class="ml-2">Farmworker/Laborer</span></label>
                        <label class="inline-flex items-center"><input type="radio" name="main_livelihood" value="fisherfolk" class="text-emerald-600"><span class="ml-2">Fisherfolk</span></label>
                        <label class="inline-flex items-center"><input type="radio" name="main_livelihood" value="agri_youth" class="text-emerald-600"><span class="ml-2">Agri Youth</span></label>
                    </div>
                </div>

                <div id="farmersSection" class="hidden">
                    <x-label value="For Farmers" />
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-1 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
                        <label class="inline-flex items-center"><input type="checkbox" name="farming_activities[]" value="rice" class="text-emerald-600"><span class="ml-2">Rice</span></label>
                        <label class="inline-flex items-center"><input type="checkbox" name="farming_activities[]" value="corn" class="text-emerald-600"><span class="ml-2">Corn</span></label>
                    </div>
                    <div class="mt-3">
                        <x-label value="Other Crops (specify)" />
                        <div class="flex flex-wrap items-center border border-gray-300 rounded-md px-3 py-2 gap-2" id="cropChips"></div>
                        <div class="mt-2 flex gap-2"><x-input id="cropInput" placeholder="Add crop..." class="flex-1" /><x-secondary-button type="button" id="addCropBtn">Add</x-secondary-button></div>
                        <div id="cropHidden"></div>
                    </div>
                    <div class="mt-3">
                        <x-label value="Livestock (specify)" />
                        <div class="flex flex-wrap items-center border border-gray-300 rounded-md px-3 py-2 gap-2" id="livestockChips"></div>
                        <div class="mt-2 flex gap-2"><x-input id="livestockInput" placeholder="Add livestock..." class="flex-1" /><x-secondary-button type="button" id="addLivestockBtn">Add</x-secondary-button></div>
                        <div id="livestockHidden"></div>
                    </div>
                    <div class="mt-3">
                        <x-label value="Poultry (specify)" />
                        <div class="flex flex-wrap items-center border border-gray-300 rounded-md px-3 py-2 gap-2" id="poultryChips"></div>
                        <div class="mt-2 flex gap-2"><x-input id="poultryInput" placeholder="Add poultry..." class="flex-1" /><x-secondary-button type="button" id="addPoultryBtn">Add</x-secondary-button></div>
                        <div id="poultryHidden"></div>
                    </div>
                </div>

                <div id="farmworkersSection" class="hidden">
                    <x-label value="For Farmworkers" />
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-1">
                        @foreach (['Land preparation','Planting/Transplanting','Cultivation','Harvesting'] as $work)
                        <label class="inline-flex items-center"><input type="checkbox" name="farmworker_kinds_of_work[]" value="{{ $work }}" class="text-emerald-600"><span class="ml-2">{{ $work }}</span></label>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <x-label value="Others, specify" />
                        <div class="flex flex-wrap items-center border border-gray-300 rounded-md px-3 py-2 gap-2" id="fwOtherChips"></div>
                        <div class="mt-2 flex gap-2"><x-input id="fwOtherInput" placeholder="Add other work..." class="flex-1" /><x-secondary-button type="button" id="addFwOtherBtn">Add</x-secondary-button></div>
                        <div id="fwOtherHidden"></div>
                    </div>
                </div>

                <div id="fisherfolkSection" class="hidden">
                    <x-label value="For Fisherfolk" />
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-1">
                        @foreach (['Fish capture','Fish Processing','Aquaculture','Fish Vending','Gleaning'] as $f)
                        <label class="inline-flex items-center"><input type="checkbox" name="fishing_activities[]" value="{{ $f }}" class="text-emerald-600"><span class="ml-2">{{ $f }}</span></label>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <x-label value="Others, specify" />
                        <div class="flex flex-wrap items-center border border-gray-300 rounded-md px-3 py-2 gap-2" id="fishOtherChips"></div>
                        <div class="mt-2 flex gap-2"><x-input id="fishOtherInput" placeholder="Add other activity..." class="flex-1" /><x-secondary-button type="button" id="addFishOtherBtn">Add</x-secondary-button></div>
                        <div id="fishOtherHidden"></div>
                    </div>
                </div>

                <div id="agriYouthSection" class="hidden">
                    <x-label value="For Agri Youth" />
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-1">
                        @foreach ([
                        'part of a farming household',
                        'attending/attended formal agri-fishery related course',
                        'attending/attended non-formal agri-fishery related course',
                        'participated in any agricultural activity/program'
                        ] as $y)
                        <label class="inline-flex items-center"><input type="checkbox" name="agriyouth_involvements[]" value="{{ $y }}" class="text-emerald-600"><span class="ml-2">{{ $y }}</span></label>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <x-label value="Others, specify" />
                        <div class="flex flex-wrap items-center border border-gray-300 rounded-md px-3 py-2 gap-2" id="youthOtherChips"></div>
                        <div class="mt-2 flex gap-2"><x-input id="youthOtherInput" placeholder="Add involvement..." class="flex-1" /><x-secondary-button type="button" id="addYouthOtherBtn">Add</x-secondary-button></div>
                        <div id="youthOtherHidden"></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
                    <div><x-label value="Gross Annual Income (Farming)" /><x-input type="number" step="0.01" name="gross_income_farming" class="mt-1 w-full" /></div>
                    <div><x-label value="Gross Annual Income (Non-farming)" /><x-input type="number" step="0.01" name="gross_income_non_farming" class="mt-1 w-full" /></div>
                </div>

                <div>
                    <x-label value="Name of Farmers in Rotation (optional)" />
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-1">
                        <x-input name="rotation_farmers_p1" placeholder="(p1)" />
                        <x-input name="rotation_farmers_p2" placeholder="(p2)" />
                        <x-input name="rotation_farmers_p3" placeholder="(p3)" />
                    </div>
                </div>

                <div>
                    <x-label value="Farm Parcels" />
                    <div id="parcelsContainer" class="space-y-4 mt-2"></div>
                    <button type="button" id="addParcelBtn" class="mt-2 px-3 py-2 rounded-lg bg-white hover:bg-emerald-50 text-emerald-900 border">Add Parcel</button>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <x-secondary-button type="button" onclick="document.getElementById('enrollmentForm').reset()">Clear</x-secondary-button>
                    <button type="button" id="saveDraftBtn" class="px-4 py-2 rounded-md bg-amber-500 hover:bg-amber-600 text-white shadow">Save as Draft</button>
                    <x-button type="submit">Submit</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

<template id="parcelTemplate">
    <div class="p-4 border rounded-md grid grid-cols-1 md:grid-cols-3 gap-3 parcel-card">
        <div>
            <x-label value="Barangay" />
            <select class="w-full border-gray-300 rounded-md parcelBrgy"></select>
            <input type="hidden" name="parcels[INDEX][barangay]" />
        </div>
        <div>
            <x-label value="Municipality/City" />
            <select class="w-full border-gray-300 rounded-md parcelCity"></select>
            <input type="hidden" name="parcels[INDEX][municipality]" />
        </div>
        <x-input type="number" step="0.01" name="parcels[INDEX][total_farm_area_ha]" placeholder="Total Farm Area (ha)" />
        <x-input name="parcels[INDEX][ownership_document_no]" placeholder="Ownership Doc No" />
        <label class="inline-flex items-center"><input type="checkbox" name="parcels[INDEX][within_ancestral_domain]" value="1" class="text-emerald-600"><span class="ml-2">Within Ancestral Domain</span></label>
        <label class="inline-flex items-center"><input type="checkbox" name="parcels[INDEX][is_agrarian_reform_beneficiary]" value="1" class="text-emerald-600"><span class="ml-2">Agrarian Reform Beneficiary</span></label>
        <select name="parcels[INDEX][ownership_type]" class="border-gray-300 rounded-md">
            <option value="">Ownership Type</option>
            <option value="registered_owner">Registered Owner</option>
            <option value="tenant">Tenant</option>
            <option value="lessee">Lessee</option>
            <option value="others">Others</option>
        </select>
        <x-input name="parcels[INDEX][land_owner_name]" placeholder="Land Owner Name" disabled />
        <x-input name="parcels[INDEX][ownership_other_specify]" placeholder="Ownership Other (specify)" disabled />
        <div class="md:col-span-3 col-span-1">
            <x-label value="Items (Crop/Commodity/Livestock & Poultry)" />
            <div class="space-y-2 parcel-items"></div>
            <button type="button" class="addParcelItemBtn mt-2 px-3 py-2 rounded-lg bg-white hover:bg-emerald-50 text-emerald-900 border">Add Item</button>
        </div>
        <div class="flex gap-2">
            <button type="button" class="duplicateParcelBtn px-3 py-2 rounded-lg bg-white hover:bg-emerald-50 text-emerald-900 border">Duplicate</button>
            <button type="button" class="removeParcelBtn px-3 py-2 rounded-lg bg-white hover:bg-rose-50 text-rose-700 border">Remove</button>
        </div>
    </div>
</template>

<template id="parcelItemTemplate">
    <div class="p-3 border rounded parcel-item grid grid-cols-1 md:grid-cols-6 gap-2">
        <select name="parcels[PARIDX][items][ITEMIDX][kind]" class="border-gray-300 rounded-md kindSelect">
            <option value="crop">Crop/Commodity</option>
            <option value="livestock">Livestock</option>
            <option value="poultry">Poultry</option>
        </select>
        <x-input name="parcels[PARIDX][items][ITEMIDX][name]" placeholder="Name (e.g., Rice, Chicken, Cow)" />
        <x-input type="number" step="0.01" name="parcels[PARIDX][items][ITEMIDX][size_ha]" placeholder="Size (ha)" />
        <x-input type="number" name="parcels[PARIDX][items][ITEMIDX][num_of_head]" class="numOfHead" placeholder="No. of head" />
        <x-input name="parcels[PARIDX][items][ITEMIDX][farm_type]" placeholder="Farm type" />
        <div class="flex items-center gap-2">
            <label class="inline-flex items-center"><input type="checkbox" name="parcels[PARIDX][items][ITEMIDX][is_organic_practitioner]" value="1" class="text-emerald-600"><span class="ml-2">Organic Practitioner</span></label>
        </div>
        <div class="md:col-span-5">
            <x-input name="parcels[PARIDX][items][ITEMIDX][remarks]" placeholder="Remarks" />
        </div>
        <div class="flex gap-2">
            <x-secondary-button type="button" class="removeParcelItemBtn">Remove Item</x-secondary-button>
        </div>
    </div>
</template>
<style>
    /* Dim any disabled controls within this form */
    #enrollmentForm input[disabled],
    #enrollmentForm select[disabled],
    #enrollmentForm textarea[disabled] {
        opacity: 0.5;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('parcelsContainer');
        const template = document.getElementById('parcelTemplate').innerHTML;
        const addBtn = document.getElementById('addParcelBtn');
        let index = 0;
        const addParcel = () => {
            // Use regex replace for broader browser support (avoid String.replaceAll)
            const html = template.replace(/INDEX/g, String(index++));
            const wrapper = document.createElement('div');
            wrapper.innerHTML = html;
            const node = wrapper.firstElementChild;
            container.appendChild(node);
            node.querySelector('.removeParcelBtn').addEventListener('click', () => node.remove());
            setupOwnershipControls(node);
            initParcelGeography(node);
        };
        addBtn.addEventListener('click', addParcel);
        addParcel();

        // 2x2 image preview (client-side crop/resize via CSS object-cover)
        const photoInput = document.getElementById('photoInput');
        const photoPreview = document.getElementById('photoPreview');
        const photoPreviewContainer = document.getElementById('photoPreviewContainer');
        photoInput?.addEventListener('change', (e) => {
            if (e.target.files && e.target.files[0]) {
                const file = e.target.files[0];
                const reader = new FileReader();
                reader.onload = (ev) => {
                    photoPreview.src = ev.target.result;
                    photoPreviewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Input cleaning: Title Case + trim
        const toTitleCase = (str) => str.replace(/\S+/g, (w) => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).trim();
        document.querySelectorAll('.js-clean').forEach((el) => {
            el.addEventListener('blur', () => {
                el.value = toTitleCase(el.value);
            });
        });

        // Mobile number masking: 4-3-4 with spaces
        const mobile = document.querySelector('input[name="mobile_number"]');
        mobile?.addEventListener('input', () => {
            const digits = mobile.value.replace(/\D/g, '').slice(0, 11);
            let out = '';
            if (digits.length <= 4) out = digits;
            else if (digits.length <= 7) out = digits.slice(0, 4) + ' ' + digits.slice(4);
            else out = digits.slice(0, 4) + ' ' + digits.slice(4, 7) + ' ' + digits.slice(7);
            mobile.value = out;
        });

        // RSBSA reference number masking: 00-00-00-000-000000
        const rsbsa = document.querySelector('input[name="rsbsa_reference_number"]');
        rsbsa?.addEventListener('input', () => {
            const digits = rsbsa.value.replace(/\D/g, '').slice(0, 15);
            let out = '';
            if (digits.length <= 2) out = digits;
            else if (digits.length <= 4) out = digits.slice(0, 2) + '-' + digits.slice(2);
            else if (digits.length <= 6) out = digits.slice(0, 2) + '-' + digits.slice(2, 4) + '-' + digits.slice(4);
            else if (digits.length <= 9) out = digits.slice(0, 2) + '-' + digits.slice(2, 4) + '-' + digits.slice(4, 6) + '-' + digits.slice(6);
            else out = digits.slice(0, 2) + '-' + digits.slice(2, 4) + '-' + digits.slice(4, 6) + '-' + digits.slice(6, 9) + '-' + digits.slice(9);
            rsbsa.value = out;
        });

        // Place of birth combine (from PSGC-based selects + country input)
        const pobRegionSel = document.getElementById('pobRegion');
        const pobProvSel = document.getElementById('pobProvince');
        const pobCitySel = document.getElementById('pobCityMun');
        const pobCountry = document.getElementById('pobCountry');
        const pobHidden = document.querySelector('input[name="place_of_birth"]');
        const syncPob = () => {
            const parts = [
                pobCitySel?.options[pobCitySel.selectedIndex]?.text || '',
                pobProvSel?.options[pobProvSel.selectedIndex]?.text || '',
                (pobCountry?.value || 'Philippines')
            ].map(v => v.trim()).filter(Boolean).map(toTitleCase);
            pobHidden.value = parts.join(', ');
        };

        // Religion: exclusive checkboxes with others text
        const relChecks = document.querySelectorAll('.js-religion');
        const relOtherChk = document.getElementById('rel_other_chk');
        const relOtherText = document.getElementById('rel_other_text');
        const relHidden = document.querySelector('input[name="religion"]');
        const syncReligion = () => {
            let value = '';
            relChecks.forEach(chk => {
                if (chk.checked && chk !== relOtherChk) value = chk.value;
            });
            if (relOtherChk.checked) {
                relOtherText.disabled = false;
                value = relOtherText.value ? `Others: ${relOtherText.value.trim()}` : 'Others';
            } else {
                relOtherText.disabled = true;
                relOtherText.value = '';
            }
            relHidden.value = value;
        };
        relChecks.forEach(chk => chk.addEventListener('change', (e) => {
            // make behavior exclusive
            if (e.target.checked) {
                relChecks.forEach(other => {
                    if (other !== e.target) other.checked = false;
                });
            }
            syncReligion();
        }));
        relOtherText?.addEventListener('input', syncReligion);

        // Government ID toggle
        const govChk = document.getElementById('govIdChk');
        const govType = document.getElementById('govIdType');
        const govNumber = document.getElementById('govIdNumber');
        const toggleGov = () => {
            const en = govChk.checked;
            govType.disabled = !en;
            govNumber.disabled = !en;
            if (!en) {
                govType.value = '';
                govNumber.value = '';
            }
        };
        govChk?.addEventListener('change', toggleGov);
        toggleGov();

        // Livelihood sections toggle
        const sections = {
            farmer: document.getElementById('farmersSection'),
            farmworker: document.getElementById('farmworkersSection'),
            fisherfolk: document.getElementById('fisherfolkSection'),
            agri_youth: document.getElementById('agriYouthSection')
        };
        const toggleLivelihood = () => {
            const sel = document.querySelector('input[name="main_livelihood"]:checked')?.value;
            Object.entries(sections).forEach(([k, el]) => {
                if (!el) return;
                if (k === sel) el.classList.remove('hidden');
                else el.classList.add('hidden');
            });
        };
        document.querySelectorAll('input[name="main_livelihood"]').forEach(r => r.addEventListener('change', toggleLivelihood));
        toggleLivelihood();

        // Generic chips helper
        const initChips = (inputId, chipsId, hiddenId, hiddenName) => {
            const input = document.getElementById(inputId);
            const chips = document.getElementById(chipsId);
            const hidden = document.getElementById(hiddenId);
            const add = (text) => {
                const val = text.trim();
                if (!val) return;
                const chip = document.createElement('span');
                chip.className = 'px-2 py-1 bg-emerald-100 text-emerald-800 rounded-full text-sm flex items-center gap-2';
                chip.innerHTML = `${val}<button type="button" class="text-emerald-600">&times;</button>`;
                const hid = document.createElement('input');
                hid.type = 'hidden';
                hid.name = hiddenName;
                hid.value = val;
                chips.appendChild(chip);
                (hidden || chips).appendChild(hid);
                chip.querySelector('button').addEventListener('click', () => {
                    chip.remove();
                    hid.remove();
                });
            };
            return {
                input,
                chips,
                add
            };
        };

        const crop = initChips('cropInput', 'cropChips', 'cropHidden', 'other_crop_specify_items[]');
        document.getElementById('addCropBtn')?.addEventListener('click', () => {
            crop.add(crop.input.value);
            crop.input.value = '';
        });
        crop.input?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                crop.add(crop.input.value);
                crop.input.value = '';
            }
        });

        const livestock = initChips('livestockInput', 'livestockChips', 'livestockHidden', 'livestock_type_specify_items[]');
        document.getElementById('addLivestockBtn')?.addEventListener('click', () => {
            livestock.add(livestock.input.value);
            livestock.input.value = '';
        });
        livestock.input?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                livestock.add(livestock.input.value);
                livestock.input.value = '';
            }
        });

        const poultry = initChips('poultryInput', 'poultryChips', 'poultryHidden', 'poultry_type_specify_items[]');
        document.getElementById('addPoultryBtn')?.addEventListener('click', () => {
            poultry.add(poultry.input.value);
            poultry.input.value = '';
        });
        poultry.input?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                poultry.add(poultry.input.value);
                poultry.input.value = '';
            }
        });

        const fwOther = initChips('fwOtherInput', 'fwOtherChips', 'fwOtherHidden', 'farmworker_other_work_items[]');
        document.getElementById('addFwOtherBtn')?.addEventListener('click', () => {
            fwOther.add(fwOther.input.value);
            fwOther.input.value = '';
        });
        fwOther.input?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                fwOther.add(fwOther.input.value);
                fwOther.input.value = '';
            }
        });

        const fishOther = initChips('fishOtherInput', 'fishOtherChips', 'fishOtherHidden', 'fishing_other_activity_items[]');
        document.getElementById('addFishOtherBtn')?.addEventListener('click', () => {
            fishOther.add(fishOther.input.value);
            fishOther.input.value = '';
        });
        fishOther.input?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                fishOther.add(fishOther.input.value);
                fishOther.input.value = '';
            }
        });

        const youthOther = initChips('youthOtherInput', 'youthOtherChips', 'youthOtherHidden', 'agriyouth_other_involvement_items[]');
        document.getElementById('addYouthOtherBtn')?.addEventListener('click', () => {
            youthOther.add(youthOther.input.value);
            youthOther.input.value = '';
        });
        youthOther.input?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                youthOther.add(youthOther.input.value);
                youthOther.input.value = '';
            }
        });

        // Parcel duplicate
        const parseIndex = (name) => {
            const m = name.match(/^parcels\[(\d+)\]/);
            return m ? parseInt(m[1], 10) : null;
        };
        const reindexParcel = (node, newIndex) => {
            node.querySelectorAll('input, select, textarea').forEach(el => {
                if (el.name) {
                    el.name = el.name.replace(/^parcels\[\d+\]/, `parcels[${newIndex}]`);
                }
            });
        };
        container.addEventListener('click', (e) => {
            if (e.target.closest('.duplicateParcelBtn')) {
                const card = e.target.closest('.parcel-card');
                const clone = card.cloneNode(true);
                // Determine new index
                const newIdx = index++;
                reindexParcel(clone, newIdx);
                // attach handlers for buttons on clone
                clone.querySelector('.removeParcelBtn')?.addEventListener('click', () => clone.remove());
                // Reindex parcel items sequentially in clone (keep current values/states)
                const items = clone.querySelectorAll('.parcel-item');
                let k = 0;
                items.forEach(item => {
                    item.querySelectorAll('input, select, textarea').forEach(el => {
                        if (el.name) {
                            el.name = el.name.replace(/items\]\[\d+\]/, `items[${k}]`);
                        }
                    });
                    initParcelItemRow(item);
                    k++;
                });
                setupOwnershipControls(clone);
                initParcelGeography(clone);
                container.appendChild(clone);
            }
        });

        // Ownership type toggles dependent inputs within a parcel card (hoisted)
        function setupOwnershipControls(card) {
            const select = card.querySelector('select[name^="parcels["][name$="[ownership_type]"]');
            const land = card.querySelector('input[name^="parcels["][name$="[land_owner_name]"]');
            const other = card.querySelector('input[name^="parcels["][name$="[ownership_other_specify]"]');
            if (!select || !land || !other) return;
            const apply = () => {
                const v = select.value;
                const landEnable = (v === 'tenant' || v === 'lessee');
                const otherEnable = (v === 'others');
                land.disabled = !landEnable;
                other.disabled = !otherEnable;
                if (!landEnable) land.value = '';
                if (!otherEnable) other.value = '';
            };
            select.addEventListener('change', apply);
            apply();
        }

        // Initialize a parcel item row (bind kind toggle for num_of_head)
        function initParcelItemRow(node) {
            const kindSel = node.querySelector('.kindSelect');
            const numHead = node.querySelector('.numOfHead');
            if (!kindSel || !numHead) return;
            const toggleNumHead = () => {
                if (kindSel.value === 'crop') {
                    numHead.disabled = true;
                    numHead.classList.add('opacity-50');
                } else {
                    numHead.disabled = false;
                    numHead.classList.remove('opacity-50');
                }
            };
            kindSel.addEventListener('change', toggleNumHead);
            toggleNumHead();
        }

        // Add parcel item handler
        const itemTpl = document.getElementById('parcelItemTemplate').innerHTML;
        const addParcelItem = (card) => {
            const firstInput = card.querySelector('input[name^="parcels["]');
            if (!firstInput) return;
            const m = firstInput.name.match(/^parcels\[(\d+)\]/);
            const pIdx = m ? m[1] : '0';
            const itemsWrap = card.querySelector('.parcel-items');
            const nextIdx = card.querySelectorAll('.parcel-item').length;
            // Replace placeholders safely across browsers
            const html = itemTpl.replace(/PARIDX/g, String(pIdx)).replace(/ITEMIDX/g, String(nextIdx));
            const wrapper = document.createElement('div');
            wrapper.innerHTML = html;
            const node = wrapper.firstElementChild;
            itemsWrap.appendChild(node);
            initParcelItemRow(node);
        };

        container.addEventListener('click', (e) => {
            if (e.target.closest('.addParcelItemBtn')) {
                const card = e.target.closest('.parcel-card');
                addParcelItem(card);
            }
            if (e.target.closest('.removeParcelItemBtn')) {
                const row = e.target.closest('.parcel-item');
                row?.remove();
            }
        });

        // Household: toggle dependent fields if head is checked
        const headChk = document.getElementById('householdHeadChk');
        const headName = document.getElementById('householdHeadName');
        const relToHead = document.getElementById('relationshipToHead');
        const dependentWrap = document.getElementById('householdDependentFields');
        const toggleHead = () => {
            const disabled = headChk.checked;
            headName.disabled = disabled;
            relToHead.disabled = disabled;
            if (disabled) {
                headName.value = '';
                relToHead.value = '';
                dependentWrap.classList.add('opacity-50');
            } else {
                dependentWrap.classList.remove('opacity-50');
            }
        };
        headChk?.addEventListener('change', toggleHead);
        toggleHead();

        // Members totals warning
        const membersTotal = document.getElementById('membersTotal');
        const membersMale = document.getElementById('membersMale');
        const membersFemale = document.getElementById('membersFemale');
        const membersWarning = document.getElementById('membersWarning');
        const checkMembers = () => {
            const t = parseInt(membersTotal.value || '0', 10);
            const m = parseInt(membersMale.value || '0', 10);
            const f = parseInt(membersFemale.value || '0', 10);
            if (!isNaN(t) && !isNaN(m) && !isNaN(f) && t !== (m + f)) {
                membersWarning.classList.remove('hidden');
            } else {
                membersWarning.classList.add('hidden');
            }
        };
        [membersTotal, membersMale, membersFemale].forEach(el => el?.addEventListener('input', checkMembers));

        // Indigenous group: enable text only when checked
        const indigenousChk = document.getElementById('indigenousChk');
        const indigenousText = document.getElementById('indigenousText');
        const toggleIndigenous = () => {
            indigenousText.disabled = !indigenousChk.checked;
            if (!indigenousChk.checked) indigenousText.value = '';
        };
        indigenousChk?.addEventListener('change', toggleIndigenous);
        toggleIndigenous();

        // Final sanitize on submit
        document.getElementById('enrollmentForm').addEventListener('submit', () => {
            document.querySelectorAll('.js-clean').forEach((el) => {
                el.value = toTitleCase(el.value);
            });
            syncPob();
            syncReligion();
            checkMembers();
            persistParcelGeography();
            // Persist selected PSGC values into hidden inputs
            const regionSel = document.getElementById('psgcRegion');
            const provSel = document.getElementById('psgcProvince');
            const citySel = document.getElementById('psgcCityMun');
            const brgySel = document.getElementById('psgcBarangay');
            const setHidden = (name, sel) => {
                const hidden = document.querySelector(`input[name="${name}"]`);
                if (hidden && sel) hidden.value = sel.options[sel.selectedIndex]?.text || '';
            };
            setHidden('address_region', regionSel);
            setHidden('address_province', provSel);
            setHidden('address_municipality_city', citySel);
            setHidden('address_barangay', brgySel);
        });

        // Draft handling
        const saveDraftBtn = document.getElementById('saveDraftBtn');
        const formEl = document.getElementById('enrollmentForm');
        // ensure hidden status field exists
        let statusHidden = formEl.querySelector('input[name="status"]');
        if (!statusHidden) {
            statusHidden = document.createElement('input');
            statusHidden.type = 'hidden';
            statusHidden.name = 'status';
            formEl.appendChild(statusHidden);
        }
        saveDraftBtn?.addEventListener('click', () => {
            statusHidden.value = 'draft';
            formEl.requestSubmit();
        });

        // PSGC API integration (psgc.gitlab.io public API)
        const regionSel = document.getElementById('psgcRegion');
        const provSel = document.getElementById('psgcProvince');
        const citySel = document.getElementById('psgcCityMun');
        const brgySel = document.getElementById('psgcBarangay');
        const streetDatalist = document.getElementById('streetDatalist');

        // Store Cagayan province code globally for farm parcels
        let cagayanProvinceCode = null;

        async function fetchJSON(url) {
            const res = await fetch(url);
            if (!res.ok) throw new Error('Network error');
            return res.json();
        }

        function setOptions(select, items, textGetter = (i) => i.name, valueGetter = (i) => i.code) {
            if (!select) return;
            select.innerHTML = '<option value="">-- Select --</option>' +
                items.map(i => `<option value="${valueGetter(i)}">${textGetter(i)}</option>`).join('');
        }
        (async () => {
            try {
                // Load regions and set default to Cagayan Valley (Region II)
                const regions = await fetchJSON('{{ url("/api/psgc/regions") }}');
                setOptions(regionSel, regions);

                // Find and select Cagayan Valley (Region II)
                const cagayanValleyRegion = regions.find(r => r.name.includes('Cagayan Valley') || r.name.includes('Region II'));
                if (cagayanValleyRegion && regionSel) {
                    regionSel.value = cagayanValleyRegion.code;

                    // Load provinces for Cagayan Valley
                    const provinces = await fetchJSON(`{{ url('/api/psgc/regions') }}/${cagayanValleyRegion.code}/provinces`);
                    setOptions(provSel, provinces);

                    // Find and select Cagayan province
                    const cagayanProvince = provinces.find(p => p.name.toLowerCase().includes('cagayan') && !p.name.toLowerCase().includes('west'));
                    if (cagayanProvince && provSel) {
                        provSel.value = cagayanProvince.code;
                        cagayanProvinceCode = cagayanProvince.code; // Save for farm parcels

                        // Load cities for Cagayan province
                        const cities = await fetchJSON(`{{ url('/api/psgc/provinces') }}/${cagayanProvince.code}/cities`);
                        setOptions(citySel, cities);

                        // Find and select Claveria
                        const claveria = cities.find(c => c.name.toLowerCase().includes('claveria'));
                        if (claveria && citySel) {
                            citySel.value = claveria.code;

                            // Load barangays for Claveria
                            const barangays = await fetchJSON(`{{ url('/api/psgc/cities') }}/${claveria.code}/barangays`);
                            setOptions(brgySel, barangays);
                        }
                    }
                }

                // Note: Event listeners removed for disabled fields (region, province, city)
                // Only barangay remains editable in personal address section
                // Load POB regions (reuse PSGC API)
                const pobRegions = await fetchJSON('{{ url("/api/psgc/regions") }}');

                setOptions(pobRegionSel, pobRegions);

                pobRegionSel?.addEventListener('change', async () => {
                    setOptions(pobProvSel, []);
                    setOptions(pobCitySel, []);
                    const code = pobRegionSel.value;
                    if (!code) return;
                    const provinces = await fetchJSON(`{{ url('/api/psgc/regions') }}/${code}/provinces`);
                    setOptions(pobProvSel, provinces);
                });
                pobProvSel?.addEventListener('change', async () => {
                    setOptions(pobCitySel, []);
                    const code = pobProvSel.value;
                    if (!code) return;
                    const cities = await fetchJSON(`{{ url('/api/psgc/provinces') }}/${code}/cities`);
                    setOptions(pobCitySel, cities);
                });
            } catch (e) {
                console.error('PSGC load failed', e);
            }
        })();

        // Initialize PSGC city/municipality + barangay per parcel card
        // Note: Farm parcels default to Cagayan province (locked to personal address)
        function initParcelGeography(card) {
            const citySel = card.querySelector('.parcelCity');
            const brgySel = card.querySelector('.parcelBrgy');
            if (!citySel || !brgySel) return;

            async function loadCities() {
                // Use the globally stored Cagayan province code
                if (!cagayanProvinceCode) {
                    // Wait a bit for the main PSGC loader to finish
                    setTimeout(() => loadCities(), 200);
                    return;
                }
                try {
                    const cities = await fetchJSON(`{{ url('/api/psgc/provinces') }}/${cagayanProvinceCode}/cities`);
                    setOptions(citySel, cities);
                    brgySel.innerHTML = '<option value="">-- Select --</option>';
                } catch (e) {
                    console.error('Failed to load cities for parcel:', e);
                }
            }

            async function loadBarangays() {
                const code = citySel.value;
                if (!code) {
                    brgySel.innerHTML = '<option value="">-- Select --</option>';
                    return;
                }
                try {
                    const barangays = await fetchJSON(`{{ url('/api/psgc/cities') }}/${code}/barangays`);
                    setOptions(brgySel, barangays);
                } catch (e) {
                    console.error('Failed to load barangays for parcel:', e);
                }
            }

            citySel.addEventListener('change', loadBarangays);

            // Initial load
            loadCities().catch(() => {});
        }

        // Persist parcel city/brgy labels on submit
        function persistParcelGeography() {
            document.querySelectorAll('.parcel-card').forEach(card => {
                const citySel = card.querySelector('.parcelCity');
                const brgySel = card.querySelector('.parcelBrgy');
                const cityHidden = card.querySelector('input[name$="[municipality]"]');
                const brgyHidden = card.querySelector('input[name$="[barangay]"]');
                if (citySel && cityHidden) cityHidden.value = citySel.options[citySel.selectedIndex]?.text || '';
                if (brgySel && brgyHidden) brgyHidden.value = brgySel.options[brgySel.selectedIndex]?.text || '';
            });
        }

        // init for first parcel
        initParcelGeography(document.querySelector('.parcel-card'));
    });
</script>
@endsection