<div>
    <div class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="bg-white w-96 rounded-lg shadow-lg overflow-hidden">
            <!-- Chat Header -->
            <div class="bg-blue-500 text-white p-4">
                <h2 class="text-xl font-semibold">Chat</h2>
            </div>

            <!-- Chat Messages -->
            <div style="max-height: 400px; overflow-y: auto;">
                @foreach($messages as $message)
                <div class="px-4 py-6 overscroll-contain" style="max-height: 400px; width: auto;">
                    @if (auth()->user()->id === $message->to_user_id)
                    <!-- Recive Message -->
                    <div class="flex mb-2">
                        <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                            A
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold">{{ $message->user->name }}</p>
                            <p class="flex items-center self-start rounded-xl rounded-tl bg-gray-300 py-2 px-3">{{
                                $message->message }}</p>
                        </div>
                    </div>

                    @else
                    <!-- Send Message -->
                    <div class="flex justify-end mb-2">
                        <div class="mr-3">
                            <p class="font-semibold">{{ $message->user->name }}</p>
                            <p
                                class="flex items-center self-end rounded-xl rounded-tr bg-blue-500 py-2 px-3 text-white">
                                {{ $message->message }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center">
                            B
                        </div>
                    </div>
                    @endif

                </div>
                @endforeach
            </div>

            <!-- Chat Input -->
            <div class="bg-gray-200 px-4 py-3 flex items-center">
                <form wire:submit.prevent="sendMessage" class="w-full flex">
                    <input wire:model="newMessage" type="text"
                        class="flex-1 px-3 py-2 bg-white rounded-full border focus:outline-none"
                        placeholder="Type your message..." />
                    <button
                        class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none"
                        type="submit">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div wire:poll.1s>
        {{-- This will refresh the component every 5 seconds --}}
    </div>
</div>