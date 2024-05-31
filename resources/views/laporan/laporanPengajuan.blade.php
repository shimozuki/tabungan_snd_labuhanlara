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
                                                       <h4 class="card-title" >Laporan Pengajuan</h4>
                                                       <div>
                                                            {{-- <a href="/exportpengajuanexcel" class="btn btn-sm btn-success btn-rounded m-1">
                                                                 Export Excel
                                                            </a> --}}
                                                            <a href="/exportpengajuanpdf" class="btn btn-sm btn-danger btn-rounded m-1">
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
                                                  <h4 class="card-title" >Data Pengajuan</h4>
                                                  <form action="/laporan/pngjn" method="GET">
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
                                                                      <select class="form-select form-select-sm rounded"  name="status" id="status">
                                                                           <option value="" >Status</option>
                                                                           <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }} >Diproses</option>
                                                                           <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }} >Disetujui</option>
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
                                             <table id="table-data" class="table table-striped text-center">
                                                  <thead>
                                                       <tr class="text-center">
                                                            <th>No</th>
                                                            <th>ID</th>
                                                            <th>Nama</th>
                                                            <th>Kelas</th>
                                                            <th>Jumlah Saldo</th>
                                                            <th>Jumlah Penarikan</th>
                                                            <th>Alasan</th>
                                                            <th>Status</th>
                                                            <th>Diajukan</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @foreach($pengajuan as $pengajuans)
                                                            <tr>
                                                                 <td>{{$loop->iteration + $pengajuan->firstItem() - 1}}</td>
                                                                 <td>{{$pengajuans->id_tabungan}}</td>
                                                                 <td>{{$pengajuans->nama}}</td>
                                                                 <td>{{$pengajuans->kelas}}</td>
                                                                 <td>{{$pengajuans->jumlah_tabungan}}</td>
                                                                 <td>{{$pengajuans->jumlah_penarikan}}</td>
                                                                 <td>{{$pengajuans->alasan}}</td>
                                                                 <td>{{$pengajuans->status}}</td>
                                                                 <td>{{ \Carbon\Carbon::parse($pengajuans->created_at)->format('H:i, F d y') }}</td>
                                                            </tr>
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                             <!-- Revisi Pagination (Tambahin'vendor.pagination.bootstrap-5') -->
                                             {{ $pengajuan->links('vendor.pagination.bootstrap-5') }}
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
<!-- End Content Main -->

<!-- Script -->
@include('layouts.script')

</body>
</html>