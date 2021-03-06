<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css')  }}">
</head>

<body>
    @component('components.main-nav')
        
    @endcomponent
    <div class="container" id="app">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js')  }}"></script>
</body>
</html>