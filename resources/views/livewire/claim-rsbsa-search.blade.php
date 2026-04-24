<div class="mt-4">
    <input
        type="text"
        wire:model.live.debounce.400ms="query"
        placeholder="Search RSBSA number or name..."
        autocomplete="off"
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500"
    >

    <p class="mt-3 text-sm {{ $messageIsError ? 'text-red-600' : 'text-gray-600' }}">
        {{ $message }}
    </p>

    <div wire:loading class="mt-2 text-xs text-emerald-700" wire:target="query">
        Searching...
    </div>

    <div class="mt-4 space-y-2">
        @foreach ($results as $item)
            <button
                type="button"
                wire:key="enrollment-{{ $item['id'] }}"
                wire:click="selectEnrollment({{ $item['id'] }})"
                class="w-full rounded-lg border px-3 py-3 text-left text-sm hover:border-emerald-400 hover:bg-emerald-50 {{ $selectedEnrollmentId === $item['id'] ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 bg-white' }}"
            >
                <p class="font-semibold text-emerald-900">{{ $item['rsbsa_reference_number'] }}</p>
                <p class="text-gray-700">{{ $item['full_name'] }}</p>
                <p class="text-xs text-gray-500">{{ $item['barangay'] ?? 'N/A' }}{{ $item['municipality'] ? ', '.$item['municipality'] : '' }}</p>
            </button>
        @endforeach
    </div>

    @if ($selectedEnrollment)
        <p class="mt-4 rounded-lg border border-emerald-100 bg-emerald-50 px-3 py-2 text-sm text-emerald-800">
            Selected: {{ $selectedEnrollment['rsbsa_reference_number'] }} - {{ $selectedEnrollment['full_name'] }}
        </p>
    @endif
</div>
