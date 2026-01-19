@extends('layouts.admin')

@push('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('header', 'Dashboard')

@section('content')
<!-- Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
    <div class="bg-white/90 rounded-2xl p-5 card-hover border border-emerald-900/5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-emerald-700">Total Enrollments</p>
                <p class="text-2xl font-bold text-emerald-900 mt-1">{{ number_format($totalEnrollments) }}</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 grid place-items-center"><i class="fa-solid fa-users"></i></div>
        </div>
    </div>
    <div class="bg-white/90 rounded-2xl p-5 card-hover border border-emerald-900/5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-emerald-700">Barangays</p>
                <p class="text-2xl font-bold text-emerald-900 mt-1">{{ $uniqueBarangays }}</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-teal-100 text-teal-700 grid place-items-center"><i class="fa-solid fa-location-dot"></i></div>
        </div>
    </div>
    <div class="bg-white/90 rounded-2xl p-5 card-hover border border-emerald-900/5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-emerald-700">Pending Drafts</p>
                <p class="text-2xl font-bold text-emerald-900 mt-1">{{ $pendingDrafts }}</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 grid place-items-center"><i class="fa-regular fa-file-lines"></i></div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="bg-white/90 rounded-2xl p-6 border border-emerald-900/5 mb-6">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-emerald-900 font-semibold">Enrollments by Barangay</h2>
        <div class="text-xs text-emerald-700 bg-emerald-50 px-2 py-1 rounded">Top 10 Barangays</div>
    </div>
    <canvas id="chartFarmers" height="80"></canvas>
</div>

<!-- Recent Enrollments & News -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Enrollments -->
    <div class="bg-white/90 rounded-2xl border border-emerald-900/5 overflow-hidden">
        <div class="px-6 py-4 flex items-center justify-between border-b border-emerald-900/10">
            <h3 class="text-emerald-900 font-semibold">Recent Enrollments</h3>
            <a href="{{ route('admin.enrollments.index') }}" class="text-xs text-emerald-700 hover:text-emerald-900">View All →</a>
        </div>
        <div class="divide-y divide-emerald-900/10">
            @forelse ($recentEnrollments as $enrollment)
            <div class="px-6 py-3 hover:bg-emerald-50/40 transition">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="flex-shrink-0">
                            @if($enrollment->photo_path)
                            <img src="{{ Storage::disk('public')->url($enrollment->photo_path) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-emerald-200">
                            @else
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center border-2 border-emerald-200">
                                <span class="text-emerald-700 font-medium text-sm">{{ strtoupper(substr($enrollment->first_name, 0, 1)) }}{{ strtoupper(substr($enrollment->surname, 0, 1)) }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="font-medium text-emerald-900">{{ $enrollment->surname }}, {{ $enrollment->first_name }}</div>
                            <div class="text-xs text-emerald-700 mt-1">
                                <span>{{ $enrollment->address_barangay }}</span>
                                <span class="mx-1">•</span>
                                <span>{{ ucfirst(str_replace('_', ' ', $enrollment->main_livelihood)) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-1 rounded-full text-xs {{ $enrollment->status === 'draft' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">
                            {{ ucfirst($enrollment->status ?? 'submitted') }}
                        </span>
                        <a href="{{ route('admin.enrollments.edit', $enrollment) }}" class="text-emerald-700 hover:text-emerald-900"><i class="fa-solid fa-edit"></i></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-500">No enrollments yet.</div>
            @endforelse
        </div>
        <div class="px-6 py-3 bg-emerald-50/30 border-t border-emerald-900/10">
            <a href="{{ route('admin.enrollments.create') }}" class="block text-center text-sm text-emerald-700 hover:text-emerald-900 font-medium">
                <i class="fa-solid fa-plus mr-1"></i> Add New Enrollment
            </a>
        </div>
    </div>

    <!-- Recent News -->
    <div class="bg-white/90 rounded-2xl border border-emerald-900/5 overflow-hidden">
        <div class="px-6 py-4 flex items-center justify-between border-b border-emerald-900/10">
            <h3 class="text-emerald-900 font-semibold">Recent News</h3>
            <a href="{{ route('admin.news.index') }}" class="text-xs text-emerald-700 hover:text-emerald-900">View All →</a>
        </div>
        <div class="divide-y divide-emerald-900/10">
            @forelse ($recentNews as $news)
            <div class="px-6 py-3 hover:bg-emerald-50/40 transition">
                <div class="font-medium text-emerald-900 line-clamp-1">{{ $news->title }}</div>
                <div class="text-xs text-emerald-700 mt-1 line-clamp-2">{{ Str::limit(strip_tags($news->content), 100) }}</div>
                <div class="flex items-center justify-between mt-2">
                    <span class="text-xs text-gray-500">{{ $news->created_at->diffForHumans() }}</span>
                    <a href="{{ route('admin.news.edit', $news) }}" class="text-xs text-emerald-700 hover:text-emerald-900">Edit →</a>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-500">No news yet.</div>
            @endforelse
        </div>
        <div class="px-6 py-3 bg-emerald-50/30 border-t border-emerald-900/10">
            <a href="{{ route('admin.news.create') }}" class="block text-center text-sm text-emerald-700 hover:text-emerald-900 font-medium">
                <i class="fa-solid fa-plus mr-1"></i> Add New Article
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx1 = document.getElementById('chartFarmers');
        if (ctx1) {
            const barangayData = @json($enrollmentsByBarangay);
            const labels = barangayData.map(item => item.address_barangay || 'Unknown');
            const counts = barangayData.map(item => item.count);

            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Enrollments',
                        data: counts,
                        backgroundColor: 'rgba(5,150,105,.35)',
                        borderColor: '#059669',
                        borderWidth: 2,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush