@extends('layouts.admin')

@section('title', 'Email Messages')
@section('header', 'Email Messages')

@section('content')
<div class="space-y-6">
    <!-- Header with Stats -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Contact Messages</h2>
            <p class="text-gray-600">Manage messages from your contact form</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="stats-card p-4 rounded-xl text-center">
                <div class="text-2xl font-bold text-emerald-600" id="total-count">{{ $messages->total() }}</div>
                <div class="text-sm text-gray-600">Total Messages</div>
            </div>
            <div class="stats-card p-4 rounded-xl text-center">
                <div class="text-2xl font-bold text-red-600" id="unread-count">{{ $unreadCount }}</div>
                <div class="text-sm text-gray-600">Unread</div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="card-hover bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form id="search-form" class="space-y-4">
            <!-- Search Bar -->
            <div class="flex items-center space-x-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text"
                            id="search-input"
                            name="search"
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                            placeholder="Search by name, email, subject, or message...">
                    </div>
                </div>
                <button type="button"
                    id="clear-search"
                    class="px-4 py-3 text-gray-500 hover:text-gray-700 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times"></i>
                    Clear
                </button>
            </div>

            <!-- Filters Row -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status"
                        id="status-filter"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">All Messages</option>
                        <option value="unread">Unread Only</option>
                        <option value="read">Read Only</option>
                    </select>
                </div>

                <!-- Date From -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                    <input type="date"
                        name="date_from"
                        id="date-from"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <!-- Date To -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                    <input type="date"
                        name="date_to"
                        id="date-to"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <!-- Sort Options -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                    <div class="flex space-x-2">
                        <select name="sort_by"
                            id="sort-by"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="created_at">Date</option>
                            <option value="name">Name</option>
                            <option value="subject">Subject</option>
                            <option value="is_read">Status</option>
                        </select>
                        <button type="button"
                            id="sort-order"
                            data-order="desc"
                            class="px-3 py-2 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                            <i class="fas fa-sort-amount-down"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Loading Indicator -->
    <div id="loading-indicator" class="hidden text-center py-8">
        <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-emerald-600 bg-white transition ease-in-out duration-150">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Searching...
        </div>
    </div>

    <!-- Messages List -->
    <div class="card-hover bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div id="messages-container">
            @include('admin.emails.partials.messages-list', ['messages' => $messages])
        </div>

        <!-- Pagination -->
        <div id="pagination-container" class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $messages->links() }}
        </div>
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('search-form');
        const searchInput = document.getElementById('search-input');
        const statusFilter = document.getElementById('status-filter');
        const dateFrom = document.getElementById('date-from');
        const dateTo = document.getElementById('date-to');
        const sortBy = document.getElementById('sort-by');
        const sortOrderBtn = document.getElementById('sort-order');
        const clearBtn = document.getElementById('clear-search');
        const loadingIndicator = document.getElementById('loading-indicator');
        const messagesContainer = document.getElementById('messages-container');
        const paginationContainer = document.getElementById('pagination-container');
        const totalCount = document.getElementById('total-count');
        const unreadCount = document.getElementById('unread-count');

        let searchTimeout;
        let currentSortOrder = 'desc';

        // Debounced search function
        function performSearch() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                executeSearch();
            }, 300);
        }

        // Execute AJAX search
        function executeSearch() {
            const formData = new FormData(searchForm);
            formData.append('sort_order', currentSortOrder);

            loadingIndicator.classList.remove('hidden');
            messagesContainer.style.opacity = '0.5';

            fetch('{{ route("admin.emails.search") }}?' + new URLSearchParams(formData), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    messagesContainer.innerHTML = data.html;
                    paginationContainer.innerHTML = data.pagination;
                    totalCount.textContent = data.total;
                    unreadCount.textContent = data.unreadCount;

                    // Update sidebar counter
                    const sidebarCounter = document.querySelector('.nav-text .bg-red-500');
                    if (sidebarCounter) {
                        if (data.unreadCount > 0) {
                            sidebarCounter.textContent = data.unreadCount;
                            sidebarCounter.style.display = 'inline-block';
                        } else {
                            sidebarCounter.style.display = 'none';
                        }
                    }
                })
                .catch(error => {
                    console.error('Search error:', error);
                })
                .finally(() => {
                    loadingIndicator.classList.add('hidden');
                    messagesContainer.style.opacity = '1';
                });
        }

        // Event listeners
        searchInput.addEventListener('input', performSearch);
        statusFilter.addEventListener('change', executeSearch);
        dateFrom.addEventListener('change', executeSearch);
        dateTo.addEventListener('change', executeSearch);
        sortBy.addEventListener('change', executeSearch);

        // Sort order toggle
        sortOrderBtn.addEventListener('click', function() {
            currentSortOrder = currentSortOrder === 'desc' ? 'asc' : 'desc';
            const icon = this.querySelector('i');

            if (currentSortOrder === 'desc') {
                icon.className = 'fas fa-sort-amount-down';
            } else {
                icon.className = 'fas fa-sort-amount-up';
            }

            executeSearch();
        });

        // Clear search
        clearBtn.addEventListener('click', function() {
            searchForm.reset();
            currentSortOrder = 'desc';
            sortOrderBtn.querySelector('i').className = 'fas fa-sort-amount-down';
            executeSearch();
        });

        // Handle pagination clicks
        document.addEventListener('click', function(e) {
            if (e.target.closest('#pagination-container a')) {
                e.preventDefault();
                const url = e.target.closest('a').href;
                const urlParams = new URLSearchParams(url.split('?')[1]);

                // Add current search parameters
                const formData = new FormData(searchForm);
                formData.append('sort_order', currentSortOrder);

                for (let [key, value] of formData.entries()) {
                    urlParams.set(key, value);
                }

                loadingIndicator.classList.remove('hidden');
                messagesContainer.style.opacity = '0.5';

                fetch('{{ route("admin.emails.search") }}?' + urlParams.toString(), {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        messagesContainer.innerHTML = data.html;
                        paginationContainer.innerHTML = data.pagination;
                        totalCount.textContent = data.total;
                        unreadCount.textContent = data.unreadCount;
                    })
                    .catch(error => {
                        console.error('Pagination error:', error);
                    })
                    .finally(() => {
                        loadingIndicator.classList.add('hidden');
                        messagesContainer.style.opacity = '1';
                    });
            }
        });
    });
</script>
@endpush