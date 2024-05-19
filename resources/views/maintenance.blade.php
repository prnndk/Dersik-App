<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.meta')
    <title>Maintenance Mode | DERSIK 22</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <section class="min-h-screen bg-gradient-to-r from-gray-700 via-gray-900 to-black px-2 py-3">
          <nav class="md:p-5 mb-12 flex justify-center ">
            <h1 class="text-4xl hover:bg-white px-6 pt-2 pb-3 rounded-tl-full rounded-br-full text-white hover:text-slate-700">smasa.id</h1>
          </nav>
          <div class="flex justify-center">
            {{-- <div class="bg-white p-4 rounded-r-full rounded-tl-full shadow-lg"> --}}
                <img src="/cnnct.gif" alt="connecting" class="rounded-r-full rounded-tl-full object-cover h-56 w-96">
            {{-- </div> --}}
          </div>
          <div class=" text-center p-10">
            <h1 class="text-5xl font-bold mb-4 py-2 text-slate-100">Sorry we're under maintenance</h1>
            <h5 class="text-lg py-5 leading-6 text-slate-100">
              Currently, undergoing maintenance. Please connect with us later!
            </h5>
          </div>
            <div class="flex justify-center">
                <a href="https://www.instagram.com/smasadersik/" class="bg-white hover:bg-slate-700 text-slate-700 hover:text-white font-bold py-2 px-4 rounded-full">
                Visit Our Instagram
                </a>
            </div>
    </section>
</body>
    <script src="/js/app.js"></script>
</html>
