<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Pendataan | DERSIK 22</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body>
<section class="bg-gray-200 min-h-screen flex items-center justify-center p-5">
    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
    <form class="space-y-6" autocomplete="off">
        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Form Pendataan Dersik 22</h5>
        <div class="grid gap-4 mb-6 md:grid-cols-2">
            <div>
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan Nama <span class="text-red-600 text-md font-medium">*</span></label>
                <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Nama Lengkap" required value="{{ old('nama') }}">
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan Email <span class="text-red-600 text-md font-medium">*</span></label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@smasa.id" required value="{{ old('email') }}">
            </div>
        </div>
        <div>
            <label for="kelas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Kelasmu <span class="text-red-600 text-md font-medium">*</span></label>
            <select name="kelas" id="kelas" class="select2 rounded-lg bg-gray-50 border border-gray-300 text-gray-800 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" disabled selected>-Pilih Kelas-</option>
                @foreach ($kelas as $kls)
                    <option value="{{ $kls->id }}">{{ $kls->kelas }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Statusmu Sekarang <span class="text-red-600 text-md font-medium">*</span></label>
            <select name="status" id="status" class="select2 rounded-lg bg-gray-50 border border-gray-300 text-gray-800 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" disabled selected>-Pilih Status-</option>
                @foreach ($status as $list)
                    <option value="{{ $list->id }}">{{ $list->nama }}</option>
                @endforeach
            </select>
        </div>
        <div id="block_instansi">
            <label for="instansi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Universitas/Nama Pekerjaan <span class="text-red-600 text-md font-medium">*</span></label>
            <select name="instansi" id="instansi" class="select2 rounded-lg  bg-gray-50 border border-gray-300 text-gray-800 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </select>
            <div class="flex">
                <div class="flex items-center h-5">
                    <input id="tidak_ada" aria-describedby="tidak_ada-text" type="checkbox" value="off" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>
                <div class="ml-2 text-sm">
                    <label for="tidak_ada" class="font-medium text-gray-900 dark:text-gray-300">Pilihan yang diinginkan tidak ada?</label>
                    <p id="tidak_ada-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">Centang pilihan disamping dan input pilihan secara manual, Mohon tuliskan secara lengkap</p>
                </div>
            </div>
        </div>
        <div id="block_input_manual">
            <label for="instansi_manual" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Input Manual</label>
            <input type="text" name="instansi_manual" id="instansi_manual" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Namanya" value="{{ old('input_manual') }}">
        </div>
        <div>
            <label for="detail_status" id="detail_placeholder" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan/Detail Pekerjaan <span class="text-red-600 text-md font-medium">*</span></label>
            <input type="text" name="detail_status" id="detail_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Misal: Teknik Informatika" required value="{{ old('detail_status') }}">
        </div>
        <div>
            <label for="nomor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor HP <span class="text-red-600 text-md font-medium">*</span></label>
            <input type="tel" name="nomor" id="nomor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="08123456789" required value="{{ old('nomor') }}">
        </div>
        <div>
            <label for="domisili" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota tempat tinggal <span class="text-red-600 text-md font-medium">*</span></label>
            <select name="domisili" id="domisili" class="select2 rounded-lg  bg-gray-50 border border-gray-300 text-gray-800 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" disabled selected>-Kota/Kab Tempat Tinggal-</option>
                @foreach ($kab as $list)
                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="button" id="submit" class="w-full bg-blue-500 text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
        <button disabled type="button" id="loadingBtn" class="w-full text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center">
        <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
        </svg>
        Loading...
        </button>
    </form>
    </div>
</section>
</body>
<script>
    $(document).ready(function () {
        $('#loadingBtn').hide();
        $('#block_input_manual').hide();
        $('.select2').select2();
        $('#status').on('change', function () {
            $('#instansi').empty();
            let id_status = $(this).val();
            if (id_status==3||id_status==5) {
                $('#block_instansi').hide();
                $('#detail_placeholder').text('Kegiatan Sekarang');
                $('#detail_status').attr('placeholder', 'Misal: Belajar untuk mencoba lagi');
            } else {
                $('#block_instansi').show();
                $('#detail_placeholder').text('Jurusan/Detail Pekerjaan');
                $('#detail_status').attr('placeholder', 'Misal: Teknik Informatika');
                $.ajax({
                    url:'/api/dtlstts',
                    type:'POST',
                    data:{
                        id_status:id_status,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'JSON',
                    success:function(response){
                        $('#instansi').append('<option value="" disabled selected>-Pilih Universitas/Nama Pekerjaan-</option>');
                        $.each(response, function (key, value) {
                            $('#instansi').append('<option value="'+value.id+'">'+value.nama+'</option>');
                        });
                    }
                });
            }
        });
        if($('#tidak_ada').on('change',function () {
            if ($(this).prop('checked')) {
                $('#tidak_ada').val('on');
                $('#block_input_manual').show();
                $('#instansi_manual').attr('required', true);
                $('#instansi').attr('required', false);
            } else {
                $('#block_input_manual').hide();
                $('#tidak_ada').val('off');
                $('#instansi_manual').attr('required', false);
            }
        }));
        $('#submit').on('click',function(){
            $('#submit').hide();
            $('#loadingBtn').show();
            $.ajax({
                url:'/api/siswa',
                type:'POST',
                data:{
                    nama:$('#nama').val(),
                    email:$('#email').val(),
                    kelas:$('#kelas').val(),
                    status:$('#status').val(),
                    tidak_ada:$('#tidak_ada').val(),
                    instansi:$('#instansi').val(),
                    instansi_manual:$('#instansi_manual').val(),
                    detail_status:$('#detail_status').val(),
                    nomor:$('#nomor').val(),
                    domisili:$('#domisili').val(),
                    _token: '{{ csrf_token() }}'
                },
                dataType:'JSON',
                success:function (response){
                    $('#submit').show();
                    $('#loadingBtn').hide();
                    console.log(response);
                },
                error:function (response){
                    $('#submit').show();
                    $('#loadingBtn').hide();
                    console.log(response);
                }
            })
        })

    });
</script>
</html>