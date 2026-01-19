<div class="overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-emerald-50/70 text-emerald-900">
            <tr>
                <th class="px-6 py-3 text-left font-medium">Name</th>
                <th class="px-6 py-3 text-left font-medium">Email</th>
                <th class="px-6 py-3 text-left font-medium">Admin Status</th>
                <th class="px-6 py-3 text-left font-medium">Registered</th>
                <th class="px-6 py-3 text-right font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-emerald-900/10">
            @forelse ($users as $user)
            <tr class="hover:bg-emerald-50/40">
                <td class="px-6 py-3 font-medium">{{ $user->name }}</td>
                <td class="px-6 py-3 text-gray-600">{{ $user->email }}</td>
                <td class="px-6 py-3">
                    <span class="px-2 py-1 rounded-full text-xs {{ $user->is_admin ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-700' }}">
                        {{ $user->is_admin ? 'Admin' : 'Pending' }}
                    </span>
                </td>
                <td class="px-6 py-3 text-gray-600">{{ $user->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-3 text-right">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="inline mr-2">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="is_admin" value="{{ $user->is_admin ? '0' : '1' }}">
                        <button 
                            type="submit" 
                            class="px-3 py-1 rounded text-xs {{ $user->is_admin ? 'bg-amber-100 text-amber-700 hover:bg-amber-200' : 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' }}"
                            onclick="return confirm('{{ $user->is_admin ? 'Revoke' : 'Grant' }} admin access for {{ $user->name }}?')"
                        >
                            {{ $user->is_admin ? 'Revoke Admin' : 'Grant Admin' }}
                        </button>
                    </form>
                    @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Delete user {{ $user->name }}? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button class="text-rose-600 hover:text-rose-700" title="Delete"><i class="fa-solid fa-trash"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">No users found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="px-6 py-4">{{ $users->links() }}</div>

