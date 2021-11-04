<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="index.html"> <img alt="image" src="/assets/images/logo/logo-elearning.png" class="header-logo" />
				{{-- <span class="logo-name">{{ Auth::user()->nama }}</span> --}}
				Learner
			</a>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-header">main</li>

			@auth('admin')
				<li class="dropdown{{ request()->routeIs('dashboard.admin') ? ' active' : '' }}">
					<a href="{{ route('dashboard.admin') }}" class="nav-link"><i
							data-feather="monitor"></i><span>Dashboard Admin</span></a>
				</li>
			@elseauth('dosen')
			<li class="dropdown{{ request()->routeIs('dashboard.dosen') ? ' active' : '' }}">
				<a href="{{ route('dashboard.dosen') }}" class="nav-link"><i
						data-feather="monitor"></i><span>Dashboard Dosen</span></a>
			</li>
			@elseauth('mahasiswa')
			<li class="dropdown{{ request()->routeIs('dashboard.mahasiswa') ? ' active' : '' }}">
				<a href="{{ route('dashboard.mahasiswa') }}" class="nav-link"><i
						data-feather="monitor"></i><span>Dashboard Mahasiswa</span></a>
			</li>
			@endauth

			@if (Auth::guard('mahasiswa')->check())
				<x-spesifik_menu.mahasiswa></x-spesifik_menu.mahasiswa>
			@elseif(Auth::guard('dosen')->check())
				<li class="menu-header">Manajemen</li>
				<x-spesifik_menu.dosen></x-spesifik_menu.dosen>
			@else
				<li class="menu-header">Manajemen</li>
				<x-spesifik_menu.admin></x-spesifik_menu.admin>
			@endif

			

			{{-- <li class="dropdown">
            <form action="{{ route('logout') }}" method="POST">
			@csrf
			<a href="{{ route('logout') }}" class="nav-link"><i data-feather="log-out"></i><span>Logout</span></a>
			</form>
			</li> --}}
			<li class="menu-header">User: {{ Auth::user()->nama }}</li>
			<li class="menu-header">Action</li>

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