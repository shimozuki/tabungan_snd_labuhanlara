<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Laporan Transaksi</title>

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
                                                       <h4 class="card-title" >Laporan Transaksi</h4>
                                                       <div>
                                                            <!-- <a href="/exporttransaksiexcel" class="btn btn-sm btn-success btn-rounded m-1">
                                                                 Export Excel
                                                            </a> -->
                                                            <a href="/exporttransaksipdf" class="btn btn-sm btn-danger btn-rounded m-1">
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
                                                  <h4 class="card-title" >Data Transaksi</h4>
                                                  <form action="/laporan/transaksi" method="GET">
                                                       <!-- @csrf -->
                                                       <div class="search d-flex">
                                                            <div class="d-blox justify-content-center m-1">
                                                                 <label for="nama" class="statistics-title mt-1">Filter</label>
                                                            </div>
                                                            <div class="d-blox justify-content-center m-1">
                                                                 <div class="form-group">
                                                                      <input type="text" class="form-control rounded" name="id_tabungan" id="id_tabungan" value="{{ request('id_tabungan') }}" placeholder="ID Tabungan">
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
                                                                 <div class="form-group">
                                                                      <select class="form-select form-select-sm rounded"  name="tipe_transaksi" id="tipe_transaksi">
                                                                           <option value="" >Tipe Transaksi</option>
                                                                           <option value="Stor" {{ request('tipe_transaksi') == 'Stor' ? 'selected' : '' }} >Stor</option>
                                                                           <option value="Tarik" {{ request('tipe_transaksi') == 'Tarik' ? 'selected' : '' }} >Tarik</option>
                                                                      </select>
                                                                 </div>
                                                            </div>
                                                            <div class="d-blox justify-content-center m-1">
                                                                 <label for="" class="statistics-title mt-1">Dari</label>
                                                            </div>
                                                            <div class="d-blox justify-content-center m-1">
                                                                 <div class="form-group">
                                                                      <input type="date" class="form-control rounded" name="awal_tanggal" id="awal_tanggal" value="{{ request('awal_tanggal') }}" placeholder="Tanggal">
                                                                 </div>
                                                            </div>
                                                            <div class="d-blox justify-content-center m-1">
                                                                 <label for="" class="statistics-title mt-1">s/d</label>
                                                            </div>
                                                            <div class="d-blox justify-content-center m-1">
                                                                 <div class="form-group">
                                                                      <input type="date" class="form-control rounded" name="akhir_tanggal" id="akhir_tanggal" value="{{ request('akhir_tanggal') }}" placeholder="Tanggal">
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
                                                            <th>Saldo Awal</th>
                                                            <th>Saldo Akhir</th>
                                                            <th>Stor</th>
                                                            <th>Tarik</th>
                                                            <th>Biaya</th>
                                                            <th>Sisa</th>
                                                            <th>Dibuat</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @foreach($tabungan as $tabungans)
                                                            <tr>
                                                                 <!-- Revisi Pagination (Tambahin '+ $tabungan->firstItem() - 1') -->
                                                                 <td>{{$loop->iteration + $tabungan->firstItem() - 1}}</td>
                                                                 <td>{{$tabungans->id_tabungan}}</td>
                                                                 <td>{{$tabungans->nama}}</td>
                                                                 <td>{{$tabungans->kelas}}</td>
                                                                 <td>{{$tabungans->saldo_awal}}</td>
                                                                 <td>{{$tabungans->saldo_akhir}}</td>
                                                                 @if ($tabungans->tipe_transaksi == null)
                                                                      <td>-</td>
                                                                      <td>-</td>
                                                                 @endif
                                                                 @if ($tabungans->tipe_transaksi == 'Stor')
                                                                      <td>{{$tabungans->jumlah}}</td>
                                                                      <td>-</td>
                                                                 @endif
                                                                 @if ($tabungans->tipe_transaksi == 'Tarik')
                                                                      <td>-</td>
                                                                      <td>{{$tabungans->jumlah}}</td>
                                                                 @endif
                                                                 <td>{{$tabungans->premi}}</td>
                                                                 <td>{{$tabungans->sisa}}</td>
                                                                 <td>{{ \Carbon\Carbon::parse($tabungans->created_at)->format('H:i, F d y') }}</td>
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
<!-- End Content Main -->

<!-- Script -->
@include('layouts.script')

</body>
</html>