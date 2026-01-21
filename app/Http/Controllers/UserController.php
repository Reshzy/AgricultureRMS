<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $users = $query->orderByDesc('created_at')->paginate($perPage)->appends($request->except('page'));

        if ($request->ajax()) {
            return view('admin.users.partials.table', compact('users'));
        }

        return view('admin.users.index', compact('users', 'search', 'adminFilter', 'perPage'));
    }

    /**
     * Update the specified user (toggle admin status).
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'is_admin' => ['required', 'boolean'],
        ]);

        // Prevent users from removing their own admin status
        if ($user->id === $request->user()->id && !$request->boolean('is_admin')) {
            return back()->with('error', 'You cannot remove your own admin access.');
        }

        $user->update([
            'is_admin' => $request->boolean('is_admin'),
        ]);

        $status = $request->boolean('is_admin') ? 'granted' : 'revoked';
        return back()->with('status', "Admin access {$status} for {$user->name}.");
    }
}

