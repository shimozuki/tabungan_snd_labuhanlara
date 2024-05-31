<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Kelola Siswa - SITASU</title>

     @include('layouts.head')

</head>

<body>
     <div class="container-scroller">
          <!-- Navigation Bar -->
          @include('layouts.navbar')

          <!-- Content Main -->
          <div class="container-fluid page-body-wrapper">
               @include('layouts.color')

               <!-- Side Bar -->
               @include('layouts.sidebar')

               <!-- Content -->
               <div class="main-panel">
                    <div class="content-wrapper">
                    <div class="row">
                         <div class="col-lg-12 grid-margin">
                              <div class="card mb-3">
                                   <div class="card-body" >
                                        <div class="col-sm-12">
                                             <div class="statistics-details d-flex align-items-center justify-content-between">
                                                  <h4 class="card-title" >Kelola Siswa</h4>
                                                  <button type="button" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                                       Tambah Data Siswa
                                                  </button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                             <h4 class="card-title" >Data Siswa</h4>
                                             <form action="/petugas/siswa" method="GET">
                                                  <!-- @csrf -->
                                                  <div class="search d-flex">
                                                       <div class="d-blox justify-content-center m-1">
                                                            <label for="nama" class="statistics-title mt-1">Filter</label>
                                                       </div>
                                                       <div class="d-blox justify-content-center m-1">
                                                            <div class="form-group">
                                                                 <input type="text" class="form-control rounded" style="padding-right: 1px" name="search" id="search" value="{{ request('search') }}" placeholder="Cari...">
                                                            </div>
                                                       </div>
                                                       <div class="d-blok justify-content-center m-1">
                                                            <div class="form-group">
                                                                 <select class="form-select form-select-sm rounded"  name="jenis_kelamin" id="jenis_kelamin">
                                                                      <option value="" >Jenis Kelamin</option>
                                                                      <option value="Laki - Laki" {{ request('jenis_kelamin') == 'Laki - Laki' ? 'selected' : '' }} >Laki - Laki</option>
                                                                      <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }} >Perempuan</option>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="d-blok justify-content-center m-1">
                                                            <div class="form-group">
                                                                 <select class="form-select form-select-sm rounded"  name="kelas" id="kelas">
                                                                      <option value="" >Kelas</option>
                                                                      <option value="1A" {{ request('kelas') == '1A' ? 'selected' : '' }} >1 - A</option>
                                                                      <option value="1B" {{ request('kelas') == '1B' ? 'selected' : '' }}>1 - B</option>
                                                                      <option value="2A" {{ request('kelas') == '2A' ? 'selected' : '' }}>2 - A</option>
                                                                      <option value="2B" {{ request('kelas') == '2B' ? 'selected' : '' }}>2 - B</option>
                                                                      <option value="3A" {{ request('kelas') == '3A' ? 'selected' : '' }}>3 - A</option>
                                                                      <option value="3B" {{ request('kelas') == '3B' ? 'selected' : '' }}>3 - B</option>
                                                                      <option value="4" {{ request('kelas') == '4' ? 'selected' : '' }}>4</option>
                                                                      <option value="5" {{ request('kelas') == '5' ? 'selected' : '' }}>5</option>
                                                                      <option value="6" {{ request('kelas') == '6' ? 'selected' : '' }}>6</option>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="d-blok justify-content-center m-1">
                                                            <button type="submit" class="btn btn-sm btn-primary btn-rounded">
                                                                 Cari
                                                            </button>
                                                       </div>
                                                  </div>
                                             </form>
                                        </div>
                                        <div class="table-responsive">
                                             <table id="table-data " class="table table-striped text-center">
                                                  <thead>
                                                       <tr class="text-center">
                                                            <th>No</th>
                                                            <th>ID</th>
                                                            <th>Nama</th>
                                                            <th>Jenis Kelamin</th>
                                                            <th>Kelas</th>
                                                            <th>Kontak</th>
                                                            <th>Orang Tua</th>
                                                            <th>Alamat</th>
                                                            {{-- <th>Email</th> --}}
                                                            <th>Tanggal Dibuat</th>
                                                            <th>Opsi</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @foreach($userSiswa as $users)
                                                            <tr>
                                                                 <td class="text-center">{{$loop->iteration}}</td>
                                                                 <td class="text-center">{{$users->id_tabungan}}</td>
                                                                 <td>{{$users->nama}}</td>
                                                                 <td>{{$users->jenis_kelamin}}</td>
                                                                 <td>{{$users->kelas}}</td>
                                                                 <td>{{$users->kontak}}</td>
                                                                 <td>{{$users->orang_tua}}</td>
                                                                 <td>{{$users->alamat}}</td>
                                                                 {{-- <td>{{$users->email}}</td> --}}
                                                                 <td>{{$users->created_at}}</td>
                                                                 <td class="text-center">
                                                                      <button type="button" class="btn btn-warning btn-sm btn-rounded" data-id="{{ $users->id }}" id="btn-edit-user" data-bs-toggle="modal" data-bs-target="#editModal">
                                                                           Edit
                                                                      </button>
                                                                      <a type="button" href="/petugas/siswa/delete/{{$users->id}}" class="btn btn-danger btn-rounded btn-sm">
                                                                           Hapus
                                                                      </a>
                                                                 </td>
                                                            </tr>
                                                       @endforeach
                                                  </tbody>
                                             </div>
                                        </table>
                                   </div>
                              </div>
                              </div>
                         </div>
                    </div>
                    </div>
               </div>
          </div>
     </div>
<!-- End Content Main -->

<!-- Tambah Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form method="post" action="{{ route('siswa.store')}}" enctype="multipart/form-data">
                         @csrf
                         <div class="row">
                              <div class="form-group col-md-6">
                                   <label for="nama">Nama</label>
                                   <input type="text" class="form-control rounded" id="nama" name="nama" placeholder="Masukan Nama">
                                   <input type="text" class="form-control rounded" id="id_tabungan" name="id_tabungan" value="{{$nomor}}" hidden>
                              </div>
                              {{-- <div class="form-group col-md-6">
                                   <label for="email">Email Address</label>
                                   <input type="email" class="form-control rounded" id="email" name="email" placeholder="Masukan Email">
                              </div> --}}
                              <div class="form-group col-md-6">
                                   <label for="kontak">Nomor Telepon</label>
                                   <input type="text" class="form-control rounded" id="kontak" name="kontak" placeholder="Masukan Kontak">
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="password">Password</label>
                                   <input type="password" class="form-control rounded" id="password" name="password" placeholder="Masukan Password">
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="jenis_kelamin">Jenis Kelamin</label>
                                   <select name="jenis_kelamin" class="form-select form-select-sm" id="jenis_kelamin">
                                   <option value="Laki - Laki">Laki - Laki</option>
                                   <option value="Perempuan">Perempuan</option>
                              </select>
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="kelas">Kelas</label>
                                   <select name="kelas" class="form-select form-select-sm" id="kelas">
                                        <option value="1A">1 - A</option>
                                        <option value="1B">1 - B</option>
                                        <option value="2A">2 - A</option>
                                        <option value="2B">2 - B</option>
                                        <option value="3A">3 - A</option>
                                        <option value="3B">3 - B</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                   </select>
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="orang_tua">Nama Orang Tua</label>
                                   <input type="text" class="form-control rounded" id="orang_tua" name="orang_tua" placeholder="Masukan Orang Tua">
                              </div>
                              <div class="form-group col-md-12">
                                   <label for="alamat">Alamat</label>
                                   <input type="text" class="form-control rounded" id="alamat" name="alamat" placeholder="Masukan Alamat">
                              </div>
                         </div>
                         <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary btn-rounded">Tambah Data Siswa</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>
<!-- End Modal -->
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form method="post" action="{{ route('siswa.ubah')}}" enctype="multipart/form-data">
                         @method ('PATCH')
                         @csrf
                         <div class="row">
                              {{-- <div class="form-group col-md-6">
                                   <label for="id">Id</label> --}}
                                   <input type="text" class="form-control rounded" id="edit-id" name="id" placeholder="Id" readonly hidden>
                                   <input type="text" class="form-control rounded" id="edit-id_tabungan" name="id_tabungan" readonly hidden >
                              {{-- </div> --}}
                              <div class="form-group col-md-6">
                                   <label for="nama">Nama</label>
                                   <input type="text" class="form-control rounded" id="edit-nama" name="nama" placeholder="Masukan Nama">
                              </div>
                              {{-- <div class="form-group col-md-6">
                                   <label for="id">NISN</label>
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="email">Email Address</label>
                                   <input type="email" class="form-control rounded" id="edit-email" name="email" placeholder="Masukan Email">
                              </div> --}}
                              <div class="form-group col-md-6">
                                   <label for="kontak">Nomor Telepon</label>
                                   <input type="text" class="form-control rounded" id="edit-kontak" name="kontak" placeholder="Masukan Kontak">
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="jenis_kelamin">Jenis Kelamin</label>
                                   <select name="jenis_kelamin" class="form-select form-select-sm" id="edit-jenis_kelamin">
                                        <option value="Laki - Laki">Laki - Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                   </select>
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="kelas">Kelas</label>
                                   <select name="kelas" class="form-select form-select-sm" id="edit-kelas">
                                        <option value="1A">1 - A</option>
                                        <option value="1B">1 - B</option>
                                        <option value="2A">2 - A</option>
                                        <option value="2B">2 - B</option>
                                        <option value="3A">3 - A</option>
                                        <option value="3B">3 - B</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                   </select>
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="orang_tua">Nama Orang Tua</label>
                                   <input type="text" class="form-control rounded" id="edit-orang_tua" name="orang_tua" placeholder="Masukan Orang Tua">
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="alamat">Alamat</label>
                                   <input type="text" class="form-control rounded" id="edit-alamat" name="alamat" placeholder="Masukan Alamat">
                              </div>
                         </div>
                         <div class="modal-footer justify-content-center">
                              <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary btn-rounded">Simpan</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>
<!-- End Modal -->

<!-- Script -->
@include('layouts.script')

<script>
     $(function(){
          $(document).on('click','#btn-edit-user', function(){

               let id = $(this).data('id');

               $.ajax({
                    type: "get",
                    url: "{{url('/admin/ajaxadmin/dataUser')}}/"+id,
                    dataType: 'json',
                    success: function(res){
                         $('#edit-id').val(res.id);
                         $('#edit-id_tabungan').val(res.id_tabungan);
                         $('#edit-nama').val(res.nama);
                         $('#edit-email').val(res.email);
                         $('#edit-jenis_kelamin').val(res.jenis_kelamin);
                         $('#edit-kontak').val(res.kontak);
                         $('#edit-kelas').val(res.kelas);
                         $('#edit-alamat').val(res.alamat);
                         $('#edit-orang_tua').val(res.orang_tua);
                    },
               });
          });
     });
</script>
</body>
</html>