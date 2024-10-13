<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipAktif;
use App\Models\ArsipVital;
use App\Models\ArsipInaktif;

class ArsipController extends Controller
{
    // Menampilkan daftar arsip
    public function index()
    {
        $arsipAktif = ArsipAktif::all();
        $arsipInaktif = ArsipInaktif::all();
        $arsipVital = ArsipVital::all();


        // Menggabungkan semua arsip ke dalam satu variabel
        $arsip = $arsipAktif->merge($arsipInaktif)->merge($arsipVital);

        return view('arsip.create', compact('arsip'));
    }

    // Menampilkan form tambah arsip
    public function create()
    {
        return view('arsip.create');
    }

    // Menyimpan arsip baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,jpg,png|max:2048',
            'type' => 'required',
        ]);

        $filePath = $request->file('file')->store('arsip');

        // Simpan arsip sesuai jenis yang dipilih
        if ($request->type == 'vital') {
            ArsipVital::create([
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $filePath,
            ]);
        } elseif ($request->type == 'aktif') {
            ArsipAktif::create([
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $filePath,
            ]);
        } elseif ($request->type == 'inaktif') {
            ArsipInaktif::create([
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $filePath,
            ]);
        }

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil disimpan!');
    }

    public function destroy($id)
    {
        // Try to find the archive by ID in all types (vital, aktif, inaktif)
        $arsipVital = ArsipVital::find($id);
        $arsipAktif = ArsipAktif::find($id);
        $arsipInaktif = ArsipInaktif::find($id);

        // Check if the archive exists in any of the types, then delete it
        if ($arsipVital) {
            $arsipVital->delete();
        } elseif ($arsipAktif) {
            $arsipAktif->delete();
        } elseif ($arsipInaktif) {
            $arsipInaktif->delete();
        } else {
            return redirect()->route('arsip.index')->with('error', 'Arsip tidak ditemukan!');
        }

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil dihapus!');
    }

    // Tambahkan metode lainnya seperti edit, update, dan destroy sesuai kebutuhan
}
