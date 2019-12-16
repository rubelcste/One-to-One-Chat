<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

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
        //
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

    public function user_list(){
        $users = User::latest()->where('id','!=',auth()->user()->id)->get();
        if(\Request::ajax()){
            return response()->json($users,200);
        }
        return abort(404);
    }
    public function user_message($id=null){
        if(!\Request::ajax()){
           return abort(404);
        }
        $user = User::findOrFail($id);
        $count = Message::count();
        // $messages = Message::where('to', $id)->get();
        // return response()->json($messages,200);
        $messages = Message::where(function($q) use($id){
            $q->where('from',auth()->user()->id);
            $q->where('to',$id);
            $q->where('type',0);
        })->orWhere(function($q) use ($id){
            $q->where('from',$id);
            $q->where('to',auth()->user()->id);
            $q->where('type',1);
        })->with('user')->get();
        return response()->json([
            'messages'=>$messages,
            'user'=>$user,
        ]);
    }
    public function send_message(Request $request){
        // if(!$request->ajax()){
        //     return abort(404);
        // }
        $messages = Message::create([
           'message'=>$request->message,
           'from'=>auth()->user()->id,
           'to'=>$request->user_id,
           'type'=>0
       ]);
        $messages = Message::create([
           'message'=>$request->message,
           'from'=>auth()->user()->id,
           'to'=>$request->user_id,
           'type'=>1
       ]);
        return response()->json($messages,201);
    }
    public function delete_message($id=null){
        if(!\Request::ajax()){
            return abort(404);
        }
        Message::findOrFail($id)->delete();
        return response()->json('delete', 200);
    }
}
