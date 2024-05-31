<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Pengajuan Penarikan - SITASU</title>

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
                                             <div class="d-flex justify-content-between">
                                                  <h4 class="card-title" >Data Pengajuan</h4>
                                                  <form action="/petugas/pengajuan" method="GET">
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
                                             <div class="table-responsive">
                                                  <table id="table-data " class="table table-striped text-center">
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
                                                                 <th>Opsi</th>
                                                            </tr>
                                                       </thead>
                                                       <tbody>
                                                            @php $no=1; @endphp
                                                            @foreach($pengajuan as $pengajuans)
                                                                 @if ($pengajuans->status == 'Diproses')
                                                                 <tr>
                                                                      <td class="text-center">{{$no++}}</td>
                                                                      <td class="text-center">{{$pengajuans->id_tabungan}}</td>
                                                                      <td>{{$pengajuans->nama}}</td>
                                                                      <td>{{$pengajuans->kelas}}</td>
                                                                      <td>{{$pengajuans->jumlah_tabungan}}</td>
                                                                      <td>{{$pengajuans->jumlah_penarikan}}</td>
                                                                      <td>{{$pengajuans->alasan}}</td>
                                                                      <td>{{$pengajuans->status}}</td>
                                                                      <td>{{ \Carbon\Carbon::parse($pengajuans->created_at)->format('H:i, F d') }}</td>
                                                                      <td class="text-center">
                                                                           <button type="button" class="btn btn-primary btn-sm btn-rounded" data-id="{{ $pengajuans->id }}" id="btn-edit-user" data-bs-toggle="modal" data-bs-target="#editModal">
                                                                                Lihat
                                                                           </button>
                                                                           <a href="/petugas/pengajuan/tolak/{{ $pengajuans->id }}" class="btn btn-warning btn-sm btn-rounded" type="button" class="btn btn-secondary btn-rounded">Tolak</a>
                                                                      </td>
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
<!-- End Content Main -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Lihat Data Pengajuan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form method="post" action="{{ route('pengajuan.setuju')}}" enctype="multipart/form-data">
                         @csrf
                         <div class="row">
                                   <input type="text" class="form-control rounded" id="edit-id" name="id" placeholder="Id" readonly hidden>
                                   <input type="text" class="form-control rounded" id="edit-id_tabungan" name="id_tabungan" placeholder="Id_tabungan" readonly hidden>
                              <div class="form-group col-md-8">
                                   <label for="nama">Nama</label>
                                   <input type="text" class="form-control rounded" id="edit-nama" name="nama" placeholder="Nama" readonly>
                              </div>
                              <div class="form-group col-md-4">
                                   <label for="kelas">Kelas</label>
                                   <input type="text" class="form-control rounded" id="edit-kelas" name="kelas" placeholder="Kelas" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="jumlah_tabungan">Jumlah Saldo</label>
                                   <input type="text" class="form-control rounded" id="edit-jumlah_tabungan" name="jumlah_tabungan" placeholder="Jumlah Tabungan" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="jumlah_penarikan">Jumlah Penarikan</label>
                                   <input type="text" class="form-control rounded" id="edit-jumlah_penarikan" name="jumlah_penarikan" placeholder="Jumlah Tarik" readonly>
                              </div>
                              <div class="form-group">
                                   <label for="alasan">Alasan</label>
                                   <input type="text" class="form-control rounded" id="edit-alasan" name="alasan" placeholder="Alasan" readonly>
                              </div>
                         </div>
                         <div class="modal-footer justify-content-center">
                              <button type="submit" class="btn btn-primary btn-rounded">Setujui</button>
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
                    url: "{{url('/petugas/ajaxpetugas/dataPengajuan')}}/"+id,
                    dataType: 'json',
                    success: function(res){
                         $('#edit-id').val(res.id);
                         $('#edit-id_tabungan').val(res.id_tabungan);
                         $('#edit-nama').val(res.nama);
                         $('#edit-kelas').val(res.kelas);
                         $('#edit-jumlah_tabungan').val(res.jumlah_tabungan);
                         $('#edit-jumlah_penarikan').val(res.jumlah_penarikan);
                         $('#edit-alasan').val(res.alasan);
                    },
               });
          });
     });
</script>
</body>
</html>