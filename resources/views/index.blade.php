@extends('layouts.home')
@section('container')
      <h4 class="section-title">Silahkan klik salah satu link dibawah ini</h4>
      <p class="section-lead">Quick Link Aplikasi Dersik 22</p>
      <div class="card card-primary mt-3">
        <div class="card-body">
          <div class="row">
              <div class="card">
                <div class="card-body">
                <div class="front-link">
                  <a href="/dashboard/regis-mail" class="text-decoration-none">
                    <div class="list">
                      <div class="list-icon"><i class="fas fa-user"></i></div>
                      <div class="list-label">Email Smasa</div>
                    </div>
                  </a>
                  <a href="/pendataan" class="text-decoration-none">
                    <div class="list list">
                      <div class="list-icon"><i class="fas fa-key"></i></div>
                      <div class="list-label">Pendataan Alumni</div>
                    </div>
                  </a>
                    <a href="/vote" class="text-decoration-none">
                        <div class="list">
                            <div class="list-icon"><i class="fas fa-check-to-slot"></i></div>
                            <div class="list-label">e-voting</div>
                        </div>
                    </a>
                  </div>
                </div>
              </div>
            </div> {{-- end row --}}
        </div>
      </div>
@endsection
