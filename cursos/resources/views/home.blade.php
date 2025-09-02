<?php
$codigo = CRUDBooster::genCode(Auth::user()->id,Auth::user()->name);

$cantidadCursos = CRUDBooster::buscaCursosAlumno(Auth::user()->id);
$cursoElegido = CRUDBooster::cursoElegido($cantidadCursos[0]['id_creador'],$cantidadCursos[0]['curso_id']);

$uriEs = $_SERVER["REQUEST_URI"];

$cantUri = explode("/", $uriEs);

$alumno = Auth::user()->id;
$elCursoEs = $cantidadCursos[0]['curso_id'];
$elCreadorEs = $cantidadCursos[0]['creador_id'];
$tituloCurso = $cantidadCursos[0]['titulo_curso'];
$tituloEmpresa = $cantidadCursos[0]['nomemp_creador'];
$keyCurso = $keyCurso;

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

$imgFondo = $clases[0]['img_curso']; 

// print("<pre>");
// print_r($cursoElegido);
// print("</pre>");
// exit();
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
    
    <title>.:: {{ $cantidadCursos[0]['nomemp_creador'] }} ::.</title>
    <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/css/plantilla/estilos_p.css") }}">
    <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assetscss/video/plyr.3.7.8.css") }}">

    <script src="{{ asset("vendor/crudbooster/assets/js/plantilla/kit-fontawesome.js") }}"></script>
    <script src="{{ asset("vendor/crudbooster/assets/js/video/plyr.3.7.8.js") }}"></script>
<style>
    body {
        background-color: #eba2bb;
        background-image: url("uploads/miu/FONDO_1.jpeg");
    }
    main {
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
        color: #FFFFFF;
    }  

</style>

</head>
<body id="body">
    
    <header>
        <div class="logo">
            <div class="centerObjeto">
                <div class="divImg" style="background-image: url({{ asset($cantidadCursos[0]['icono_creador']) }})"></div>
            </div>
            <div class="centerObjeto">
                {{ $cantidadCursos[0]['nomemp_creador'] }}
            </div>
        </div>

        <div class="icon__menu">
            <span style="width: 20%;">
                <i class="fas fa-bars" id="btn_open"></i> Menu 
            </span>
            <div class="tituloCreador">
                <span style="font-size: 0.8em;">{{ Auth::user()->name }}</span>
                <a style="font-size: 0.5em;" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Salir') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>              
            </div>
        </div>
    </header>

    <div class="menu__side" id="menu_side">
        <div class="options__menu"> 
          <details style="margin-bottom: 10px;" class="warning" open>
            <summary>Modulo de Bienvenida</summary>
                <div class="option">
                    <a style="display: flex; margin-bottom: 0;" href="{{ url('/home/'.myEncrypt($cursoElegido[0]['id']."*000000000000000000000000*".$cursoElegido[0]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;">-</div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">Introducción (Video de introducción</h5>
                        </div>
                    </a>
                </div>
          </details>
          <details style="margin-bottom: 10px;" class="warning">
            <summary>Modulo Teoria de los Recogidos Texturizados</summary>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[1]['id']."*000000000000000000000000*".$cursoElegido[1]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;">-</div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">Lección Teórica Parte #1 </h5>
                        </div>
                    </a>
                </div>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[2]['id']."*000000000000000000000000*".$cursoElegido[2]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;">-</div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">Lección Teórica Parte #2 </h5>
                        </div>
                    </a>
                </div>
          </details>
          <details style="margin-bottom: 10px;" class="warning">
            <summary>Modulo de Practica</summary>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[3]['id']."*000000000000000000000000*".$cursoElegido[3]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;"></div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">1) RECOGIDO ESTILO DE NOCHE CLASICO</h5>
                        </div>
                    </a>
                </div>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[4]['id']."*000000000000000000000000*".$cursoElegido[4]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;"></div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">2) RECOGIDO ESTILO EUROPEO</h5>
                        </div>
                    </a>
                </div>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[5]['id']."*000000000000000000000000*".$cursoElegido[5]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;"></div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">3) RECOGIDO ESTILO DE NOCHE TEXTURIZADO</h5>
                        </div>
                    </a>
                </div>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[6]['id']."*000000000000000000000000*".$cursoElegido[6]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;"></div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">4) COLETA TEXTURIZADA</h5>
                        </div>
                    </a>
                </div>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[7]['id']."*000000000000000000000000*".$cursoElegido[7]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;"></div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">5) RECOGIDO ESTILO EUROPEO TEXTURIZADO</h5>
                        </div>
                    </a>
                </div>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[8]['id']."*000000000000000000000000*".$cursoElegido[8]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;"></div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">6) PEIDADO ESTILO GRIEGO</h5>
                        </div>
                    </a>
                </div>
          </details>
          <details style="margin-bottom: 10px;" class="warning">
            <summary>Bonos</summary>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[9]['id']."*000000000000000000000000*".$cursoElegido[9]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;">-</div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">Master Class Coleta Sencilla</h5>
                        </div>
                    </a>
                </div>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[10]['id']."*000000000000000000000000*".$cursoElegido[10]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;">-</div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">Master Class Recogido con lazo texturizado</h5>
                        </div>
                    </a>
                </div>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[12]['id']."*000000000000000000000000*".$cursoElegido[12]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;">-</div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">Master Class Accesorios para los peinados</h5>
                        </div>
                    </a>
                </div>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[13]['id']."*000000000000000000000000*".$cursoElegido[13]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;">-</div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">Masster Class Diagnostico Capilar</h5>
                        </div>
                    </a>
                </div>
          </details>
          <details style="margin-bottom: 10px;" class="warning">
            <summary>Recapitulación del Curso La Base de Los Recogidos</summary>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[11]['id']."*000000000000000000000000*".$cursoElegido[11]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;">-</div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">Clase de Recopilación del curso</h5>
                        </div>
                    </a>
                </div>
          </details>
          <details style="margin-bottom: 10px;" class="warning">
            <summary>Espacio Exclusivo</summary>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[14]['id']."*000000000000000000000000*".$cursoElegido[14]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;">-</div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">3 Secretos para un peinado perfecto - Primera clase</h5>
                        </div>
                    </a>
                </div>
                <div class="option">
                    <a style="display: flex; margin-bottom: 5px;" href="{{ url('/home/'.myEncrypt($cursoElegido[15]['id']."*000000000000000000000000*".$cursoElegido[15]['id_curso']."*".$alumno,$semilla)) }}" class="selected">
                        <div style="padding-left: 15px;">-</div>
                        <div class="elTitle">
                            <h5 style="padding-left: 10px;">3 Secretos para un peinado perfecto - Segunda clase</h5>
                        </div>
                    </a>
                </div>
          </details>
            <br><hr><br>
            <a style="display: flex; margin-bottom: 5px;" href="https://www.facebook.com/groups/480687373986655/?ref=share_group_link" target="_blank">
                <div class="elTitle">
                    <h5 style="padding: 0 10px 0 10px; text-align: center;">Únete a nuestro grupo privado de FACEBOOK:</h5>
                </div>
            </a>
      
        </div>
        <br><br><br><br>
    </div>

    <main>
        @php 
            if(count($cantUri,COUNT_RECURSIVE) != 4){ 
        @endphp
            <section>
                <article class="img__ini">
                    <div class="main1">
                        <div style="padding:56.25% 0 0 0;position:relative;">
                            <iframe src="https://player.vimeo.com/video/930477526?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="video_guia"></iframe>
                        </div>
                        <div>
                            <p>! Importante ¡</p>
                            <p>Una vez habiendo terminado de ver los videos debes ir al área de evaluaciones, para que una vez, habiendo terminado el curso, obtengas tu certificación.</p>
                            <p>Las evaluaciones únicamente aplican para el MÓDULO TEORÍA DE LOS RECOGIDOS TEXTURIZADOS y MÓDULO DE PRÁCTICA.</p>
                            <br>
                            <p>Tomar en cuenta que la puntuación minima para acceder a la certificación es de 80%.</p>
                            {{-- <img src="uploads/miu/cristina_presenta.jpeg" loading="lazy" width="100" height="100"> --}}
                        </div>
                    </div>
                </article>
            </section> 
        @php
            } else { 
        @endphp
                <h1>{{ $clases[0]['titulo_clase'] }}</h1>
                <section>
                    <article class="breaking">
                        <div style="padding:56.25% 0 0 0;position:relative;">
                            <iframe src="{!! asset($clases[0]['codevid_class']) !!}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="0 introduccion"></iframe>
                        </div>
                    </article>
                </section> 

                <section>
                    <article>
                        @php
                            $paraEvaluar = myEncrypt($elCreadorEs
                                ."*"
                                .$elCursoEs
                                ."*000000000000000000000000*"
                                .$alumno
                                ."*"
                                .$tituloCurso
                                ."*"
                                .$tituloEmpresa
                                ."*"
                                .$keyCurso
                                ,$semilla);
                            $dataEvalua = CRUDBooster::base64url_encode($paraEvaluar);
                        @endphp
                        <a class="button" href="{{ url('/quiz/'.$dataEvalua) }}">
                          <i class="fa fa-list"></i>&nbsp;
                          Evaluar lección 
                        </a>
                    </article>
                </section> 

                <section>
                    <article class="breaking">
                        <div class="tabs">
                            {{-- comentario de miembros --}}
                            <div class="tabby-tab">
                                <input type="radio" id="tab-1" name="tabby-tabs" checked>
                                <label for="tab-1">Area de Miembros</label>
                                <div style="overflow-y: auto;" class="tabby-content">
                                    <form action="{{ route('home.store') }}" method="POST" name="frm_aporte" style="width: 100%;">
                                        <dir class="divTexto">
                                            <div class="divText"></div>
                                            @csrf
                                            <input type="hidden" name="txth_key" value="{{ $keyCurso }}">
                                            <input type="hidden" name="txth_curso" value="{{ $tokenId[2] }}">
                                            <input type="hidden" name="txth_alumno" value="{{ $alumno }}">
                                            <input type="hidden" name="txth_fecha" value="{{ date('Y-m-d') }}">
                                            <input type="hidden" name="txth_status" value="Activo">
                                            <input type="text" name="txt_apunte" class="css-input" placeholder="Ingrese su comentario" required="required">
                                            <input type="submit" name="submitButton" maxlength="250" value="Enviar">
                                        </dir>
                                    </form>

                                    <div class="comments-container">
                                        <ul id="comments-list" class="comments-list">
                                            <li>
                                                @if(!empty($aporte))
                                                    @foreach($aporte as $losAportes)
                                                        <div class="comment-main-level">
                                                            <!-- Avatar -->
                                                            <div class="comment-avatar"><img src="{{ asset("uploads/miu/noimage.png") }}" alt=""></div>
                                                            <!-- Contenedor del Comentario -->
                                                            <div class="comment-box">
                                                                <div class="comment-head">
                                                                    <h6 class="comment-name by-author">
                                                                        <a href="">
                                                                            <span>{{ $losAportes['name'] }}</span>
                                                                        </a>
                                                                    </h6>
                                                                </div>
                                                                <div class="comment-content">
                                                                    <span>{{ $losAportes['detalle_aporte'] }}</span>
                                                                    <div class="comment-footer">
                                                                        <span>Publicado: {{ CRUDBooster::fechaEspanol($losAportes['fecha_aporte']) }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p style="text-align: left; line-height: 1;">
                                                        <span style="font-size: 1rem; font-weight: 700;">Sin datos para mostrar!!!</span>
                                                    </p>                            
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            {{-- material de apoyo --}}
                            <div class="tabby-tab">
                                <input type="radio" id="tab-2" name="tabby-tabs">
                                <label for="tab-2">Material de Apoyo</label>
                                <div style="overflow-y: auto;" class="tabby-content">
                                    <div class="divApoyo">
                                        <div style="margin-top: 20px;" class="comment-box">
                                            <div class="comment-head-apoyo">
                                                <span>Detalle del material de apoyo</span>
                                            </div>
                                            <div class="comment-content-apoyo">
                                                @if(!empty($materiales))
                                                    @foreach($materiales as $dataMaterial)
                                                        <p style="text-align: left; line-height: 1;">
                                                            <span style="font-size: 0.75rem;">{!! $dataMaterial['detalle_material'] !!}</span>
                                                        </p>
                                                        <div class="comment-footer-apoyo">
                                                            Publicado: {{ CRUDBooster::fechaEspanol($dataMaterial['fecreg_material']) }}
                                                        </div>
                                                        <hr>
                                                    @endforeach
                                                @else
                                                    <p style="text-align: left; line-height: 1;">
                                                        <span style="font-size: 1rem; font-weight: 700;">Sin datos para mostrar!!!</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- tabla de evaluacion --}}
                            <div class="tabby-tab">
                                <input type="radio" id="tab-3" name="tabby-tabs">
                                <label for="tab-3">Evaluaciones</label>
                                <div style="overflow-y: auto;" class="tabby-content">
                                    @if(!empty($evaluacion))
                                        <table class="tg" style="undefined;table-layout: fixed; width: 95%">
                                            <colgroup>
                                                <col style="width: 5%">
                                                <col style="width: 65%">
                                                <col style="width: 10%">
                                                <col style="width: 10%">
                                                <col style="width: 10%">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th class="tg-375j" colspan="5">Detalle de evaluaciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $resultEval = explode("|",$evaluacion[0]['rp1_result']);
                                                    sort($resultEval,0);
                                                    $promedio = 0;
                                                    $np = 0;
                                                    $existe = 0;
                                                @endphp
                                                @foreach ($resultEval as $value)
                                                    @php
                                                        $detalle = explode("*",$value);
                                                        if ($existe != $detalle[0]) {
                                                            $promedio = $promedio + $detalle[1];
                                                            $nombClase = CRUDBooster::sacarClasePorId($detalle[0]);
                                                            $np = $np + 1;
                                                            $existe = $detalle[0];
                                                    @endphp
                                                            <tr>
                                                                <td class="tg-4nwd">{{ $np }}</td>
                                                                <td class="tg-4nwd">{{ $nombClase[0]['titulo_clase'] }}</td>
                                                                <td class="tg-4nwd">{{ $nombClase[0]['ptaprueba_clase']."%" }}</td>
                                                                @php
                                                                    if ($nombClase[0]['ptaprueba_clase'] > $detalle[1]) {
                                                                @endphp
                                                                        <td class="tg-4nwd" style="background-color: red;">{{ $detalle[1]."%" }}</td>
                                                                @php
                                                                    } else {
                                                                @endphp
                                                                        <td class="tg-4nwd" style="background-color: green;">{{ $detalle[1]."%" }}</td>
                                                                @php
                                                                    }
                                                                @endphp
                                                                <td class="tg-4nwd">{{ $detalle[2] }}</td>
                                                            </tr>
                                                    @php
                                                        }
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p style="text-align: left; line-height: 1;">
                                            <span style="font-size: 1rem; font-weight: 700;">Sin datos para mostrar!!!</span>
                                        </p>
                                    @endif
                                    @if(!empty($evaluacion))
                                        @php
                                            $puntajeVence = $evaluacion[0]['puntaje_curso'];
                                            if (($promedio/($clasesTotal-4)) >= $puntajeVence) {
                                        @endphp
                                                <section>
                                                    <article></article>
                                                    <article>
                                                        <a class="button" href="{{ url('/certifica/'.CRUDBooster::base64url_encode(myEncrypt(
                                                            $elCreadorEs
                                                            ."*"
                                                            .$elCursoEs
                                                            ."*000000000000000000000000*"
                                                            .$alumno."*"
                                                            .$tituloCurso
                                                            ."*"
                                                            .$tituloEmpresa
                                                            ."*"
                                                            .$keyCurso
                                                            ,$semilla))) }}">
                                                            <i class="fa fa-list"></i>&nbsp;
                                                            Emitir Certificado
                                                        </a>
                                                    </article>
                                                </section> 
                                            @php  
                                                } else { 
                                            @endphp
                                                <p style="color: #FFFFFF; font-size: 1em;">
                                                    El puntaje de aprobación del curso es de <span>{{ $puntajeVence }}</span>%
                                                </p>
                                        @php
                                            }
                                        @endphp  
                                    @endif 
                                </div>
                            </div>
                        </div>
                    </article>            
                </section>

        @php 
            } 
        @endphp

    </main>

    <script src="{{ asset("vendor/crudbooster/assets/js/plantilla/script_p.js") }}"></script>
    <script src="{{ asset("vendor/crudbooster/assets/js/video/v_player.js") }}"></script>
        {{-- <script src="https://player.vimeo.com/api/player.js"></script> --}}
</body>
</html>

