<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = Profil::orderBy('updated_at', 'desc')->get();

        $jumlahData = Profil::count();

        $bisaTambah = $jumlahData < 4;

        return view('admin.profil.index', compact('profil', 'bisaTambah'));
    }

    public function create()
    {
        return view('admin.profil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_profil' => 'required',
            'isi_konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $sudahAda = Profil::where('kategori_profil', $request->kategori_profil)->exists();

        if ($sudahAda) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['kategori_profil' => 'Kategori ini sudah ada datanya! Silakan edit data yang lama saja, tidak perlu buat baru.']);
        }

        $data = $request->except('gambar');
        $data['id_admin'] = Auth::id();
        $data['updated_at'] = now();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('profil', 'public'); 
            $data['gambar'] = $path;
        }

        Profil::create($data);

        return redirect()->route('profil.index')->with('success', 'Data Profil berhasil ditambahkan');
    }

    public function edit($id)
    {
        $profil = Profil::findOrFail($id);
        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        $profil = Profil::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'isi_konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('gambar');
        $data['updated_at'] = now();
        $data['id_admin'] = Auth::id();

        if ($request->hasFile('gambar')) {
            if ($profil->gambar && Storage::disk('public')->exists($profil->gambar)) {
                Storage::disk('public')->delete($profil->gambar);
            }
            $path = $request->file('gambar')->store('profil', 'public');
            $data['gambar'] = $path;
        }

        $profil->update($data);

        return redirect()->route('profil.index')->with('success', 'Data Profil berhasil diperbarui');
    }

    public function destroy($id)
    {
        $profil = Profil::findOrFail($id);
        
        if ($profil->gambar && Storage::disk('public')->exists($profil->gambar)) {
            Storage::disk('public')->delete($profil->gambar);
        }
        
        $profil->delete();
        return redirect()->route('profil.index')->with('success', 'Data berhasil dihapus');
    }
}