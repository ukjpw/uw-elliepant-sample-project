<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Elliephant Project - Products</title>
        
        @yield('scripts')
        @yield('styles')
        
        <!-- Fonts -->
        <link rel="stylesheet" rel="/public/style.css" />
        @vite('resources/css/app.css')
    </head>
    <body class="font-sans">
      @include('_includes/nav/topnav')

      @yield('content')

      
    </body>
</html>
