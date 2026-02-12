<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user=User::find($id);
        if(empty($user)){
            return response()->json(['message'=>'user not found']);
        }
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user=User::find($id);
        if(empty($user)){
            return response()->json(['message'=>'user not found']);
        }
        $request->validate([
            'name'=>'required|string',
            'address'=>'required|string',
            'about_me'=>'required|string',
            'projectNumber'=>'required|string',
            'yearsOfExperiance'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|min:8|confirmed',
        ]);
        if($request->hasFile('cv')){
            $cv=$request->file('cv');
            $cvname=time().".".$cv->getclientoriginalname();
            $cv->move(public_path("files/file"),$cvname);
            $user->cv=$cvname;
        }
            if($request->hasFile('image')){
            $image=$request->file('image');
            $imagename=time().".".$image->getclientoriginalname();
            $image->move(public_path("files/images"),$imagename);
            $user->image=$imagename;
        }
        $user->name=strip_tags($request->name);
        $user->address=strip_tags($request->address);
        $user->yearsOfExperiance=strip_tags($request->yearsOfExperiance);
        $user->projectNumber=strip_tags($request->projectNumber);
        $user->about_me=strip_tags($request->about_me);
        $user->email=strip_tags($request->email);
        $user->password=strip_tags($request->password);
        $user->save();
        return response()->json(['message'=>'updated successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
