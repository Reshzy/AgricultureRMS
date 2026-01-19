@extends('layouts.admin')

@section('title', 'View Message')
@section('header', 'Email Message')

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.emails.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Messages
        </a>

        <div class="flex items-center space-x-2">
            @if($contactMessage->is_read)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                <i class="fas fa-check-circle mr-1"></i>
                Read
            </span>
            @else
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-600">
                <i class="fas fa-circle mr-1"></i>
                New
            </span>
            @endif
        </div>
    </div>

    <!-- Message Details -->
    <div class="card-hover bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-gray-100">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $contactMessage->subject }}</h1>
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-user text-gray-400"></i>
                            <span class="font-medium">{{ $contactMessage->name }}</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-envelope text-gray-400"></i>
                            <a href="mailto:{{ $contactMessage->email }}" class="text-emerald-600 hover:text-emerald-700 font-medium">
                                {{ $contactMessage->email }}
                            </a>
                        </div>
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-clock text-gray-400"></i>
                            <span>{{ $contactMessage->created_at->format('F j, Y \a\t g:i A') }}</span>
                        </div>
                    </div>
                </div>

                <div class="text-right text-sm text-gray-500">
                    <div>Message ID: #{{ $contactMessage->id }}</div>
                    @if($contactMessage->created_at != $contactMessage->updated_at)
                    <div>Last updated: {{ $contactMessage->updated_at->diffForHumans() }}</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Message Content -->
        <div class="p-6">
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Message:</label>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <div class="prose prose-sm max-w-none text-gray-700 whitespace-pre-wrap">{{ $contactMessage->message }}</div>
                </div>
            </div>

            <!-- Contact Information Card -->
            <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-200">
                <h3 class="text-sm font-semibold text-emerald-800 mb-3">Contact Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-emerald-700 mb-1">Full Name</label>
                        <div class="text-sm text-emerald-900">{{ $contactMessage->name }}</div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-emerald-700 mb-1">Email Address</label>
                        <div class="text-sm text-emerald-900">
                            <a href="mailto:{{ $contactMessage->email }}" class="hover:underline">
                                {{ $contactMessage->email }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Footer -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
            <div class="text-sm text-gray-500">
                Received {{ $contactMessage->created_at->diffForHumans() }}
            </div>

            <div class="flex items-center space-x-3">
                <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->subject }}"
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <i class="fas fa-reply mr-2"></i>
                    Reply via Email
                </a>
            </div>
        </div>
    </div>

    <!-- Message Timeline (if needed for future enhancements) -->
    <div class="card-hover bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Message Timeline</h3>
        <div class="space-y-4">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-envelope text-emerald-600 text-sm"></i>
                </div>
                <div class="flex-1">
                    <div class="text-sm font-medium text-gray-900">Message received</div>
                    <div class="text-xs text-gray-500">{{ $contactMessage->created_at->format('F j, Y \a\t g:i A') }}</div>
                </div>
            </div>

            @if($contactMessage->is_read)
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-eye text-blue-600 text-sm"></i>
                </div>
                <div class="flex-1">
                    <div class="text-sm font-medium text-gray-900">Message read</div>
                    <div class="text-xs text-gray-500">{{ $contactMessage->updated_at->format('F j, Y \a\t g:i A') }}</div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection