<?php

namespace App\Http\Controllers;

use App\Models\Masukan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasukanController extends Controller
{
    public function index()
    {
        $masukan = Masukan::orderBy('tgl_kirim', 'desc')->get();
        return view('admin.masukan.index', compact('masukan'));
    }

    public function destroy($id)
    {
        $masukan = Masukan::findOrFail($id);
        $masukan->delete();

        return redirect()->route('pesan.index')->with('success', 'Pesan berhasil dihapus');
    }
}
