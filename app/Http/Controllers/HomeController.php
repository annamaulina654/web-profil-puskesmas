<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\Layanan;
use App\Models\Informasi;
use App\Models\Masukan;

class HomeController extends Controller
{
    public function index()
    {
        $layanan = Layanan::limit(3)->get();
        
        $berita  = Informasi::orderBy('tgl_posting', 'desc')->limit(3)->get();
        
        $tentang = Profil::where('kategori_profil', 'tentang')->first();

        return view('public.home', compact('layanan', 'berita', 'tentang'));
    }

    public function showProfil($kategori)
    {
        $validCategories = ['visi_misi', 'struktur_organisasi', 'inovasi', 'tentang'];
        
        if (!in_array($kategori, $validCategories)) {
            abort(404);
        }

        $data = Profil::where('kategori_profil', $kategori)->first();
        
        return view('public.profil', compact('data', 'kategori'));
    }

    public function indexLayanan()
    {
        $layanan = Layanan::all();
        return view('public.layanan', compact('layanan'));
    }

    public function indexInformasi(Request $request)
    {
        $query = Informasi::orderBy('tgl_posting', 'desc');

        if ($request->has('kategori')) {
            $query->where('kategori_info', $request->kategori);
        }

        $informasi = $query->paginate(6)->appends($request->all());

        $title = $request->kategori ? ucfirst($request->kategori) : 'Semua Informasi';

        return view('public.informasi', compact('informasi', 'title'));
    }
    
    public function showInformasi($id)
    {
        $informasi = Informasi::findOrFail($id);
        
        $informasiTerbaru = Informasi::where('id_informasi', '!=', $id)
                        ->orderBy('tgl_posting', 'desc')
                        ->limit(5)
                        ->get();

        return view('public.informasi_detail', compact('informasi', 'informasiTerbaru'));
    }

    public function kontak()
    {
        return view('public.kontak');
    }

    public function kirimPesan(Request $request)
    {
        $request->validate([
            'nama_pengirim' => 'required|min:3',
            'email' => 'required|email',
            'subjek' => 'required|min:5',
            'pesan' => 'required|min:10'
        ], [
            'nama_pengirim.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'pesan.min' => 'Pesan terlalu pendek, minimal 10 karakter.'
        ]);

        Masukan::create([
            'nama_pengirim' => $request->nama_pengirim,
            'email' => $request->email,
            'subjek' => $request->subjek,
            'pesan' => $request->pesan,
            'tgl_kirim' => now()
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah terkirim dan akan kami tinjau.');
    }
}