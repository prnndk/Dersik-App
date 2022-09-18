@extends('dashboard.layouts.main')
@section('webtitle','QR Scanner')
@section('container')
<div class="card">
    <div class="card-body">
        <div class="card-header">
            <h3>Scan QR Code</h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div id="reader" width="600px"></div>
            </div>
                <div class="col-md-6">
                   <input type="text" width="200px" placeholder="Hasil QR" id="result">
                </div>
        </div>
        </div>
</div>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"> </script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        // console.log(`Code matched = ${decodedText}`, decodedResult);
        $("#result").val(decodedText)
        let id = decodedText

        csrf_token = $('meta[name="csrf_token"]').attr('content');

        Swal.fire({
            title: 'Scan Berhasil',
            text: 'Cek data pada QR',
            type: 'success ',
            icon: "success",
            confirmButtonColor:'#3085d6',
            confirmButtonText:'Validate QR'
        }).then((result)=>{
            if(result.value){
                $.ajax({
                    url:"{{ route('verifikasiQR') }}",
                    type:'POST',
                    data:{
                        '_method':'POST',
                        '_token': "{{ csrf_token() }}",
                        'qr_code': id,
                    },
                    success:function(response){
                        if(response.status_error){
                            Swal.fire({
                            type:'error',
                            icon:"error",
                            title:'Oops...',
                            text:'QrCode Tidak Terdaftar pada Database'
                        })
                        }
                        if (response.berhasil){
                         window.location.replace("/userdata/"+response.dataid+"")
                        }

                    },
                    error:function(xhr){
                        Swal.fire({
                            type:'error',
                            icon:"error",
                            title:'Oops...',
                            text:'Something went wrong please try again'
                        })
                    }
                })
            }
        })
    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection
