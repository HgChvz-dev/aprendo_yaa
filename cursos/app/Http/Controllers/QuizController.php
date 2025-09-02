<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use CRUDBooster;

class QuizController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($post)
    {
        $idCreador = 1; 
        $semilla = "Sistema de videos, integral * y secciónes de aprendisaje";

        // desencriptar el id de la clase
        $post = CRUDBooster::base64url_decode($post);
        $result = '';
        $string = base64_decode($post);
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($semilla, ($i % strlen($semilla))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }

        $id = explode('*', $result); 

        $todasLasClases = CRUDBooster::cursoElegido($id[0], $id[1]);
        $idCursoEs = $id[1];
        $nombreCurso = $id[4];
        $tituloEmpresa = $id[5];
        $keyCurso = $id[6];

        // print("<pre>");
        // print_r($todasLasClases);
        // print("</pre>");

        return view('quiz')
        ->with('todasLasClases',$todasLasClases)
        ->with('llaves',$id[6])
        ->with('nombreCurso',$nombreCurso)
        ->with('tituloEmpresa',$tituloEmpresa)
        ->with('idCursoEs',$idCursoEs); 
    }

    public function evaluando($post)
    {
        $postLlave = $post;

        $idCreador = 1; 
        $semilla = "Sistema de videos, integral * y secciónes de aprendisaje";

        $post = explode("?", $post);
        $post = $post[0];
        
        $post = CRUDBooster::base64url_decode($post);
 
        // desencriptar el id de la clase
        $result = '';
        $string = base64_decode($post);
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($semilla, ($i % strlen($semilla))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }

        $id = explode('*', $result); 

        if ($oldLlave == "") {
            $oldLlave = $id[3];
        }

        $dataQCurse = DB::table('t_cursos')
            ->where([
                ['t_cursos.id', '=', $id[0]],
                ['t_cursos.status', '=', 'Activo'],
            ])
            ->get();
        $dataQCurse = json_decode(json_encode($dataQCurse, JSON_FORCE_OBJECT), true);

        $dataQClass = DB::table('t_clases')
            ->select(
                't_clases.id as clases_id',
                't_clases.*')
            ->where([
                ['t_clases.id','=',$id[2]],
                ['t_clases.status','=','Activo'],
            ])
            ->get();
        $dataQClass   = json_decode(json_encode($dataQClass, JSON_FORCE_OBJECT),true);

        $pregQuiz = DB::table('t_quizs')
            ->where([
                ['t_quizs.id_clase','=',$id[2]],
                ['t_quizs.status','=','Activo'],
            ])
            ->get();

        $pregQuiz = json_decode(json_encode($pregQuiz, JSON_FORCE_OBJECT),true);

        return view('evaluando')
            ->with('pregCur',$dataQCurse)
            ->with('pregCla',$dataQClass)
            ->with('pregQuiz',$pregQuiz)
            ->with('llave',$postLlave)
            ->with('oldLlave',$oldLlave);
    }

    public function final($post)
    {
        // bFlPWm82U1ZuWkZRbEpWUXBwbVVsWitqWEZDWm5xU1ZrZFNvb0ptQmpiRlN5SmE5Mk1BdURjREh1SkM3dW5pajU5Uzd4TmZBM05YYnU4RGh4OHFwdHBTRnVzMVQwTDdJdnRQZGVvakF4Y3JldHNySTVtNlRrNnFFdUpyVnlOUXZBY09ydlZhNnZYcXgxTjdKMXNXYzM1SzhxN2Vjek9LdnhNUjNxcHB0NEtxV3h0dmlwSHJqbnEyUG1aeVI
        // $idCreador = 1; 

        $postN = CRUDBooster::base64url_decode($post);
        $semilla = "Sistema de videos, integral * y secciónes de aprendisaje";

        // desencriptar el id de la clase
        $result = '';
        $string = base64_decode($postN);
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($semilla, ($i % strlen($semilla))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }

        // "000000000000000000000000*bG4yWm82U1ZuWkZRbEpWUXBwbVVsWitqVmxTVDI3eVh3ZUdYdjNhWWVyOXgzNis1dE5reklNUFJ6VXZPdldha3l1RFd3YnJWcWF5MjA2aloxZz09*2*0"

        $idQ = explode('*',$result);
        // array:4 [▼
        //   0 => "000000000000000000000000"
        //   1 => "bG4yWm82U1ZuWkZRbEpWUXBwbVVsWitqVmxTVDI3eVh3ZUdYdjNhWWVyOXgzNis1dE5reklNUFJ6VXZPdldha3l1RFd3YnJWcWF5MjA2aloxZz09"
        //   2 => "2"
        //   3 => "0"
        // ]        
        $idH =  CRUDBooster::base64url_decode($idQ[1]);
        // ln2Zo6SVnZFQlJVQppmUlZ+jVlST27yXweGXv3aYer9x36+5tNkzIMPRzUvOvWakyuDWwbrVqay206jZ1g==

        $result = '';
        $string = base64_decode($idH);
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($semilla, ($i % strlen($semilla))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }

        // 1*0000000000000000*4*mH2Zo6SVnZFQlJVQppmUlZ+jXFCZnqSVl6KLnUpc
        $idH = explode('*', $result); 
        $status = "Activo";
        // dd($idH);
        // array:4 [▼
        //   0 => "1"
        //   1 => "0000000000000000"
        //   2 => "4"
        //   3 => "mH2Zo6SVnZFQlJVQppmUlZ+jXFCZnqSVl6KLnUpc"
        // ]
        $dataInsert = $idQ[2]."|".$idH[0]."|".$idH[2]."*".$idQ[3]."*".date('Y-m-d')."|".$status."|".$idH[2];
        $resultInsert = CRUDBooster::guardaResultado($dataInsert);

        return view('final');
    }


}
