<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Role;
use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Imports\PetugasImport;
use App\Exports\PetugasExport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    // Read Data Petugas --------------------------------------------------------------------------------------------
    public function index(Request $request){
        $user = User::All();
        $role = Role::All();

        //Searching
        $query = User::query()->where('roles_id', 2);
        $query->select('id','nama','email','id_tabungan','jenis_kelamin','kelas','kontak','password','orang_tua','alamat','roles_id','created_at','updated_at');
        $searchTerm = $request->input('search');

        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('nama', 'LIKE', '%'.$searchTerm.'%')
                    ->orWhere('email', 'LIKE', '%'.$searchTerm.'%')
                    ->orWhere('id_tabungan', 'LIKE', '%'.$searchTerm.'%')
                    ->orWhere('kontak', 'LIKE', '%'.$searchTerm.'%');
            });
        }
        if($request->jenis_kelamin == "Laki - Laki" || $request->jenis_kelamin == "Perempuan"){
            $query->where('jenis_kelamin',$request->jenis_kelamin);
        }
        $query->orderBy('created_at','desc');
        //End Searching
        $userPetugas = $query->paginate(10);

        return view('admin.kelolaPetugas', compact('user','role','userPetugas'));
    }
    // Create Data Petugas ------------------------------------------------------------------------------------------
    public function store(Request $req){
        $user = new User;
        $validate = $req->validate([
            'nama' => 'required|max:255',
            'id_tabungan' => 'required|max:10',
            'email' => 'required',
            'kontak' => 'required|max:12',
            'password' => 'required|min:8',
            'jenis_kelamin' => 'required',
        ]);
        $user->nama = $req->get('nama');
        $user->id_tabungan = $req->get('id_tabungan');
        $user->email = $req->get('email');
        $user->kontak = $req->get('kontak');
        $user->jenis_kelamin = $req->get('jenis_kelamin');
        $user->password = Hash::make($req->get('password'));
        $user->roles_id = 2 ;
        $user->kelas = '-' ;
        $user->save();
        $notification = array(
            'message' =>'Data Petugas berhasil ditambahkan', 'alert-type' =>'success'
        );
        return redirect()->route('petugas')->with($notification);
    }
    // Get Data User ------------------------------------------------------------------------------------------------
    public function getDataUser($id){
        $user = User::find($id);
        return response()->json($user);
    }
    // Update Data Petugas ------------------------------------------------------------------------------------------
    public function edit(Request $req){
        $user = User::find($req->get('id'));
        $validate = $req->validate([
            'nama' => 'required|max:255',
            'email' => 'required',
            'kontak' => 'required|max:12',
            'jenis_kelamin' => 'required',
        ]);
        $user->nama = $req->get('nama');
        $user->email = $req->get('email');
        $user->kontak = $req->get('kontak');
        $user->jenis_kelamin = $req->get('jenis_kelamin');
        $user->save();
        $notification = array(
            'message' => 'Data Petugas berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('petugas')->with($notification);
    }
    // Delete Data Petugas ------------------------------------------------------------------------------------------
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        $notification = array(
            'message' => 'Data Petugas berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('petugas')->with($notification);
    }
    // Laporan Data Petugas -----------------------------------------------------------------------------------------
    public function laporan(Request $request){
        //Searching
        $query = User::query()->where('roles_id', 2);
        $query->select('id','nama','email','id_tabungan','jenis_kelamin','kelas','kontak','password','orang_tua','alamat','roles_id');
        if(!empty($request->nama)){
            $query->where('nama', 'LIKE', '%' . $request->nama . '%');
        }
        $query->orderBy('created_at','desc');
        //End Searching
        $tabungan = $query->paginate(10);
        return view('laporan.laporanPetugas', compact('tabungan'));
    }
    public function exportpdf(){
        $user = User::where('roles_id', '2')->get();
        view()->share('user', $user);
        $pdf = PDF::loadview('export.petugas');
        return $pdf->download('data_petugas.pdf');
    }
    public function exportexcel(){
        return Excel::download(new PetugasExport, 'datapetugas.xlsx');
    }
    public function importexcel(Request $req){
        $data = $req->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('PetugasData',  $namafile);
        Excel::import(new  PetugasImport, \public_path('/PetugasData/'.$namafile));
        return \redirect()->back();
    }
}
