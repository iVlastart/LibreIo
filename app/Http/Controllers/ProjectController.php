<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('editor.home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('editor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:30',
        ]);

        $data['user_id'] = Auth::id();

        Project::create($data);

        return redirect()->route('editor.edit', ['name'=>$data['name']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        if(!Project::where('name', $name)->where('user_id', Auth::id())->exists()){
            return redirect()->route('editor');
        }

        $project = Project::where('name', $name)->where('user_id', Auth::id())->first();
        return view('editor.edit', ['name'=>$name]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:mp4,mov,mkv,mp3,jpg,jpeg,png', 'max:5120000']
        ]);

        if($request->hasFile(('file')))
        {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            return json_encode([
                'name'=>$name
            ]);
        }
        
    }
}
