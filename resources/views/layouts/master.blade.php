<!DOCTYPE html>
@yield('pre')
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="robots" content="index, follow">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="Bhaktij Koli <bhaktijkoli121@gmail.com>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title }}</title>
  <link rel="icon" href="{{url('favicon.ico')}}" type="image/ico" sizes="16x16">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/flexboxgrid.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
</head>
<body class="bg">
  @yield('content')
  <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
  @yield('post')
</body>
</html>
