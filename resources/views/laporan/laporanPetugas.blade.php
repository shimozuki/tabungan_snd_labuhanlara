<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Laporan Wali Kelas</title>

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
                                                  <h4 class="card-title" >Laporan Wali Kelas</h4>
                                                  <div>
                                                       <button type="button" class="btn btn-sm btn-primary btn-rounded m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            Import Excel
                                                       </button>
                                                       {{-- <a href="/exportpetugasexcel" class="btn btn-sm btn-success btn-rounded m-1">
                                                            Export Excel
                                                       </a> --}}
                                                       <a href="/exportpetugaspdf" class="btn btn-sm btn-danger btn-rounded m-1">
                                                            Export PDF
                                                       </a>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                             <h4 class="card-title" >Data Wali Kelas</h4>
                                             <form action="/laporan/ptgs" method="GET">
                                                  <!-- @csrf -->
                                                  <div class="search d-flex">
                                                       <div class="d-blox justify-content-center m-1">
                                                            <label for="nama" class="statistics-title mt-1">Filter</label>
                                                       </div>
                                                       <div class="d-blox justify-content-center m-1">
                                                            <div class="form-group">
                                                                 <input type="text" class="form-control rounded" name="nama" id="nama" value="{{ request('nama') }}" placeholder="Cari Nama...">
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
                                        <table id="table-data" class="table table-striped text-center">
                                             <thead>
                                                  <tr class="text-center">
                                                       <th>No</th>
                                                       <th>Username</th>
                                                       <th>Nama</th>
                                                       <th>Jenis Kelamin</th>
                                                       <th>Email</th>
                                                       <th>Kontak</th>
                                                       <th>Tanggal Dibuat</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  @foreach($tabungan as $users)
                                                       <tr>
                                                            <td>{{$loop->iteration + $tabungan->firstItem() - 1}}</td>
                                                            <td>{{$users->id_tabungan}}</td>
                                                            <td>{{$users->nama}}</td>
                                                            <td>{{$users->jenis_kelamin}}</td>
                                                            <td>{{$users->email}}</td>
                                                            <td>{{$users->kontak}}</td>
                                                            <td>{{ \Carbon\Carbon::parse($users->created_at)->format('H:i, F d y') }}</td>
                                                       </tr>
                                                  @endforeach
                                             </tbody>
                                        </table>
                                        <!-- Revisi Pagination (Tambahin'vendor.pagination.bootstrap-5') -->
                                        {{ $tabungan->links('vendor.pagination.bootstrap-5') }}
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

<!-- Import Excel -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
               <div class="modal-content">
                    <div class="modal-header">
                         <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data Petugas</h1>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/importpetugasexcel" method="POST" enctype="multipart/form-data">
                         @csrf
                         <div class="modal-body" style="margin-bottom: -30px">
                              <label for="file" class="m-1">Pilih File Excel</label>
                              <div class="form-group">
                                   <input type="file" class="form-control rounded" style="padding-bottom: 28px" name="file" required>
                              </div>
                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary btn-rounded">Import</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>

<!-- Script -->
@include('layouts.script')

</body>
</html>
