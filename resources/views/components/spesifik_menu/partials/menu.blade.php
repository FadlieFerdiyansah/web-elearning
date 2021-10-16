<li class="dropdown{{ request()->routeIs($nameRoute) ? ' active' : '' }}">
    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="{{ $icon }}"></i><span>{{ $parentName }}</span></a>
    <ul class="dropdown-menu">
        @for ($i = 0; $i < $countChild; $i++)
        <li {{ request()->routeIs($nameRoute[$i]) ? 'class=active' : '' }}><a class="nav-link"
            href="{{ route($nameRoute[$i]) }}">{{ $childName[$i] }}</a></li>
        @endfor
    </ul>
  </li>