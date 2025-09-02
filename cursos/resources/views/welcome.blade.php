<?php
session_start();

use App\Http\Controllers\Auth\LoginController;

$semilla = "Sistema de videos, integral * y secciónes de aprendisaje";
function myEncrypt($string, $key) {
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}

if(Auth::user()->name != ""){
  $kesSecurity = myEncrypt(Auth::user()->id."*".Auth::user()->name."*".Auth::user()->id_curso,$semilla);
  $_SESSION['keyDelCurso'] = $kesSecurity;
}

?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html style="font-size: 16px;" lang="es"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">

  <title>{{ $creador[0]['titemp_creador'] }}</title>
  <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/miu/bootstrap.min.css") }}" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  {{-- i will provide this in description  --}}
  <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/miu/slick.css") }}" />
  <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/miu/slick-theme.css") }}" />
  <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/miu/owl.carousel.min.css") }}" />
  <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/miu/animate.min.css") }}" />
  <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/miu/magnific-popup.css") }}" />
  <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/miu/select2.min.css") }}" />
  <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/miu/select2-bootstrap4.min.css") }}" />
  <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/miu/slick-animation.css") }}" />
  <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/miu/style_nf.css") }}" />
  {{-- <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/miu/estilos_nf.css") }}" /> // ver que es este estilo--}}
  <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/miu/acordeon.css") }}" />
  <script type="text/javascript" src="{{ asset("vendor/crudbooster/assets/js/home/JWPlayerversion8.27.1.js") }}"></script> 
  {{-- <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/miu/bootstrap.min.css") }}" /> --}}

  <style>
    /* para poner el fondo en las letras de los titulos */
    .big-title{
       font-family: var(--fontFamily); /*'Playfair Display', serif;*/
       background: url( {{ asset("uploads/miu/texure.jpg") }} );
       background-repeat: repeat-x;
       background-position: 100% 100%;
       color: transparent;
       background-clip: text;
       -webkit-font-smoothing : antialiased;
       -webkit-background-clip: text;
       -webkit-text-fill-color: transparent;
    }
  </style>
</head>

<body>
  <header id="main-header">
    <div class="main-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            {{-- barra de navegacion --}}
            <nav class="navbar navbar-expand-lg navbar-light p-0" style="max-height: 50px;">
              <a href="#" class="navbar-toggler c-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <div class="navbar-toggler-icon" data-toggle="collapse">
                  <span class="navbar-menu-icon navbar-menu-icon--top"></span>
                  <span class="navbar-menu-icon navbar-menu-icon--middle"></span>
                  <span class="navbar-menu-icon navbar-menu-icon--bottom"></span>
                </div>
              </a>
              <a href="{{ url('/') }}" style="height: 50px; width: 150px;" class="navbar-brand">
                <img style=" height: 100%; width: 100%; object-fit: contain;" src="{{ asset($creador[0]['icono_creador']) }}" class="img-fluid logo" alt="" />
              </a>
              <strong class="big-title title text-uppercase" style="font-size: 1.5em; text-transform: uppercase; ">
                {{ $creador[0]['titemp_creador'] }}
              </strong>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="menu-main-menu-container">
                  <ul id="top-menu" class="navbar-nav ml-auto">
                    @if (Route::has('login'))
                      <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                          @auth
                              <a style="font-size: 0.8em;" class="text-sm text-gray-700 dark:text-gray-500 underline">
                                {{ Auth::user()->name }}
                              </a>
                              <div>
                                <a style="font-size: 0.8em;" class="text-sm text-gray-700 dark:text-gray-500 underline" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Salir') }}
                                  </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                                </form>
                              </div>
                          @else
                              <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Ingreso</a>
                              @if (Route::has('register'))
                                  <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Registrate</a>
                                  {{-- <a href="https://pay.hotmart.com/A85956607S?bid=1692910022277" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Registrate</a> --}}
                              @endif
                          @endauth
                      </div>
                    @endif
                  </ul>
                </div>
              </div>
            </nav>
            <div class="nav-overlay"></div>
            {{-- fin barra de navegacion --}}
          </div>
        </div>
      </div>
    </div>
  </header>

  {{-- slider starts  --}}
  <section id="home" class="iq-main-slider p-0">
    <div id="home-slider" class="slider m-0 p-0">
      @php $x=1; @endphp
      @foreach($cursos as $dataCur)
        {{-- <div style="background-image: url( {{ $dataCur['img_curso'] }} ); " class="slide slick-bg s-bg-{{ $x }}; parallax-window"> --}}
        <div style="background-image: url(  );" class="slide slick-bg s-bg-{{ $x }};">
          <div class="container-fluid position-relative h-100">
            <div class="slider-inner h-100">
              <div class="row align-items-center h--100">
                {{-- manejo del slider inicial --}}
                <div class="col-xl-6 col-lg-12 col-md-12">
                  <a href="javascript:void(0)">
                    <div style="height: 50px; width: 150px;" class="channel-logo" data-animation-in="fadeInLeft" data-delay-in="0.5">
                      {{-- <img style="height: 100%; width: 100%; object-fit: contain;" src="{{ asset($creador[0]['logo_creador']) }}" class="c-logo" alt="" /> --}}
                    </div>
                  </a>
                  <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft" data-delay-in="0.6" style="font-size: 1.8em;">
                    {{ $dataCur['titulo_curso'] }}
                  </h1>
                  <div class="d-flex flex-wrap align-items-center fadeInLeft animated" data-animation-in="fadeInLeft"
                    style="opacity: 1;">
                    <div style="font-size: 0.8em;" class="slider-ratting d-flex align-items-center mr-4 mt-2 mt-md-3">
                      <ul
                        class="ratting-start p-0 m-0 list-inline text-primary d-flex align-items-center justify-content-left">
                        {{-- ESTRELLAS --}}
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-half"></i></li>
                        {{-- FIN ESTRELLAS --}}
                      </ul>
                      {{-- PUNTUACION --}}
                      <span style="font-size: 0.8em;" class="text-white ml-2">7.5</span>
                      {{-- FIN PUNTUACION --}}
                    </div>
                    <div style="font-size: 0.8em;" class="d-flex align-items-center mt-2 mt-md-3">
                      {{-- APTO PARA Y TIEMPO DURACION --}}
                      <span class="badge badge-secondary p-2">{{ $dataCur['clasifi_curso'] }}</span>
                      @php $hsm = explode(":", $dataCur['tiempo_curso'])  @endphp
                      <span class="ml-3">{{ $hsm[0]."h ".$hsm[1]."min" }}</span>
                      {{-- FIN APTO PARA Y TIEMPO DURACION --}}
                    </div>
                  </div>
                  {{-- DETALLE DEL CURSO --}}
                  <p style="font-size: 0.8em;" data-animation-in="fadeInUp">
                    @php $txt = substr($dataCur['descrip_curso'],0,170) @endphp
                    {!! $txt !!}
                  </p>
                  {{-- FIN DETALLE DEL CURSO --}}
                  <div style="font-size: 0.8em;" class="trending-list" data-animation-in="fadeInUp" data-delay-in="1.2">
                    <div style="font-size: 0.8em;" class="text-primary title starring">
                      Estilista :
                      <span style="font-size: 1em;" class="text-body">{{ $creador[0]['nomemp_creador'] }}</span>
                    </div>
                    <div style="font-size: 0.8em;" class="text-primary title genres">
                      Tipo : <span style="font-size: 1em;" class="text-body">{{ $dataCur['tipvalora_curso'] }}</span>
                    </div>
                    <div style="font-size: 0.8em;" style="font-size: 1.8em;" class="text-primary title tag">
                      Costo :
                      <span style="font-size: 1em;" style="font-size: 1em;" class="text-body">{{ $dataCur['costo_curso']." USD" }}</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center r-mb-23 mt-4" data-animation-in="fadeInUp" data-delay-in="1.2">
                    <a href="https://pay.hotmart.com/A85956607S?bid=1692910022277" class="btn btn-hover iq-button" >
                      <i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;
                      Comprar ahora
                    </a>
                    {{-- <a href="#" class="btn btn-link">More Details</a> --}}
                  </div>
                </div>
                {{-- fin manejo del slider inicial --}}
              </div>
              <div class="col-xl-5 col-lg-12 col-md-12 trailor-video">
                {{-- MANEJO DEL DETALLE DEL CURSO --}}
                {{-- <a href="{{ asset($dataCur['vidintro_curso']) }}" class="video-open playbtn">
                  <img src="{{ asset("uploads/miu/play.png") }}" class="play" alt="" />
                  <span class="w-trailor">Detalle del Curso</span>
                </a> --}}
                <div class="video-open playbtn">
                  <img style="width: 20px;" src="{{ asset("uploads/miu/play.png") }}" class="play" alt="" />
                  <button type="button" class="w-trailor" data-toggle="modal" data-target="#exampleModal" style="background-color: transparent; border-color: transparent; font-size: 0.8em;">
                    Introducción al Curso
                  </button>
                </div>
                {{-- FIN MANEJO DEL DETALLE DEL CURSO --}}
              </div>
            </div>
          </div>
        </div>
        @php $x=$x+1; @endphp
      @endforeach
    </div>

      {{-- modal para reproduccion de video presentacion --}}
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" style="color: #000000;" id="exampleModalLabel">{{ $dataCur['titulo_curso'] }}</h5>
              <button id="cerrar_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-4by3">
                  <iframe class="embed-responsive-item" src="{{ $dataCur['vidintro_curso'] }}" sandbox id="iframeVideo{{ $x }}"></iframe>
                </div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>    
  </section>
  {{-- slider ends --}}

  {{-- main content starts  --}}
  <div class="main-content">
    {{-- favorite section starts   --}}
    @foreach($cursos as $curData)
      <section id="iq-favorites">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12 overflow-hidden">
              <div class="iq-main-header d-flex align-items-center justify-content-between">
                <h4 class="main-title">Curso: {{ $curData['titulo_curso'] }}</h4>
                {{-- <a href="#" class="iq-view-all">Ver todo</a> --}}
              </div>
              <div class="favorite-contens">
                <ul class="favorites-slider list-inline row p-0 mb-0">
                  @foreach($clases as $clasData)
                    @if($clasData['id_curso'] == $curData['id'] )
                      {{-- slide item --}}
                      <li class="slide-item">
                         {{-- style=" height: 100%; width: 100%; object-fit: contain;" --}}
                        <div class="block-images position-relative">
                          {{-- <form method="POST">
                            <input type="hidden" value="{{ $clasData['clases_id'] }}">
                            <input type="hidden" value="{{ $clasData['id_curso'] }}">
                          </form> --}}
                          <div class="img-box">
                            <img src="{{ asset($clasData['imgchiqui_clase']) }}" class="img-fluid" alt="" />
                          </div>
                          <div class="block-description">
                            <h6 class="iq-title">Modulo: 
                              {{ $clasData['titulo_clase'] }}
                            </h6>
                            <div class="movie-time d-flex align-items-center my-2">
                              <div class="badge badge-secondary p-1 mr-2">{{ $clasData['clasifi_clase'] }}</div>
                              @php 
                                $hms = explode(":", $clasData['timedura_clase']);
                              @endphp
                              <span class="text-white">{{ $hms[0]."h ".$hms[1]."min" }}</span>
                            </div>
                            <div class="hover-buttons">
                              @if (Route::has('login'))
                                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                    @auth
                                      <a href="{{ url('/home/'.$kesSecurity) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                                        <span class="btn btn-hover iq-button">
                                          <i class="fa fa-play mr-1"></i>
                                          Reproducir Video
                                        </span>
                                      </a>
                                    @else
                                      <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                                        <span class="btn btn-hover iq-button">
                                          <i class="fa fa-play mr-1"></i>
                                          Ingresar
                                        </span>
                                      </a>
                                    @endauth
                                </div>
                              @endif
                            </div>
                          </div>
                          <div class="block-social-info">
                          </div>
                        </div>
                      </li>
                    @endif
                  @endforeach            
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      <br>
    @endforeach
    {{-- favourite section ends --}}

    {{-- parallax section  --}}
    <br><br>
    @foreach($cursos as $curParalax)
      @if($curParalax['new_curso'] == 'Si')
        {{-- /* para poner la imagen de fondo en el parallax de nuevo curso */ --}}
        <style>
          .parallax-window{
            /*  background-image: url( {{ asset($curParalax['img_curso']) }} );*/
            /*  background-image: url(  }} );*/
            background-color: #cccccc;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #000000;
          }  
        </style>
        <section id="parallex" class="parallax-window">
          <div class="container-fluid h-100">
            <div class="row mirow align-items-center justify-content-center h-100 parallaxt-details">
              <header class="ribbon-container">
                <h2 class="ribbon">
                  <a class="ribbon-content">LO NUEVO</a>
                </h2>
                <br>
                    <div class="row">
                      <div class="col-lg-4 r-mb-23">
                        <div class="text-left">
                          <h1 style="font-size: 2em;" class="trending-text big-title text-uppercase">
                            {{ $curParalax['titulo_curso'] }}
                          </h1>
                          <div class="parallax-ratting d-flex align-items-center mt-3 mb-3">
                            <ul
                              class="ratting-start p-o m-0 list-inline text-primary d-flex align-items-center justify-content-left">
                              <li>
                                <i class="fa fa-star"></i>
                              </li>
                              <li>
                                <i class="pl-2 fa fa-star"></i>
                              </li>
                              <li>
                                <i class="pl-2 fa fa-star"></i>
                              </li>
                              <li>
                                <i class="pl-2 fa fa-star"></i>
                              </li>
                              <li>
                                <i class="pl-2 fa fa-star-half-o"></i>
                              </li>
                            </ul>
                            <span class="text-white ml-3">7.5</span>
                          </div>
                          <div class="movie-time d-flex align-items-center mb-3">
                            <div class="badge badge-secondary p-1 mr-2">{{ $curParalax['clasifi_curso'] }}</div>
                            @php $smh = explode(":", $curParalax['tiempo_curso'])  @endphp
                            <span class="text-white">{{ $smh[0]."h ".$smh[1]."min" }}</span>
                          </div>
                          <p style="font-size: 0.8em;">
                            {!! $curParalax['descrip_curso'] !!}
                          </p>
                        </div>
                      </div>
                      <div class="col-lg-7 miCambioVideo">
                        <div class="parallax-img">
                          <video width="100%" controls>
                            <source src="{{ asset($curParalax['vidintro_curso']) }}" type="video/mp4">
                          </video>
                          {{-- <iframe style="width: 700px; height: 400px;" sandbox src="{{ asset($curParalax['vidintro_curso']) }}" frameborder="0" allowfullscreen></iframe> --}}
                        </div>
                      </div>
                    </div>
              </header>
            </div>
          </div>
        </section>
      @endif
    @endforeach            
    {{-- parallax section end  --}}

    {{-- trending section PARA APUNTES POR LECCIONES --}}
    <section id="iq-trending" class="s-margin">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 overflow-hidden">
            <div class="iq-main-header d-flex align-items-center justify-content-between">
              <h4 class="main-title">TODOS LOS CURSOS PARA TI</h4>
            </div>
            <div class="trending-contens">
              {{-- bara de navegacion de apuntes con imagenes --}}
              <ul id="trending-slider-nav" class="list-inline p-0 mb-0 row align-items-center">
                @php $z=1; @endphp
                @foreach($cursos as $dataCurPreg)            
                  {{-- se genera un li por cada imagen para apuntes --}}
                  <li>
                    <a href="javascript:void(0);">
                      <div class="movie-slick position-relative">
                        <img src="{{ asset($dataCurPreg['img_curso']) }}" class="img-fluid" alt="">
                        <img src="" class="img-fluid" alt="">
                      </div>
                    </a>
                  </li>
                  {{-- se genera un li por cada imagen para apuntes ends --}}
                  @php $z=$z+1; @endphp
                @endforeach 
              </ul>
              {{-- bara de navegacion de apuntes con imagenes ends --}}

              {{-- slider de apuntes y tabs --}}
              <ul id="trending-slider" class="list-inline p-0 m-0 d-flex align-items-center">
                {{-- los detalles de apuntes se genera por cada li --}}
                @php $X=1; @endphp
                @php $a = 1; @endphp
                @foreach($cursos as $dataCurPregL)   
                  @php $Xz=0; @endphp
                  @foreach($clases as $clasDataL)
                    @if($clasDataL['id_curso'] == $dataCurPregL['id'] )
                      @php $Xz=$Xz+1; @endphp
                    @endif
                  @endforeach
                  <li>
                    {{-- <div class="tranding-block position-relative" style="background-image: url({{ asset($dataCurPregL['img_curso']) }});"> --}}
                    <div class="tranding-block position-relative" style="">
                      <div class="trending-custom-tab">
                        {{-- contenido de los tabs de apuntes --}}
                        <div class="trending-content">
                          {{-- datos para la tab 1 --}}
                          <div id="trending-data{{ $X }}" class="overview-tab tab-pane fade active show">
                            <div class="trending-info align-items-center w-100 animated fadeInUp">
                              <div class="row milineaapunte">
                                <div class="detalleApuntes">
                                  {{-- logo del productor de contenido --}}
                                  <a href="javascript:void(0);" tabindex="0">
                                    <div class="res-logo">
                                      <div style="height: 50px; width: 150px;" class="channel-logo">
                                        {{-- <img style=" height: 100%; width: 100%; object-fit: contain;" src="{{ asset($creador[0]['logo_creador']) }}" class="c-logo" alt=""> --}}
                                      </div>
                                    </div>
                                  </a>
                                  {{-- logo del productor de contenido ends --}}
                                  <h1 class="trending-text big-title text-uppercase" style="padding-top: 5%; padding-bottom: 5%; font-size: 2em; line-height: 50px;">{{ $dataCurPregL['titulo_curso'] }}</h1>
                                  <div class="d-flex align-items-center text-white text-detail">
                                    <span class="badge badge-secondary p-3" style="font-size: 0.8em;">{{ $dataCurPregL['clasifi_curso'] }}</span>
                                    <span class="ml-3">{{ $Xz }} Lecciones</span>
                                    {{-- <span class="trending-year">2020</span> --}}
                                  </div>
                                  <div class="d-flex align-items-center series mb-4">
                                    <a href="javascript:void(0);">
                                      <img src="{{ asset("uploads/miu/top10.png") }}" class="img-fluid" alt="">
                                    </a>
                                    <span class="text-gold ml-3">#2 hasta hoy</span>
                                  </div>
                                  <p class="trending-dec" style="font-size: 0.8em;">
                                    {!! $dataCurPregL['descrip_curso'] !!}
                                  </p>
                                  <div class="p-btns">
                                    <div class="d-flex align-items-center p-0">
                                    </div>
                                  </div>
                                  <div class="trending-list mt-4">
                                    <div class="text-primary title">
                                      Estilista : 
                                      <span class="text-body">
                                        {{ $creador[0]['nomemp_creador'] }}
                                      </span>
                                    </div>
                                    <div class="text-primary title">
                                      Tipo :
                                      <span class="text-body">
                                        {{ $dataCurPregL['tipvalora_curso'] }}
                                      </span>
                                    </div>
                                    <div class="text-primary title">
                                      Coproductor :
                                      <span class="text-body">
                                        {{ $dataCurPregL['coprod_curso'] }}
                                      </span>
                                    </div>
                                  </div>
                                </div>
                                {{-- zona de acordeon star --}}
                                <div class="detalle-clases" style="max-height: 100%; overflow-y: auto;">
                                    {{-- @php $a = 1; @endphp --}}
                                    @foreach($clases as $clasDataT)
                                      @if($clasDataT['id_curso'] == $dataCurPregL['id'] )  
                                        <section class="ac-container">
                                              <div>
                                                <input id="ac-{{ $a }}" name="accordion-1" type="radio">
                                                <label style="font-size: 1em;" for="ac-{{ $a }}">{{ $clasDataT['titulo_clase'] }}</label>
                                                <article class="ac-small" style="background-color: #FFFFFF;">
                                                  <p style="font-size: 1em;">{!! $clasDataT['detalle_clase'] !!}</p>
                                                </article>
                                              </div>
                                        </section>
                                        @php $a++ @endphp
                                      @endif
                                    @endforeach
                                </div>
                                {{-- zona de acordeon end --}}
                              </div>
                            </div>
                          </div>
                          {{-- datos para la tab 1 ends --}}
                        </div>
                        {{-- contenido de los tabs de apuntes ends --}}
                      </div>
                    </div>
                  </li>
                  {{-- los detalles de apuntes se genera por cada li ends --}}
                  @php $X=$X+1; @endphp                
                @endforeach 
              </ul>
              {{-- slider de apuntes ends --}}
            </div>
          </div>
        </div>
      </div>
    </section>
    {{-- trending section PARA APUNTES POR LECCIONES ends --}}
  </div>
  {{-- main content end  --}}

  {{-- footer starts  --}}
  <footer class="iq-bg-dark">
    <div class="footer-top">
      <div class="container-fluid">
        <hr>
        <div class="row footer-standard">
          <div class="col-lg-5">
            <div class="widget text-left">
              <div>
                {{-- <ul class="menu p-0">
                  <li><a href="#">Terms of Use</a></li>
                  <li><a href="#">Privacy-Policy</a></li>
                  <li><a href="#">FAQ</a></li>
                  <li><a href="#">Watch List</a></li>
                </ul>  --}}
              </div>
            </div>
            <div class="widget text-left">
              <div class="textwidget">
                {{-- <p><small>This is Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, quo tempore. Quasi rem rerum est in nulla atque quibusdam illo. this is footer and simple tsesxij is writen jkd. fsek hello how are you. please like and subscribe. footer ends .</small></p> --}}
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
          </div>
          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
            <div class="widget text-left">
              <div class="textwidget">
                {{-- <h6 class="footer-link-title">
                  NetFlix App 
                </h6> --}}
                <div class="d-flex align-items-center">
                  {{-- <a href="#"><img src="images/footer/01.jpg" alt=""></a> --}}
                  {{-- <br> --}}
                  {{-- <a href="#" class="ml-3"><img src="images/footer/02.jpg" alt=""></a> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer end -->

  <!-- js files  -->
  <script src="{{ asset("vendor/crudbooster/assets/js/miu/jquery-3.4.1.min.js") }}"></script>
  <script src="{{ asset("vendor/crudbooster/assets/js/miu/popper.min.js") }}"></script>
  <script src="{{ asset("vendor/crudbooster/assets/js/miu/bootstrap.min.js") }}"></script>
  <script src="{{ asset("vendor/crudbooster/assets/js/miu/slick.min.js") }}"></script>
  <script src="{{ asset("vendor/crudbooster/assets/js/miu/owl.carousel.min.js") }}"></script>
  <script src="{{ asset("vendor/crudbooster/assets/js/miu/select2.min.js") }}"></script>
  <script src="{{ asset("vendor/crudbooster/assets/js/miu/jquery.magnific-popup.min.js") }}"></script>
  <script src="{{ asset("vendor/crudbooster/assets/js/miu/slick-animation.min.js") }}"></script>

  <script src="{{ asset("vendor/crudbooster/assets/js/miu/main_nf.js") }}"></script>

  {{-- <script type="text/javascript" src="{{ asset("vendor/crudbooster/assets/js/home/JWPlayerversion8.27.1.js") }}"></script>  --}}

 <script>
    $('#exampleModal').on('shown.bs.modal', function (event) {
      $('#iframeVideo{{ $x }}').attr('src', '{{ $dataCur['vidintro_curso'] }}');
    });
    $('#exampleModal').on('hidden.bs.modal', function (event) {
      $('#iframeVideo{{ $x }}').removeAttr('src', null);
    });
  </script>

</body>

</html>