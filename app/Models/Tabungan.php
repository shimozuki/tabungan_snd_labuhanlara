<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;

    public function relationToUser()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function relationToRole()
    {
        return $this->belongsTo(Role::class, 'roles_id');
    }
    public function relationUser()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public static function getDataTabungans(){
        $tabungans = Tabungan::all();

        $tabungan_filter = [];

        $no = 1;
        for($i=0; $i < $tabungans->count(); $i++){
            $tabungan_filter[$i]['No'] = $no++;
            $tabungan_filter[$i]['Kode'] = $tabungans[$i]->id_tabungan;
            $tabungan_filter[$i]['Nama'] = $tabungans[$i]->nama;
            $tabungan_filter[$i]['Kelas'] = $tabungans[$i]->kelas;
            $tabungan_filter[$i]['Saldo Awal'] = $tabungans[$i]->saldo_awal;
            $tabungan_filter[$i]['Saldo Akhir'] = $tabungans[$i]->saldo_akhir;
            $tabungan_filter[$i]['Stor'] = $tabungans[$i]->tipe_transaksi;
            $tabungan_filter[$i]['Tarik'] = $tabungans[$i]->jumlah;
            $tabungan_filter[$i]['Biaya'] = $tabungans[$i]->premi;
            $tabungan_filter[$i]['Sisa'] = $tabungans[$i]->sisa;
            $tabungan_filter[$i]['Dibuat'] = $tabungans[$i]->created_at;
        }

        return $tabungan_filter;
    }

    protected $guarded = [];
}
