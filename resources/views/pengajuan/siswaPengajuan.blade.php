<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Ajukan Penarikan - SITASU</title>

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
                              <div class="card">
                                   <div class="card-body">
                                        <h4 class="card-title" >Ajukan Penarikan Tabungan</h4>
                                             @if ( $cekData == 0 || $dataStatus == null || $selisihHari >= 1 )
                                             <form method="post" action="{{ route('siswa.ajukan') }}" enctype="multipart/form-data">
                                                  @csrf
                                                  <div class="form-group">
                                                       <label for="nama">Nama</label>
                                                       <input type="text" class="form-control rounded" id="id_tabungan" name="id_tabungan" value="{{ $data->id_tabungan }}" hidden>
                                                       <input type="text" class="form-control rounded" id="nama" name="nama" value="{{ $data->nama }}" readonly>
                                                  </div>
                                                  <div class="form-group">
                                                       <label for="kelas">Kelas</label>
                                                       <input type="text" class="form-control rounded" id="kelas" name="kelas" value="{{ $data->kelas }}" readonly>
                                                  </div>
                                                  <div class="form-group">
                                                       <label for="jumlah_tabungan">Saldo</label>
                                                       <input type="text" class="form-control rounded" id="jumlah_tabungan" name="jumlah_tabungan" value="{{ $data->sisa }}" readonly>
                                                  </div>
                                                  <div class="form-group">
                                                       <label for="alasan">Berikan Alasan</label>
                                                       <input type="text" class="form-control rounded" id="alasan" name="alasan" placeholder="Masukan Alasan">
                                                  </div>
                                                  <div class="form-group">
                                                       <label for="jumlah_tarik">Jumlah Penarikan</label>
                                                       <input type="text" class="form-control rounded" id="jumlah_tarik" name="jumlah_tarik" placeholder="Masukan Nominal">
                                                  </div>
                                                  <div class="form-group">
                                                       <button type="submit" class="btn btn-primary btn-rounded">Ajukan</button>
                                                  </div>
                                             </form>
                                             @endif
                                             @if ( $dataStatus == 'Diproses' && $selisihHari < 1 )
                                             <div class="text-center p-5">
                                                  <p>Pengajuan Penarikan Tabungan</p>
                                                  <h5 style="color: green">Sedang di Tinjau</h5>
                                                  <p>Mohon Menunggu</p>
                                             </div>
                                             @endif
                                             @if ( $dataStatus == 'Disetujui' && $selisihHari < 1 )
                                             <div class="text-center p-5">
                                                  <p>Pengajuan Penarikan Tabungan</p>
                                                  <h5 style="color: green">DISETUJUI</h5>
                                                  <p>Segera Menghadap Ke Petugas Tabungan</p>
                                             </div>
                                             @endif
                                             @if ( $dataStatus == 'Ditolak' && $selisihHari < 1 )
                                             <div class="text-center p-5">
                                                  <p>Pengajuan Penarikan Tabungan</p>
                                                  <h5 style="color: red">DITOLAK</h5>
                                                  <p>Anda Dapat Melakukan Pengajuan 1 Bulan Lagi</p>
                                             </div>
                                             @endif
                                             {{-- @if ( $validasi2 == 'Diproses' )
                                                  <div class="text-center p-5">
                                                       <p>Pengajuan Penarikan Tabungan</p>
                                                       <h5 style="color: red">TIDAK BISA DILAKUKAN</h5>
                                                       <p>Penarikan Tabungan Dapat Dilakukan 1 Bulan Sekali</p>
                                                  </div>
                                             @endif --}}
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