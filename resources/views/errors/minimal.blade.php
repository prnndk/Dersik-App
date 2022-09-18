<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/error.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/stisla/css/style.css">
    <link rel="stylesheet" href="/stisla/css/components.css">
    <title>@yield('title')</title>

  </head>
  <body style="background-color: cadetblue">
    <div class="modal modal-tour position-static d-block py-5" tabindex="-1" role="dialog" id="modalTour">
        <div class="modal-dialog" role="document">
          <div class="modal-content rounded-6 shadow">
            <div class="modal-body p-5">
            @yield('icon')
              <h1 class="fw-bold mb-0">@yield('code')</h1>
              <h4 class="mb-0">@yield('message')</h4>
              <ul class="d-grid gap-4 my-5 list-unstyled">
                @yield('content')
              </ul>
              <hr class="my-4">
                 <p class="fw-bold mb-2 text-center">Is this wrong? send us email</p>
                 <div class="d-grid gap-2 d-flex justify-content-between">
                    <a href="mailto:dev@prinandika.my.id" class=""><button class="btn btn-outline-info bi bi-envelope-paper px-md-3" type="button"> Email us!</button></a>
                    <a href="/" class=""><button class="btn btn-primary bi bi-house px-md-3" type="button"> Homepage</button></a>
                  </div>
                </div>
                <span class="text-center mb-2">&copy; {{ date('Y') }} by Prinandika</span>
            </div>
        </div>
        <div class="simple-footer mt-5 text-light">
            <p class="mb-0 mt-1">Ip Address: {{ request()->ip() }}, Requested URL: {{ request()->path() }}</p>
            <p>Diakses pada: {{ date('d-m-Y H:i:m') }} WIB</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
