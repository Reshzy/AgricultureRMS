<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 15);
        if (! in_array($perPage, [10, 15, 25, 50, 100])) {
            $perPage = 15;
        }

        $query = User::query();

        // Search filter
        $search = trim((string) $request->input('q'));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Admin status filter
        $adminFilter = $request->input('admin');
        if ($adminFilter === 'yes') {
            $query->where('is_admin', true);
        } elseif ($adminFilter === 'no') {
            $query->where('is_admin', false);
        }

        $requestStatusFilter = $request->input('request_status');
        if (in_array($requestStatusFilter, [User::ADMIN_REQUEST_PENDING, User::ADMIN_REQUEST_APPROVED], true)) {
            $query->where('admin_request_status', $requestStatusFilter);
        }

        $users = $query->orderByDesc('created_at')->paginate($perPage)->appends($request->except('page'));

        if ($request->ajax()) {
            return view('admin.users.partials.table', compact('users'));
        }

        return view('admin.users.index', compact('users', 'search', 'adminFilter', 'requestStatusFilter', 'perPage'));
    }

    /**
     * Approve a pending registration request.
     */
    public function approve(Request $request, User $user)
    {
        if ($user->is_main_admin) {
            return back()->with('error', 'Main admin accounts cannot be modified from this screen.');
        }

        if ($user->admin_request_status === User::ADMIN_REQUEST_APPROVED && $user->is_admin) {
            return back()->with('status', "{$user->name} is already approved.");
        }

        $user->update([
            'is_admin' => true,
            'admin_request_status' => User::ADMIN_REQUEST_APPROVED,
            'approved_at' => now(),
            'is_active' => true,
        ]);

        return back()->with('status', "Approved {$user->name}'s admin registration request.");
    }

    /**
     * Reject a pending registration request and delete the account.
     */
    public function reject(Request $request, User $user)
    {
        if ($user->is_main_admin) {
            return back()->with('error', 'Main admin accounts cannot be modified from this screen.');
        }

        if ($user->id === $request->user()->id) {
            return back()->with('error', 'You cannot reject your own account.');
        }

        if ($user->admin_request_status !== User::ADMIN_REQUEST_PENDING) {
            return back()->with('error', 'Only pending requests can be rejected.');
        }

        $name = $user->name;
        $user->delete();

        return back()->with('status', "Rejected and removed {$name}'s registration request.");
    }

    /**
     * Disable an approved admin account.
     */
    public function disable(Request $request, User $user)
    {
        if ($user->is_main_admin) {
            return back()->with('error', 'Main admin accounts cannot be disabled.');
        }

        if ($user->id === $request->user()->id) {
            return back()->with('error', 'You cannot disable your own account.');
        }

        if ($user->admin_request_status !== User::ADMIN_REQUEST_APPROVED || ! $user->is_admin) {
            return back()->with('error', 'Only approved admins can be disabled.');
        }

        if (! $user->is_active) {
            return back()->with('status', "{$user->name} is already disabled.");
        }

        $user->update([
            'is_active' => false,
        ]);

        return back()->with('status', "Disabled access for {$user->name}.");
    }

    /**
     * Re-enable a disabled approved admin account.
     */
    public function enable(Request $request, User $user)
    {
        if ($user->is_main_admin) {
            return back()->with('error', 'Main admin accounts are always enabled.');
        }

        if ($user->admin_request_status !== User::ADMIN_REQUEST_APPROVED || ! $user->is_admin) {
            return back()->with('error', 'Only approved admins can be enabled.');
        }

        if ($user->is_active) {
            return back()->with('status', "{$user->name} is already active.");
        }

        $user->update([
            'is_active' => true,
        ]);

        return back()->with('status', "Re-enabled access for {$user->name}.");
    }
}
