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
                    @foreach($buttons as $button)
                     <a href="{{$button->route}}" class="text-decoration-none" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$button->informasi}}">
                        <div class="list" >
                            <div class="list-icon"><i class="{{$button->icon}}"></i></div>
                            <div class="list-label">{{$button->nama}}</div>
                        </div>
                    </a>
                    @endforeach
                  </div>
                </div>
              </div>
            </div> {{-- end row --}}
        </div>
      </div>
@endsection
