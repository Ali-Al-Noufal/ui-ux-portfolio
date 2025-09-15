<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class Projectcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects=Project::all();
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
          'image'=>'image|required',
          'url'=>'string|required',
          'title'=>'string|required',
          'description'=>'string|required',
        ]);
            $image=$request->file('image');
            $imagename=time().".".$image->getclientoriginalname();
            $image->move(public_path("files/"),$imagename);
        $description=strip_tags($request->description);
        $title=strip_tags($request->title);
        $project=new Project([
            'url'=>$request->url,
            'title'=>$title,
            'image'=>$imagename,
            'description'=>$description,
        ]);
        auth()->user()->projects()->save($project);
        return response()->json(['message'=>'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project=Project::find($id);
        if(empty($project)){
            return response()->json(['message'=>'project not found']);
        }
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project=Project::find($id);
        if(empty($project)){
            return response()->json(['message'=>'project not found']);
        }
                $request->validate([
          'image'=>'image|required',
          'url'=>'string|required',
          'title'=>'string|required',
          'description'=>'string|required',
        ]);
            if($request->hasFile('image')){
            $image_path=public_path('files/'.$project->image);
            unlink($image_path);
            $image=$request->file('image');
            $imagename=time().".".$image->getclientoriginalname();
            $image->move(public_path("files/"),$imagename);
            $project->image=$imagename;
        }
        $project->url=$request->url;
        $project->title=strip_tags($request->title);
        $project->description=strip_tags($request->description);
        $project->save();
        return response()->json(['message'=>'updated successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project=Project::find($id);
        if(empty($project)){
            return response()->json(['message'=>'project not found']);
        }
        $image_path=public_path('files/'.$project->image);
        unlink($image_path);
        $project->delete();
        return response()->json(['message'=>'success']);
    }
}
