<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
@vite(['resources/css/app.css'])

<link rel="apple-touch-icon" sizes="76x76" href="{{asset('apple-touch-icon.png')}}" />
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}" />
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}" />

<link rel="manifest" href="{{asset('site.webmanifest')}}" />
<link rel="mask-icon" href="{{asset('safari-pinned-tab.svg')}}" color="#207891" />
<meta name="msapplication-TileColor" content="#ffc40d" />
<meta name="theme-color" content="#ffffff" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Toastr CSS & JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Cart JS -->
@vite(['resources/js/cart.js'])