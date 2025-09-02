<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\t_aporte;
use PDF;
use CRUDBooster;

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index()
    {
        return view('home');
    }

    public function buscar($post)
    {
        $idCreador = 1;

        $resulta = CRUDBooster::desenCripta($post);

        $id = explode('*', $resulta); 

        // sacamos las clases por id
        $dataClass = DB::table('t_clases')
            ->join('t_creadors','t_clases.id_creador','=','t_creadors.id')
            ->join('t_cursos','t_clases.id_curso','=','t_cursos.id')
            ->select(
                't_clases.id as clases_id',
                't_creadors.id as creador_id',
                't_cursos.id as cursos_id',
                't_clases.*',
                't_creadors.*',
                't_cursos.*')
            ->where([
                ['t_clases.id','=',$id[0]],
                ['t_clases.id_curso','=',$id[2]],
                ['t_creadors.status','=','Activo'],
                ['t_cursos.status','=','Activo'],
                ['t_clases.status','=','Activo'],
            ])
            ->get();
        $dataClass   = json_decode(json_encode($dataClass, JSON_FORCE_OBJECT),true);

        // sacamos todas las clase
        $allClass = DB::table('t_clases')
            ->join('t_creadors','t_clases.id_creador','=','t_creadors.id')
            ->join('t_cursos','t_clases.id_curso','=','t_cursos.id')
            ->select(
                't_clases.id as clases_id',
                't_creadors.id as creador_id',
                't_cursos.id as cursos_id',
                't_clases.*',
                't_creadors.*',
                't_cursos.*')
            ->where([
                ['t_clases.id_creador','=',$idCreador],
                ['t_clases.id_curso','=',$id[2]],
                ['t_creadors.status','=','Activo'],
                ['t_cursos.status','=','Activo'],
                ['t_clases.status','=','Activo'],
            ])
            ->get();
        $allClass   = json_decode(json_encode($allClass, JSON_FORCE_OBJECT),true);

        // archivos de la clase
        $dataRecurso = DB::table('t_recursos')
            ->where([
                ['t_recursos.id_clase','=',$id[0]],
                ['t_recursos.status','=','Activo'],
            ])
            ->get();
        $dataRecurso   = json_decode(json_encode($dataRecurso, JSON_FORCE_OBJECT),true);

        // para materiales de apoyo
        $dataMaterial = DB::table('t_materiales')
            ->where([
                ['t_materiales.id_clase','=',$id[0]],
                ['t_materiales.status','=','Activo'],
            ])
            ->get();
        $dataMaterial   = json_decode(json_encode($dataMaterial, JSON_FORCE_OBJECT),true);

        // para tabla de evaluaciones
        $dataEvalua = DB::table('t_results')
            ->join('t_cursos','t_results.id_curso','=','t_cursos.id')        
            ->where([
                ['t_results.id_alumno','=',$id[3]],
                ['t_results.id_curso','=',$id[2]],
                ['t_results.status','=','Activo']
            ])
            ->get();
        $dataEvalua   = json_decode(json_encode($dataEvalua, JSON_FORCE_OBJECT),true);

        $quizTotalClases = CRUDBooster::quizLecciones($id[2]);
        $totalCount = count($quizTotalClases);
        $totalClases = ($totalCount/10);

        $misApuntes = CRUDBooster::apuntesCurso($id[3],$id[0]);

        $losAportes = CRUDBooster::aportesCurso($id[3],$id[2],$id[0]);

        return view('home')
        ->with('clases',$dataClass)
        ->with('allclases',$allClass)
        ->with('clasesTotal',$totalClases)
        ->with('recurso',$dataRecurso)
        ->with('materiales',$dataMaterial)
        ->with('evaluacion',$dataEvalua)
        ->with('apuntes',$misApuntes)
        ->with('aporte',$losAportes)
        ->with('tokenId',$id)
        ->with('alumno',$id[3])
        ->with('keyCurso',$post);
    }

    public function certifica($post)
    {

        // bG4yYW5hU1ZuWkZRbEpWUXBwbVVsWitqWEZDWm5xU1ZsNktSbkVwY1VhTnN0SVdscEx3STA3S3FrMnl6dUVDenRiVzB0YTJ0d3JTVXFLV3l4c2l1dTZKQXI3Ump5Ykszajl2aFhucllwTWU3MWN5bnZZeDBkc3FRNDlLNHo4UHVIY2FydG5yUzFuTzMzS2l3dXRLKzQ4Uy90cENt
        // ln2anaSVnZFQlJVQppmUlZ+jXFCZnqSVl6KRnEpcUaNstIWlpLwI07Kqk2yzuECztbW0ta2twrSUqKWyxsiuu6JAr7RjybK3j9vhXnrYpMe71cynvYx0dsqQ49K4z8PuHcartnrS1nO33KiwutK+48S/tpCm
        $post1 = CRUDBooster::base64url_decode($post); 
        $post = $post1;
        // dd($post1);

        $idCreador = 1; 
        $semilla = "Sistema de videos, integral * y secciónes de aprendisaje";

        // desencriptar el id de la clase
        $result = '';
        $string = base64_decode($post);
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($semilla, ($i % strlen($semilla))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }
        // dd($result);
        // $elCreadorEs.
        // "*".$elCursoEs.
        // "*000000000000000000000000*".
        // $alumno."*"
        // .$tituloCurso."*"
        // .$tituloEmpresa."*"
        // .$keyCurso

        $id = explode('*', $result); 

        $dataCurseCer = DB::table('t_alumnocurso')
            ->join('t_cursos','t_cursos.id','=','t_alumnocurso.id_curso')
            ->join('users','users.id','=','t_alumnocurso.id_alumno')
            ->where([
                ['t_cursos.id', '=', $id[1]],
                ['users.id', '=', $id[3]],
                ['t_cursos.status', '=', 'Activo'],
            ])
            ->get();
        $dataCurseCer = json_decode(json_encode($dataCurseCer, JSON_FORCE_OBJECT), true);

        PDF::loadHTML(ob_get_clean());

        $pdf = PDF::loadView('certifica', compact('dataCurseCer'));
        $pdf->setPaper('letter','landscape');

        return $pdf->stream('certificado.pdf');

    }

    public function store(Request $request)
    {
        $aporte = new t_aporte();
        $aporte->id_curso = $request->post('txth_curso');
        $aporte->id_alumno = $request->post('txth_alumno');
        $aporte->detalle_aporte = $request->post('txt_apunte');
        $aporte->fecha_aporte = $request->post('txth_fecha');
        $aporte->status = $request->post('txth_status');
        $aporte->save();
        $irA = $request->post('txth_key');
        return redirect()->route('home.buscar', $irA);
    }

}
