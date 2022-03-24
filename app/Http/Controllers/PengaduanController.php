<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Auth;
use Carbon\Carbon;

class PengaduanController extends Controller
{
    public function index() {
        $pengaduan = Pengaduan::with('user')->where('status', 'process')->latest()->paginate(10);
        return view('pengaduan.index', compact('pengaduan'));
    }

    public function finish() {
        if (Auth::user()->role == 'admin') {
            $pengaduan = Pengaduan::with('user')
                ->where('status', 'complete')
                ->orWhere('status', 'spam')
                ->latest()->paginate(10);
        } else {
            $pengaduan = Pengaduan::where('user_id', Auth::id())
                ->Where([
                        'status' => 'complete',
                        'status' => 'spam'
                    ])
                ->latest()->paginate(10);
        }
        
        return view('pengaduan.finish', compact('pengaduan'));
    }

    public function store(Request $request) {
        request()->validate([
            'judul' => 'required',
            'isi_laporan' => 'required',
            'foto' => 'required|file',
        ]);

        $pengaduan = Pengaduan::create([
            'no_aduan' => 'Aduan-'.rand(0000000, 9999999),
            'user_id' => Auth::id(),
            'tanggal' => carbon::today(),
            'judul' => request('judul'),
            'isi_laporan' => request('isi_laporan'),
        ]);

        $file = request('foto');
        if ($file) {
            $dir = 'uploads';
            $fileName = time() . '-' . str::random(8) . '.' .
            $file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;
            $pengaduan->foto = $filepath;
            $pengaduan->save();
        }
        return redirect()->back();
    }

    public function show(Pengaduan $pengaduan) {
        $pengaduan->load('user', 'tanggapan');
        return view('pengaduan.show', compact('pengaduan'));
    }
}
