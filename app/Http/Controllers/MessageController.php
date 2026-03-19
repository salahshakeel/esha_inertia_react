<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use Inertia\Inertia;
use App\Models\User;
use App\Jobs\MessageJob;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::latest()->paginate(10);
        return Inertia::render('Messages/Index',[
            'messages' => $messages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return Inertia::render('Messages/Create',[
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        $find_user_from_email = User::wherein('email', $request->email)->get();
        
        foreach ($find_user_from_email as $user) {
            $message = new Message();
            $message->name = $user->name;
            $message->email = $user->email;
            $message->message = $request->message;
            $message->save();

             // Dispatch Job
            MessageJob::dispatch($user, $message);
        }
        return redirect()->route('dashboard.messages.index')->with('success', 'Message sent successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
