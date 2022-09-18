<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="/dashboard">DERSIK 22</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="/dashboard">DRSK</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dersik Web App</li>
          <li class="{{ Request::is('dashboard')? 'active':'' }}"><a class="nav-link" href="/dashboard"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
          <li class="{{ Request::is('informasi*')? 'active':'' }}"><a class="nav-link" href="/informasi"><i class="fas fa-circle-info"></i> <span>Informasi</span></a></li>
          <li class="menu-header">User Menu</li>
          @if (auth()->user()->role=='admin')
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-table-list"></i> <span>Data menu</span></a>
            <ul class="dropdown-menu">
              <li class="{{ Request::is('dashboard/kelas*')? 'active':'' }}"><a class="nav-link" href="/dashboard/kelas"><i class="fas fa-chalkboard-user"></i> <span>Data Kelas</span></a></li>
              <li class="{{ Request::is('dashboard/angkatan*')? 'active':'' }}"><a class="nav-link" href="/dashboard/angkatan"><i class="fas fa-people-roof"></i> <span>Data Angkatan</span></a></li>
              <li class="{{ Request::is('dashboard/domain*')? 'active':'' }}"><a class="nav-link" href="/dashboard/domain"><i class="fab fa-firefox"></i> <span>List Domain</span></a></li>
              <li class="{{ Request::is('dashboard/korwil*')? 'active':'' }}"><a class="nav-link" href="/dashboard/korwil"><i class="fas fa-person-rays"></i> <span>Data korwil</span></a></li>
            </ul>
          </li>
          @endif
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-check"></i> <span>Pemilihan</span></a>
            <ul class="dropdown-menu">
              <li class="{{ Request::is('vote/*')? 'active':'' }}"><a class="nav-link" href="/vote"><i class="fas fa-square-check"></i> <span>e-Voting</span></a></li>
              <li class="{{ Request::is('dashboard/ketua*')? 'active':'' }}"><a class="nav-link" href="/dashboard/ketua"><i class="fas fa-box-tissue"></i> <span>Calon Ketua</span></a></li>
              @if (auth()->user()->role=='admin')
              <li class="{{ Request::is('dashboard/dataketua*')? 'active':'' }}"><a class="nav-link" href="/dashboard/dataketua"><i class="fas fa-user-tie"></i> <span>Data Ketua</span></a></li>
              <li class="{{ Request::is('voting/*')? 'active':'' }}"><a class="nav-link" href="/voting"><i class="fas fa-check-to-slot"></i> <span>Data Voting</span></a></li>
              <li class="{{ Request::is('pemilih/*')? 'active':'' }}"><a class="nav-link" href="/pemilih"><i class="fas fa-people-group"></i> <span>Daftar Pemilih</span></a></li>
              @endif
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-server"></i> <span>Layanan</span></a>
            <ul class="dropdown-menu">
              <li class="{{ Request::is('dashboard/regis-mail*')? 'active':'' }}"><a class="nav-link" href="/dashboard/regis-mail"><i class="fa-solid fa-at"></i> <span>Regis Email</span></a></li>
              <li class="{{ Request::is('/pendataan*')? 'active':'' }}"><a class="nav-link" href="/pendataan"><i class="fab fa-wpforms"></i> <span>Pendataan</span></a></li>
              @if (auth()->user()->role=='admin')
              <li class="{{ Request::is('/userlist*')? 'active':'' }}"><a class="nav-link" href="/userlist"><i class="fas fa-users"></i> <span>Data User</span></a></li>
              @endif
            </ul>
          </li>
    </aside>
  </div>