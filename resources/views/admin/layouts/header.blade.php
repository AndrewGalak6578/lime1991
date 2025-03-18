<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Ilyas Korolev" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- PAGE TITLE HERE -->
    <title>@yield('page_title', env('APP_NAME'))</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="/admin_assets/images/favicon.png" />

    <!-- Style css -->
    <link href="/admin_assets/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
{{--    <link href="/admin_assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">--}}
    <link href="/admin_assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/admin_assets/css/style.css" rel="stylesheet">
    <link href="/front_assets/css/map.css" rel="stylesheet">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
		<script src="https://api-maps.yandex.ru/v3/?apikey=e0bf0d0f-97f7-4cb2-93b1-9cbc4d3436f0&lang=ru_RU">/*test*/</script>
		<script src="https://api-maps.yandex.ru/v3/?apikey=4636e874-8e53-42ab-8d33-526f7f85bded&lang=ru_RU"></script>
    <link href="/admin_assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
			.tox-promotion {
				display: none !important;
			}
			.tox-statusbar__right-container {
				display: none !important;
			}
			.tab-content{
				padding-top: 15px;
				height: 100%;
			}
			.tab-content > .tab-pane {
				height: 100%;
			}
			.tab-content > .tab-pane > .tab-nav-menu {
				height: 100%;
				overflow: auto;
			}
			.modal-xxl{
				max-width: 95%;
			}
			input:disabled {
				background: #dddddd;
			}
    </style>
    @yield('header')
</head>
<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="index.html" class="brand-logo">
            <img class="logo-abbr" src="/admin_assets/images/logo-white.png" alt="">
            <img class="logo-compact" src="/admin_assets/images/logo-text.png" alt="">
            <img class="brand-title" src="/admin_assets/images/logo-text.png" alt="">
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->


    @include('admin.layouts.sidebar')
    @include('admin.layouts.topbar')
    @include('admin.layouts.second_sidebar')




    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
        @if(Route::current()->getName() != 'admin.dashboard')

            <div class="row page-titles mx-0">
                <div class="col-12 p-md-0">
                    <div class="welcome-text">
                        <h4>@yield('page_name')</h4>
{{--                        <span>Badge</span>--}}
                    </div>
                </div>
                <div class="col-12 p-md-0 justify-content-start mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Главная</a></li>
                        @yield('breadcrumbs')
                    </ol>
                </div>
            </div>

@endif

        <div class="row">

           <div class="col-12">
               @include('flash::message')

               @if ($errors->any())
                   <div class="alert alert-danger">
                       <ul>
                           @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                           @endforeach
                       </ul>
                   </div>
               @endif
           </div>


        </div>

