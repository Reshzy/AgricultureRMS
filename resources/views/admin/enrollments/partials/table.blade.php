<div class="overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-emerald-50/70 text-emerald-900">
            <tr>
                <th class="px-6 py-3 text-left font-medium">RSBSA No.</th>
                <th class="px-6 py-3 text-left font-medium">Name</th>
                <th class="px-6 py-3 text-left font-medium">Barangay</th>
                <th class="px-6 py-3 text-left font-medium">Livelihood</th>
                <th class="px-6 py-3 text-left font-medium">Status</th>
                <th class="px-6 py-3 text-right font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-emerald-900/10">
            @forelse ($enrollments as $e)
            <tr class="hover:bg-emerald-50/40">
                <td class="px-6 py-3 text-gray-600">{{ $e->rsbsa_reference_number ?? '-' }}</td>
                <td class="px-6 py-3 font-medium">{{ $e->surname }}, {{ $e->first_name }}</td>
                <td class="px-6 py-3">{{ $e->address_barangay }}</td>
                <td class="px-6 py-3">{{ ucfirst(str_replace('_',' ', $e->main_livelihood)) }}</td>
                <td class="px-6 py-3">
                    <span class="px-2 py-1 rounded-full text-xs {{ $e->status==='draft' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">{{ ucfirst($e->status ?? 'submitted') }}</span>
                </td>
                <td class="px-6 py-3 text-right">
                    <button data-view-id="{{ $e->id }}" class="text-emerald-700 hover:text-emerald-900 mr-3 viewBtn" title="View Details"><i class="fa-solid fa-eye"></i></button>
                    <a href="{{ route('admin.enrollments.pdf', $e) }}" class="text-indigo-600 hover:text-indigo-800 mr-3" title="Export PDF"><i class="fa-solid fa-file-pdf"></i></a>
                    <a href="{{ route('admin.enrollments.edit', $e) }}" class="text-blue-600 hover:text-blue-800 mr-3" title="Edit"><i class="fa-solid fa-edit"></i></a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-500">No records found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="px-6 py-4">{{ $enrollments->links() }}</div>