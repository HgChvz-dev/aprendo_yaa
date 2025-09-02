<?php

session_start();

// print("<pre>");
// print_r($_SESSION);
// print("</pre>");

// print("<pre>");
// print_r($_POST);
// print("</pre>");


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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/quiz/estilo_qz.css") }}">
    <title>Evaluación - Leccion: {{ $_SESSION['tituloLeccion'] }}</title>

    <style>
        body {
            background: url( {{ asset("uploads/miu/fondo.jpg") }}  );
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: red;
            color: white;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-final" id="container-final">
        <div class="info">
            <h2>RESULTADO FINAL</h2>
            <h3>Leccion: {{ $_SESSION['tituloLeccion'] }}</h3>
            <div class="estadistica">
                <div class="acierto">
                    <span class="correctas numero"> 
                        {{ $_SESSION['correctas'] }}
                    </span>
                    CORRECTAS
                </div>
                <div class="acierto">
                    <span class="incorrectas numero"> 
                        {{ $_SESSION['incorrectas'] }}
                    </span>
                    INCORRECTAS
                </div>
            </div>
            <div class="score">
                <div class="box">
                    <div class="chart" data-percent="{{ $_SESSION['score'] }}">
                       {{ $_SESSION['score'] }}%
                    </div>
                    <h2>SCORE</h2>
                </div>
            </div>

            <a href="{{ url('/') }}">Retornar al curso</a>

        </div>
    </div>
    <script src="{{ asset("vendor/crudbooster/assets/js/quiz/juego.js") }}"></script>    
</body>
</html>
@php
 session_destroy();
@endphp