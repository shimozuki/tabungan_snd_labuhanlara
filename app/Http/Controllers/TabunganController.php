<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Tabungan;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Exports\TabunganExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class TabunganController extends Controller
{
    // Read Tabungan ----------------------------------------------------------------------------------------------------------------
    public function index_stor(Request $request){
        $stor = Tabungan::All();
        $user = User::All();
        $role = Role::All();

        //Searching
        $query = Tabungan::query()->where('tipe_transaksi', 'Stor');
        $query->select('id','nama','kelas','id_tabungan','saldo_awal','saldo_akhir','tipe_transaksi','jumlah','premi','sisa','roles_id');
        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('nama', 'LIKE', '%'.$searchTerm.'%')
                    ->orWhere('email', 'LIKE', '%'.$searchTerm.'%')
                    ->orWhere('alamat', 'LIKE', '%'.$searchTerm.'%')
                    ->orWhere('id_tabungan', 'LIKE', '%'.$searchTerm.'%')
                    ->orWhere('orang_tua', 'LIKE', '%'.$searchTerm.'%')
                    ->orWhere('kontak', 'LIKE', '%'.$searchTerm.'%')
                    ->orWhere('alamat', 'LIKE', '%'.$searchTerm.'%');
            });
        }
        if($request->kelas == "1A" || $request->kelas == "1B" || $request->kelas == "2A"
            || $request->kelas == "2B" || $request->kelas == "3A" || $request->kelas == "3B"
            || $request->kelas == "4" || $request->kelas == "5" || $request->kelas == "6"){
            $query->where('kelas',$request->kelas);
        }
        $query->orderBy('created_at','desc')->whereDate('created_at', Carbon::today());
        //End Searching
        $storTabel = $query->paginate(10);

        // Tabel Stor Tabungan ------------------------------------------------------------------------------------------------------
        // $startDate = now()->startOfMonth(); // Mulai bulan ini
        // $endDate = now()->endOfMonth(); // Akhir bulan ini
        // $storTabel = Tabungan::whereBetween('created_at', [$startDate, $endDate])->where('tipe_transaksi', 'Stor')->paginate(30);

        // Total Tabungan -----------------------------------------------------------------------------------------------------------
        $hitungTotalSaldo = Tabungan::sum('saldo_akhir');
        $dataTerbaru = DB::table('tabungans')->select('id', 'id_tabungan', 'saldo_akhir')->whereIn('id', function ($query) {
            $query->select(DB::raw('MAX(id)'))->from('tabungans')->groupBy('id_tabungan');
        })->get();
        $totalJumlahTabungan = 0;
        foreach ($dataTerbaru as $data) {
            $totalJumlahTabungan += $data->saldo_akhir;
        }

        // Total Stor Tabungan -------------------------------------------------------------------------------------------------------
        $hitungTotalStor = Tabungan::where('tipe_transaksi', 'Stor')->sum('jumlah');

        // Total Stor Tabungan Bulan Ini ---------------------------------------------------------------------------------------------
        $bulanIni = Carbon::now()->format('m');
        $bulanStor = Tabungan::whereMonth('created_at', $bulanIni)->where('tipe_transaksi', 'Stor')->sum('jumlah');

        // Total Stor Tabungan Minggu Ini --------------------------------------------------------------------------------------------
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $mingguStor = Tabungan::where('tipe_transaksi', 'Stor')->whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('jumlah');

        // Total Stor Tabungan Hari Ini ----------------------------------------------------------------------------------------------
        $today = Carbon::today();
        $hariStor = Tabungan::whereDate('created_at', $today)->where('tipe_transaksi', 'Stor')->sum('jumlah');

        // Total Per Kelas Stor Tabungan Hari Ini ------------------------------------------------------------------------------------
        $today = Carbon::today();
        $kelasList = ['1A', '1B', '2A', '2B', '3A', '3B', '4', '5', '6'];
        $totalStorHariIni = [];
        foreach ($kelasList as $kelas) {
            $totalStorHariIni[$kelas] = Tabungan::where('kelas', $kelas)
                ->where('tipe_transaksi', 'Stor')
                ->whereDate('created_at', $today)
                ->sum('jumlah');
        }

        // Generate Dropdown NISN -----------------------------------------------------------------------------------------------------
        $storTerbaru = [];
        $result = [];
        $result2 = [];
        $ambilDataTerakhir = Tabungan::pluck('id_tabungan');

        foreach ($ambilDataTerakhir as $index => $value) {
            $result[$value] = $index;
        }
        foreach ($result as $index => $value) {
            $result2[$value] = $index;
        }
        foreach ($result2 as $index => $value) {
            $storTerbaru[$value] = Tabungan::where('id_tabungan', $value )->latest('id')->first();
        }

        return view('petugas.kelolaStor', compact('storTabel','totalJumlahTabungan','totalStorHariIni','kelasList',
                                                    'storTerbaru','stor','user','role','hitungTotalSaldo','hitungTotalStor',
                                                    'bulanStor','mingguStor','hariStor'));
    }
    // Stor Tabungan ----------------------------------------------------------------------------------------------------------------
    public function stor_tabungan(Request $req){
        $tabungan = new Tabungan ;
        $validate = $req->validate([
            'nama' => 'required|max:255',
            'kelas' => 'required',
            'jumlah_stor' => 'required|numeric',
            'jumlah_tabungan' => 'required',
        ]);
        $tabungan->id_tabungan = $req->get('selectuser');
        $tabungan->nama = $req->get('nama');
        $tabungan->kelas = $req->get('kelas');
        $tabungan->roles_id = 3 ;
        $tabungan->tipe_transaksi = 'Stor';
        $tabungan->jumlah = $req->get('jumlah_stor');
        $tabungan->saldo_awal = $req->get('jumlah_tabungan');
        $tabungan->saldo_akhir = $tabungan->saldo_awal + $tabungan->jumlah ;
        $tabungan->premi = $tabungan->saldo_akhir * 0.05 ;
        $tabungan->sisa = $tabungan->saldo_akhir - $tabungan->premi ;
        $tabungan->save();
        $notification = array(
            'message' => 'Transaksi Stor Tabungan Berhasil',
            'alert-type' => 'success'
        );
        return redirect()->route('tabungan.stor')->with($notification);
        
    }
    // Stor Searching ----------------------------------------------------------------------------------------------------------------
    public function search($id){
        $user = Tabungan::find($id);
        return response()->json($user);
    }
    // Tarik Tabungan ----------------------------------------------------------------------------------------------------------------
    public function index_tarik(Request $request){
        $tarik = Tabungan::All();
        $user = User::All();
        $role = Role::All();

        //Searching
        $query = Tabungan::query()->where('tipe_transaksi', 'Tarik');
        $query->select('id','nama','kelas','id_tabungan','saldo_awal','saldo_akhir','tipe_transaksi','jumlah','premi','sisa','roles_id');
        $searchTerm = $request->input('search');

        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('nama', 'LIKE', '%'.$searchTerm.'%')
                    ->orWhere('id_tabungan', 'LIKE', '%'.$searchTerm.'%');
            });
        }
        if($request->kelas == "1A" || $request->kelas == "1B" || $request->kelas == "2A"
            || $request->kelas == "2B" || $request->kelas == "3A" || $request->kelas == "3B"
            || $request->kelas == "4" || $request->kelas == "5" || $request->kelas == "6"){
            $query->where('kelas',$request->kelas);
        }
        $query->orderBy('created_at','desc')->whereDate('created_at', Carbon::today());
        //End Searching
        $tarikTabel = $query->paginate(10);

        // Tabel Tarik Tabungan -------------------------------------------------------------------------------------------------------
        // $startDate = now()->startOfMonth(); // Mulai bulan ini
        // $endDate = now()->endOfMonth(); // Akhir bulan ini
        // $tarikTabel = Tabungan::whereBetween('created_at', [$startDate, $endDate])->where('tipe_transaksi', 'Tarik')->paginate(30);

        // Total Tabungan --------------------------------------------------------------------------------------------------------------
        $hitungTotalSaldo = Tabungan::sum('saldo_akhir');
        $dataTerbaru = DB::table('tabungans')->select('id', 'id_tabungan', 'saldo_akhir')->whereIn('id', function ($query) {
            $query->select(DB::raw('MAX(id)'))->from('tabungans')->groupBy('id_tabungan');
        })->get();
        $totalJumlahTabungan = 0;
        foreach ($dataTerbaru as $data) {
            $totalJumlahTabungan += $data->saldo_akhir;
        }

        // Total Tarik Tabungan --------------------------------------------------------------------------------------------------------
        $hitungTotalTarik = Tabungan::where('tipe_transaksi', 'Tarik')->sum('jumlah');

        // Total Tarik Tabungan Bulan Ini ----------------------------------------------------------------------------------------------
        $bulanIni = Carbon::now()->format('m');
        $bulanTarik = Tabungan::whereMonth('created_at', $bulanIni)->where('tipe_transaksi', 'Tarik')->sum('jumlah');

        // Total Tarik Tabungan Minggu Ini ---------------------------------------------------------------------------------------------
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $mingguTarik = Tabungan::where('tipe_transaksi', 'Tarik')->whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('jumlah');

        // Total Tarik Tabungan Hari Ini -----------------------------------------------------------------------------------------------
        $today = Carbon::today();
        $hariTarik = Tabungan::whereDate('created_at', $today)->where('tipe_transaksi', 'Tarik')->sum('jumlah');

        // Total Per Kelas Tarik Tabungan Hari Ini -------------------------------------------------------------------------------------
        $today = Carbon::today();
        $kelasList = ['1A', '1B', '2A', '2B', '3A', '3B', '4', '5', '6'];
        $totalTarikHariIni = [];
        foreach ($kelasList as $kelas) {
            $totalTarikHariIni[$kelas] = Tabungan::where('kelas', $kelas)
                ->where('tipe_transaksi', 'Tarik')
                ->whereDate('created_at', $today)
                ->sum('jumlah');
        }

        // Generate Dropdown NISN ------------------------------------------------------------------------------------------------------
        $tarikTerbaru = [];
        $result = [];
        $result2 = [];
        $ambilDataTerakhir = Tabungan::pluck('id_tabungan');
        foreach ($ambilDataTerakhir as $index => $value) {
            $result[$value] = $index;
        }
        foreach ($result as $index => $value) {
            $result2[$value] = $index;
        }
        foreach ($result2 as $index => $value) {
            $tarikTerbaru[$value] = Tabungan::where('id_tabungan', $value )->latest('id')->first();
        }
        return view('petugas.kelolaTarik', compact('tarikTabel','totalJumlahTabungan','totalTarikHariIni','kelasList',
                                                    'tarikTerbaru','tarik','user','role','hitungTotalSaldo','hitungTotalTarik',
                                                    'bulanTarik','mingguTarik','hariTarik'));
    }
    // Tarik Tabungan ----------------------------------------------------------------------------------------------------------------
    public function tarik_tabungan(Request $req){
        $tabungan = new Tabungan ;
        $validate = $req->validate([
            'nama' => 'required|max:255',
            'kelas' => 'required',
            'jumlah_tarik' => 'required',
            'jumlah_tabungan' => 'required',
        ]);

        if ($req->get('jumlah_tabungan') != 0){
            $tabungan->id_tabungan = $req->get('selectuser');
            $tabungan->nama = $req->get('nama');
            $tabungan->kelas = $req->get('kelas');
            $tabungan->roles_id = 3 ;
            $tabungan->tipe_transaksi = 'Tarik';
            $tabungan->jumlah = $req->get('jumlah_tarik');
            $tabungan->saldo_awal = $req->get('jumlah_tabungan');
            $tabungan->saldo_akhir = $tabungan->saldo_awal - $tabungan->jumlah ;
            $tabungan->premi = $tabungan->saldo_akhir * 0.05 ;
            $tabungan->sisa = $tabungan->saldo_akhir - $tabungan->premi ;
            $tabungan->save();
            $notification = array(
                'message' => 'Transaksi Tarik Tabungan Berhasil',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Tidak Dapat Melakukan Transaksi',
                'alert-type' => 'warning'
            );
        }
        return redirect()->route('tabungan.tarik')->with($notification);
    }
    // Laporan Data Tabungan --------------------------------------------------------------------------------------------------------
    public function laporan(Request $request){
        //Searching
        $query = Tabungan::query();
        $query->select('id','nama','kelas','id_tabungan','saldo_awal','saldo_akhir','tipe_transaksi','jumlah','premi','sisa','roles_id');
        if(!empty($request->id_tabungan)){
            $query->where('id_tabungan',$request->id_tabungan);
        }
        if($request->kelas == "1A" || $request->kelas == "1B" || $request->kelas == "2A"
            || $request->kelas == "2B" || $request->kelas == "3A" || $request->kelas == "3B"
            || $request->kelas == "4" || $request->kelas == "5" || $request->kelas == "6"){
            $query->where('kelas',$request->kelas);
        }
        if($request->tipe_transaksi == "Stor" || $request->tipe_transaksi == "Tarik"){
            $query->where('tipe_transaksi',$request->tipe_transaksi);
        }
        if(!empty($request->awal_tanggal) && !empty($request->akhir_tanggal)){
            $query->whereBetween('created_at',[$request->awal_tanggal, $request->akhir_tanggal]);
        }
        $query->orderBy('created_at','desc');
        //End Searching
        $tabungan = $query->paginate(10);
        return view('laporan.laporanTabungan', compact('tabungan'));
    }
    public function ubah_stor(Request $req){
        $tabungan = Tabungan::find($req->get('id'));

        $validate = $req->validate([
            'jumlah_Stor' => 'required|numeric',
        ]);
        $tabungan->jumlah =  $req->get('jumlah_Stor');
        $tabungan->saldo_akhir = $tabungan->saldo_awal + $tabungan->jumlah ;
        $tabungan->premi = $tabungan->saldo_akhir * 0.05 ;
        $tabungan->sisa = $tabungan->saldo_akhir - $tabungan->premi ;
        $tabungan->save();

        $notification = array(
            'message' => 'Data Stor berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('tabungan.stor')->with($notification);
    }
    public function ubah_tarik(Request $req){
        $tabungan = Tabungan::find($req->get('id'));

        $validate = $req->validate([
            'jumlah_Tarik' => 'required|numeric',
        ]);
        $tabungan->jumlah =  $req->get('jumlah_Tarik');
        $tabungan->saldo_akhir = $tabungan->saldo_awal - $tabungan->jumlah ;
        $tabungan->premi = $tabungan->saldo_akhir * 0.05 ;
        $tabungan->sisa = $tabungan->saldo_akhir - $tabungan->premi ;
        $tabungan->save();

        $notification = array(
            'message' => 'Data Tarik berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('tabungan.tarik')->with($notification);
    }
    // Ambil Data Pengajuan -------------------------------------------------------------------------------------------------------
    public function getDataTransaksi($id){
        $tabungan = Tabungan::find($id);
        return response()->json($tabungan);
    }
    // Laporan Data Tabungan --------------------------------------------------------------------------------------------------------
    public function laporanTabungan(Request $request){
        //Searching
        $query = Tabungan::query();
        $query->select('id','nama','kelas','id_tabungan','saldo_awal','saldo_akhir','tipe_transaksi','jumlah','premi','sisa','roles_id');
        if(!empty($request->id_tabungan)){
            $query->where('id_tabungan',$request->id_tabungan);
        }
        if($request->kelas == "1A" || $request->kelas == "1B" || $request->kelas == "2A"
            || $request->kelas == "2B" || $request->kelas == "3A" || $request->kelas == "3B"
            || $request->kelas == "4" || $request->kelas == "5" || $request->kelas == "6"){
            $query->where('kelas',$request->kelas);
        }
        if(!empty($request->awal_tanggal) && !empty($request->akhir_tanggal)){
            $query->whereBetween('created_at',[$request->awal_tanggal, $request->akhir_tanggal]);
        }
        $query->orderBy('created_at','desc');
        //End Searching
        $tabungan = $query->paginate(10);

        $laporanTabungan = [];
        $result = [];
        $result2 = [];
        $ambilDataTerakhir = Tabungan::pluck('id_tabungan');

        foreach ($ambilDataTerakhir as $index => $value) {
            $result[$value] = $index;
        }
        foreach ($result as $index => $value) {
            $result2[$value] = $index;
        }
        foreach ($result2 as $index => $value) {
            $laporanTabungan[$value] = Tabungan::where('id_tabungan', $value )->latest('id')->first();
        }

        return view('laporan.tabungan', compact('tabungan','laporanTabungan'));
    }
    // Export Data Tabungan PDF ----------------------------------------------------------------------------------------------------
    public function exportpdf(){
        $tabungan = Tabungan::all();
        view()->share('tabungan', $tabungan);
        $pdf = PDF::loadview('export.transaksi');
        return $pdf->download('data_transaksi.pdf');
    }
    // Export Data Tabungan Excel ------------------------------------------------------------------------------------------- Error
    public function exportexcel(){
        return Excel::download(new TabunganExport, 'nama_file.xlsx');
    }
    // Export Data Tabungan PDF ----------------------------------------------------------------------------------------------------
    public function exportpdftabungan(){

        $tabungan = [];
        $result = [];
        $result2 = [];
        $ambilDataTerakhir = Tabungan::pluck('id_tabungan');

        foreach ($ambilDataTerakhir as $index => $value) {
            $result[$value] = $index;
        }
        foreach ($result as $index => $value) {
            $result2[$value] = $index;
        }
        foreach ($result2 as $index => $value) {
            $tabungan[$value] = Tabungan::where('id_tabungan', $value )->latest('id')->first();
        }

        view()->share('tabungan', $tabungan);
        $pdf = PDF::loadview('export.tabungan');
        return $pdf->download('data_tabungan.pdf');
    }
    // Export Data Tabungan Excel ------------------------------------------------------------------------------------------- Error
    public function exportexceltabungan(){
        return Excel::download(new TabunganExport, 'nama_file.xlsx');
    }
}