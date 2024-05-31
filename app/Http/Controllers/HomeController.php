<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Total Tabungan -----------------------------------------------------------------------------------------------------------
        $hitungTotalSaldo = Tabungan::sum('saldo_akhir');
        $dataTerbaru = DB::table('tabungans')->select('id', 'id_tabungan', 'saldo_akhir')->whereIn('id', function ($query) {
            $query->select(DB::raw('MAX(id)'))->from('tabungans')->groupBy('id_tabungan');
        })->get();
        $totalTabungan = 0;
        foreach ($dataTerbaru as $data) {
            $totalTabungan += $data->saldo_akhir;
        }
        // Total Stor Tabungan Bulan Ini ---------------------------------------------------------------------------------------------
        $bulanIni = Carbon::now()->format('m');
        $bulanStor = Tabungan::whereMonth('created_at', $bulanIni)->where('tipe_transaksi', 'Stor')->sum('jumlah');
        // Total Tarik Tabungan Bulan Ini ---------------------------------------------------------------------------------------------
        $bulanIni = Carbon::now()->format('m');
        $bulanTarik = Tabungan::whereMonth('created_at', $bulanIni)->where('tipe_transaksi', 'Tarik')->sum('jumlah');
        // Total Stor Tabungan bulan Ini ----------------------------------------------------------------------------------------------
        $totalStor = Tabungan::where('tipe_transaksi', 'Stor')->count();
        // Total Tarik Tabungan bulan Ini ---------------------------------------------------------------------------------------------
        $totalTarik = Tabungan::where('tipe_transaksi', 'Tarik')->count();
        // Total Siswa  ---------------------------------------------------------------------------------------------------------------
        $totalSiswa = User::where('roles_id', 3)->count();

        // Untuk Siswa ----------------------------------------------------------------------------------------------------------------
        $user = Auth::user();
        $test = $user->id_tabungan;
        $data = Tabungan::where('id_tabungan', $test)->latest('created_at')->first();
        $totalStorSiswa = Tabungan::where('id_tabungan', $test)->where('tipe_transaksi', 'Stor')->sum('jumlah');
        $totalTarikSiswa = Tabungan::where('id_tabungan', $test)->where('tipe_transaksi', 'Tarik')->sum('jumlah');
        $kaliStorSiswa = Tabungan::where('id_tabungan', $test)->where('tipe_transaksi', 'Stor')->count();
        $kaliTarikSiswa = Tabungan::where('id_tabungan', $test)->where('tipe_transaksi', 'Tarik')->count();

        return view('home', compact('bulanStor','bulanTarik','totalStor','totalTarik','totalSiswa','totalTabungan','totalTarikSiswa','totalStorSiswa','data','kaliStorSiswa','kaliTarikSiswa'));
    }
}
