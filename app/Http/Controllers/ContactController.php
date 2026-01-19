<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\User;
use App\Mail\ContactMessageReceived;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Store a new contact message
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        // Create the contact message
        $contactMessage = ContactMessage::create($validated);

        // Send email notification to all admin users
        $adminUsers = User::where('is_admin', true)->get();
        foreach ($adminUsers as $admin) {
            Mail::to($admin->email)->send(new ContactMessageReceived($contactMessage));
        }

        return back()->with('success', 'Thank you for your message! We\'ll get back to you soon.');
    }

    /**
     * Display all contact messages for admin
     */
    public function index()
    {
        $messages = ContactMessage::orderByDesc('created_at')->paginate(20);
        $unreadCount = ContactMessage::unread()->count();

        return view('admin.emails.index', compact('messages', 'unreadCount'));
    }

    /**
     * AJAX search for contact messages
     */
    public function search(Request $request)
    {
        $query = ContactMessage::query();

        // Search by name, email, subject, or message
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%")
                    ->orWhere('subject', 'like', "%{$searchTerm}%")
                    ->orWhere('message', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by read status
        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status === 'read') {
                $query->where('is_read', true);
            }
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        if (in_array($sortBy, ['created_at', 'name', 'subject', 'is_read'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderByDesc('created_at');
        }

        $messages = $query->paginate(20);
        $unreadCount = ContactMessage::unread()->count();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.emails.partials.messages-list', compact('messages'))->render(),
                'pagination' => $messages->appends($request->all())->links()->toHtml(),
                'unreadCount' => $unreadCount,
                'total' => $messages->total()
            ]);
        }

        return view('admin.emails.index', compact('messages', 'unreadCount'));
    }

    /**
     * Display a specific contact message
     */
    public function show(ContactMessage $contactMessage)
    {
        // Mark as read when viewed
        if (!$contactMessage->is_read) {
            $contactMessage->markAsRead();
        }

        return view('admin.emails.show', compact('contactMessage'));
    }
}
