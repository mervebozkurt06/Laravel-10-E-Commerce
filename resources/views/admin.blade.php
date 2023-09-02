<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Concept - Bootstrap 4 Admin Dashboard Template</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets')}}/vendor/bootstrap/css/bootstrap.min.css">
    <link href="{{ asset('assets')}}/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets')}}/libs/css/style.css">
    <link rel="stylesheet" href="{{ asset('assets')}}/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets')}}/vendor/bootstrap/css/bootstrap.min.css">
    <link href="{{ asset('assets')}}/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets')}}/libs/css/style.css">
    <link rel="stylesheet" href="{{ asset('assets')}}/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets')}}/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets')}}/vendor/datatables/css/buttons.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets')}}/vendor/datatables/css/select.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets')}}/vendor/datatables/css/fixedHeader.bootstrap4.css">


    @yield('css')
    @yield('javascript')

</head>

<body>



    @include('_header')

    @include('_sidebar')
    <!-- Dinamik İçerik Alanı -->

@yield('content')

@include('_footer')

@yield('footer')


</body>

</html>
