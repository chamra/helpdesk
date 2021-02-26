<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk - Agent</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')  }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @component('components.nav')
    
    @endcomponent
    <div class="container" id="app">
        @yield('content')
    </div>
    
    
    <script src="{{ asset('js/app.js')  }}"></script>
</body>
</html>