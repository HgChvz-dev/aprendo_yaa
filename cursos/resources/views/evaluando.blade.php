<?php
session_start();

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

$totalPreguntasPorJuego = $pregCla[0]['cantpreg_clase'];
$totPre = $pregCla[0]['cantpreg_clase'];

$styloIn = ""; 
$styloOut = "";
$dataFinal = "";

$_SESSION['tituloLeccion'] = $pregCla[0]['titulo_clase'];

if(isset($_GET['siguiente'])){
    if($_SESSION['respuesta_correcta']==$_GET['vr']){
        $_SESSION['correctas'] = $_SESSION['correctas'] + 1;
    }

    $_SESSION['numPreguntaActual'] = $_SESSION['numPreguntaActual'] + 1;

    if ($_SESSION['numPreguntaActual'] < $totPre ) {
        if($_SESSION['numPreguntaActual'] < ($totalPreguntasPorJuego)){
            $preguntaActual = CRUDBooster::obtenerPreguntaPorId($_SESSION['idPreguntas'][ $_SESSION['numPreguntaActual']]);
            $_SESSION['respuesta_correcta'] = $preguntaActual[0]['corre_quiz'];
        }else{
            $_SESSION['incorrectas'] = $totalPreguntasPorJuego - $_SESSION['correctas'];
            $_SESSION['score'] = ($_SESSION['correctas'] * 100)/$totalPreguntasPorJuego;
            $alumnoSera = Auth::user()->id;
            $scoreSera = $_SESSION['score'];

            $dataFinal = myEncrypt(
                "000000000000000000000000*"
                .$llave
                ."*"
                .$alumnoSera
                ."*"
                .$scoreSera
                ,$semilla);
            
            $dataFinal = CRUDBooster::base64url_encode($dataFinal);

            $styloIn = "display: block";
            $styloOut = "display: none;";
        }
    } else {
        $_SESSION['incorrectas'] = $totalPreguntasPorJuego - $_SESSION['correctas'];
        $_SESSION['score'] = ($_SESSION['correctas'] * 100)/$totalPreguntasPorJuego;
        $alumnoSera = Auth::user()->id;
        $scoreSera = $_SESSION['score'];

        $dataFinal = myEncrypt(
            "000000000000000000000000*"
            .$llave
            ."*"
            .$alumnoSera
            ."*"
            .$scoreSera
            ,$semilla);

        $dataFinal = CRUDBooster::base64url_encode($dataFinal);

        $styloIn = "display: block";
        $styloOut = "display: none;";
    }
}else{
    $_SESSION['correctas']=0;
    $_SESSION['numPreguntaActual'] = 0;
    $_SESSION['preguntas'] = CRUDBooster::obtenerIdsPreguntasPorCategoria($pregCla[0]['clases_id']);
    $_SESSION['idPreguntas'] = array();

    foreach ($_SESSION['preguntas'] as $idPregunta) {
        array_push($_SESSION['idPreguntas'],$idPregunta['id']); // Item agregado
    }
    shuffle($_SESSION['idPreguntas']);
    $preguntaActual = CRUDBooster::obtenerPreguntaPorId($_SESSION['idPreguntas'][0]);
    $_SESSION['respuesta_correcta'] = $preguntaActual[0]['corre_quiz'];
}

// $imgFondo = $pregCur[0]['img_curso']; 
$imgFondo = $imgFondo = "uploads/miu/FONDO_1.jpeg";


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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/quiz/estilo_qz.css") }}">
    <title>Evaluación - Leccion: {{ $pregCla[0]['titulo_clase'] }}</title>
    <style>
        body{
            height: 100vh;
            background: #141414;
            animation: opacidad 1s alternate;
            background-image: url( {{ asset($imgFondo) }} );
            background-color: #cccccc;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .estilo{
            color: #FFFFFF; 
            background-color: #0f0f0f; 
            border: 1px solid silver;
            opacity: 0.6;º
        }
        .submitDiv {
            {{ $styloOut }}
        }
        .finalDiv {
            {{ $styloIn }}
        }
    </style>    
</head>

<body>

    <div class="container-juego" id="container-juego">
        <header class="header">
            <div class="categoria">
                {{ $pregCla[0]['titulo_clase'] }}
            </div>
        </header>
        <div class="info">
            @if(!empty($pregQuiz))
                <div class="estadoPregunta">
                    Pregunta <span class="numPregunta">{{ $_SESSION['numPreguntaActual'] + 1 }}</span> de {{ count($pregQuiz) }}
                </div>
                <h3>
                    {{ $preguntaActual[0]['pregu_quiz'] }}
                </h3>
                <form action="{{ url('/evaluando/'.$llave) }}" method="GET">
                    <div class="opciones">
                        <label for="respuesta1" onclick="seleccionar(this)" class="op1">
                            <p>{{ $preguntaActual[0]['respa_quiz'] }}</p>
                            <input type="radio" name="vr" value="A" id="respuesta1" required>
                        </label>
                        <label for="respuesta2" onclick="seleccionar(this)" class="op2">
                            <p>{{ $preguntaActual[0]['respb_quiz'] }}</p>
                            <input type="radio" name="vr" value="B" id="respuesta2" required>
                        </label>
                        <label for="respuesta3" onclick="seleccionar(this)" class="op3">
                            <p>{{ $preguntaActual[0]['respc_quiz'] }}</p>
                            <input type="radio" name="vr" value="C" id="respuesta3" required>
                        </label>
                        <label for="respuesta4" onclick="seleccionar(this)" class="op4">
                            <p>{{ $preguntaActual[0]['respd_quiz'] }}</p>
                            <input type="radio" name="vr" value="D" id="respuesta4" required>
                        </label>
                    </div>

                    <div class="submitDiv">
                        <div class="boton">
                            <input type="submit" value="Siguiente" name="siguiente">
                        </div>
                    </div>

                    <div class="finalDiv">
                        <div class="retornofin">
                            <a href="{{ url('/final/'.$dataFinal) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                                <i class="fas fa-arrow-circle-left"></i>&nbsp; Finalisar
                            </a>
                        </div>
                    </div>

                    <div class="retorno">
                        <a href="{{ url('/home/'.$oldLlave) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                            <i class="fas fa-arrow-circle-left"></i>&nbsp;Retornar al curso
                        </a>                    
                    </div>
                </form>
            @else
                <div class="estadoPregunta">
                    <p><h1>La lección no cuenta con preguntas</h1></p>
                </div>                
                <div class="retorno">
                    <a href="{{ url('/home/'.$oldLlave) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                        <i class="fas fa-arrow-circle-left"></i> Retornar al curso
                    </a>                    
                </div>
            @endif
        </div>
    </div>

    <script src="{{ asset("vendor/crudbooster/assets/js/quiz/script_qz.js") }}"></script>

</body>
</html>