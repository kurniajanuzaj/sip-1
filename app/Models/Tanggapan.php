<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $table = 'tanggapans';
    protected $fillable = ['user_id', 'pengaduan_id', 'tanggal', 'isi_laporan', 'status',];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
