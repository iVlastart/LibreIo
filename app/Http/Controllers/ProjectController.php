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
        $json = $project->original_files;
        $data = json_decode($json, true);
        return view('editor.edit', [
                    'id'=>$project->id,
                    'name'=>$name, 
                    'files'=>$data
        ]);
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
            'name' => ['required', 'exists:projects,name'],
            'file' => ['required', 'mimes:mp4,mov,mkv,mp3,jpg,jpeg,png', 'max:5120000']
        ]);

        if($request->hasFile(('file')) && Project::where('name', $request['name'])->where('user_id', Auth::id())->exists())
        {
            $project = Project::where('name', $request['name'])->where('user_id', Auth::id())->first();
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $mime = $file->getClientMimeType();
            //type is image video audio extension is mp4 mp3 jpeg etc...
            //adding that here cause I'm dumb
            list($type, $extension) = explode('/', $mime);
            $filepath = $file->store('projects/'.Auth::user()->name.'/'.$request['name'].'/'.$type, 'public');

            $originalFiles = json_decode($project->original_files, true) ?? [];
            $newFile = [
                'path'      => $filepath,
                'name'      => $filename,
                'type'      => $type,
                'extension' => $extension,
                'track'     => null,
                'starts'    => '0:00',
                'ends'      => '0:00',
            ];
            $originalFiles[] = $newFile;
            $project->update([
                'original_files' => json_encode($originalFiles),
            ]);
            return json_encode([
                'filename'=>$filename,
            ]);
        }
        
    }

    public function streamVideoPreview($id, $name, Request $request)
    {
        $file = Project::where('id', $id)
                        ->first();
        $data = json_decode($file->original_files, true);
        foreach($data as $json)
        {
            if($json['name']!==$name) continue;
            $path = storage_path('app/public/'.$json['path']);

            if (!file_exists($path)) abort(404);

            $size = filesize($path);
            $stream = fopen($path, 'rb');
            $resp_code = 200;
            $headers = [
                'Content-Type' => $file->type.'/'.$file->extension,
                'Accept-Ranges' => 'bytes',
            ];

            $range = $request->header('Range');
            if ($range) 
            {
                list(, $range) = explode('=', $range, 2);
                $range = explode('-', $range);
                $start = intval($range[0]);
                $end = $range[1] !== '' ? intval($range[1]) : $size - 1;

                fseek($stream, $start);

                $length = $end - $start + 1;
                $resp_code = 206;

                $headers['Content-Range'] = "bytes $start-$end/$size";
                $headers['Content-Length'] = $length;
            } 
            else 
            {
                $headers['Content-Length'] = $size;
            }

            return response()->stream(function () use ($stream) {
                fpassthru($stream);
            }, $resp_code, $headers);
        }
    }
}
