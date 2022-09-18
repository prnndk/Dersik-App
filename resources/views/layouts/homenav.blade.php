<div class="row">
  <div class="col-12 col-md-10 offset-md-1 col-lg-10 offset-lg-1">
    <div class="login-brand">WEBSITE DERSIK SMASA 22</div>
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link {{Request::is('/')? 'active':''}}" href="/"><i class="fas fa-home"></i> Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{Request::is('korwil')? 'active':''}}" href="/korwil"><i class="fas fa-user"></i> Data Korwil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-cog"></i> List Alumni</a>
      </li>
      @if (Route::has('login'))
        @auth
          <div class="nav-item ms-auto">
          <a href="{{ route('dashboard') }}" class="nav-link active"><i class="fas fa-user"></i> Hello, {{ auth()->user()->username }}</a>
          </div>
      @else
      <div class="nav-item ms-auto">
        <a href="{{ route('login') }}" class="nav-link"><i class="fas fa-user"></i> Login To Your Account</a>
      </div>
      @if (Route::has('register'))
          <div class="nav-item">
            <a href="{{ route('register') }}" class="nav-link">Register</a>
          </div>
      @endif
        @endauth
      @endif
    </ul>
  </div>
</div>
