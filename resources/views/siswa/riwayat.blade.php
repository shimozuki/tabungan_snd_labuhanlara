<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Riwayat Tabungan - SITASU</title>

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
                                        <h4 class="card-title" >Identitas Siswa</h4>
                                        <div class="table-responsive">
                                                  <table id="table-data" class="table table-striped">
                                                  <tr>
                                                       <td>ID Tabungan</td>
                                                       <td>{{Auth::user()->id_tabungan}}</td>
                                                  </tr>
                                                  <tr>
                                                       <td>Nama</td>
                                                       <td>{{Auth::user()->nama}}</td>
                                                  </tr>
                                                  <tr>
                                                       <td>Kelas</td>
                                                       <td>{{Auth::user()->kelas}}</td>
                                                  </tr>
                                                  <tr>
                                                       <td>Nomer Kontak</td>
                                                       <td>{{Auth::user()->kontak}}</td>
                                                  </tr>
                                                  <tr>
                                                       <td>Nama Orang Tua</td>
                                                       <td>{{Auth::user()->orang_tua}}</td>
                                                  </tr>
                                                  <tr>
                                                       <td>Alamat</td>
                                                       <td>{{Auth::user()->alamat}}</td>
                                                  </tr>
                                                  <tr>
                                                       <td>Saldo</td>
                                                       <td>Rp. {{$data->sisa}}</td>
                                                  </tr>
                                             </table>
                                        </div>
                                        <br><br>
                                        <h4 class="card-title" >Riwayat Transaksi</h4>
                                        <div class="table-responsive">
                                             <table id="table-data" class="table table-striped text-center">
                                                  <thead>
                                                       <tr class="text-center">
                                                            <th>No</th>
                                                            <th>Stor</th>
                                                            <th>Tarik</th>
                                                            <th>Sisa</th>
                                                            <th>Dibuat</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @php $no=1; @endphp
                                                            @foreach($tabel as $tabel)
                                                                 @if ($tabel->tipe_transaksi)
                                                                 <tr>
                                                                      <td class="text-center">{{$no++}}</td>
                                                                      @if ($tabel->tipe_transaksi == 'Stor')
                                                                           <td>{{$tabel->jumlah}}</td>
                                                                           <td>-</td>
                                                                      @endif
                                                                      @if ($tabel->tipe_transaksi == 'Tarik')
                                                                           <td>-</td>
                                                                           <td>{{$tabel->jumlah}}</td>
                                                                      @endif
                                                                      <td>{{$tabel->sisa}}</td>
                                                                      <td>{{ \Carbon\Carbon::parse($tabel->created_at)->format('d F y') }}</td>
                                                                 </tr>
                                                                 @endif
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

<!-- Script -->
@include('layouts.script')

</body>
</html>