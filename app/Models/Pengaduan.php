<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduans';
    protected $fillable = [ 'no_aduan','user_id', 'tanggal', 'judul','isi_laporan', 'status', 'foto'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function tanggapan(){
    return $this->hasMany('App\Models\Tanggapan');
    } 
}
