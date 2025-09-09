<?php

namespace App\Http\Controllers\Cms;

use App\Models\Cms\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $files = File::latest()->get();
        return view('cms.filemanager.index', compact('files'));
    }

    public function upload(Request $request)
    {
        try {
            $request->validate([
                'files.*' => 'required|file|max:5120', // max 5MB
            ]);

            if (!$request->hasFile('files')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada file yang diunggah'
                ]);
            }

            $uploadedFiles = $request->file('files');
            $result = [];

            foreach ($uploadedFiles as $file) {
                // Simpan ke disk 'public' agar bisa diakses lewat url()
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads', $filename, 'public');

                // Simpan data ke database
                $model = File::create([
                    'filename'  => $file->getClientOriginalName(),
                    'path'      => $path,
                    'mime_type' => $file->getMimeType(),
                    'size'      => $file->getSize(),
                ]);

                $result[] = [
                    'id'   => $model->id,
                    'name' => $model->filename,
                    'url'  => asset('storage/' . $path), // URL publik
                ];
            }

            return response()->json([
                'success' => true,
                'files'   => $result,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $file = File::findOrFail($request->id);

        // hapus file fisik dari disk public
        Storage::disk('public')->delete($file->path);

        // hapus record database
        $file->delete();

        return response()->json(['success' => true]);
    }
}
