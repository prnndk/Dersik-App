@extends('dashboard.layouts.main')
@section('webtitle', 'Shortlink')
@section('container')
    <div class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/dashboard" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Link Shortener</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Make a shortlink</h4>
                        </div>
                        <div class="card-body">
                            <ul id="error"></ul>
{{--                            <div class="form-group col-md-8">--}}
{{--                                <label for="name">Nama Link</label>--}}
{{--                                <input type="text" class="form-control" id="name" name="name"  required value="{{ old('name') }}">--}}
{{--                            </div>--}}
                            <div class="form-group col-md-8">
                                <label for="link">Long Link</label>
                                <input type="url" class="form-control" id="link" name="link"  required value="{{ old('link') }}">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="shortlink">Link pendek</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="shortlink" id="shortlink" placeholder="Link Pendek" required value="{{ old('shortlink') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" id="cekAda">Cek link</button>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" id="submit">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>List shortenedlink</h4>
                        </div>
                        <div class="card-body">
                            @foreach($links as $link)
                            <div class="row">
                                <div class="col-md-8">
                                    <a href="{{ 'to/'.$link->shortened }}" target="_blank">{{ '/to/'.$link->shortened }}</a>
                                </div>
                                <div class="col-md-4">
                                    <span class="badge {{$link->active ? 'badge-success' : 'badge-danger'}}">{{$link->active ? 'Active' : 'Non-Active'}}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Row --}}
        </div>
    </div>
@endsection
@section('customjs')
    <script>
        $('#cekAda').click(function(e){
            e.preventDefault();
            let short = $('#shortlink').val();
            $('#cekAda').addClass('btn-progress');
            $('#shortlink').removeClass('is-valid is-invalid');
            $.ajax({
                type:"POST",
                url: "/api/cekLink",
                data:{
                    shortened: short,
                },
                dataType: "JSON",
                success: function (response) {
                    $('#cekAda').removeClass('btn-progress');
                    $("#shortlink").addClass('is-valid');
                },
                error:function (response) {
                    $('#cekAda').removeClass('btn-progress');
                    $("#shortlink").addClass('is-invalid');
                }
            })
        });
        $('#submit').click(function (e) {
            e.preventDefault();
            $('#submit').addClass('btn-progress');
            $.ajax({
                type: "POST",
                url: "api/links",
                data: {
                    original: $('#link').val(),
                    shortened: $('#shortlink').val(),
                    oleh: {{ Auth::user()->id }},
                },
                dataType: "JSON",
                success: function (response) {
                    $('#error').empty();
                    $('#submit').removeClass('btn-progress');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                    });
                    $('#name').val('');
                    $('#link').val('');
                    $('#shortlink').val('');
                },
                error: function (response) {
                    $('#submit').removeClass('btn-progress');
                    let errors = response.responseJSON.errors;
                    $('#error').empty();
                    $('#error').show();
                    $.each(errors, function (key, value) {
                        $('#error').append('<li class="text-danger">'+value+'</li>');
                    });
                }
            });
        });
    </script>
@endsection
