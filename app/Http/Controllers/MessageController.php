<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Auth;
use Illuminate\Http\Request;
use DB;
use Broadcast;

use App\Events\MessageEvent;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('message');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function messageRoom($receiver)
    {
        $user = User::find($receiver);
        if(!$user){
            return redirect('/');
        }

        if($user->id == Auth::user()->id){
            return redirect('/');
        }

        return view('message', ['user' => $user]);
    }

    public function fetchMessage($receiver)
    {
        $sender = Auth::user()->id;
        $messages = Message::with(['sender','receiver'])
        ->where('sender', $sender)
        ->orWhere('receiver', $receiver)
        ->orWhere('sender', $receiver)
        ->orWhere('receiver', $sender)
        ->get();

        return $messages;
    }

    public function sendMessage(Request $request, $receiver)
    {
        DB::beginTransaction();
        $message = Message::create([
            'sender' => Auth::user()->id,
            'receiver' => $receiver,
            'message' => $request->message,
        ]);

        $newMessage = Message::with(['sender','receiver'])
        ->where('id', $message->id)
        ->first();
            
        broadcast(new MessageEvent($newMessage));
        
        DB::commit();
        
        return $newMessage;
    }
}
