<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileUpLoadController extends Controller
{
    public function getFileUploadForm()
    {
        return view('file-upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:png,jpg,jpeg,doc,csv,txt|max:2048',
        ]);

        $fileName = $request->file->getClientOriginalName();
        $fileName = "test.jpg";
        $filePath = 'uploads/' . $fileName;


        $path = Storage::disk('s3')->put($filePath, file_get_contents($request->file));
        $path = Storage::disk('s3')->url($path);

        // Perform the database operation here

        return back()
            ->with('success','File has been successfully uploaded.');
    }
}
