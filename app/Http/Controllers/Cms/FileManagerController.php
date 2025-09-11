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

    /**
     * Halaman utama file manager di CMS
     */
    public function index()
    {
        $files = File::latest()->get();

        // Tambahkan property url agar bisa langsung dipakai di blade
        $files->each(function ($file) {
            $file->url = asset('storage/' . $file->path);
        });

        return view('cms.filemanager.index', compact('files'));
    }

    /**
     * Upload file baru + simpan ke database
     */
    public function upload(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|max:5120', // 5 MB per file
        ]);

        if (!$request->hasFile('files')) {
            return response()->json(['success' => false, 'message' => 'Tidak ada file yang diupload'], 422);
        }

        $uploadedFiles = $request->file('files');
        $savedFiles = [];

        foreach ($uploadedFiles as $file) {
            // Simpan ke storage/app/public/uploads
            $path = $file->store('uploads', 'public');

            // Simpan record ke database
            $dbFile = File::create([
                'filename'   => $file->getClientOriginalName(),
                'path'       => $path,
                'mime_type'  => $file->getMimeType(),
                'size'       => $file->getSize(),
            ]);

            $savedFiles[] = [
                'id'   => $dbFile->id,
                'url'  => asset('storage/' . $path),
                'path' => $path,
            ];
        }

        return response()->json([
            'success' => true,
            'files'   => $savedFiles,
        ]);
    }

    /**
     * Hapus file
     */
    public function delete(Request $request)
    {
        $file = File::findOrFail($request->id);

        // hapus file fisik dari disk public
        Storage::disk('public')->delete($file->path);

        // hapus record database
        $file->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Popup untuk TinyMCE atau editor lain
     */
    public function popup()
    {
        $files = File::latest()->get()->map(function ($file) {
            return [
                'id'   => $file->id,
                'name' => $file->filename,
                'url'  => asset('storage/' . $file->path),
                'mime' => $file->mime_type,
            ];
        });

        return view('cms.filemanager.popup', compact('files'));
    }
}
