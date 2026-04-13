<style>
    .folder-tab-shell {
        border: 1px solid #a7f3d0;
        background: linear-gradient(180deg, #ecfdf5 0%, #d1fae5 100%);
    }

    .folder-tab {
        position: relative;
        border: 1px solid transparent;
        border-radius: 0.85rem 0.85rem 0.6rem 0.6rem;
        background: linear-gradient(180deg, #ffffff 0%, #f0fdf4 100%);
        color: #4b5563;
        transform: translateY(0);
        transition: transform 220ms ease, box-shadow 220ms ease, border-color 220ms ease, color 220ms ease, background-color 220ms ease;
        box-shadow: inset 0 -1px 0 rgba(16, 185, 129, 0.15);
    }

    .folder-tab::before {
        content: '';
        position: absolute;
        top: -0.45rem;
        left: 0.85rem;
        width: 2.4rem;
        height: 0.45rem;
        border: 1px solid rgba(16, 185, 129, 0.25);
        border-bottom: 0;
        border-radius: 0.55rem 0.55rem 0 0;
        background: #dcfce7;
        opacity: 0.75;
        transition: width 220ms ease, opacity 220ms ease, background-color 220ms ease;
    }

    .folder-tab.is-active {
        border-color: #6ee7b7;
        background: linear-gradient(180deg, #ffffff 0%, #ecfdf5 100%);
        color: #065f46;
        transform: translateY(-2px);
        box-shadow: 0 10px 22px -16px rgba(5, 150, 105, 0.8), inset 0 -1px 0 rgba(16, 185, 129, 0.22);
    }

    .folder-tab.is-active::before {
        width: 3.2rem;
        opacity: 1;
        background: #bbf7d0;
    }

    .tab-highlight-pop {
        animation: tab-highlight-pop 300ms ease;
    }

    .folder-subtab-shell {
        border: 1px solid #d1fae5;
        background: linear-gradient(180deg, #f0fdf4 0%, #dcfce7 100%);
    }

    .folder-subtab {
        position: relative;
        border: 1px solid transparent;
        border-radius: 0.75rem 0.75rem 0.45rem 0.45rem;
        background: rgba(255, 255, 255, 0.88);
        color: #475569;
        transition: transform 220ms ease, box-shadow 220ms ease, border-color 220ms ease, color 220ms ease, background-color 220ms ease;
    }

    .folder-subtab::before {
        content: '';
        position: absolute;
        top: -0.35rem;
        left: 0.7rem;
        width: 1.8rem;
        height: 0.35rem;
        border: 1px solid rgba(16, 185, 129, 0.2);
        border-bottom: 0;
        border-radius: 0.45rem 0.45rem 0 0;
        background: #dcfce7;
        opacity: 0.75;
        transition: width 220ms ease, opacity 220ms ease;
    }

    .folder-subtab.is-active {
        border-color: #86efac;
        background: #ffffff;
        color: #065f46;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -18px rgba(5, 150, 105, 0.75);
    }

    .folder-subtab.is-active::before {
        width: 2.5rem;
        opacity: 1;
    }

    @keyframes tab-highlight-pop {
        0% {
            transform: translateY(0) scale(0.985);
        }
        55% {
            transform: translateY(-3px) scale(1.02);
        }
        100% {
            transform: translateY(-2px) scale(1);
        }
    }
</style>

<div class="folder-tab-shell rounded-xl p-3">
    <div class="flex flex-wrap gap-2" role="tablist" aria-label="Enrollment form sections" data-tab-list>
        <button
            type="button"
            role="tab"
            id="tab-personal-trigger"
            aria-controls="tab-personal-panel"
            aria-selected="true"
            data-tab-trigger="personal"
            class="folder-tab is-active inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold"
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
            class="folder-tab inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold"
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
            class="folder-tab inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold"
        >
            <span>Farm Parcels</span>
            <span data-tab-error-badge="parcels" class="hidden rounded-full bg-rose-100 px-2 py-0.5 text-xs font-semibold text-rose-700"></span>
        </button>
    </div>
</div>
