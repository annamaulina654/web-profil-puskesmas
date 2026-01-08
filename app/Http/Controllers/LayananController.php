<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        return view('admin.layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'deskripsi' => 'required',
            'jam_operasional' => 'required',
            'foto_layanan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['id_admin'] = Auth::id();

        if ($request->hasFile('foto_layanan')) {
            $path = $request->file('foto_layanan')->store('layanan', 'public');
            $data['foto_layanan'] = $path;
        }

        Layanan::create($data);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $request->validate([
            'nama_layanan' => 'required',
            'deskripsi' => 'required',
            'jam_operasional' => 'required',
            'foto_layanan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto_layanan');
        $data['id_admin'] = Auth::id();

        if ($request->hasFile('foto_layanan')) {
            if ($layanan->foto_layanan && Storage::disk('public')->exists($layanan->foto_layanan)) {
                Storage::disk('public')->delete($layanan->foto_layanan);
            }
            $path = $request->file('foto_layanan')->store('layanan', 'public');
            $data['foto_layanan'] = $path;
        }

        $layanan->update($data);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);

        if ($layanan->foto_layanan && Storage::disk('public')->exists($layanan->foto_layanan)) {
            Storage::disk('public')->delete($layanan->foto_layanan);
        }

        $layanan->delete();
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus');
    }
}
