<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('webtitle') | DERSIK 22 APP</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- Bootstrap Newest --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    {{--DataTable css--}}
    <link rel="stylesheet" type="text/css" href="/dtable/datatables.min.css"/>
    <!-- Template CSS -->
    <link rel="stylesheet" href="/stisla/css/style.css">
    <link rel="stylesheet" href="/stisla/css/components.css">
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <link rel="stylesheet" type="text/css" href="/css/selectric.css">
    {{--Select2 Css--}}
    <link href="/css/select2.css" rel="stylesheet" />
    {{-- fontawesome kit --}}
    {{--  <script src="https://kit.fontawesome.com/3e98a0e824.js" crossorigin="anonymous"></script>--}}
    <link rel="stylesheet" href="/fas/css/all.min.css ">
      {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    {{--jQuery--}}
    <script src="/js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id="app">
    <div class="main-wrapper">
        @include('dashboard.layouts.top')
        @include('dashboard.layouts.side')
        @include('sweetalert::alert')
        <div class="main-content">
            <section class="section">
                @yield('container')
            </section>
          @yield('bawahsection')
        </div>
    </div>
</div>
<footer class="main-footer">
    <div class="footer-left">
      Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Made with 💙 <a href="https://dersik.smasa.id/">DERSIK SMASA 22</a>
    </div>
    <div class="footer-right">
      1.5
    </div>
</footer>
    <!-- General JS Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    {{-- Bootstrap newest JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="/stisla/js/stisla.js"></script>

    <!-- Template JS File -->
    <script src="/stisla/js/scripts.js"></script>
    <script src="/stisla/js/custom.js"></script>
    {{--Trix--}}
    <script type="text/javascript" src="/js/trix.js"></script>
    {{--Select2--}}
    <script src="/js/select2.min.js"></script>
    {{--  Selectric  --}}
    <script type="text/javascript" src="/js/selectric.js"></script>
    {{-- DataTables --}}
    <script type="text/javascript" src="/dtable/datatables.min.js"></script>
    {{--Sweet Alert--}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('customjs')
<script>
    $(document).ready( function () {
      $('#table').DataTable();
      $('.longselect').select2({
          minimumInputLength:3
      });
    });
    $(function() {
        $('.selectric').selectric();
    });
</script>
<script src="/js/custom.js"></script>
