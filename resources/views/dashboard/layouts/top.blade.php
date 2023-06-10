<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      @if(auth()->user()->profile_photo_path==NULL)
        <img alt="image" src="/owl.png" class=" mr-1">
      @else
        <img alt="image" src="{{ asset('storage/'.auth()->user()->profile_photo_path) }}" class="mr-2 avatar" style="height: 2rem; width:2rem;">
      @endif
      <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->username }}</div></a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title">User Menu</div>
        <a href="{{ route('profile.show') }}" class="dropdown-item has-icon">
          <i class="far fa-user"></i>  {{ __('Profile') }}
        </a>
        <div class="dropdown-divider"></div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); this.closest('form').submit();">
              <i class="fas fa-sign-out-alt"></i>Log Out
            </a>
      </form>
      </div>
    </li>
  </ul>
</nav>