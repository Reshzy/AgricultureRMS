@extends('layouts.admin')

@section('title', 'Enrollments • Admin')
@section('header', 'Enrollments')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold text-emerald-900">Enrollments</h1>
    <div class="flex gap-2">
        <a href="{{ route('admin.enrollments.create') }}" class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm transition"><i class="fa-solid fa-plus mr-1"></i> New</a>
    </div>
</div>

@if (session('status'))
<div class="mb-4 text-green-700 bg-green-100 border border-green-200 rounded p-3">{{ session('status') }}</div>
@endif

<div class="bg-white/90 rounded-2xl border border-emerald-900/5 overflow-hidden">
    <div class="px-6 py-4 border-b border-emerald-900/10">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div class="text-emerald-900 font-semibold">All Records</div>
            <div class="flex items-center gap-2">
                <label class="text-xs text-emerald-700">Per page</label>
                <select id="perPage" class="px-2 py-1 rounded border text-sm">
                    @foreach([10,15,25,50,100] as $n)
                    <option value="{{ $n }}" {{ ($perPage ?? 15)===$n ? 'selected' : '' }}>{{ $n }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-3 grid grid-cols-1 md:grid-cols-6 gap-2">
            <input id="filterName" type="text" value="{{ $name ?? '' }}" placeholder="Search name or RSBSA..." class="px-3 py-2 rounded-lg border text-sm md:col-span-2" />
            <select id="filterBarangay" class="px-3 py-2 rounded-lg border text-sm">
                <option value="">All barangays</option>
                @foreach($barangays ?? [] as $brgy)
                <option value="{{ $brgy }}" {{ ($barangay ?? '')===$brgy ? 'selected':'' }}>{{ $brgy }}</option>
                @endforeach
            </select>
            <input id="filterParcel" type="text" value="{{ $parcel ?? '' }}" placeholder="Parcel (kind, name, farm type)..." class="px-3 py-2 rounded-lg border text-sm" />
            <select id="filterLivelihood" class="px-3 py-2 rounded-lg border text-sm">
                <option value="">All livelihoods</option>
                <option value="farmer" {{ ($livelihood ?? '')==='farmer' ? 'selected':'' }}>Farmer</option>
                <option value="farmworker" {{ ($livelihood ?? '')==='farmworker' ? 'selected':'' }}>Farmworker</option>
                <option value="fisherfolk" {{ ($livelihood ?? '')==='fisherfolk' ? 'selected':'' }}>Fisherfolk</option>
                <option value="agri_youth" {{ ($livelihood ?? '')==='agri_youth' ? 'selected':'' }}>Agri Youth</option>
            </select>
            <select id="filterStatus" class="px-3 py-2 rounded-lg border text-sm">
                <option value="">All status</option>
                <option value="draft" {{ ($status ?? '')==='draft' ? 'selected':'' }}>Draft</option>
                <option value="submitted" {{ ($status ?? '')==='submitted' ? 'selected':'' }}>Submitted</option>
            </select>
            <button id="resetFilters" class="px-3 py-2 rounded-lg border text-sm">Reset</button>
        </div>
        <button id="toggleAdvancedFilters" type="button" class="mt-3 w-full px-3 py-2 rounded-lg border border-emerald-900/10 bg-emerald-50/50 hover:bg-emerald-50 text-emerald-900 text-sm transition-colors flex items-center justify-between" aria-expanded="false" aria-controls="advancedFiltersContainer">
            <span class="font-medium">Advanced Filters</span>
            <i class="fa-solid fa-chevron-down transition-transform duration-300" id="toggleIcon"></i>
        </button>
        <div id="advancedFiltersContainer" class="hidden mt-3 pt-3 border-t border-emerald-900/10 transition-all duration-300" aria-labelledby="toggleAdvancedFilters">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-2">
                <select id="filterInsurance" class="px-3 py-2 rounded-lg border text-sm">
                    <option value="">All insurance</option>
                    <option value="1" {{ ($insurance ?? '')==='1' ? 'selected':'' }}>Yes</option>
                    <option value="0" {{ ($insurance ?? '')==='0' ? 'selected':'' }}>No</option>
                </select>
                <select id="filterSex" class="px-3 py-2 rounded-lg border text-sm">
                    <option value="">All sex</option>
                    <option value="male" {{ ($sex ?? '')==='male' ? 'selected':'' }}>Male</option>
                    <option value="female" {{ ($sex ?? '')==='female' ? 'selected':'' }}>Female</option>
                </select>
                <input id="filterMobile" type="text" value="{{ $mobile ?? '' }}" placeholder="Mobile number..." class="px-3 py-2 rounded-lg border text-sm" />
                <input id="filterLandline" type="text" value="{{ $landline ?? '' }}" placeholder="Landline number..." class="px-3 py-2 rounded-lg border text-sm" />
                <select id="filterEducation" class="px-3 py-2 rounded-lg border text-sm">
                    <option value="">All education</option>
                    @foreach(['Pre-school','Elementary','High school (non-K-12)','Junior High school (K-12)','Senior High school (K-12)','College','Vocational','Post graduate','None'] as $opt)
                    <option value="{{ $opt }}" {{ ($education ?? '')===$opt ? 'selected':'' }}>{{ $opt }}</option>
                    @endforeach
                </select>
                <input id="filterReligion" type="text" value="{{ $religion ?? '' }}" placeholder="Religion..." class="px-3 py-2 rounded-lg border text-sm" />
                <select id="filterCivilStatus" class="px-3 py-2 rounded-lg border text-sm">
                    <option value="">All civil status</option>
                    <option value="single" {{ ($civilStatus ?? '')==='single' ? 'selected':'' }}>Single</option>
                    <option value="married" {{ ($civilStatus ?? '')==='married' ? 'selected':'' }}>Married</option>
                    <option value="widowed" {{ ($civilStatus ?? '')==='widowed' ? 'selected':'' }}>Widowed</option>
                    <option value="separated" {{ ($civilStatus ?? '')==='separated' ? 'selected':'' }}>Separated</option>
                </select>
                <select id="filterHouseholdHead" class="px-3 py-2 rounded-lg border text-sm">
                    <option value="">All household head</option>
                    <option value="1" {{ ($householdHead ?? '')==='1' ? 'selected':'' }}>Yes</option>
                    <option value="0" {{ ($householdHead ?? '')==='0' ? 'selected':'' }}>No</option>
                </select>
                <select id="filterPwd" class="px-3 py-2 rounded-lg border text-sm">
                    <option value="">All PWD</option>
                    <option value="1" {{ ($pwd ?? '')==='1' ? 'selected':'' }}>Yes</option>
                    <option value="0" {{ ($pwd ?? '')==='0' ? 'selected':'' }}>No</option>
                </select>
                <select id="filterFourPs" class="px-3 py-2 rounded-lg border text-sm">
                    <option value="">All 4P's</option>
                    <option value="1" {{ ($fourPs ?? '')==='1' ? 'selected':'' }}>Yes</option>
                    <option value="0" {{ ($fourPs ?? '')==='0' ? 'selected':'' }}>No</option>
                </select>
                <select id="filterIndigenous" class="px-3 py-2 rounded-lg border text-sm">
                    <option value="">All indigenous</option>
                    <option value="1" {{ ($indigenous ?? '')==='1' ? 'selected':'' }}>Yes</option>
                    <option value="0" {{ ($indigenous ?? '')==='0' ? 'selected':'' }}>No</option>
                </select>
                <select id="filterGovernmentId" class="px-3 py-2 rounded-lg border text-sm">
                    <option value="">All Gov't ID</option>
                    <option value="1" {{ ($governmentId ?? '')==='1' ? 'selected':'' }}>Yes</option>
                    <option value="0" {{ ($governmentId ?? '')==='0' ? 'selected':'' }}>No</option>
                </select>
            </div>
        </div>
    </div>
    <div id="tableWrap">
        @include('admin.enrollments.partials.table', ['enrollments' => $enrollments])
    </div>
</div>

<!-- View Modal -->
<div id="viewModal" class="fixed inset-0 bg-black/40 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-3xl w-full max-h-[80vh] overflow-hidden flex flex-col">
        <div class="px-6 py-4 border-b">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-emerald-900">Enrollment Details</h3>
                <button id="viewClose" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
        </div>
        <div id="viewBody" class="p-6 space-y-6 overflow-y-auto scrollbar">
            <!-- Sections injected via fetch -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('viewModal');
        const body = document.getElementById('viewBody');
        const closeBtn = document.getElementById('viewClose');
        const wrap = document.getElementById('tableWrap');
        const nameI = document.getElementById('filterName');
        const brgyI = document.getElementById('filterBarangay');
        const parcelI = document.getElementById('filterParcel');
        const livI = document.getElementById('filterLivelihood');
        const statusI = document.getElementById('filterStatus');
        const insuranceI = document.getElementById('filterInsurance');
        const sexI = document.getElementById('filterSex');
        const mobileI = document.getElementById('filterMobile');
        const landlineI = document.getElementById('filterLandline');
        const educationI = document.getElementById('filterEducation');
        const religionI = document.getElementById('filterReligion');
        const civilStatusI = document.getElementById('filterCivilStatus');
        const householdHeadI = document.getElementById('filterHouseholdHead');
        const pwdI = document.getElementById('filterPwd');
        const fourPsI = document.getElementById('filterFourPs');
        const indigenousI = document.getElementById('filterIndigenous');
        const governmentIdI = document.getElementById('filterGovernmentId');
        const perPageI = document.getElementById('perPage');
        const resetBtn = document.getElementById('resetFilters');
        const toggleAdvancedBtn = document.getElementById('toggleAdvancedFilters');
        const advancedFiltersContainer = document.getElementById('advancedFiltersContainer');
        const toggleIcon = document.getElementById('toggleIcon');
        const advancedFiltersStateKey = 'enrollmentsAdvancedFiltersVisible';

        // Advanced Filters Toggle Functionality
        const applyAdvancedFiltersState = (visible) => {
            if (!advancedFiltersContainer || !toggleIcon || !toggleAdvancedBtn) {
                return;
            }

            if (visible) {
                advancedFiltersContainer.classList.remove('hidden');
                toggleIcon.classList.remove('fa-chevron-down');
                toggleIcon.classList.add('fa-chevron-up');
                toggleAdvancedBtn.setAttribute('aria-expanded', 'true');
            } else {
                advancedFiltersContainer.classList.add('hidden');
                toggleIcon.classList.remove('fa-chevron-up');
                toggleIcon.classList.add('fa-chevron-down');
                toggleAdvancedBtn.setAttribute('aria-expanded', 'false');
            }
        };

        // Initialize advanced filters state from localStorage
        const savedAdvancedFiltersState = localStorage.getItem(advancedFiltersStateKey);
        if (savedAdvancedFiltersState !== null) {
            applyAdvancedFiltersState(savedAdvancedFiltersState === 'true');
        } else {
            // Default to hidden if no saved state
            applyAdvancedFiltersState(false);
        }

        // Toggle advanced filters on button click
        toggleAdvancedBtn?.addEventListener('click', () => {
            const isCurrentlyVisible = !advancedFiltersContainer.classList.contains('hidden');
            const nextState = !isCurrentlyVisible;
            applyAdvancedFiltersState(nextState);
            localStorage.setItem(advancedFiltersStateKey, String(nextState));
        });

        closeBtn?.addEventListener('click', () => modal.classList.add('hidden'));
        modal?.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.add('hidden');
        });

        function bindViewButtons(scope = document) {
            scope.querySelectorAll('.viewBtn').forEach(btn => {
                btn.addEventListener('click', async () => {
                    const id = btn.getAttribute('data-view-id');
                    const res = await fetch(`{{ url('/admin/enrollments') }}/${id}`);
                    const html = await res.text();
                    body.innerHTML = html;
                    modal.classList.remove('hidden');
                });
            });
        }

        // Handle history accordion toggles (works with dynamically loaded content)
        function toggleHistory(id) {
            console.log('toggleHistory called with id:', id);
            const element = document.getElementById(id);
            if (!element) {
                console.warn('History element not found:', id);
                return;
            }
            
            console.log('Element found, current classes:', element.className);
            const icon = document.getElementById('icon-' + id);
            const button = element.previousElementSibling;
            
            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden');
                console.log('Removed hidden class, element should be visible now');
                if (icon) icon.classList.add('rotate-180');
                if (button) button.setAttribute('aria-expanded', 'true');
            } else {
                element.classList.add('hidden');
                console.log('Added hidden class');
                if (icon) icon.classList.remove('rotate-180');
                if (button) button.setAttribute('aria-expanded', 'false');
            }
        }

        // Use event delegation for history accordion buttons (works with dynamically loaded content)
        // Attach to document and check if click is inside modal
        document.addEventListener('click', (e) => {
            // Only handle clicks inside the modal
            if (!modal || !modal.contains(e.target)) return;
            
            const button = e.target.closest('.history-toggle-btn');
            if (button) {
                console.log('History toggle button clicked');
                e.preventDefault();
                e.stopPropagation();
                const historyId = button.getAttribute('data-history-id');
                console.log('History ID:', historyId);
                if (historyId) {
                    toggleHistory(historyId);
                } else {
                    console.warn('No data-history-id found on button');
                }
            }
        });

        // Make toggleHistory available globally (backup for onclick handlers)
        window.toggleHistory = toggleHistory;

        bindViewButtons(document);

        const debounce = (fn, ms = 300) => {
            let t;
            return (...args) => {
                clearTimeout(t);
                t = setTimeout(() => fn(...args), ms);
            };
        };

        function buildParams(page) {
            const p = new URLSearchParams();
            if (nameI.value.trim()) p.set('q', nameI.value.trim());
            if (brgyI.value.trim()) p.set('barangay', brgyI.value.trim());
            if (parcelI.value.trim()) p.set('parcel', parcelI.value.trim());
            if (livI.value) p.set('livelihood', livI.value);
            if (statusI.value) p.set('status', statusI.value);
            if (insuranceI.value) p.set('insurance', insuranceI.value);
            if (sexI.value) p.set('sex', sexI.value);
            if (mobileI.value.trim()) p.set('mobile', mobileI.value.trim());
            if (landlineI.value.trim()) p.set('landline', landlineI.value.trim());
            if (educationI.value) p.set('education', educationI.value);
            if (religionI.value.trim()) p.set('religion', religionI.value.trim());
            if (civilStatusI.value) p.set('civil_status', civilStatusI.value);
            if (householdHeadI.value) p.set('household_head', householdHeadI.value);
            if (pwdI.value) p.set('pwd', pwdI.value);
            if (fourPsI.value) p.set('four_ps', fourPsI.value);
            if (indigenousI.value) p.set('indigenous', indigenousI.value);
            if (governmentIdI.value) p.set('government_id', governmentIdI.value);
            p.set('per_page', perPageI.value || '15');
            if (page) p.set('page', page);
            return p.toString();
        }

        async function loadTableWithParams(params) {
            const url = `{{ route('admin.enrollments.index') }}?${params}`;
            const res = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const html = await res.text();
            wrap.innerHTML = html;
            bindViewButtons(wrap);
        }

        const refresh = debounce(() => loadTableWithParams(buildParams()), 300);

        nameI.addEventListener('input', refresh);
        brgyI.addEventListener('change', refresh);
        parcelI.addEventListener('input', refresh);
        livI.addEventListener('change', refresh);
        statusI.addEventListener('change', refresh);
        insuranceI.addEventListener('change', refresh);
        sexI.addEventListener('change', refresh);
        mobileI.addEventListener('input', refresh);
        landlineI.addEventListener('input', refresh);
        educationI.addEventListener('change', refresh);
        religionI.addEventListener('input', refresh);
        civilStatusI.addEventListener('change', refresh);
        householdHeadI.addEventListener('change', refresh);
        pwdI.addEventListener('change', refresh);
        fourPsI.addEventListener('change', refresh);
        indigenousI.addEventListener('change', refresh);
        governmentIdI.addEventListener('change', refresh);
        perPageI.addEventListener('change', () => loadTableWithParams(buildParams(1)));
        resetBtn.addEventListener('click', () => {
            nameI.value = '';
            brgyI.value = '';
            parcelI.value = '';
            livI.value = '';
            statusI.value = '';
            insuranceI.value = '';
            sexI.value = '';
            mobileI.value = '';
            landlineI.value = '';
            educationI.value = '';
            religionI.value = '';
            civilStatusI.value = '';
            householdHeadI.value = '';
            pwdI.value = '';
            fourPsI.value = '';
            indigenousI.value = '';
            governmentIdI.value = '';
            loadTableWithParams(buildParams(1));
        });

        // Intercept pagination inside table wrapper
        wrap.addEventListener('click', (e) => {
            const a = e.target.closest('a');
            if (!a) return;
            const url = new URL(a.getAttribute('href'), window.location.origin);
            if (url.searchParams.has('page')) {
                e.preventDefault();
                const page = url.searchParams.get('page');
                loadTableWithParams(buildParams(page));
            }
        });
    });
</script>
@endpush