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
                                                  <h4 class="card-title" >Laporan Siswa</h4>
                                                  <div>
                                                       <button type="button" class="btn btn-sm btn-primary btn-rounded m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            Import Excel
                                                       </button>
                                                       {{-- <a href="/exportsiswaexcel" class="btn btn-sm btn-success btn-rounded m-1">
                                                            Export Excel
                                                       </a> --}}
                                                       <a href="/exportsiswapdf" class="btn btn-sm btn-danger btn-rounded m-1">
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
                                             <h4 class="card-title" >Data Siswa</h4>
                                             <form action="/laporan/user" method="GET">
                                                  <!-- @csrf -->
                                                  <div class="search d-flex">
                                                       <div class="d-blox justify-content-center m-1">
                                                            <label for="nama" class="statistics-title mt-1">Filter</label>
                                                       </div>
                                                       <div class="d-blox justify-content-center m-1">
                                                            <div class="form-group">
                                                                 <input type="text" class="form-control rounded" style="padding-right: 1px" name="id_tabungan" id="id_tabungan" value="{{ request('id_tabungan') }}" placeholder="ID Tabungan">
                                                            </div>
                                                       </div>
                                                       <div class="d-blox justify-content-center m-1">
                                                            <div class="form-group">
                                                                 <input type="text" class="form-control rounded" style="padding-right: 1px" name="nama" id="nama" value="{{ request('nama') }}" placeholder="Nama">
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
                                                       <div class="d-blox justify-content-center m-1">
                                                            <div class="form-group">
                                                                 <input type="text" class="form-control rounded" style="padding-right: 1px" name="kontak" id="kontak" value="{{ request('kontak') }}" placeholder="Kontak">
                                                            </div>
                                                       </div>
                                                       <div class="d-blox justify-content-center m-1">
                                                            <div class="form-group">
                                                                 <input type="text" class="form-control rounded" style="padding-right: 1px" name="orang_tua" id="orang_tua" value="{{ request('orang_tua') }}" placeholder="Orang Tua">
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
                                                            <th>Tanggal Dibuat</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @foreach($siswa as $users)
                                                            <tr>
                                                                 <td>{{$loop->iteration + $siswa->firstItem() - 1}}</td>
                                                                 <td class="text-center">{{$users->id_tabungan}}</td>
                                                                 <td>{{$users->nama}}</td>
                                                                 <td>{{$users->jenis_kelamin}}</td>
                                                                 <td>{{$users->kelas}}</td>
                                                                 <td>{{$users->kontak}}</td>
                                                                 <td>{{$users->orang_tua}}</td>
                                                                 <td>{{$users->alamat}}</td>
                                                                 <td>{{ \Carbon\Carbon::parse($users->created_at)->format('H:i, F d y') }}</td>
                                                            </tr>
                                                       @endforeach
                                                  </tbody>
                                             </div>
                                        </table>
                                        <!-- Revisi Pagination (Tambahin'vendor.pagination.bootstrap-5') -->
                                        {{ $siswa->links('vendor.pagination.bootstrap-5') }}
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form action="/importsiswaexcel" method="POST" enctype="multipart/form-data">
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