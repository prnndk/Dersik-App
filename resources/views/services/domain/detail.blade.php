@extends('dashboard.layouts.main')
@section('container')
<div class="card">
    <div class="card-header">
        <h4>Detail domain {{ $domain->name }}</h4>
        <div class="card-header-action">
            <a href="{{ route('domain.index') }}" class="badge badge-warning text-decoration-none"><i class="fas fa-arrow-left"></i> Back to index</a>
        </div>
    </div>
    <div class="card-body">
        <div class="col-md-8">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="show-tab" data-toggle="tab" href="#show" role="tab" aria-controls="show" aria-selected="true">Data</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="false">Edit</a>
            </li>
          </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="show" role="tabpanel" aria-labelledby="show-tab">
              <li>Domain name: {{ $domain->name }}</li>
              <li>Admin domain mail: {{ $domain->email }}</li>
              <li>Registrar name: {{ $domain->pj }}</li>
              <li>Belongs to: {{ $domain->angkatan->nama }}</li>
            </div>
            <div class="tab-pane fade show" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                <form method='POST' role="form" action="{{ route('domain.update',$domain->id) }}">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Nama Domain</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  required autofocus value="{{ old('name',$domain->name) }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email Admin Domain</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  required value="{{ old('email',$domain->email) }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pj">Penanggung Jawab Domain</label>
                            <input type="text" class="form-control @error('pj') is-invalid @enderror" id="name" name="pj"  required value="{{ old('pj',$domain->pj) }}">
                            @error('pj')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        {{-- select angkatan --}}
                        <div class="form-group col-md-6">
                        <label for='angkatan_id'>Pilih Angkatan</label>
                        <select class="form-control selectric" name='angkatan_id'>
                            @foreach ($angkatan as $list)
                            @if (old('angkatan_id',$domain->angkatan_id)==$list->id)
                                <option value="{{ $list->id }}" selected>{{ $list->nama }}</option>
                            @else
                                <option value="{{ $list->id }}">{{ $list->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        </div>
                    {{-- end row --}}
                    </div>
                      <div class="col-6"> <button type="submit" class="btn btn-primary">Submit Form</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection