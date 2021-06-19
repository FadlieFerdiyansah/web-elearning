{{-- {{ dd(auth()->user()) }} --}}

<nav class="navbar navbar-expand-lg main-navbar sticky">
  <div class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
                                collapse-btn"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="feather feather-align-justify">
            <line x1="21" y1="10" x2="3" y2="10"></line>
            <line x1="21" y1="6" x2="3" y2="6"></line>
            <line x1="21" y1="14" x2="3" y2="14"></line>
            <line x1="21" y1="18" x2="3" y2="18"></line>
          </svg></a></li>
      <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-maximize">
            <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3">
            </path>
          </svg>
        </a></li>
      <li>
        <form class="form-inline mr-auto">
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200"
              style="width: 200px;">
            <button class="btn" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </form>
      </li>
    </ul>
  </div>

    <p>{{ Auth::user()->nama }}</p>
    
  <ul class="navbar-nav navbar-right">
    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
        class="nav-link nav-link-lg message-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" class="feather feather-mail">
          <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
          <polyline points="22,6 12,13 2,6"></polyline>
        </svg>
        <span class="badge headerBadge1">
          6 </span> </a>
      <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
        <div class="dropdown-header">
          Messages
          <div class="float-right">
            <a href="#">Mark All As Read</a>
          </div>
        </div>
        <div class="dropdown-list-content dropdown-list-message">
          <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar
                                        text-white"> <img alt="image" src="assets/img/users/user-1.png"
                class="rounded-circle">
            </span> <span class="dropdown-item-desc"> <span class="message-user">John
                Deo</span>
              <span class="time messege-text">Please check your mail !!</span>
              <span class="time">2 Min Ago</span>
            </span>
          </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
              <img alt="image" src="assets/img/users/user-2.png" class="rounded-circle">
            </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                Smith</span> <span class="time messege-text">Request for leave
                application</span>
              <span class="time">5 Min Ago</span>
            </span>
          </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
              <img alt="image" src="assets/img/users/user-5.png" class="rounded-circle">
            </span> <span class="dropdown-item-desc"> <span class="message-user">Jacob
                Ryan</span> <span class="time messege-text">Your payment invoice is
                generated.</span> <span class="time">12 Min Ago</span>
            </span>
          </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
              <img alt="image" src="assets/img/users/user-4.png" class="rounded-circle">
            </span> <span class="dropdown-item-desc"> <span class="message-user">Lina
                Smith</span> <span class="time messege-text">hii John, I have upload
                doc
                related to task.</span> <span class="time">30
                Min Ago</span>
            </span>
          </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
              <img alt="image" src="assets/img/users/user-3.png" class="rounded-circle">
            </span> <span class="dropdown-item-desc"> <span class="message-user">Jalpa
                Joshi</span> <span class="time messege-text">Please do as specify.
                Let me
                know if you have any query.</span> <span class="time">1
                Days Ago</span>
            </span>
          </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
              <img alt="image" src="assets/img/users/user-2.png" class="rounded-circle">
            </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                Smith</span> <span class="time messege-text">Client Requirements</span>
              <span class="time">2 Days Ago</span>
            </span>
          </a>
        </div>
        <div class="dropdown-footer text-center">
          <a href="#">View All <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
    </li>
    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
        class="nav-link notification-toggle nav-link-lg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" class="feather feather-bell bell">
          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
          <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>
      </a>
      <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
        <div class="dropdown-header">
          Notifications
          <div class="float-right">
            <a href="#">Mark All As Read</a>
          </div>
        </div>
        <div class="dropdown-list-content dropdown-list-icons">
          <a href="#" class="dropdown-item dropdown-item-unread"> <span
              class="dropdown-item-icon bg-primary text-white"> <i class="fas
                                            fa-code"></i>
            </span> <span class="dropdown-item-desc"> Template update is
              available now! <span class="time">2 Min
                Ago</span>
            </span>
          </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="far
                                            fa-user"></i>
            </span> <span class="dropdown-item-desc"> <b>You</b> and <b>Dedik
                Sugiharto</b> are now friends <span class="time">10 Hours
                Ago</span>
            </span>
          </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-success text-white"> <i class="fas
                                            fa-check"></i>
            </span> <span class="dropdown-item-desc"> <b>Kusnaedi</b> has
              moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12
                Hours
                Ago</span>
            </span>
          </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-danger text-white"> <i
                class="fas fa-exclamation-triangle"></i>
            </span> <span class="dropdown-item-desc"> Low disk space. Let's
              clean it! <span class="time">17 Hours Ago</span>
            </span>
          </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="fas
                                            fa-bell"></i>
            </span> <span class="dropdown-item-desc"> Welcome to Otika
              template! <span class="time">Yesterday</span>
            </span>
          </a>
        </div>
        <div class="dropdown-footer text-center">
          <a href="#">View All <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
    </li>
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="assets/img/user.png" class="user-img-radious-style"> <span
          class="d-sm-none d-lg-inline-block"></span></a>
      <div class="dropdown-menu dropdown-menu-right pullDown">
        <div class="dropdown-title">Hello Sarah Smith</div>
        <a href="profile.html" class="dropdown-item has-icon"> <i class="far
                                    fa-user"></i> Profile
        </a> <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
          Activities
        </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
          Settings
        </a>
        <div class="dropdown-divider"></div>
        <a href="auth-login.html" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>