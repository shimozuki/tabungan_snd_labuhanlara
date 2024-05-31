<html>
<head>
     <title> Laporan Tabungan Siswa </title>
     <style>
            * {
            box-sizing: border-box;
            }
            body {
            font-size: 14px;
            }
            .headee{
            width: auto;
            text-align:center;
            height: 92px;
            background: rgba(255,255,255,1);
            opacity: 1;
            position: relative;
            }
            .foo{
            width: auto;
            text-align:right;
            background: rgba(255,255,255,1);
            opacity: 1;
            position: relative;
            }
            .v1_3 {
               text-align:center;
            width: auto;
            color: rgba(0,0,0,1);
            position: absolute;
            top: 15px;
            left: 212px;
            font-family: Times New Roman;
            font-weight: Bold;
            font-size: 13px;
            opacity: 1;
            text-align: left;
            }
            .v1_4 {
               width: auto;
               text-align:center;
            color: rgba(0,0,0,1);
            position: absolute;
            top: 31px;
            left: 290px;
            font-family: Times New Roman;
            font-weight: Bold;
            font-size: 13px;
            opacity: 1;
            text-align: left;
            }
            .v1_5 {
            width: auto;
            text-align:center;
            color: rgba(0,0,0,1);
            position: absolute;
            top: 47px;
            left: 177px;
            font-family: Times New Roman;
            font-weight: Bold;
            font-size: 19px;
            opacity: 1;
            text-align: left;
            }
            .v1_6 {
            width: auto;
            text-align:center;
            color: rgba(0,0,0,1);
            position: absolute;
            top: 70px;
            left: 260px;
            font-family: Times New Roman;
            font-weight: Bold;
            font-size: 13px;
            opacity: 1;
            text-align: left;
            }
            .name {
            color: #fff;
            }
            .v6_2 {
            width: 132px;
            color: rgba(0,0,0,1);
            
            font-family: Inter;
            font-weight: Regular;
            font-size: 13px;
            opacity: 1;
            text-align: left;
            margin-top:20px;
            }
            .v6_3 {
            width: 94px;
            color: rgba(0,0,0,1);
            padding-right: 15px;
            font-family: Inter;
            font-weight: Regular;
            font-size: 13px;
            opacity: 1;
            text-align: left;
            margin-top:10px;
            }
            .v6_4 {
            opacity: 1;
            text-align: left;
            width: auto;
            color: rgba(0,0,0,1);
            
            font-size: 13px;
            opacity: 1;
            text-align: left;
            margin-top:30px;
            }
            .table{
                margin-top: 10px;
            }
            h4 {
                margin-top: 120px;
                margin-bottom: 10px;
                font-family: Times New Roman;
            font-weight: Bold;
            }

            #user {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
          }

          #user td, #user th {
          border: 1px solid #ddd;
          padding: 8px;
          font-size: 12px;
          }

          #user tr:nth-child(even){background-color: #f2f2f2;}

          #user tr:hover {background-color: #ddd;}

          #user th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #688889;
          color: white;
          }
        </style>
</head>
<body>
<div class="headee">
            <span class="v1_3">DINAS PENDIDIKAN PEMUDA DAN OLAHRAGA</span>
            <span class="v1_4">KABUPATEN CIANJUR</span>
            <span class="v1_5">SEKOLAH DASAR NEGERI SUKARAME</span>
            <span class="v1_6">KECAMATAN SUKANAGARA</span>
        </div>
        <hr>
     <h3>Data Tabungan Siswa</h3>

     <table id="user">
          <thead>
               <tr class="text-center">
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Saldo Akhir</th>
                    <th>Biaya</th>
                    <th>Sisa</th>
                    <th>Terakhir Menabung</th>
               </tr>
          </thead>
          <tbody>
               @foreach($tabungan as $tabungans)
                    <tr>
                         <td>{{$loop->iteration}}</td>
                         <td>{{$tabungans->id_tabungan}}</td>
                         <td>{{$tabungans->nama}}</td>
                         <td>{{$tabungans->kelas}}</td>
                         <td>{{$tabungans->saldo_akhir}}</td>
                         <td>{{$tabungans->premi}}</td>
                         <td>{{$tabungans->sisa}}</td>
                         <td>{{ \Carbon\Carbon::parse($tabungans->created_at)->format('H:i, F d y') }}</td>
                    </tr>
               @endforeach
          </tbody>
     </table>
     <div class="foo">
          <br>
         <span class="v6_2">Cianjur, {{ \Carbon\Carbon::now()->format('d F Y') }}</span><br>
         <span class="v6_3">Kepala Sekolah</span><br><br><br><br><br><br>
         <span class="v6_4">HERI MULYAWAN</span><br>
        </div>
    </body>
</body>
</html>