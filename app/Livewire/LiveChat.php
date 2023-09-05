<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class LiveChat extends Component
{
    public $messages;
    public $newMessage = '';

    public function render()
    {
        $this->messages = Chat::where(function ($query) {
            $query->where('from_user_id', Auth::id())
                  ->orWhere('to_user_id', Auth::id());
        })->get();

        return view('livewire.live-chat');
    }

    public function sendMessage()
    {

        Chat::create([
            'message' => $this->newMessage,
            'from_user_id' => Auth::id(),
            'to_user_id' => 2, // Replace with the recipient's user ID
            'is_read' => false,
        ]);

        $this->newMessage = '';
        $this->render();
    }
}
