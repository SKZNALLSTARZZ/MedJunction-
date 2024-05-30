<?php

namespace Modules\FileManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class FileManagementController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $imageUrl = Storage::url($filePath);


            return response()->json(['img_url' => $imageUrl], 200);
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
    }
}
