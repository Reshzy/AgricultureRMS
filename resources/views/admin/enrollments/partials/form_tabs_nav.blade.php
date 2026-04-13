<div class="rounded-xl border border-emerald-100 bg-emerald-50/40 p-3">
    <div class="flex flex-wrap gap-2" role="tablist" aria-label="Enrollment form sections" data-tab-list>
        <button
            type="button"
            role="tab"
            id="tab-personal-trigger"
            aria-controls="tab-personal-panel"
            aria-selected="true"
            data-tab-trigger="personal"
            class="inline-flex items-center gap-2 rounded-lg border border-emerald-200 bg-white px-4 py-2 text-sm font-semibold text-emerald-900 transition hover:bg-emerald-100"
        >
            <span>Part 1: Personal Information</span>
            <span data-tab-error-badge="personal" class="hidden rounded-full bg-rose-100 px-2 py-0.5 text-xs font-semibold text-rose-700"></span>
        </button>
        <button
            type="button"
            role="tab"
            id="tab-farm-trigger"
            aria-controls="tab-farm-panel"
            aria-selected="false"
            data-tab-trigger="farm"
            class="inline-flex items-center gap-2 rounded-lg border border-transparent bg-white px-4 py-2 text-sm font-semibold text-gray-600 transition hover:bg-emerald-100"
        >
            <span>Part 2: Farm Profile</span>
            <span data-tab-error-badge="farm" class="hidden rounded-full bg-rose-100 px-2 py-0.5 text-xs font-semibold text-rose-700"></span>
        </button>
        <button
            type="button"
            role="tab"
            id="tab-parcels-trigger"
            aria-controls="tab-parcels-panel"
            aria-selected="false"
            data-tab-trigger="parcels"
            class="inline-flex items-center gap-2 rounded-lg border border-transparent bg-white px-4 py-2 text-sm font-semibold text-gray-600 transition hover:bg-emerald-100"
        >
            <span>Farm Parcels</span>
            <span data-tab-error-badge="parcels" class="hidden rounded-full bg-rose-100 px-2 py-0.5 text-xs font-semibold text-rose-700"></span>
        </button>
    </div>
</div>
