<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html"> <img alt="image" src="/assets/images/logo/logo-elearning.png" class="header-logo" /> <span
            class="logo-name">{{ Auth::user()->nama }}</span>
        </a>
      </div>
      <small class="ml-3">Role : {{ implode(', ', Auth::user()->getRoleNames()->toArray()) }}</small>
      <ul class="sidebar-menu">
        <li class="menu-header">Menu</li>
        <li class="dropdown{{ request()->routeIs('dashboard') ? ' active' : '' }}">
          <a href="{{ route('dashboard') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
        {{-- <li class="dropdown">
            <a href="index.html" class="nav-link"><i data-feather="user"></i><span>Profile</span></a>
        </li> --}}

        @canany(['jadwal kuliahd','jadwal kuliahm'])
          <li class="dropdown{{ request()->routeIs(['jadwalKuliah','jadwalPengganti']) ? ' active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="calendar"></i><span>Jadwal</span></a>
              <ul class="dropdown-menu">
                  <li {{ request()->routeIs('jadwalKuliah') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('jadwalKuliah') }}">Jadwal Kuliah</a></li>
                <li {{ request()->routeIs('jadwalPengganti') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('jadwalPengganti') }}">Jadwal Pengganti</a></li>
              </ul>
          </li>
        @endcanany

          @can('management nilai')          
              <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="clipboard"></i><span>Management Nilai</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="icon-material.html">Dosen</a></li>
                  <li><a class="nav-link" href="icon-font-awesome.html">Mahasiswa</a></li>
                </ul>
              </li>
          @endcan

          @can('management materi')          
              <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="clipboard"></i><span>Management Materi</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('materi.upload') }}">Materi</a></li>
                  {{-- <li><a class="nav-link" href="icon-font-awesome.html">Mahasiswa</a></li> --}}
                </ul>
              </li>
          @endcan

          @can('management roles and permissions')            
            <li class="dropdown{{ request()->routeIs(['']) ? ' active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shield-off"></i><span>Role & Permission</span></a>
              <ul class="dropdown-menu">
                  <li><a class="nav-link" href="icon-material.html">Role</a></li>
                <li><a class="nav-link" href="icon-font-awesome.html">Permission</a></li>
              </ul>
            </li>
          @endcan

          @can('management users')
            <li class="dropdown{{ request()->routeIs(['dosen.table','mahasiswa.table']) ? ' active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Management Users</span></a>
              <ul class="dropdown-menu">
                  <li {{ request()->routeIs('dosen.table') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('dosen.table') }}">Dosen</a></li>
                  <li {{ request()->routeIs('mahasiswa.table') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('mahasiswa.table') }}">Mahasiswa</a></li>
              </ul>
            </li>
          @endcan

          @can('management users')
            <li class="dropdown{{ request()->routeIs(['jadwals.create','matkuls.create','kelas.create','fakultas.create','mahasiswa.create','dosen.create']) ? ' active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Form Control</span></a>
              <ul class="dropdown-menu">
                <li {{ request()->routeIs('jadwals.create') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('jadwals.create') }}">Buat Jadwal</a></li>
                <li {{ request()->routeIs('matkuls.create') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('matkuls.create') }}">Buat Matakuliah</a></li>
                <li {{ request()->routeIs('kelas.create') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('kelas.create') }}">Buat Kelas</a></li>
                <li {{ request()->routeIs('fakultas.create') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('fakultas.create') }}">Buat Fakultas</a></li>
                <li {{ request()->routeIs('mahasiswa.create') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('mahasiswa.create') }}">Buat Mahasiswa</a></li>
                <li {{ request()->routeIs('dosen.create') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('dosen.create') }}">Buat Dosen</a></li>
              </ul>
            </li>
          @endcan

          @can('management datatable')
            <li class="dropdown{{ request()->routeIs(['jadwals.table','matkuls.table','kelas.table','fakultas.table']) ? ' active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="grid"></i><span>Data Table</span></a>
              <ul class="dropdown-menu">
                <li {{ request()->routeIs('matkuls.table') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('matkuls.table') }}">Matakuliah</a></li>
                <li {{ request()->routeIs('kelas.table') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('kelas.table') }}">Kelas</a></li>
                <li {{ request()->routeIs('fakultas.table') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('fakultas.index') }}">Fakultas</a></li>
                <li {{ request()->routeIs('jadwals.table') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('jadwals.table') }}">Jadwal</a></li>
                {{-- <li><a class="nav-link" href="{{ route('mahasiswa.table') }}">Mahasiswa</a></li>
                <li><a class="nav-link" href="{{ route('dosen.table') }}">Dosen</a></li> --}}
              </ul>
            </li>
          @endcan

        {{-- <li class="dropdown">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <a href="{{ route('logout') }}" class="nav-link"><i data-feather="log-out"></i><span>Logout</span></a>
            </form>
        </li> --}}
        <li class="dropdown">
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                             <i data-feather="log-out"></i>
            <span>Logout</span>
          </a>
  
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>

      </ul>
    </aside>
  </div>