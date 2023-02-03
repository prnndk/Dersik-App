@extends('dashboard.layouts.main')
@section('webtitle','Blast Email')
@section('container')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Blast Email</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Mail Blasting History</h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Make New Blast Mail</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('blasting-mail.store') }}" method="POST" role="form">
                        @csrf
                        <div class="form-group">
                            <label for="title">Judul Email</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"  required value="{{ old('title') }}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="subject">Email Subject</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject"  required value="{{ old('subject') }}">
                            @error('subject')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Email Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"  required>{{ old('content') }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('bawahsection')
    
@endsection
@section('customjs')
<script>

</script>
@endsection