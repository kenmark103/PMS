<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{



public function __construct()
{
  $this->middleware(['auth','auth:admin']);
}

/**
 * Show chats
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
  
}

/**
 * Fetch all messages
 *
 * @return Message
 */
public function fetchMessages()
{
  return Message::with('user')->get();
}

/**
 * Persist message to database
 *
 * @param  Request $request
 * @return Response
 */
public function sendMessage(Request $request)
{

  $user=auth()->user();
  if (is_null($user)) {
  	$user=auth('admin')->user();
  }
  $message = $user->messages()->create([
    'message' => $request->input('message')
  ]);

  return ['status' => 'Message Sent!'];
}
}
