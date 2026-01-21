@extends('layouts.admin')
@section('title', 'Edit Enrollment • Admin')
@section('header', 'Edit Enrollment')
@section('content')

<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white/90 overflow-hidden shadow-xl sm:rounded-2xl p-6 space-y-10 border border-emerald-900/5">
            <form method="POST" action="{{ route('admin.enrollments.update', $enrollment) }}" enctype="multipart/form-data" class="space-y-6" id="enrollmentForm">
                @csrf
                @method('PUT')

                <div>
                    <div class="h-1 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-sky-500 rounded"></div>
                    <h3 class="mt-3 text-lg font-semibold text-emerald-900">Part I: Personal Information</h3>
                </div>

                <div>
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        <div class="flex-1">
                            <x-label value="RSBSA Reference Number" />
                            <x-input name="rsbsa_reference_number" class="mt-1 w-full js-rsbsa" maxlength="17" placeholder="00-00-00-000-000000" value="{{ old('rsbsa_reference_number', $enrollment->rsbsa_reference_number) }}" />
                        </div>
                        <div>
                            <x-label value="2x2 Picture (leave blank to keep)" />
                            <input type="file" name="photo" accept="image/*" class="mt-1 block" />
                        </div>
                    </div>
                </div>

                <div>
                    <x-label value="Link to User Account (Optional)" />
                    <select name="user_id" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">-- No user account linked --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $enrollment->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Select a user account if this enrollment is for a registered user</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div><x-label value="Surname" /><x-input name="surname" class="mt-1 w-full js-clean" value="{{ old('surname', $enrollment->surname) }}" /></div>
                    <div><x-label value="First Name" /><x-input name="first_name" class="mt-1 w-full js-clean" value="{{ old('first_name', $enrollment->first_name) }}" /></div>
                    <div><x-label value="Middle Name" /><x-input name="middle_name" class="mt-1 w-full js-clean" value="{{ old('middle_name', $enrollment->middle_name) }}" /></div>
                    <div><x-label value="Extension" /><x-input name="extension_name" class="mt-1 w-full js-clean" value="{{ old('extension_name', $enrollment->extension_name) }}" /></div>
                </div>

                <div>
                    <x-label value="Sex" />
                    <div class="flex gap-6 mt-1">
                        <label class="inline-flex items-center"><input type="radio" name="sex" value="male" class="text-emerald-600" {{ old('sex', $enrollment->sex)==='male' ? 'checked' : '' }}><span class="ml-2">Male</span></label>
                        <label class="inline-flex items-center"><input type="radio" name="sex" value="female" class="text-emerald-600" {{ old('sex', $enrollment->sex)==='female' ? 'checked' : '' }}><span class="ml-2">Female</span></label>
                    </div>
                </div>

                <div>
                    <x-label value="Address" />
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-1 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
                        <x-input name="address_house_lot" class="js-clean" placeholder="House/lot/bldg.no./purok" value="{{ old('address_house_lot', $enrollment->address_house_lot) }}" />
                        <div class="md:col-span-2">
                            <x-label value="Street/Sitio/Subdv." />
                            <x-input name="address_street" class="js-clean w-full" placeholder="Street/Sitio/Subdv." list="streetDatalist" value="{{ old('address_street', $enrollment->address_street) }}" />
                            <datalist id="streetDatalist"></datalist>
                        </div>
                        <div>
                            <x-label value="Region" />
                            <select id="psgcRegion" class="w-full border-gray-300 rounded-md opacity-60" disabled></select>
                            <input type="hidden" name="address_region" value="{{ old('address_region', $enrollment->address_region) }}" />
                        </div>
                        <div>
                            <x-label value="Province" />
                            <select id="psgcProvince" class="w-full border-gray-300 rounded-md opacity-60" disabled></select>
                            <input type="hidden" name="address_province" value="{{ old('address_province', $enrollment->address_province) }}" />
                        </div>
                        <div>
                            <x-label value="Municipality/City" />
                            <select id="psgcCityMun" class="w-full border-gray-300 rounded-md opacity-60" disabled></select>
                            <input type="hidden" name="address_municipality_city" value="{{ old('address_municipality_city', $enrollment->address_municipality_city) }}" />
                        </div>
                        <div>
                            <x-label value="Barangay" />
                            <select id="psgcBarangay" class="w-full border-gray-300 rounded-md"></select>
                            <input type="hidden" name="address_barangay" value="{{ old('address_barangay', $enrollment->address_barangay) }}" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
                    <div><x-label value="Mobile Number" /><x-input name="mobile_number" class="mt-1 w-full js-mobile" maxlength="14" placeholder="0912 345 6789" value="{{ old('mobile_number', $enrollment->mobile_number) }}" /></div>
                    <div><x-label value="Landline Number" /><x-input name="landline_number" class="mt-1 w-full" value="{{ old('landline_number', $enrollment->landline_number) }}" /></div>
                    <div><x-label value="Date of Birth" /><x-input type="date" name="date_of_birth" class="mt-1 w-full" value="{{ old('date_of_birth', optional($enrollment->date_of_birth)->format('Y-m-d')) }}" /></div>
                </div>

                <div>
                    <x-label value="Place of Birth" />
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-1 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
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
                            <x-input id="pobCountry" class="js-clean w-full" value="{{ old('pob_country', 'Philippines') }}" />
                        </div>
                    </div>
                    <input type="hidden" name="place_of_birth" value="{{ old('place_of_birth', $enrollment->place_of_birth) }}" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-label value="Highest Formal Education" />
                        <select name="highest_formal_education" class="mt-1 w-full border-gray-300 rounded-md">
                            <option value="">--</option>
                            @foreach(['Pre-school','Elementary','High school (non-K-12)','Junior High school (K-12)','Senior High school (K-12)','College','Vocational','Post graduate','None'] as $opt)
                            <option value="{{ $opt }}" {{ old('highest_formal_education', $enrollment->highest_formal_education)===$opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-label value="Religion" />
                        <div class="flex items-center gap-4 mt-1">
                            <label class="inline-flex items-center"><input type="checkbox" class="text-emerald-600 js-religion" value="Christianity"><span class="ml-2">Christianity</span></label>
                            <label class="inline-flex items-center"><input type="checkbox" class="text-emerald-600 js-religion" value="Islam"><span class="ml-2">Islam</span></label>
                            <label class="inline-flex items-center"><input type="checkbox" id="rel_other_chk" class="text-emerald-600 js-religion" value="Others"><span class="ml-2">Others</span></label>
                        </div>
                        <x-input id="rel_other_text" class="mt-2 w-full js-clean" placeholder="Specify religion" disabled />
                        <input type="hidden" name="religion" value="{{ old('religion', $enrollment->religion) }}" />
                    </div>
                    <div>
                        <x-label value="Civil Status" />
                        <select name="civil_status" class="mt-1 w-full border-gray-300 rounded-md">
                            <option value="">--</option>
                            @foreach(['single'=>'Single','married'=>'Married','widowed'=>'Widowed','separated'=>'Separated'] as $val=>$label)
                            <option value="{{ $val }}" {{ old('civil_status', $enrollment->civil_status)===$val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
                    <div><x-label value="Name of Spouse" /><x-input name="name_of_spouse" class="mt-1 w-full js-clean" placeholder="Surname, Firstname Middlename" value="{{ old('name_of_spouse', $enrollment->name_of_spouse) }}" /></div>
                    <div><x-label value="Mother's Maiden Name" /><x-input name="mothers_maiden_name" class="mt-1 w-full js-clean" placeholder="Surname, Firstname Middlename" value="{{ old('mothers_maiden_name', $enrollment->mothers_maiden_name) }}" /></div>
                </div>

                <div class="mt-4">
                    <div class="h-1 w-full bg-gradient-to-r from-sky-500 via-indigo-500 to-fuchsia-500 rounded"></div>
                    <h3 class="mt-3 text-lg font-semibold text-emerald-900">Household & IDs</h3>
                </div>

                <div>
                    <x-label value="Household" />
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-1 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
                        <label class="inline-flex items-center"><input type="checkbox" name="household_head" id="householdHeadChk" value="1" class="text-emerald-600" {{ old('household_head', $enrollment->household_head) ? 'checked' : '' }}><span class="ml-2">Household Head</span></label>
                        <x-input name="household_head_name" class="js-clean" placeholder="If not head: Head's Name" value="{{ old('household_head_name', $enrollment->household_head_name) }}" />
                        <x-input name="relationship_to_head" class="js-clean" placeholder="Relationship" value="{{ old('relationship_to_head', $enrollment->relationship_to_head) }}" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
                    <div><x-label value="Total Members" /><x-input type="number" name="household_members_total" class="mt-1 w-full js-total" value="{{ old('household_members_total', $enrollment->household_members_total) }}" /></div>
                    <div><x-label value="Male" /><x-input type="number" name="household_members_male" class="mt-1 w-full js-male" value="{{ old('household_members_male', $enrollment->household_members_male) }}" /></div>
                    <div><x-label value="Female" /><x-input type="number" name="household_members_female" class="mt-1 w-full js-female" value="{{ old('household_members_female', $enrollment->household_members_female) }}" /></div>
                    <div class="md:col-span-3 text-amber-700 bg-amber-50 border border-amber-200 rounded p-2 hidden" id="membersWarn">Total must equal male + female.</div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="inline-flex items-center"><input type="checkbox" name="is_pwd" value="1" class="text-emerald-600" {{ old('is_pwd', $enrollment->is_pwd) ? 'checked' : '' }}><span class="ml-2">Person with Disability (PWD)</span></label>
                    <label class="inline-flex items-center"><input type="checkbox" name="is_four_ps_beneficiary" value="1" class="text-emerald-600" {{ old('is_four_ps_beneficiary', $enrollment->is_four_ps_beneficiary) ? 'checked' : '' }}><span class="ml-2">4Ps Beneficiary</span></label>
                    <label class="inline-flex items-center"><input type="checkbox" id="indigenousChk" name="is_indigenous_group_member" value="1" class="text-emerald-600" {{ old('is_indigenous_group_member', $enrollment->is_indigenous_group_member) ? 'checked' : '' }}><span class="ml-2">Member of an indigenous group</span></label>
                </div>
                <div>
                    <x-input id="indigenousText" class="js-clean" name="indigenous_group_specify" placeholder="Specify indigenous group" disabled value="{{ old('indigenous_group_specify', $enrollment->indigenous_group_specify) }}" />
                </div>

                <div>
                    <x-label value="Government ID" />
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-1 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
                        <label class="inline-flex items-center"><input type="checkbox" id="govIdChk" name="has_government_id" value="1" class="text-emerald-600" {{ old('has_government_id', $enrollment->has_government_id) ? 'checked' : '' }}><span class="ml-2">Has Government ID</span></label>
                        <x-input name="government_id_type" class="js-clean" placeholder="ID Type (e.g., PhilID)" disabled value="{{ old('government_id_type', $enrollment->government_id_type) }}" />
                        <x-input name="government_id_number" class="js-clean" placeholder="ID Number" disabled value="{{ old('government_id_number', $enrollment->government_id_number) }}" />
                    </div>
                </div>

                <div class="mt-4">
                    <div class="h-1 w-full bg-gradient-to-r from-amber-500 via-orange-500 to-rose-500 rounded"></div>
                    <h3 class="mt-3 text-lg font-semibold text-emerald-900">Emergency Contact</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
                    <div><x-label value="Name" /><x-input name="emergency_contact_name" class="mt-1 w-full js-clean" placeholder="Surname, Firstname Middlename" value="{{ old('emergency_contact_name', $enrollment->emergency_contact_name) }}" /></div>
                    <div><x-label value="Contact Number" /><x-input name="emergency_contact_number" class="mt-1 w-full" value="{{ old('emergency_contact_number', $enrollment->emergency_contact_number) }}" /></div>
                </div>

                <div class="mt-4">
                    <div class="h-1 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-sky-500 rounded"></div>
                    <h3 class="mt-3 text-lg font-semibold text-emerald-900">Part II: Farm Profile</h3>
                </div>

                <div>
                    <x-label value="Main Livelihood" />
                    <div class="flex flex-wrap gap-6 mt-1">
                        <label class="inline-flex items-center"><input type="radio" name="main_livelihood" value="farmer" class="text-emerald-600 js-livelihood" {{ old('main_livelihood', $enrollment->main_livelihood)==='farmer' ? 'checked' : '' }}><span class="ml-2">Farmer</span></label>
                        <label class="inline-flex items-center"><input type="radio" name="main_livelihood" value="farmworker" class="text-emerald-600 js-livelihood" {{ old('main_livelihood', $enrollment->main_livelihood)==='farmworker' ? 'checked' : '' }}><span class="ml-2">Farmworker</span></label>
                        <label class="inline-flex items-center"><input type="radio" name="main_livelihood" value="fisherfolk" class="text-emerald-600 js-livelihood" {{ old('main_livelihood', $enrollment->main_livelihood)==='fisherfolk' ? 'checked' : '' }}><span class="ml-2">Fisherfolk</span></label>
                        <label class="inline-flex items-center"><input type="radio" name="main_livelihood" value="agri_youth" class="text-emerald-600 js-livelihood" {{ old('main_livelihood', $enrollment->main_livelihood)==='agri_youth' ? 'checked' : '' }}><span class="ml-2">Agri Youth</span></label>
                    </div>
                </div>

                @include('admin.enrollments.partials.livelihood_sections')

                <div>
                    <x-label value="Farm Parcels" />
                    <div id="parcelsContainer" class="space-y-4 mt-2"></div>
                    <button type="button" id="addParcelBtn" class="mt-2 px-3 py-2 rounded-lg bg-white hover:bg-emerald-50 text-emerald-900 border">Add Parcel</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><x-label value="Gross Annual Income (Farming)" /><x-input type="number" step="0.01" name="gross_income_farming" class="mt-1 w-full" value="{{ old('gross_income_farming', $enrollment->gross_income_farming) }}" /></div>
                    <div><x-label value="Gross Annual Income (Non-farming)" /><x-input type="number" step="0.01" name="gross_income_non_farming" class="mt-1 w-full" value="{{ old('gross_income_non_farming', $enrollment->gross_income_non_farming) }}" /></div>
                </div>

                <div>
                    <x-label value="Name of Farmers in Rotation (optional)" />
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-1">
                        <x-input name="rotation_farmers_p1" placeholder="(p1)" value="{{ old('rotation_farmers_p1', $enrollment->rotation_farmers_p1) }}" />
                        <x-input name="rotation_farmers_p2" placeholder="(p2)" value="{{ old('rotation_farmers_p2', $enrollment->rotation_farmers_p2) }}" />
                        <x-input name="rotation_farmers_p3" placeholder="(p3)" value="{{ old('rotation_farmers_p3', $enrollment->rotation_farmers_p3) }}" />
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <!-- <x-secondary-button type="button" onclick="document.getElementById('enrollmentForm').reset()">Reset</x-secondary-button> -->
                    <button type="button" id="saveDraftBtn" class="px-4 py-2 rounded-md bg-amber-500 hover:bg-amber-600 text-white shadow" title="Waiting for information to load, please wait...">Save as Draft</button>
                    <x-button type="submit" id="updateBtn" title="Waiting for information to load, please wait...">Update</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.enrollments.partials.templates')

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Provide a minimal CSS.escape polyfill for older browsers to avoid breaking subsequent code
        if (!window.CSS) window.CSS = {};
        if (typeof window.CSS.escape !== 'function') {
            window.CSS.escape = function(value) {
                return String(value).replace(/[^a-zA-Z0-9_\-]/g, function(ch) {
                    const hex = ch.charCodeAt(0).toString(16).toUpperCase();
                    return '\\' + hex + ' ';
                });
            };
        }
        const data = @json($enrollment->load('farmParcels.items')->toArray());

        function setByName(name, value) {
            const els = document.querySelectorAll(`[name="${name}"]`);
            if (!els.length) return;
            const el = els[0];
            if (el.type === 'radio') {
                document.querySelectorAll(`[name="${name}"][value="${value}"]`).forEach(r => r.checked = true);
            } else if (el.type === 'checkbox') {
                els.forEach(c => {
                    if (Array.isArray(value)) c.checked = value.includes(c.value);
                    else c.checked = !!value;
                });
            } else {
                els.forEach(e => e.value = value ?? '');
            }
        }

        // Input cleaning: Title Case + trim (match create)
        const toTitleCase = (str) => str.replace(/\S+/g, (w) => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).trim();
        document.querySelectorAll('.js-clean').forEach((el) => {
            el.addEventListener('blur', () => {
                el.value = toTitleCase(el.value);
            });
        });

        // Mobile number masking: 4-3-4 with spaces (match create)
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

        // Simple fields
        ['surname', 'first_name', 'middle_name', 'extension_name', 'rsbsa_reference_number', 'mobile_number', 'landline_number', 'highest_formal_education', 'civil_status', 'name_of_spouse', 'mothers_maiden_name', 'emergency_contact_name', 'emergency_contact_number', 'gross_income_farming', 'gross_income_non_farming', 'rotation_farmers_p1', 'rotation_farmers_p2', 'rotation_farmers_p3'].forEach(f => setByName(f, data[f]));
        // Date of birth: keep server-rendered value (YYYY-MM-DD). Only set if blank and data looks like YYYY-MM-DD
        const dobInput = document.querySelector('input[name="date_of_birth"]');
        if (dobInput && !dobInput.value && typeof data.date_of_birth === 'string') {
            const m = data.date_of_birth.match(/^\d{4}-\d{2}-\d{2}$/);
            if (m) dobInput.value = data.date_of_birth;
        }
        setByName('sex', data.sex);
        setByName('household_head', data.household_head);
        setByName('household_head_name', data.household_head_name);
        setByName('relationship_to_head', data.relationship_to_head);
        setByName('household_members_total', data.household_members_total);
        setByName('household_members_male', data.household_members_male);
        setByName('household_members_female', data.household_members_female);
        setByName('is_pwd', data.is_pwd);
        setByName('is_four_ps_beneficiary', data.is_four_ps_beneficiary);
        setByName('is_indigenous_group_member', data.is_indigenous_group_member);
        setByName('indigenous_group_specify', data.indigenous_group_specify);
        setByName('has_government_id', data.has_government_id);
        setByName('government_id_type', data.government_id_type);
        setByName('government_id_number', data.government_id_number);
        setByName('main_livelihood', data.main_livelihood);

        // Address labels populate hidden fields; PSGC selects will be matched by text when loaded
        setByName('address_region', data.address_region);
        setByName('address_province', data.address_province);
        setByName('address_municipality_city', data.address_municipality_city);
        setByName('address_barangay', data.address_barangay);

        // Place of birth
        setByName('place_of_birth', data.place_of_birth);
        const pobParts = (data.place_of_birth || '').split(',').map(s => s.trim());
        document.getElementById('pobCountry').value = pobParts[2] || 'Philippines';

        // Generic chips helper (match create)
        const initChips = (inputId, chipsId, hiddenId, hiddenName) => {
            const input = document.getElementById(inputId);
            const chips = document.getElementById(chipsId);
            const hidden = document.getElementById(hiddenId);
            const add = (text) => {
                const val = (text || '').toString().trim();
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

        // Instantiate chips groups
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

        // Chips arrays (prefill from saved data)
        if (typeof crop !== 'undefined' && data.other_crop_specify) data.other_crop_specify.split(',').map(s => s.trim()).filter(Boolean).forEach(v => crop.add(v));
        if (typeof livestock !== 'undefined' && data.livestock_type_specify) data.livestock_type_specify.split(',').map(s => s.trim()).filter(Boolean).forEach(v => livestock.add(v));
        if (typeof poultry !== 'undefined' && data.poultry_type_specify) data.poultry_type_specify.split(',').map(s => s.trim()).filter(Boolean).forEach(v => poultry.add(v));
        if (typeof fwOther !== 'undefined' && data.farmworker_other_work) data.farmworker_other_work.split(',').map(s => s.trim()).filter(Boolean).forEach(v => fwOther.add(v));
        if (typeof fishOther !== 'undefined' && data.fishing_other_activity) data.fishing_other_activity.split(',').map(s => s.trim()).filter(Boolean).forEach(v => fishOther.add(v));
        if (typeof youthOther !== 'undefined' && data.agriyouth_other_involvement) data.agriyouth_other_involvement.split(',').map(s => s.trim()).filter(Boolean).forEach(v => youthOther.add(v));

        // Livelihood-specific arrays
        (data.farming_activities || []).forEach(v => {
            const cb = document.querySelector(`input[name="farming_activities[]"][value="${CSS.escape(v)}"]`);
            if (cb) cb.checked = true;
        });
        (data.farmworker_kinds_of_work || []).forEach(v => {
            const cb = document.querySelector(`input[name="farmworker_kinds_of_work[]"][value="${CSS.escape(v)}"]`);
            if (cb) cb.checked = true;
        });
        (data.fishing_activities || []).forEach(v => {
            const cb = document.querySelector(`input[name="fishing_activities[]"][value="${CSS.escape(v)}"]`);
            if (cb) cb.checked = true;
        });
        (data.agriyouth_involvements || []).forEach(v => {
            const cb = document.querySelector(`input[name="agriyouth_involvements[]"][value="${CSS.escape(v)}"]`);
            if (cb) cb.checked = true;
        });

        // Parcel template system (copied from create)
        const container = document.getElementById('parcelsContainer');
        const parcelTemplateHTML = document.getElementById('parcelTemplate')?.innerHTML || '';
        const addParcelBtn = document.getElementById('addParcelBtn');
        let parcelIndex = 0;

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

        function addParcel() {
            if (!parcelTemplateHTML) return;
            const html = parcelTemplateHTML.replace(/INDEX/g, String(parcelIndex++));
            const wrapper = document.createElement('div');
            wrapper.innerHTML = html;
            const node = wrapper.firstElementChild;
            container.appendChild(node);
            node.querySelector('.removeParcelBtn')?.addEventListener('click', () => node.remove());
            setupOwnershipControls(node);
            initParcelGeography(node);
        }
        addParcelBtn?.addEventListener('click', addParcel);

        // Add/Remove/Duplicate parcel items
        const itemTplHTML = document.getElementById('parcelItemTemplate')?.innerHTML || '';

        function addParcelItem(card) {
            const firstInput = card.querySelector('input[name^="parcels["]');
            if (!firstInput) return;
            const m = firstInput.name.match(/^parcels\[(\d+)\]/);
            const pIdx = m ? m[1] : '0';
            const itemsWrap = card.querySelector('.parcel-items');
            const nextIdx = card.querySelectorAll('.parcel-item').length;
            const html = itemTplHTML.replace(/PARIDX/g, String(pIdx)).replace(/ITEMIDX/g, String(nextIdx));
            const wrapper = document.createElement('div');
            wrapper.innerHTML = html;
            const node = wrapper.firstElementChild;
            itemsWrap.appendChild(node);
            initParcelItemRow(node);
        }
        container?.addEventListener('click', (e) => {
            if (e.target.closest('.addParcelItemBtn')) {
                const card = e.target.closest('.parcel-card');
                addParcelItem(card);
            }
            if (e.target.closest('.removeParcelItemBtn')) {
                const row = e.target.closest('.parcel-item');
                row?.remove();
            }
            if (e.target.closest('.duplicateParcelBtn')) {
                const card = e.target.closest('.parcel-card');
                const clone = card.cloneNode(true);
                const newIdx = parcelIndex++;
                // Reindex names to the new parcel index
                clone.querySelectorAll('input, select, textarea').forEach(el => {
                    if (el.name) {
                        el.name = el.name.replace(/^parcels\[\d+\]/, `parcels[${newIdx}]`);
                    }
                });
                // Reindex its items
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
                clone.querySelector('.removeParcelBtn')?.addEventListener('click', () => clone.remove());
                container.appendChild(clone);
            }
        });

        // Pre-render farm parcels + items using the template system
        (data.farm_parcels || []).forEach((parcel, idx) => {
            addParcel();
            const card = document.querySelectorAll('.parcel-card')[idx];
            if (!card) return;
            // Hidden text labels (server stores labels)
            const brgyHidden = card.querySelector('input[name$="[barangay]"]');
            const cityHidden = card.querySelector('input[name$="[municipality]"]');
            if (brgyHidden) brgyHidden.value = parcel.barangay || '';
            if (cityHidden) cityHidden.value = parcel.municipality || '';
            // Direct fill other inputs in card
            card.querySelector(`[name$="[total_farm_area_ha]"]`)?.setAttribute('value', parcel.total_farm_area_ha ?? '');
            card.querySelector(`[name$="[ownership_document_no]"]`)?.setAttribute('value', parcel.ownership_document_no ?? '');
            const ownSel = card.querySelector(`[name$="[ownership_type]"]`);
            if (ownSel) ownSel.value = parcel.ownership_type || '';
            const landOwner = card.querySelector(`[name$="[land_owner_name]"]`);
            if (landOwner) {
                landOwner.value = parcel.land_owner_name || '';
            }
            const ownOther = card.querySelector(`[name$="[ownership_other_specify]"]`);
            if (ownOther) {
                ownOther.value = parcel.ownership_other_specify || '';
            }
            const anc = card.querySelector(`[name$="[within_ancestral_domain]"]`);
            if (anc) anc.checked = !!parcel.within_ancestral_domain;
            const arb = card.querySelector(`[name$="[is_agrarian_reform_beneficiary]"]`);
            if (arb) arb.checked = !!parcel.is_agrarian_reform_beneficiary;

            // Items
            const addItemBtn = card.querySelector('.addParcelItemBtn');
            (parcel.items || []).forEach((it, ii) => {
                addParcelItem(card);
                const row = card.querySelectorAll('.parcel-item')[ii];
                if (!row) return;
                row.querySelector('select.kindSelect').value = it.kind || 'crop';
                row.querySelector('select.kindSelect').dispatchEvent(new Event('change'));
                row.querySelector(`[name$="[name]"]`).value = it.name || '';
                row.querySelector(`[name$="[size_ha]"]`).value = it.size_ha ?? '';
                const noh = row.querySelector(`[name$="[num_of_head]"]`);
                if (noh) noh.value = it.num_of_head ?? '';
                row.querySelector(`[name$="[farm_type]"]`).value = it.farm_type || '';
                const org = row.querySelector(`[name$="[is_organic_practitioner]"]`);
                if (org) org.checked = !!it.is_organic_practitioner;
                row.querySelector(`[name$="[remarks]"]`).value = it.remarks || '';
            });
        });

        // Match PSGC selects by text after options load
        function selectByText(select, text) {
            if (!select || !text) return;
            const opts = [...select.options];
            const m = opts.find(o => o.text.trim().toLowerCase() === String(text).trim().toLowerCase());
            if (m) {
                select.value = m.value;
                select.dispatchEvent(new Event('change'));
            }
        }
        const regionSel = document.getElementById('psgcRegion');
        const provSel = document.getElementById('psgcProvince');
        const citySel = document.getElementById('psgcCityMun');
        const brgySel = document.getElementById('psgcBarangay');

        // Store Cagayan province code globally for farm parcels
        let cagayanProvinceCode = null;

        // Note: Address fields (region, province, city) are now locked to Cagayan/Claveria
        // Only barangay is editable, handled in the async PSGC loader below

        // Livelihood sections toggle (show the saved one)
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

        // Religion: exclusive checkboxes with Others text; sync hidden input
        const relChecks = document.querySelectorAll('.js-religion');
        const relOtherChk = document.getElementById('rel_other_chk');
        const relOtherText = document.getElementById('rel_other_text');
        const relHidden = document.querySelector('input[name="religion"]');

        function applyReligionFromHidden() {
            const v = (relHidden?.value || '').trim();
            let matched = false;
            relChecks.forEach(c => c.checked = false);
            if (v.toLowerCase().startsWith('others')) {
                if (relOtherChk) {
                    relOtherChk.checked = true;
                }
                const m = v.match(/^Others:\s*(.*)$/i);
                if (relOtherText) {
                    relOtherText.value = m ? m[1] : '';
                    relOtherText.disabled = false;
                }
                matched = true;
            } else if (v) {
                relChecks.forEach(c => {
                    if (c.value === v) {
                        c.checked = true;
                        matched = true;
                    }
                });
                if (relOtherText) {
                    relOtherText.value = '';
                    relOtherText.disabled = true;
                }
            } else {
                if (relOtherText) {
                    relOtherText.value = '';
                    relOtherText.disabled = true;
                }
            }
        }

        function syncReligion() {
            let value = '';
            relChecks.forEach(chk => {
                if (chk.checked && chk !== relOtherChk) value = chk.value;
            });
            if (relOtherChk && relOtherChk.checked) {
                relOtherText.disabled = false;
                value = relOtherText.value ? `Others: ${relOtherText.value.trim()}` : 'Others';
            } else if (relOtherText) {
                relOtherText.disabled = true;
                relOtherText.value = '';
            }
            if (relHidden) relHidden.value = value;
        }
        relChecks.forEach(chk => chk.addEventListener('change', (e) => {
            if (e.target.checked) {
                relChecks.forEach(other => {
                    if (other !== e.target) other.checked = false;
                });
            }
            syncReligion();
        }));
        relOtherText?.addEventListener('input', syncReligion);
        applyReligionFromHidden();

        // Government ID toggle enable/disable
        const govChk = document.getElementById('govIdChk');
        const govType = document.querySelector('input[name="government_id_type"]');
        const govNumber = document.querySelector('input[name="government_id_number"]');
        const toggleGov = () => {
            const en = !!(govChk && govChk.checked);
            if (govType) {
                govType.disabled = !en;
                if (!en && !govType.value) govType.value = '';
            }
            if (govNumber) {
                govNumber.disabled = !en;
                if (!en && !govNumber.value) govNumber.value = '';
            }
        };
        govChk?.addEventListener('change', toggleGov);
        toggleGov();

        // Indigenous toggle enable/disable
        const indigenousChk = document.getElementById('indigenousChk');
        const indigenousText = document.getElementById('indigenousText');
        const toggleIndigenous = () => {
            if (!indigenousText) return;
            const en = !!(indigenousChk && indigenousChk.checked);
            indigenousText.disabled = !en;
            if (!en && !indigenousText.value) indigenousText.value = '';
        };
        indigenousChk?.addEventListener('change', toggleIndigenous);
        toggleIndigenous();

        // PSGC API integration via backend proxy (reuse earlier select refs)

        async function fetchJSON(url) {
            const res = await fetch(url);
            if (!res.ok) throw new Error('Network error');
            return res.json();
        }

        function setOptions(select, items, textGetter = (i) => i.name, valueGetter = (i) => i.code) {
            if (!select) return;
            select.innerHTML = '<option value="">-- Select --</option>' +
                items.map(i => `<option value="${valueGetter(i)}">${textGetter(i)}</option>`).join('');
            checkButtons();
        }
        // Enable/disable buttons based on PSGC select readiness
        function isSelected(select) {
            return !!(select && select.options && select.selectedIndex > 0);
        }

        function checkButtons() {
            const saveBtn = document.getElementById('saveDraftBtn');
            const updBtn = document.getElementById('updateBtn');
            const ready = [regionSel, provSel, citySel, brgySel, pobRegionSel, pobProvSel, pobCitySel].every(isSelected);
            const title = ready ? '' : 'Waiting for information to load, please wait...';
            if (saveBtn) {
                saveBtn.disabled = !ready;
                if (title) saveBtn.setAttribute('title', title);
                else saveBtn.removeAttribute('title');
            }
            if (updBtn) {
                updBtn.disabled = !ready;
                if (title) updBtn.setAttribute('title', title);
                else updBtn.removeAttribute('title');
            }
        }

        (async () => {
            try {
                // Load regions and set default to Cagayan Valley (Region II)
                const regions = await fetchJSON('{{ url("/api/psgc/regions") }}');
                setOptions(regionSel, regions);

                // Saved labels (from hidden inputs) - only for barangay
                const savedBrgyText = document.querySelector('input[name="address_barangay"]')?.value || data.address_barangay || '';

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

                            // Try to select saved barangay
                            if (savedBrgyText) {
                                selectByText(brgySel, savedBrgyText);
                            }
                        }
                    }
                }

                // Note: Event listeners removed for disabled fields (region, province, city)
                // Only barangay remains editable in personal address section

                checkButtons();
            } catch (e) {
                console.error('PSGC load failed', e);
            }
        })();

        // POB PSGC loaders
        const pobRegionSel = document.getElementById('pobRegion');
        const pobProvSel = document.getElementById('pobProvince');
        const pobCitySel = document.getElementById('pobCityMun');
        (async () => {
            try {
                const pobRegions = await fetchJSON('{{ url("/api/psgc/regions") }}');

                setOptions(pobRegionSel, pobRegions);
                pobRegionSel?.addEventListener('change', async () => {
                    setOptions(pobProvSel, []);
                    setOptions(pobCitySel, []);
                    const code = pobRegionSel.value;
                    if (!code) return;
                    const provinces = await fetchJSON(`{{ url('/api/psgc/regions') }}/${code}/provinces`);
                    setOptions(pobProvSel, provinces);
                    checkButtons();
                });
                pobProvSel?.addEventListener('change', async () => {
                    setOptions(pobCitySel, []);
                    const code = pobProvSel.value;
                    if (!code) return;
                    const cities = await fetchJSON(`{{ url('/api/psgc/provinces') }}/${code}/cities`);
                    setOptions(pobCitySel, cities);
                    checkButtons();
                });
                // Auto-match POB from saved place_of_birth (City, Province)
                const pobParts = (data.place_of_birth || '').split(',').map(s => s.trim());
                const cityText = pobParts[0] || '';
                const provText = pobParts[1] || '';
                async function selectByTextAsync(select, text) {
                    if (!select || !text) return false;
                    const opts = [...select.options];
                    const m = opts.find(o => o.text.trim().toLowerCase() === String(text).trim().toLowerCase());
                    if (m) {
                        select.value = m.value;
                        select.dispatchEvent(new Event('change'));
                        return true;
                    }
                    return false;
                }
                async function autoMatchPOB() {
                    if (!provText) return; // nothing to match
                    // Try current region first (if any), otherwise scan regions to find the province
                    const tryRegion = async (regionCode) => {
                        const provinces = await fetchJSON(`{{ url('/api/psgc/regions') }}/${regionCode}/provinces`);
                        setOptions(pobProvSel, provinces);
                        const provOk = await selectByTextAsync(pobProvSel, provText);
                        if (!provOk) return false;
                        const cities = await fetchJSON(`{{ url('/api/psgc/provinces') }}/${pobProvSel.value}/cities`);
                        setOptions(pobCitySel, cities);
                        await selectByTextAsync(pobCitySel, cityText);
                        return true;
                    };
                    // If region already selected by user, try there
                    if (pobRegionSel && pobRegionSel.value) {
                        const ok = await tryRegion(pobRegionSel.value);
                        if (ok) return;
                    }
                    // Otherwise scan regions to find province
                    for (const r of pobRegions) {
                        const ok = await tryRegion(r.code);
                        if (ok) {
                            pobRegionSel.value = r.code; /* don't dispatch change to avoid clearing selections */
                            break;
                        }
                    }
                }
                // Run matching after regions rendered, and again after 600ms to resist flicker
                setTimeout(() => {
                    autoMatchPOB();
                    checkButtons();
                }, 200);
                setTimeout(() => {
                    autoMatchPOB();
                    checkButtons();
                }, 800);
            } catch (e) {
                console.error('POB PSGC load failed', e);
            }
        })();

        // Initialize PSGC city/municipality + barangay per parcel card
        // Note: Farm parcels default to Cagayan province (locked to personal address)
        function initParcelGeography(card) {
            const citySel = card.querySelector('.parcelCity');
            const brgySel = card.querySelector('.parcelBrgy');
            if (!citySel || !brgySel) return;
            const getSavedCity = () => (card.querySelector('input[name$="[municipality]"]')?.value || '').trim();
            const getSavedBrgy = () => (card.querySelector('input[name$="[barangay]"]')?.value || '').trim();

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
                    // Attempt to auto-select saved city, then trigger barangay load
                    const savedCity = getSavedCity();
                    if (savedCity) {
                        selectByText(citySel, savedCity);
                    }
                    await loadBarangays();
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
                    const savedBrgy = getSavedBrgy();
                    if (savedBrgy) {
                        selectByText(brgySel, savedBrgy);
                    }
                } catch (e) {
                    console.error('Failed to load barangays for parcel:', e);
                }
            }

            citySel.addEventListener('change', () => {
                loadBarangays();
                checkButtons();
            });

            // Initial load
            loadCities().catch(() => {});
        }

        // After parcels are rendered, init their geography selects and match by labels
        setTimeout(() => {
            document.querySelectorAll('.parcel-card').forEach((card) => {
                initParcelGeography(card);
            });
            checkButtons();
        }, 600);

        // Persist selected labels into hidden inputs on submit (address + parcels)
        document.getElementById('enrollmentForm').addEventListener('submit', () => {
            const setHidden = (name, sel) => {
                const hidden = document.querySelector(`input[name="${name}"]`);
                if (hidden && sel) hidden.value = sel.options[sel.selectedIndex]?.text || '';
            };
            setHidden('address_region', regionSel);
            setHidden('address_province', provSel);
            setHidden('address_municipality_city', citySel);
            setHidden('address_barangay', brgySel);
            // Build place_of_birth from pob selects + country input
            const pobHidden = document.querySelector('input[name="place_of_birth"]');
            const pobCountry = document.getElementById('pobCountry');
            if (pobHidden) {
                const parts = [
                    pobCitySel?.options[pobCitySel.selectedIndex]?.text || '',
                    pobProvSel?.options[pobProvSel.selectedIndex]?.text || '',
                    (pobCountry?.value || 'Philippines')
                ].map(v => String(v).trim()).filter(Boolean);
                pobHidden.value = parts.join(', ');
            }
            document.querySelectorAll('.parcel-card').forEach(card => {
                const citySelect = card.querySelector('.parcelCity');
                const brgySelect = card.querySelector('.parcelBrgy');
                const cityHidden = card.querySelector('input[name$="[municipality]"]');
                const brgyHidden = card.querySelector('input[name$="[barangay]"]');
                if (citySelect && cityHidden) cityHidden.value = citySelect.options[citySelect.selectedIndex]?.text || '';
                if (brgySelect && brgyHidden) brgyHidden.value = brgySelect.options[brgySelect.selectedIndex]?.text || '';
            });
        });

        // Draft handling
        const saveDraftBtn = document.getElementById('saveDraftBtn');
        const updateBtn = document.getElementById('updateBtn');
        const formEl = document.getElementById('enrollmentForm');
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
        updateBtn?.addEventListener('click', () => {
            statusHidden.value = 'submitted';
        });
        // Keep buttons state updated on any change of the required selects
        [regionSel, provSel, citySel, brgySel, pobRegionSel, pobProvSel, pobCitySel].forEach(sel => sel?.addEventListener('change', checkButtons));
        // Initial state
        setTimeout(checkButtons, 300);
    });
</script>
@endpush

@endsection