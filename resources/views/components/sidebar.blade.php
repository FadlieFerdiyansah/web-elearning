<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="index.html"> <img alt="image" src="/assets/images/logo/logo-elearning.png" class="header-logo" />
				<span class="logo-name">{{ Auth::user()->nama }}</span>
			</a>
		</div>
		<small class="ml-3">Role : {{ implode(', ', Auth::user()->getRoleNames()->toArray()) }}</small>
		@if (Auth::guard('mahasiswa')->user())
		<small><b>Kelas</b> : {{ Auth::user()->kelas->kd_kelas }} &raquo; <b>Id</b> :
			{{ Auth::user()->kelas->id }}</small>
		@endif
		<ul class="sidebar-menu">
			<li class="menu-header">Menu</li>

			<li class="dropdown{{ request()->routeIs('dashboard') ? ' active' : '' }}">
				<a href="{{ route('dashboard') }}" class="nav-link"><i
						data-feather="monitor"></i><span>Dashboard</span></a>
			</li>

			@canany(['jadwal kuliahd','jadwal kuliahm'])
			@include('components._partials.menu',[
			'parentName' => 'Jadwal',
			'nameRoute' => ['jadwalKuliah','jadwalPengganti'],
			'countChild' => 2,
			'childName' => ['Jadwal Kuliah','Jadwal Pengganti'],
			])
			@endcanany

			@can('management nilai')
			<li class="dropdown">
				<a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="clipboard"></i><span>Management
						Nilai</span></a>
				<ul class="dropdown-menu">
					<li><a class="nav-link" href="icon-material.html">Dosen</a></li>
					<li><a class="nav-link" href="icon-font-awesome.html">Mahasiswa</a></li>
				</ul>
			</li>
			@endcan

			@can('management materi')
			@include('components._partials.menu',[
			'parentName' => 'Management Materi',
			'nameRoute' => ['materi.upload','materi.table'],
			'countChild' => 2,
			'childName' => ['Upload Materi','Tabel Materi'],
			])
			@endcan

			@can('management absensi')
			@include('components._partials.menu',[
			'parentName' => 'Management Absensi',
			'nameRoute' => ['absensi.table','absensi.kelas'],
			'countChild' => 2,
			'childName' => ['Absen','Kelas'],
			])
			@endcan

			@can('management roles and permissions')
			<li class="dropdown{{ request()->routeIs(['']) ? ' active' : '' }}">
				<a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shield-off"></i><span>Role &
						Permission</span></a>
				<ul class="dropdown-menu">
					<li><a class="nav-link" href="icon-material.html">Role</a></li>
					<li><a class="nav-link" href="icon-font-awesome.html">Permission</a></li>
				</ul>
			</li>
			@endcan


			@can('management users')
			<li class="dropdown{{ request()->routeIs(['dosen.table','mahasiswa.table']) ? ' active' : '' }}">
				<a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Management
						Users</span></a>
				<ul class="dropdown-menu">
					<li {{ request()->routeIs('dosen.table') ? 'class=active' : '' }}><a class="nav-link"
							href="{{ route('dosen.table') }}">Dosen</a></li>
					<li {{ request()->routeIs('mahasiswa.table') ? 'class=active' : '' }}><a class="nav-link"
							href="{{ route('mahasiswa.table') }}">Mahasiswa</a></li>
				</ul>
			</li>
			@endcan

			@can('management users')
			@include('components._partials.menu',[
			'parentName' => 'Form Control',
			'nameRoute' =>
			['jadwals.create','matkuls.create','kelas.create','fakultas.create','mahasiswa.create','dosen.create'],
			'countChild' => 6,
			'childName' => [ 'Buat Jadwal', 'Buat Matakuliah', 'Buat Kelas', 'Buat Fakultas', 'Buat Mahasiswa', 'Buat
			Dosen', ],
			])
			@endcan

			@can('management datatable')
			@include('components._partials.menu',[
			'parentName' => 'Data Table',
			'nameRoute' => ['matkuls.table','kelas.table','fakultas.table','jadwals.table'],
			'countChild' => 4,
			'childName' => [ 'Matakuliah', 'Kelas', 'Fakultas', 'Jadwal' ],
			])
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