<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    public static function getDataPengajuans(){

        $pengajuan = Pengajuan::all();

        $pengajuan_filter = [];

        $no = 1;

        for($i = 0; $i < $pengajuan->count(); $i++){
            $pengajuan_filter[$i]['no'] = $no++ ;
            $pengajuan_filter[$i]['nama'] = $pengajuan[$i]->nama ;
            $pengajuan_filter[$i]['kelas'] = $pengajuan[$i]->kelas ;
            $pengajuan_filter[$i]['jumlah_tabungan'] = $pengajuan[$i]->jumlah_tabungan ;
            $pengajuan_filter[$i]['jumlah_tarik'] = $pengajuan[$i]->jumlah_tarik ;
            $pengajuan_filter[$i]['alasan'] = $pengajuan[$i]->alasan ;

        }

        return $pengajuan_filter;
    }
}
