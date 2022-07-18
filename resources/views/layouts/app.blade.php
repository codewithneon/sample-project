<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title', 'Welcome To Laravel App')</title>
    <link href="{{asset('css/sweetalert2.min.css')}}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{asset('css/materialdesignicons.min.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>
    <style>.pagination{ margin: 0; justify-content: end;} </style>
    @stack('style')
</head>
<body>
<main>
    @yield('body')
</main>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/sweetalert2.all.min.js')}}"></script>

<script type="text/javascript">
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': `{{csrf_token()}}`}});
    const SwConf = Swal.mixin({
        icon: "warning",
        title: "Are You sure?",
        showCancelButton: !0,
        cancelButtonColor: "#d33",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Confirmed"
    });
    const SwToast = Swal.mixin({
        toast: !0,
        timer: 2000,
        position: "top-end",
        timerProgressBar: !0,
        showConfirmButton: !1
    })
</script>
@stack('script')
</body>
</html>

