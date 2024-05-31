<!DOCTYPE html>
<html lang="en">
     @include('sweetalert::alert')
<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Stor Tabungan - SITASU</title>

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
                    <h4 class="card-title">Stor Tabungan</h4>
                    <hr>
                    {{-- Row 1 --}}
                    <div class="row">
                         <div class="col-lg-3 grid-margin">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="col-sm-12">
                                             <div class="statistics-details d-flex align-items-center justify-content-between">
                                                  <div>
                                                       <p class="statistics-title">Total Saldo Tabungan Saat Ini</p>
                                                       <h4 class="rate-percentage">Rp. {{$totalJumlahTabungan}}</h4>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-3 grid-margin">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="col-sm-12">
                                             <div class="statistics-details d-flex align-items-center justify-content-between">
                                                  <div>
                                                       <p class="statistics-title">Total Keseluruhan Uang Masuk</p>
                                                       <h4 class="rate-percentage">Rp. {{$hitungTotalStor}}</h4>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-2 grid-margin">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="col-sm-12">
                                             <div class="statistics-details d-flex align-items-center justify-content-between">
                                                  <div>
                                                       <p class="statistics-title">Bulan Ini</p>
                                                       <h4 class="rate-percentage">Rp. {{$bulanStor}}</h4>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-2 grid-margin">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="col-sm-12">
                                             <div class="statistics-details d-flex align-items-center justify-content-between">
                                                  <div>
                                                       <p class="statistics-title">Minggu Ini</p>
                                                       <h4 class="rate-percentage">Rp. {{$mingguStor}}</h4>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-2 grid-margin">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="col-sm-12">
                                             <div class="statistics-details d-flex align-items-center justify-content-between">
                                                  <div>
                                                       <p class="statistics-title">Hari Ini</p>
                                                       <h4 class="rate-percentage">Rp. {{$hariStor}}</h4>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="card mb-4">
                         <div class="card-body" style="margin-bottom: -25px ;">
                              <div class="row " >
                                   <form method="post" action="{{ route('tabungan.stor.tambah')}}" enctype="multipart/form-data">
                                        @method ('PATCH')
                                        @csrf
                                        <div class="row justify-content-between" >
                                             <div class="form-group col-md-2" >
                                                  <label for="id">Masukan Kode</label>
                                                  <select name="selectuser" class="form-control" id="selectuser">
                                                       <option selected >Pilih Kode</option>
                                                       @foreach($storTerbaru as $key => $value)
                                                            <option value="{{$value->id_tabungan}}" id="getname"
                                                                 data-id="{{ $value->id }}"
                                                                 data-nama="{{ $value->nama }}"
                                                                 data-kelas="{{ $value->kelas }}"
                                                                 data-tabungan="{{ $value->saldo_akhir }}"
                                                                 data-dibuku="{{ $value->jumlah_dibuku }}">
                                                                 {{$value->id_tabungan}}
                                                            </option>
                                                       @endforeach
                                                  </select>
                                                  <!-- <input type="text" class="form-control rounded"> -->
                                                  {{-- <input type="text" class="form-control rounded searchuser" id="searchuser" name="searchuser" placeholder="Search User"> --}}
                                             </div>
                                             <div class="form-group col-md-3 "style="margin-right: -10px;">
                                                  <label for="nama">Nama Siswa</label>
                                                  <input type="text" class="form-control rounded" id="id" name="id" placeholder="id" hidden>
                                                  <input type="text" class="form-control rounded" id="nama" name="nama" placeholder="Nama" readonly>
                                             </div>
                                             <div class="form-group col-md-2 "style="margin-right: -10px;">
                                                  <label for="kelas">Kelas</label>
                                                  <input type="text" class="form-control rounded" id="kelas" name="kelas" placeholder="Kelas" readonly>
                                             </div>
                                             <div class="form-group col-md-2 ">
                                                  <label for="jumlah_tabungan">Saldo Awal</label>
                                                  <input type="text" class="form-control rounded" id="jumlah_tabungan" name="jumlah_tabungan" placeholder="Tabungan" readonly>
                                             </div>
                                             <div class="form-group col-md-2 ">
                                                  <label for="jumlah_stor">Masukan Jumlah Stor</label>
                                                  <input type="text" class="form-control rounded" id="jumlah_stor" name="jumlah_stor" placeholder="Jumlah Stor">
                                             </div>
                                             <div class="form-group col-md-1 " style="margin-right: 12px">
                                                  <button type="submit" class="btn btn-sm btn-primary m-1 btn-rounded p-3 mt-3">
                                                       Tambah
                                                  </button>
                                             </div>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>

                    <div class="card">
                         <div class="card-body">
                              <div class="col-lg-12 d-flex  justify-content-between">
                                   <h4 class="card-title mt-2">Data Stor Tabungan</h4>
                                   <div class="d-flex justify-content-between">
                                        <form action="/petugas/tabungan/stor-tabungan" method="GET">
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
                              </div>
                              {{-- Row 2 --}}
                              <div class="row m-2 mt-4">
                                   <div class="col-lg-12 grid-margin">
                                        <div class="col-sm-12 statistics-details d-flex align-items-center justify-content-between">
                                             @foreach ($totalStorHariIni as $totalStorHari)
                                             <div class="statistics-details d-flex align-items-center justify-content-between">
                                                  <div>
                                                       <p class="statistics-title">Kelas {{$kelasList[$loop->iteration-1]}}</p>
                                                       <h5 class="rate-percentage">Rp. {{$totalStorHari}}</h5>
                                                  </div>
                                             </div>
                                             @endforeach
                                        </div>
                                   </div>
                              </div>
                              <div class="table-responsive">
                                   <table id="table-data " class="table table-striped text-center">
                                        <thead>
                                             <tr class="text-center">
                                                  <th>No</th>
                                                  <th>ID</th>
                                                  <th>Nama</th>
                                                  <th>Kelas</th>
                                                  <th>Saldo Awal</th>
                                                  <th>Jumlah Stor</th>
                                                  <th>Saldo Akhir</th>
                                                  <th>Dibuat</th>
                                                  <th>Aksi</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             @foreach($storTabel as $stors)
                                                  <tr>
                                                       <td class="text-center">{{$loop->iteration}}</td>
                                                       <td class="text-center">{{$stors->id_tabungan}}</td>
                                                       <td>{{$stors->nama}}</td>
                                                       <td>{{$stors->kelas}}</td>
                                                       <td>{{$stors->saldo_awal}}</td>
                                                       <td>{{$stors->jumlah}}</td>
                                                       <td>{{$stors->saldo_akhir}}</td>
                                                       <td>{{ \Carbon\Carbon::parse($stors->created_at)->format('H:i, F d') }}</td>
                                                       <td class="text-center">
                                                            <button type="button" class="btn btn-warning btn-sm btn-rounded" data-id="{{ $stors->id }}" id="btn-edit-user" data-bs-toggle="modal" data-bs-target="#editModal">
                                                                 Edit
                                                            </button>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Transaksi Stor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form method="post" action="{{ route('stor.ubah')}}" enctype="multipart/form-data">
                         @method ('PATCH')
                         @csrf
                         <div class="row">
                                   <input type="text" class="form-control rounded" id="edit-id" name="id" placeholder="Id" readonly hidden>
                              <div class="form-group col-md-6">
                                   <label for="nama">Nama</label>
                                   <input type="text" class="form-control rounded" id="edit-nama" name="nama" placeholder="Masukan Nama" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="jumlah Stor">Jumlah Stor</label>
                                   <input type="text" class="form-control rounded" id="edit-jumlah_Stor" name="jumlah_Stor" placeholder="Masukan Jumlah Stor">
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
          var selectElement   = document.getElementById('selectuser');
          var inputId         = document.getElementById('id');
          var inputNama       = document.getElementById('nama');
          var inputKelas      = document.getElementById('kelas');
          var inputTabungan   = document.getElementById('jumlah_tabungan');
          var inputDibuku     = document.getElementById('jumlah_dibuku');

          selectElement.addEventListener('change', function() {
               var selectedOption  = selectElement.options[selectElement.selectedIndex];
               var itemID          = selectedOption.getAttribute('data-id');
               var itemNama        = selectedOption.getAttribute('data-nama');
               var itemKelas       = selectedOption.getAttribute('data-kelas');
               var itemTabungan    = selectedOption.getAttribute('data-tabungan');
               var itemDibuku      = selectedOption.getAttribute('data-dibuku');
               inputId.value       = itemID;
               inputNama.value     = itemNama;
               inputKelas.value    = itemKelas;
               inputTabungan.value = itemTabungan;
               inputDibuku.value   = itemDibuku;
          });

          $(function(){
          $(document).on('click','#btn-edit-user', function(){

               let id = $(this).data('id');

               $.ajax({
                    type: "get",
                    url: "{{url('/petugas/ajaxpetugas/dataTransaksi')}}/"+id,
                    dataType: 'json',
                    success: function(res){
                         $('#edit-id').val(res.id);
                         $('#edit-nama').val(res.nama);
                         $('#edit-jumlah_Stor').val(res.jumlah);
                    },
               });
          });
     });

     </script>

</body>
</html>
