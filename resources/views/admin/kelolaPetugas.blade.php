<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Kelola Wali kelas - SIMPLE</title>

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
                                                  <h4 class="card-title" >Kelola Wali Kelas</h4>
                                                  <button type="button" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                                       Tambah Data Wali Kelas
                                                  </button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                             <h4 class="card-title" >Data Wali Kelas</h4>
                                             <form action="/amdin/petugas" method="GET">
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
                                                            <button type="submit" class="btn btn-sm btn-primary btn-rounded">
                                                                 Cari
                                                            </button>
                                                       </div>
                                                  </div>
                                             </form>
                                        </div>
                                        <div class="table-responsive">
                                             <table id="table-data" class="table table-striped text-center">
                                                  <thead>
                                                       <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Username</th>
                                                            <th>Jenis Kelamin</th>
                                                            <th>Email</th>
                                                            <th>Kontak</th>
                                                            <th>Tanggal Dibuat</th>
                                                            <th>Opsi</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @foreach($userPetugas as $users)
                                                            <tr>
                                                                 <td class="text-center">{{$loop->iteration}}</td>
                                                                 <td>{{$users->nama}}</td>
                                                                 <td>{{$users->id_tabungan}}</td>
                                                                 <td>{{$users->jenis_kelamin}}</td>
                                                                 <td>{{$users->email}}</td>
                                                                 <td>{{$users->kontak}}</td>
                                                                 <td>{{$users->created_at}}</td>
                                                                 <td class="text-center">
                                                                      <button type="button" class="btn btn-warning btn-sm btn-rounded" data-id="{{ $users->id }}" id="btn-edit-user" data-bs-toggle="modal" data-bs-target="#editModal">
                                                                           Edit
                                                                      </button>
                                                                      <a type="button" href="/admin/petugas/delete/{{$users->id}}" class="btn btn-danger btn-rounded btn-sm">
                                                                           Hapus
                                                                      </a>
                                                                 </td>
                                                            </tr>
                                                       @endforeach
                                                  </tbody>
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
     </div>
<!-- End Content Main -->

<!-- Tambah Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Petugas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form method="post" action="{{ route('petugas.store')}}" enctype="multipart/form-data">
                         @csrf
                         <div class="row">
                              <div class="form-group col-md-6">
                                   <label for="nama">Nama</label>
                                   <input type="text" class="form-control rounded" id="nama" name="nama" placeholder="Nama">
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="id_tabungan">Username</label>
                                   <input type="text" class="form-control rounded" id="id_tabungan" name="id_tabungan" placeholder="Username Maks. 10">
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="email">Email Address</label>
                                   <input type="email" class="form-control rounded" id="email" name="email" placeholder="Email">
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="kontak">Nomor Telepon</label>
                                   <input type="text" class="form-control rounded" id="kontak" name="kontak" placeholder="Kontak">
                              </div>
                              <div class="form-group col-md-6">
                              <label for="password">Password</label>
                              <input type="password" class="form-control rounded" id="password" name="password" placeholder="Password">
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="jenis_kelamin">Jenis Kelamin</label>
                                   <select name="jenis_kelamin" class="form-select form-select-sm" id="jenis_kelamin">
                                        <option value="Laki - Laki">Laki - Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                   </select>
                              </div>
                         </div>
                         <div class="modal-footer justify-content-center">
                              <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary btn-rounded">Tambah</button>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Petugas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form method="post" action="{{ route('petugas.ubah')}}" enctype="multipart/form-data">
                         @method ('PATCH')
                         @csrf
                         <div class="row">
                              <div class="form-group">
                                   <label for="nama">Nama</label>
                                   <input type="text" class="form-control rounded" id="edit-id" name="id" placeholder="Id" readonly hidden>
                                   <input type="text" class="form-control rounded" id="edit-nama" name="nama" placeholder="Nama">
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="id_tabungan">Username</label>
                                   <input type="text" class="form-control rounded" id="edit-id_tabungan" name="id_tabungan" placeholder="Username">
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="email">Email Address</label>
                                   <input type="email" class="form-control rounded" id="edit-email" name="email" placeholder="Email">
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="kontak">Nomor Telepon</label>
                                   <input type="text" class="form-control rounded" id="edit-kontak" name="kontak" placeholder="Kontak">
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="jenis_kelamin">Jenis Kelamin</label>
                                   <select name="jenis_kelamin" class="form-select form-select-sm rounded" id="edit-jenis_kelamin">
                                        <option value="Laki - Laki">Laki - Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                   </select>
                              </div>
                              <div class="modal-footer justify-content-center">
                                   <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Batal</button>
                                   <button type="submit" class="btn btn-primary btn-rounded">Simpan</button>
                              </div>
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
                         $('#edit-kontak').val(res.kontak);
                         $('#edit-jenis_kelamin').val(res.jenis_kelamin);
                    },
               });
          });
     });
</script>
</body>
</html>