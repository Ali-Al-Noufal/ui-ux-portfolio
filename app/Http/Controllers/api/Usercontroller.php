<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
            'image'=>'required|image',
            'cv'=>'required|file',
            'projectNumber'=>'required|string',
            'yearsOfExperiance'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|min:8|confirmed',
        ]);
        
            $cv=$request->file('cv');
            $cvname=time().".".$cv->getclientoriginalname();
        $fileContent2 = file_get_contents($cv->getRealPath());

        // إرسال الصورة إلى Vercel Blob API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('BLOB_READ_WRITE_TOKEN'),
            'x-add-random-suffix' => 'true', // لإضافة رمز عشوائي يمنع تكرار الأسماء
        ])->withBody($fileContent2, $cv->getMimeType())
          ->put("https://blob.vercel-storage.com/" . $cvname);
            $data = $response->json();
            $cvUrl = $data['url'];
            $user->cv = $cvUrl;
   
        $image = $request->file('image');
        $filename = time() . '-' . $image->getClientOriginalName();
        
        // قراءة محتوى الصورة
        $fileContent = file_get_contents($image->getRealPath());

        // إرسال الصورة إلى Vercel Blob API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('BLOB_READ_WRITE_TOKEN'),
            'x-add-random-suffix' => 'true', // لإضافة رمز عشوائي يمنع تكرار الأسماء
        ])->withBody($fileContent, $image->getMimeType())
          ->put("https://blob.vercel-storage.com/" . $filename);
            $data = $response->json();
            $imageUrl = $data['url'];
            $user->image = $imageUrl;
            
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
