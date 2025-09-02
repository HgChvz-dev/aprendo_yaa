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

  <meta http-equiv='pragma' content='no-cache'>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0px;
      padding: 0px;
    }
    body {
      font-family: 'Roboto Condensed', sans-serif;
      width: 1080px;
      height: 780px;
      animation: opacidad 1s alternate;
      background-image: url( {{ asset("uploads/miu/certificado.png") }});
      background-color: #cccccc;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    } 
    .codigo{
      background-color: transparent;
      margin-top: 180px;
      padding-left: 70px;
      text-align: center;
    }
    .txtcodigo{
      background-color: transparent;
      color: #7E7F80;
      width: 175px;
      font-size: 0.7em;
    }
    .nombre{
      background-color: transparent;
      margin-top: 230px;
      padding-left: 70px;
      text-align: center;
    }
    .txtnombre{
      background-color: transparent;
      color: #7E7F80;
      width: 500px;
      font-size: 2em;
    }
    .fecha{
      background-color: transparent;
      margin-top: 155px;
      padding-left: 55px;
      text-align: center;
    }
    .txtfecha{
      background-color: transparent;
      color: #7E7F80;
      width: 260px;
      font-size: 1em;
    }
  </style>

</head>
<body>
  <div class="codigo">
    <p class="txtcodigo">{{ $dataCurseCer[0]['codigo_alumno'] }}</p>
  </div>
  <div class="nombre">
    <p class="txtnombre">{{ $dataCurseCer[0]['name'] }}</p>
  </div>
  <div class="fecha">
    <p class="txtfecha">{{ CRUDBooster::fechaEspanol(date('Y-m-d')) }}</p>
  </div>
</body>
</html>