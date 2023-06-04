@extends('dashboard.layouts.main')
@section('webtitle','Manage Dashboard Link')
@section('container')
<div class="card">
    <div class="card-header">
        <h4>Manage Dashboard Links</h4>
        <div class="card-header-action">
            <button class="badge badge-primary decoration-none border-0" id="createLink"><i class="fas fa-plus"></i> Add New Link</button>
        </div>
    </div>
    <div class="card-body">
       <div class="table-responsive table-invoice my-2">
            <table class="table">
              <tbody>
                <tr>
                <th>Nama Link</th>
                <th>URL</th>
                <th>Icon</th>
                <th>Color</th>
                <th>Aktif</th>
                <th>Action</th>
                </tr>
                @foreach ($data as $link )
                <tr>
                    <td>{{ $link->nama}}</td>
                    <td>{{ $link->route }}</td>
                    <td>{{ $link->icon }}</td>
                    <td>{{ $link->btn_color }}</td>
                    <td>@if ($link->active)
                        <div class="badge badge-success">Aktif</div>
                        @else
                        <div class="badge badge-danger">Tidak Aktif</div>
                        @endif
                    </td>
                    <td><button class="btn btn-info tab-edit" data-id={{ $link->id }}>Test</button></td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('bawahsection')
<div class="modal fade" tabindex="-1" role="dialog" id="NewLinks">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Buat link dashboard</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <ul id="error">

            </ul>
            <div class="form-group col-md-12">
                <label for="nama">Nama Link</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required value="{{ old('nama') }}">
                @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-12">
                <label for="route">Route to</label>
                <input type="text" class="form-control @error('route') is-invalid @enderror" id="route" name="route"  required value="{{ old('route') }}">
                @error('route')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-12">
                <label for="icon">What icon you use</label>
                <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon"  required value="{{ old('icon') }}">
                <small class="form-text text-muted">We use the icon from font-awesome or bootstrap icon </small>
                @error('icon')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-12">
                <label for="btn_color">Choose Button Color</label>
                <select name="btn_color" class="form-control selectric" id="btn_color">
                    <option value="" selected disabled>Choose Button Color</option>
                    @foreach ($btn_color as $color)
                    @if(old('btn_color') == $color)
                        <option value="{{ $color }}" selected>{{ $color }}</option>
                    @endif
                        <option value="{{ $color }}">{{ $color }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="informasi">Informasi Link</label>
                <input type="text" name="informasi" id="informasi" class="form-control" required value="{{old('informasi')}}">
            </div>
            <div class="form-group col-md-12">
                <div class="form-check">
                    <input type="checkbox" name="active" id="active" class="form-check-input">
                    <label for="active" class="form-check-label">Is Active?</label>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="location">Choose Link Location</label>
                <select name="location" class="form-control selectric" id="location">
                    <option value="" selected disabled>Choose Link Location</option>
                    @if (old('location') == '1')
                        <option value="1" selected>Dashboard</option>
                    @elseif(old('location')== '2')
                        <option value="2" selected>Front</option>
                    @endif
                    <option value="1">Dashboard</option>
                    <option value="2">Front</option>
                </select>
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button id="addSubmit" class="btn btn-primary">Add new link</button>
        </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="viewLinks">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Lihat & Ubah Link</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <ul id="errorEdit">

            </ul>
            <div class="form-group col-md-12">
                <label for="nama">Nama Link</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="namaEdit" name="nama"  required value="{{ old('nama') }}">
            </div>
            <div class="form-group col-md-12">
                <label for="route">Route to</label>
                <input type="text" class="form-control @error('route') is-invalid @enderror" id="routeEdit" name="route"  required value="{{ old('route') }}">
            </div>
            <div class="form-group col-md-12">
                <label for="icon">What icon you use</label>
                <input type="text" class="form-control @error('icon') is-invalid @enderror" id="iconEdit" name="icon"  required value="{{ old('icon') }}">
                <small class="form-text text-muted">We use the icon from font-awesome or bootstrap icon </small>
            </div>
            <div class="form-group col-md-12">
                <label for="btn_color">Choose Button Color</label>
                <select name="btn_color" class="form-control selectric" id="btn_colorEdit">
                    <option value="" selected disabled>Choose Button Color</option>
                    @foreach ($btn_color as $color)
                    @if(old('btn_color') == $color)
                        <option value="{{ $color }}" selected>{{ $color }}</option>
                    @endif
                        <option value="{{ $color }}">{{ $color }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="informasi">Choose Link Status</label>
                <select name="informasi" class="form-control selectric" id="informasiEdit">
                    <option value="" selected disabled>Choose Link Status</option>
                    @if (old('informasi') == 'Y')
                        <option value="Y" selected>Aktif</option>
                    @elseif(old('informasi')== 'N')
                        <option value="N" selected>Tidak Aktif</option>
                    @endif
                    <option value="Y">Aktif</option>
                    <option value="N">Tidak Aktif</option>
                </select>
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button id="editSubmit" class="btn btn-primary">Edit This Link</button>
        </div>
        </div>
    </div>
</div>
@endsection
@section('customjs')
<script>
    $(document).ready(function () {
        $('#createLink').on('click', function () {
            $('#NewLinks').modal('show');
            $('#addSubmit').on('click', function () {
                $.ajax({
                    type: "POST",
                    url: "{{ route('links.store') }}",
                    data: {
                        '_token' : '{{ csrf_token() }}',
                        'nama' : $('#nama').val(),
                        'route' : $('#route').val(),
                        'btn_color' : $('#btn_color').val(),
                        'informasi' : $('#informasi').val(),
                        'icon' : $('#icon').val(),
                        'location' : $('#location').val(),
                        'active': //value of checkbox if checked == true else false
                        $('#active').is(":checked") ? 1 : 0,
                    },
                    dataType: "JSON",
                    success: function (response) {
                        $('#NewLinks').modal('hide');
                        $('#nama').val('');
                        $('#route').val('');
                        $('#btn_color').val('');
                        $('#informasi').val('');
                        $('#icon').val('');
                        $('#location').val('');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Dashboard Link has been added',
                        });
                    },
                    error:function (xhr) {
                        $('#error').empty();
                        var res = xhr.responseJSON;
                        if ($.isEmptyObject(res) == false) {
                            $.each(res.errors, function (key, value) {
                                $('#error').append('<li class="text-danger">'+value+'</li>');
                            });
                        }
                     }
                });
            });
        });
        $('.tab-edit').on('click', function(){
            let id=$(this).data('id');
            $("#viewLinks").modal('show');
            $.ajax({
                type:"GET",
                url:"/api/link/",
                data:{
                    'id':id
                },
                dataType:"JSON",
                success:function(response){
                    $('#namaEdit').val(response.data.nama);
                    $('#routeEdit').val(response.data.route);
                    $('#btn_colorEdit').val(response.data.btn_color).change();
                    $('#informasiEdit').val(response.data.informasi).change();
                    $('#iconEdit').val(response.data.icon);
                }
            })
        })
    });
</script>
@endsection


