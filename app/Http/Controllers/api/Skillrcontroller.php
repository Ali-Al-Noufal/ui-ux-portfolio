<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Skillrcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills=Skill::all();
        return response()->json($skills);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
          'title'=>'string|required',
          'description'=>'string|required',
        ]);
        $description=strip_tags($request->description);
        $title=strip_tags($request->title);
        $skill=new Skill([
            'title'=>$title,
            'description'=>$description,
        ]);
        auth()->user()->skills()->save($skill);
        return response()->json(['message'=>'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
               $skill=Skill::find($id);
        if(empty($skill)){
            return response()->json(['message'=>'skill not found']);
        }
        return response()->json($skill);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $skill=Skill::find($id);
        if(empty($skill)){
            return response()->json(['message'=>'skill not found']);
        }
                $request->validate([
          'title'=>'string|required',
          'description'=>'string|required',
        ]);
        $skill->title=strip_tags($request->title);
        $skill->description=strip_tags($request->description);
        $skill->save();
        return response()->json(['message'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skill=Skill::find($id);
        if(empty($skill)){
            return response()->json(['message'=>'skill not found']);
        }
        $skill->delete();
        return response()->json(['message'=>'success']);
    }
}
