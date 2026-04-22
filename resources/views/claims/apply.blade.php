<x-guest-layout>
    <div class="mx-auto w-full max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <p class="mb-1 font-semibold">Please fix the following and try again:</p>
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-8">
            <h1 class="text-3xl font-semibold text-emerald-900">Apply Claim</h1>
            <p class="mt-2 text-sm text-gray-600">
                Search your RSBSA number, choose one claim type, upload required documents, then review before submission.
            </p>
        </div>

        <div class="mb-8 grid gap-3 sm:grid-cols-5" id="stepIndicators">
            @foreach ([
                1 => 'Find RSBSA',
                2 => 'Contact Email',
                3 => 'Claim Type',
                4 => 'Documents',
                5 => 'Review',
            ] as $step => $label)
                <button
                    type="button"
                    data-step-target="{{ $step }}"
                    class="step-indicator w-full rounded-lg border px-3 py-2 text-left text-sm transition {{ $step === 1 ? 'border-emerald-600 bg-emerald-50 text-emerald-700' : 'border-gray-200 bg-white text-gray-500' }}"
                >
                    <span data-step-badge class="mr-2 inline-flex h-6 w-6 items-center justify-center rounded-full bg-current/10 text-xs font-semibold">{{ $step }}</span>
                    <span>{{ $label }}</span>
                </button>
            @endforeach
        </div>

        <form
            method="POST"
            action="{{ route('claims.store') }}"
            enctype="multipart/form-data"
            id="claimWizardForm"
            data-claim-requirements='@json($claimRequirements)'
            data-claim-labels='@json($claimLabels)'
            data-old-enrollment-id="{{ old('enrollment_id') }}"
            data-old-claim-type="{{ old('claim_type') }}"
            data-search-url="{{ route('claims.search') }}"
            class="space-y-6 rounded-2xl border border-emerald-100 bg-white p-6 shadow-sm"
        >
            @csrf
            <input type="hidden" name="enrollment_id" id="enrollmentIdInput" value="{{ old('enrollment_id') }}">
            <input type="hidden" name="claim_type" id="claimTypeInput" value="{{ old('claim_type') }}">
            <input type="hidden" name="contact_email" id="contactEmailInput" value="{{ old('contact_email') }}">

            <section data-step-panel="1" class="step-panel">
                <h2 class="text-lg font-semibold text-emerald-900">Step 1: Search and select your RSBSA record</h2>
                <p class="mt-1 text-sm text-gray-600">You must select an existing RSBSA record to continue.</p>

                <div class="mt-4 flex flex-col gap-3 sm:flex-row">
                    <input
                        type="text"
                        id="rsbsaSearchInput"
                        value="{{ old('rsbsa_search') }}"
                        placeholder="Format: xx-xx-xx-xxx-xxxx"
                        inputmode="numeric"
                        autocomplete="off"
                        maxlength="17"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500"
                    >
                    <button type="button" id="rsbsaSearchButton" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                        Search
                    </button>
                </div>

                <p id="rsbsaSearchMessage" class="mt-3 text-sm text-gray-600"></p>

                <div id="rsbsaResults" class="mt-4 space-y-2"></div>
                <p id="selectedEnrollmentSummary" class="mt-4 rounded-lg border border-emerald-100 bg-emerald-50 px-3 py-2 text-sm text-emerald-800 hidden"></p>
            </section>

            <section data-step-panel="2" class="step-panel hidden">
                <h2 class="text-lg font-semibold text-emerald-900">Step 2: Provide contact email</h2>
                <p class="mt-1 text-sm text-gray-600">We will send updates to this email when your claim status changes.</p>

                <div class="mt-4 max-w-xl">
                    <label for="contactEmailField" class="mb-1 block text-sm font-medium text-gray-700">Contact Email <span class="text-red-500">*</span></label>
                    <input
                        type="email"
                        id="contactEmailField"
                        value="{{ old('contact_email') }}"
                        placeholder="you@example.com"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500"
                    >
                    <p class="mt-1 text-xs text-gray-500">Required for status notifications: submitted, under review, approved, rejected.</p>
                </div>
            </section>

            <section data-step-panel="3" class="step-panel hidden">
                <h2 class="text-lg font-semibold text-emerald-900">Step 3: Choose claim type</h2>
                <p class="mt-1 text-sm text-gray-600">Only one claim type can be submitted per application.</p>

                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                    @foreach ($claimLabels as $key => $label)
                        <button
                            type="button"
                            data-claim-type="{{ $key }}"
                            class="claim-type-card rounded-xl border border-gray-200 p-4 text-left transition hover:border-emerald-300 hover:bg-emerald-50"
                        >
                            <p class="font-medium text-emerald-900">{{ $label }}</p>
                            <p class="mt-2 text-xs text-gray-600">
                                Required documents:
                                {{ implode(', ', array_values($claimRequirements[$key] ?? [])) }}
                            </p>
                        </button>
                    @endforeach
                </div>
            </section>

            <section data-step-panel="4" class="step-panel hidden">
                <h2 class="text-lg font-semibold text-emerald-900">Step 4: Upload required documents</h2>
                <p class="mt-1 text-sm text-gray-600">Upload one or more files (PDF or image) for each required document.</p>

                <div id="documentFields" class="mt-4 space-y-4"></div>
            </section>

            <section data-step-panel="5" class="step-panel hidden">
                <h2 class="text-lg font-semibold text-emerald-900">Step 5: Review and submit</h2>
                <p class="mt-1 text-sm text-gray-600">Confirm all information before submitting your claim.</p>

                <div class="mt-4 space-y-3 rounded-xl border border-gray-200 bg-gray-50 p-4 text-sm text-gray-700">
                    <p><span class="font-semibold text-gray-900">Selected RSBSA:</span> <span id="reviewRsbsa">—</span></p>
                    <p><span class="font-semibold text-gray-900">Claim type:</span> <span id="reviewClaimType">—</span></p>
                    <p><span class="font-semibold text-gray-900">Contact email:</span> <span id="reviewContactEmail">—</span></p>
                    <div>
                        <p class="font-semibold text-gray-900">Required documents:</p>
                        <ul id="reviewDocuments" class="mt-1 list-disc space-y-1 pl-5"></ul>
                    </div>
                </div>
            </section>

            <div class="flex flex-wrap items-center justify-between gap-3 border-t border-gray-100 pt-4">
                <button type="button" id="prevStepButton" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50" disabled>
                    Previous
                </button>
                <div class="flex items-center gap-2">
                    <button type="button" id="nextStepButton" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                        Next
                    </button>
                    <button type="submit" id="submitButton" class="hidden rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                        Submit Claim
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('claimWizardForm');
            const claimRequirements = JSON.parse(form.dataset.claimRequirements || '{}');
            const claimLabels = JSON.parse(form.dataset.claimLabels || '{}');
            const oldEnrollmentId = form.dataset.oldEnrollmentId || '';
            const oldClaimType = form.dataset.oldClaimType || '';
            const searchRoute = form.dataset.searchUrl || '';
            const enrollmentIdInput = document.getElementById('enrollmentIdInput');
            const claimTypeInput = document.getElementById('claimTypeInput');
            const contactEmailInput = document.getElementById('contactEmailInput');
            const stepPanels = document.querySelectorAll('[data-step-panel]');
            const stepIndicators = document.querySelectorAll('.step-indicator');
            const prevStepButton = document.getElementById('prevStepButton');
            const nextStepButton = document.getElementById('nextStepButton');
            const submitButton = document.getElementById('submitButton');
            const rsbsaSearchInput = document.getElementById('rsbsaSearchInput');
            const rsbsaSearchButton = document.getElementById('rsbsaSearchButton');
            const rsbsaSearchMessage = document.getElementById('rsbsaSearchMessage');
            const rsbsaResults = document.getElementById('rsbsaResults');
            const selectedEnrollmentSummary = document.getElementById('selectedEnrollmentSummary');
            const documentFields = document.getElementById('documentFields');
            const reviewRsbsa = document.getElementById('reviewRsbsa');
            const reviewClaimType = document.getElementById('reviewClaimType');
            const reviewContactEmail = document.getElementById('reviewContactEmail');
            const reviewDocuments = document.getElementById('reviewDocuments');
            const contactEmailField = document.getElementById('contactEmailField');
            const rsbsaDigitGroups = [2, 2, 2, 3, 4];
            const maxRsbsaDigits = 13;

            let currentStep = 1;
            let selectedEnrollment = null;
            let highestVisitedStep = 1;

            function setMessage(message, isError = false) {
                rsbsaSearchMessage.textContent = message;
                rsbsaSearchMessage.className = `mt-3 text-sm ${isError ? 'text-red-600' : 'text-gray-600'}`;
            }

            function formatRsbsaInput(value) {
                const digits = value.replace(/\D/g, '').slice(0, maxRsbsaDigits);
                const chunks = [];
                let cursor = 0;

                rsbsaDigitGroups.forEach((groupSize) => {
                    const chunk = digits.slice(cursor, cursor + groupSize);
                    if (!chunk) {
                        return;
                    }

                    chunks.push(chunk);
                    cursor += groupSize;
                });

                return chunks.join('-');
            }

            function updateStepUI() {
                stepPanels.forEach((panel) => {
                    panel.classList.toggle('hidden', Number(panel.dataset.stepPanel) !== currentStep);
                });

                stepIndicators.forEach((indicator) => {
                    const step = Number(indicator.dataset.stepTarget);
                    const isActive = step === currentStep;
                    const isVisited = step < currentStep || step <= highestVisitedStep - 1;
                    const badge = indicator.querySelector('[data-step-badge]');

                    indicator.className = `step-indicator w-full rounded-lg border px-3 py-2 text-left text-sm transition ${
                        isActive
                            ? 'border-emerald-600 bg-emerald-50 text-emerald-700'
                            : isVisited
                                ? 'border-sky-300 bg-sky-50 text-sky-700'
                                : 'border-gray-200 bg-white text-gray-500'
                    }`;

                    if (badge) {
                        badge.className = `mr-2 inline-flex h-6 w-6 items-center justify-center rounded-full text-xs font-semibold ${
                            isActive
                                ? 'bg-emerald-100 text-emerald-700'
                                : isVisited
                                    ? 'bg-sky-100 text-sky-700'
                                    : 'bg-current/10'
                        }`;
                    }
                });

                prevStepButton.disabled = currentStep === 1;
                nextStepButton.classList.toggle('hidden', currentStep === 5);
                submitButton.classList.toggle('hidden', currentStep !== 5);
            }

            function validateCurrentStep() {
                if (currentStep === 1 && !enrollmentIdInput.value) {
                    setMessage('Please select your RSBSA record first.', true);
                    return false;
                }

                if (currentStep === 2) {
                    const email = contactEmailField.value.trim();
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (email === '' || !emailPattern.test(email)) {
                        alert('Please enter a valid contact email.');
                        return false;
                    }

                    contactEmailInput.value = email;
                }

                if (currentStep === 3 && !claimTypeInput.value) {
                    alert('Please select one claim type.');
                    return false;
                }

                if (currentStep === 4) {
                    const selectedClaimType = claimTypeInput.value;
                    const requirements = claimRequirements[selectedClaimType] || {};
                    for (const key of Object.keys(requirements)) {
                        const input = form.querySelector(`input[name="documents[${key}][]"]`);
                        if (!input || !input.files || input.files.length === 0) {
                            alert(`Please upload at least one file for "${requirements[key]}".`);
                            return false;
                        }
                    }
                }

                return true;
            }

            function renderRequirementInputs() {
                const selectedClaimType = claimTypeInput.value;
                const requirements = claimRequirements[selectedClaimType] || {};
                documentFields.innerHTML = '';

                Object.entries(requirements).forEach(([key, label]) => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'rounded-lg border border-gray-200 p-4';
                    wrapper.innerHTML = `
                        <label class="mb-2 block text-sm font-medium text-gray-800">${label} <span class="text-red-500">*</span></label>
                        <input type="file" name="documents[${key}][]" multiple accept=".jpg,.jpeg,.png,.webp,.pdf" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-emerald-600 file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-white hover:file:bg-emerald-700">
                        <p class="mt-1 text-xs text-gray-500">Allowed: JPG, JPEG, PNG, WEBP, PDF | Max 5MB per file.</p>
                    `;
                    documentFields.appendChild(wrapper);
                });
            }

            function updateReview() {
                reviewRsbsa.textContent = selectedEnrollment
                    ? `${selectedEnrollment.rsbsa_reference_number} - ${selectedEnrollment.full_name}`
                    : '—';

                reviewClaimType.textContent = claimTypeInput.value
                    ? (claimLabels[claimTypeInput.value] || claimTypeInput.value)
                    : '—';
                reviewContactEmail.textContent = contactEmailInput.value || '—';

                reviewDocuments.innerHTML = '';
                const requirements = claimRequirements[claimTypeInput.value] || {};
                Object.values(requirements).forEach((label) => {
                    const li = document.createElement('li');
                    li.textContent = label;
                    reviewDocuments.appendChild(li);
                });
            }

            async function searchRsbsa() {
                const query = rsbsaSearchInput.value.trim();
                if (query.length < 3) {
                    setMessage('Enter at least 3 characters to search.', true);
                    return;
                }

                rsbsaResults.innerHTML = '';
                setMessage('Searching...');

                const url = new URL(searchRoute, window.location.origin);
                url.searchParams.set('q', query);

                try {
                    const response = await fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                    });

                    const payload = await response.json();
                    const data = payload.data || [];

                    if (!data.length) {
                        setMessage(payload.message || 'No registered farmer found for this RSBSA number.', true);
                        rsbsaResults.innerHTML = `
                            <div class="rounded-lg border border-amber-200 bg-amber-50 px-3 py-2 text-sm text-amber-800">
                                You are not registered in the system yet. Please contact the admin office for registration.
                            </div>
                        `;
                        return;
                    }

                    setMessage('Select your record below.');
                    data.forEach((item) => {
                        const button = document.createElement('button');
                        button.type = 'button';
                        button.className = 'w-full rounded-lg border border-gray-200 bg-white px-3 py-3 text-left text-sm hover:border-emerald-400 hover:bg-emerald-50';
                        button.innerHTML = `
                            <p class="font-semibold text-emerald-900">${item.rsbsa_reference_number}</p>
                            <p class="text-gray-700">${item.full_name}</p>
                            <p class="text-xs text-gray-500">${item.barangay || 'N/A'}${item.municipality ? ', ' + item.municipality : ''}</p>
                        `;
                        button.addEventListener('click', () => {
                            selectedEnrollment = item;
                            enrollmentIdInput.value = item.id;
                            selectedEnrollmentSummary.classList.remove('hidden');
                            selectedEnrollmentSummary.textContent = `Selected: ${item.rsbsa_reference_number} - ${item.full_name}`;
                            updateReview();
                        });
                        rsbsaResults.appendChild(button);
                    });
                } catch (error) {
                    setMessage('Search failed. Please try again.', true);
                }
            }

            rsbsaSearchButton.addEventListener('click', searchRsbsa);
            rsbsaSearchInput.addEventListener('input', () => {
                rsbsaSearchInput.value = formatRsbsaInput(rsbsaSearchInput.value);
            });
            rsbsaSearchInput.addEventListener('keydown', (event) => {
                const allowedKeys = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Home', 'End', 'Enter'];
                const isDigit = /^\d$/.test(event.key);
                const hasModifier = event.ctrlKey || event.metaKey || event.altKey;

                if (!hasModifier && !isDigit && !allowedKeys.includes(event.key)) {
                    event.preventDefault();
                }
            });
            rsbsaSearchInput.addEventListener('keydown', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    searchRsbsa();
                }
            });

            rsbsaSearchInput.value = formatRsbsaInput(rsbsaSearchInput.value);

            document.querySelectorAll('.claim-type-card').forEach((button) => {
                button.addEventListener('click', () => {
                    document.querySelectorAll('.claim-type-card').forEach((card) => {
                        card.classList.remove('border-emerald-500', 'bg-emerald-50');
                    });

                    button.classList.add('border-emerald-500', 'bg-emerald-50');
                    claimTypeInput.value = button.dataset.claimType;
                    renderRequirementInputs();
                    updateReview();
                });
            });

            nextStepButton.addEventListener('click', () => {
                if (!validateCurrentStep()) {
                    return;
                }

                if (currentStep < 5) {
                    currentStep += 1;
                }
                highestVisitedStep = Math.max(highestVisitedStep, currentStep);

                if (currentStep === 5) {
                    updateReview();
                }

                updateStepUI();
            });

            prevStepButton.addEventListener('click', () => {
                if (currentStep > 1) {
                    currentStep -= 1;
                }
                updateStepUI();
            });

            if (oldEnrollmentId) {
                enrollmentIdInput.value = oldEnrollmentId;
                selectedEnrollmentSummary.classList.remove('hidden');
                selectedEnrollmentSummary.textContent = 'RSBSA record selected from previous attempt.';
            }

            if (oldClaimType && claimRequirements[oldClaimType]) {
                claimTypeInput.value = oldClaimType;
                const card = document.querySelector(`[data-claim-type="${oldClaimType}"]`);
                card?.classList.add('border-emerald-500', 'bg-emerald-50');
                renderRequirementInputs();
            }

            if (contactEmailInput.value) {
                contactEmailField.value = contactEmailInput.value;
            }

            contactEmailField.addEventListener('input', () => {
                contactEmailInput.value = contactEmailField.value.trim();
                updateReview();
            });

            updateReview();
            updateStepUI();
        });
    </script>
</x-guest-layout>
