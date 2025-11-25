<?php

namespace App\Http\Controllers;

use App\Models\Multiupload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MultiuploadController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'files.*' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'ref_table' => 'required',
            'ref_id' => 'required'
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Buat nama file unik
                $filename = time() . '-' . $file->getClientOriginalName();
                // Simpan ke folder public/uploads
                $file->move(public_path('uploads'), $filename);

                // Simpan ke database dengan ref_table & ref_id
                Multiupload::create([
                    'filename' => $filename,
                    'ref_table' => $request->ref_table, // didapat dari input hidden
                    'ref_id' => $request->ref_id,       // didapat dari input hidden
                ]);
            }
            return redirect()->back()->with('success', 'File berhasil diunggah!');
        }

        return redirect()->back()->with('error', 'Tidak ada file yang dipilih.');
    }

    public function destroy($id)
    {
        $file = Multiupload::findOrFail($id);

        // Hapus file fisik dari folder public/uploads
        $path = public_path('uploads/' . $file->filename);
        if (File::exists($path)) {
            File::delete($path);
        }

        // Hapus data di database
        $file->delete();

        return redirect()->back()->with('success', 'File berhasil dihapus.');
    }
}
