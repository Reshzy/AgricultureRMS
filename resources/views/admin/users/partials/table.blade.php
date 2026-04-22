<div class="overflow-x-auto">
    @php($canManageRequests = (bool) auth()->user()?->is_main_admin)
    <table class="min-w-full text-sm">
        <thead class="bg-emerald-50/70 text-emerald-900">
            <tr>
                <th class="px-6 py-3 text-left font-medium">Name</th>
                <th class="px-6 py-3 text-left font-medium">Email</th>
                <th class="px-6 py-3 text-left font-medium">Hierarchy</th>
                <th class="px-6 py-3 text-left font-medium">Request Status</th>
                <th class="px-6 py-3 text-left font-medium">Access</th>
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
                    <span class="px-2 py-1 rounded-full text-xs {{ $user->is_main_admin ? 'bg-purple-100 text-purple-700' : ($user->is_admin ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-700') }}">
                        {{ $user->is_main_admin ? 'Main Admin' : ($user->is_admin ? 'Admin' : 'Admin Request') }}
                    </span>
                </td>
                <td class="px-6 py-3">
                    <span class="px-2 py-1 rounded-full text-xs {{ $user->admin_request_status === 'approved' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ ucfirst($user->admin_request_status ?? 'pending') }}
                    </span>
                </td>
                <td class="px-6 py-3">
                    <span class="px-2 py-1 rounded-full text-xs {{ ($user->is_active ?? true) ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                        {{ ($user->is_active ?? true) ? 'Active' : 'Disabled' }}
                    </span>
                </td>
                <td class="px-6 py-3 text-gray-600">{{ $user->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-3 text-right">
                    @if ($canManageRequests && ! $user->is_main_admin)
                        @if (($user->admin_request_status ?? 'pending') === 'pending')
                            <form method="POST" action="{{ route('admin.users.approve', $user) }}" class="inline mr-2">
                                @csrf
                                @method('PATCH')
                                <button
                                    type="submit"
                                    class="px-3 py-1 rounded text-xs bg-emerald-100 text-emerald-700 hover:bg-emerald-200"
                                    onclick="return confirm('Approve admin registration for {{ $user->name }}?')"
                                >
                                    Approve
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.users.reject', $user) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="px-3 py-1 rounded text-xs bg-red-100 text-red-700 hover:bg-red-200"
                                    onclick="return confirm('Reject this request and delete the account for {{ $user->name }}? This cannot be undone.')"
                                >
                                    Reject & Delete
                                </button>
                            </form>
                        @else
                            @if ($user->is_active)
                                <form method="POST" action="{{ route('admin.users.disable', $user) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        type="submit"
                                        class="px-3 py-1 rounded text-xs bg-amber-100 text-amber-700 hover:bg-amber-200"
                                        onclick="return confirm('Disable access for {{ $user->name }}? They will no longer be able to log in.')"
                                    >
                                        Disable Access
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.users.enable', $user) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        type="submit"
                                        class="px-3 py-1 rounded text-xs bg-emerald-100 text-emerald-700 hover:bg-emerald-200"
                                        onclick="return confirm('Re-enable access for {{ $user->name }}?')"
                                    >
                                        Re-enable Access
                                    </button>
                                </form>
                            @endif
                        @endif
                    @else
                        <span class="text-xs text-gray-500">No actions available</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-8 text-center text-gray-500">No users found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="px-6 py-4">{{ $users->links() }}</div>

