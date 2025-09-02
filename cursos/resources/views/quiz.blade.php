<?php
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

/* poner en tabla campo img y color para fondo sistema */
$imgFondo = "uploads/miu/FONDO_1.jpeg"; 


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
    <title>.:: Sistema de Evaluación ::.</title>
    
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

</style>	

</head>
<body>
    <div class="container" id="cantainer">
        <div class="left">
            <div class="logo">
                {{ $tituloEmpresa }}
            </div>
            <h2>
                Sistema de evaluación de capacitación y aprendizaje
            </h2>
        </div>
        @php if (count($todasLasClases) > 1): @endphp
            <div class="right">
                <h3><i class="fas fa-computer-classic"></i> {{ $nombreCurso }}</h3>
                <div class="categorias">
                    @foreach($todasLasClases as $clasQData)
                        @php
                            $dataEvalua = myEncrypt(
                                $idCursoEs
                                ."*0000000000000000*"
                                .$clasQData['id']
                                ."*"
                                .$llaves
                                ,$semilla);
                            $dataEvalua = CRUDBooster::base64url_encode($dataEvalua);
                        @endphp
                        <div class="categoria">
                            <a href="{{ url('/evaluando/'.$dataEvalua) }}">{{ $clasQData['titulo_clase'] }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @php else: @endphp
            <div class="noRight">
                <h3>El curso no cuenta con evaluación para su certificación</h3>
            </div>
        @php endif @endphp

        <footer>
	        @auth
	          <a href="{{ url('/home/'.$llaves) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                <i class="fas fa-arrow-circle-left"></i> Retornar a las lecciónes
	          </a>
	        @else
	          <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
	            <span class="btn btn-hover iq-button">
	              <i class="fa fa-play mr-1"></i>
	              Ingresar
	            </span>
	          </a>
	        @endauth
        </footer>
    </div>
</body>
</html>