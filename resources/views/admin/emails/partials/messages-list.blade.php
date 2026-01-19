@if($messages->count() > 0)
<div class="divide-y divide-gray-100">
    @foreach($messages as $message)
    <div class="p-6 hover:bg-gray-50 transition-colors">
        <div class="flex items-start justify-between">
            <div class="flex-1 min-w-0">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="flex-shrink-0">
                        @if(!$message->is_read)
                        <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                        @else
                        <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 truncate">
                        {{ $message->subject }}
                    </h3>
                    @if(!$message->is_read)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                        New
                    </span>
                    @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                        Read
                    </span>
                    @endif
                </div>

                <div class="flex items-center space-x-4 text-sm text-gray-600 mb-2">
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-user text-gray-400"></i>
                        <span>{{ $message->name }}</span>
                    </div>
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-envelope text-gray-400"></i>
                        <span>{{ $message->email }}</span>
                    </div>
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-clock text-gray-400"></i>
                        <span>{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <p class="text-gray-700 line-clamp-2">
                    {{ Str::limit($message->message, 120) }}
                </p>
            </div>

            <div class="flex-shrink-0 ml-4">
                <a href="{{ route('admin.emails.show', $message) }}"
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <i class="fas fa-eye mr-2"></i>
                    View
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="text-center py-12">
    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="fas fa-search text-gray-400 text-2xl"></i>
    </div>
    <h3 class="text-lg font-medium text-gray-900 mb-2">No messages found</h3>
    <p class="text-gray-500">Try adjusting your search criteria or filters.</p>
</div>
@endif