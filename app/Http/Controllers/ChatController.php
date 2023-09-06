<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Chat;

class ChatController extends Controller
{
    public function showChatsView()
    {
        $lastchat = Chat::where('from_user_id',Auth::id())->orWhere('to_user_id',Auth::id())->orderBy("created_at","desc")->first();
        if($lastchat == null){
            $user_id = User::where('id','1')->first();

            return view('chat.chat-index', compact('user_id'));
        }

        if($lastchat->from_user_id==Auth::id()){
            $lastcontact = $lastchat->to_user_id;
        }elseif($lastchat->to_user_id==Auth::id()){
            $lastcontact = $lastchat->from_user_id;
        }else{
            $lastcontact = null;
        }

        $user_id = User::where('id', $lastcontact)->first();

        return view('chat.chat-index', compact('user_id'));
    }
}