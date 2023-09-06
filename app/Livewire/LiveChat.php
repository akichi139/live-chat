<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class LiveChat extends Component
{

    public $messages, $user_id, $users;
    public $newMessage = '';

    public $listeners = [
        'userChange' => 'navigateTo'
    ];

    public function mount($user_id)
    {
        if ($user_id == null) {
            $lastchat = Chat::where('from_user_id', Auth::id())->orWhere('to_user_id', Auth::id())->orderBy("created_at", "desc")->first();

            if ($lastchat->from_user_id == Auth::id()) {
                $lastcontact = $lastchat->to_user_id;
            } else {
                $lastcontact = $lastchat->from_user_id;
            }

            $user_id = User::where('id', $lastcontact)->first();
        }

        $this->user_id = $user_id;
    }

    public function navigateTo($id)
    {
        $this->user_id = User::find($id);
    }

    public function render()
    {
        $this->messages = Chat::where([
            ['from_user_id', Auth::id()],
            ['to_user_id', $this->user_id->id]
        ])->orWhere([
                    ['from_user_id', $this->user_id->id],
                    ['to_user_id', Auth::id()]
                ])->get();

        $this->users = User::where('id','!=',Auth::id())->get();

        return view('livewire.live-chat');
    }

    public function sendMessage()
    {

        Chat::create([
            'message' => $this->newMessage,
            'from_user_id' => Auth::id(),
            'to_user_id' => $this->user_id->id,
            'is_read' => false,
        ]);

        $this->newMessage = '';
        $this->render();
    }
}