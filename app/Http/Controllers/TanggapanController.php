<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanggapan;
use App\Models\Pengaduan;
use Auth;
use Carbon\Carbon;

class TanggapanController extends Controller
{
    public function store(Request $request, Pengaduan $pengaduan){
        request()->validate([
            'isi_laporan' => 'required',
            'status' => 'required',
        ]);

        $tanggapan = Tanggapan::create([
            'user_id' => Auth::id(),
            'pengaduan_id' => request('pengaduan_id'),
            'tanggal' => carbon::today(),
            'isi_laporan' => request('isi_laporan'),
            'status' => request('status'),
        ]);

        $pengaduan = Pengaduan::find($tanggapan->pengaduan_id);
        $pengaduan->status = $tanggapan->status;
        $pengaduan->save();
        
        return redirect()->back();
    }

}
