<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
          <a class="nav-link" href="{{ route('admin')}}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Beranda</span>
      </a>
    </li>
    @if (Auth::user()->roles_id === 1 || Auth::user()->roles_id === 2)
        <li class="nav-item nav-category">Pengelolaan Tabungan</li>
    @endif
    @if (Auth::user()->roles_id === 3)
        <li class="nav-item nav-category">Tabungan</li>
    @endif
    @if (Auth::user()->roles_id === 2)
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#transaksi" aria-expanded="false" aria-controls="transaksi">
        <i class="menu-icon mdi mdi-cash-register"></i>
        <span class="menu-title">Transaksi</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="transaksi">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{route('tabungan.stor')}}">Stor Tabungan</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{route('tabungan.tarik')}}">Tarik Tabungan</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('pengajuan')}}">
        <i class="menu-icon mdi mdi-cash-refund"></i>
        <span class="menu-title">Pengajuan</span>
      </a>
    </li>
    @endif
    @if (Auth::user()->roles_id === 3)
    <li class="nav-item">
      <a class="nav-link" href="{{route('siswa.riwayat')}}">
        <i class="menu-icon mdi mdi-cash"></i>
        <span class="menu-title">Tabungan</span>
      </a>
    </li>
    @endif
    @if (Auth::user()->roles_id === 3)
    <li class="nav-item">
      <a class="nav-link" href="{{route('siswa.pengajuan')}}">
        <i class="menu-icon mdi mdi-cash-refund"></i>
        <span class="menu-title">Tarik Uang</span>
      </a>
    </li>
    @endif
    @if (Auth::user()->roles_id === 1)
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="laporan">
            <i class="menu-icon mdi mdi-file-document"></i>
            <span class="menu-title">Laporan</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="laporan">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item "> <a class="nav-link" href="{{ route('laporan.tabungan') }}">Tabungan</a></li>
              <li class="nav-item "> <a class="nav-link" href="{{ route('laporan.transaksi') }}">Transaksi</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('laporan.pengajuan') }}">Pengajuan</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('laporan.siswa') }}">Siswa</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('laporan.petugas') }}">Wali Kelas</a></li>
            </ul>`
          </div>
        </li>
    @endif
    @if (Auth::user()->roles_id === 1 || Auth::user()->roles_id === 2)
        <li class="nav-item nav-category">Pengelolaan Pengguna</li>
    @endif
    @if (Auth::user()->roles_id === 2)
    <li class="nav-item">
      <a class="nav-link" href="{{route('siswa')}}">
        <i class="menu-icon mdi mdi-account-group"></i>
        <span class="menu-title">Data Siswa</span>
      </a>
    </li>
    @endif
    @if (Auth::user()->roles_id === 1)
    <li class="nav-item">
      <a class="nav-link" href="{{route('petugas')}}">
        <i class="menu-icon mdi mdi-account-tie"></i>
        <span class="menu-title">Data Wali Kelas</span>
      </a>
    </li>
    @endif
    <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span class="menu-title">Logout</span>
      </a>
    </li>
  </ul>
</nav>