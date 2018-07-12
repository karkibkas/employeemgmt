<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('css/materialize.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    @if(auth::guard('admin')->check())
        <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    @endif
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <title>Laracart | The Best Online Store Like Ever...</title>
</head>
<body>
    {{-- Show loader before the page loads --}}
        {{--@include('inc.preloader')--}}
    {{-- Include the Navbar --}}
    <header>
        @include('inc.navbar')
    </header>

    <main>
        <br><br><br>
        {{-- Page content here --}}
        @yield('content')
        <br><br><br>
    </main>

    {{-- Footer here --}}
    @include('inc.footer')

    {{-- Javascript --}}
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/materialize.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

    {{-- Show toasts, if there are any --}}
    @include('inc.message')
    {{-- javascript from a view that's extending this layout --}}
    @yield('script')
</body>
</html>