<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function relationToRole()
    {
        return $this->belongsTo(Role::class, 'roles_id');
    }
    public function relationTabungan()
    {
        return $this->hasOne(Tabungan::class)->withDefault();
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'roles_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded=[];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getDataPetugas(){

        $petugas = User::all();
        $user_filter = [];

        foreach ($petugas as $index => $petugas) {
            $petugas_filter[$index]['No'] = $index + 1;
            $petugas_filter[$index]['Username'] = $petugas->id_tabungan;
            $petugas_filter[$index]['Nama'] = $petugas->nama;
            $petugas_filter[$index]['Jenis Kelamin'] = $petugas->jenis_kelamin;
            $petugas_filter[$index]['Email'] = $petugas->email;
            $petugas_filter[$index]['Kontak'] = $petugas->kontak;
            $petugas_filter[$index]['Password'] = $petugas->password;
        }

    return $user_filter;
    }
}
