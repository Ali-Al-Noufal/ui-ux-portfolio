<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Messagecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages=Message::all();
        return response()->json($messages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,String $id)
    {
        $request->validate([
          'name'=>'string|required',
          'title'=>'string|required',
          'content'=>'string|required',
        ]);
        $user=User::find($id);
        if(empty($user)){
            return response()->json(['message'=>'user not found']);
        }
        $message=new Message;
        $message->name=strip_tags($request->name);
        $message->content=strip_tags($request->content);
        $message->title=strip_tags($request->title);
        // $message=Message::create([
        //     'name'=>$request->name,
        //     'title'=>$request->title,
        //     'content'=>$request->content,
        // ]);
        $user->messages()->save($message);
        return response()->json(['message'=>'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message=Message::find($id);
        if(empty($message)){
            return response()->json(['message'=>'message not found']);
        }
        return response()->json($message);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message=Message::find($id);
        if(empty($message)){
            return response()->json(['message'=>'message not found']);
        }
        $message->delete();
        return response()->json(['message'=>'success']);
    }
}
