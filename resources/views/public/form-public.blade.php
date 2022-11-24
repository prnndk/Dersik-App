<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Pendataan | DERSIK 22</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body>
<section class="bg-gray-200 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
    <form class="space-y-6" action="#" autocomplete="off">
        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Form Pendataan Dersik 22</h5>
        <div>
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan Nama</label>
            <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Nama Lengkap" required>
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan Email</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@smasa.id" required>
        </div>
        <div>
            <label for="kelas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Kelasmu <span class="text-red-600 text-md font-medium">*</span></label>
            <select name="kelas" id="kelas" class="select2 rounded-lg bg-gray-50 border border-gray-300 text-gray-800 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" disabled selected>-Pilih Kelas-</option>
                @foreach ($kelas as $kls)
                    <option value="{{ $kls->id }}">{{ $kelas->kelas }}</option>
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
        <div>
            <label for="instansi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Universitas/Nama Pekerjaan <span class="text-red-600 text-md font-medium">*</span></label>
            <select name="instansi" id="instansi" class="select2 rounded-lg bg-gray-50 border border-gray-300 text-gray-800 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" disabled selected>-Pilih Universitas/Nama Pekerjaan-</option>
                @foreach ($instansi as $list)
                    <option value="{{ $list->id }}">{{ $list->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-start">
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required>
                </div>
                <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
            </div>
            <a href="#" class="ml-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a>
        </div>
        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
    </form>
    </div>
</section>
</body>
<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
</html>