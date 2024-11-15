<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-xl font-bold mb-4">{{ __("Your Conversations") }}</h3>

                @forelse ($chats as $chat)
                    @if ($chat->messages->isNotEmpty()) <!-- Only show chats with messages -->
                        <div class="mb-4">
                            <h4 class="font-semibold">{{ $chat->product->name }}</h4>
                            <p><strong>Last Message:</strong>
                                {{ $chat->messages->first()->message }}
                            </p>
                            <a href="{{ route('chats.show', $chat->id) }}" class="text-blue-500 hover:underline">View Conversation</a>
                        </div>
                    @endif
                @empty
                    <p class="text-muted">You have no conversations yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
