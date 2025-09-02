<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    // funcion principal de la pagina
    public function index()
    {

        $idCreador = 1; 

        $dataCreator = DB::table('t_creadors')
            ->where([
                ['t_creadors.id', '=', $idCreador],
                ['t_creadors.status', '=', 'Activo'],
            ])
            ->get();
        $dataCreator = json_decode(json_encode($dataCreator, JSON_FORCE_OBJECT), true);

        $dataCurse = DB::table('t_cursos')
            ->where([
                ['t_cursos.id_creador', '=', $idCreador],
                ['t_cursos.status', '=', 'Activo'],
            ])
            ->get();
        $dataCurse = json_decode(json_encode($dataCurse, JSON_FORCE_OBJECT), true);

        $dataClass = DB::table('t_clases')
            ->join('t_creadors','t_clases.id_creador','=','t_creadors.id')
            ->join('t_cursos','t_clases.id_curso','=','t_cursos.id')
            ->select(
                't_clases.id as clases_id',
                't_cursos.id as cursos_id',
                't_clases.*',
                't_creadors.*',
                't_cursos.*')
            ->where([
                ['t_clases.id_creador','=',$idCreador],
                ['t_creadors.status','=','Activo'],
                ['t_cursos.status','=','Activo'],
                ['t_clases.status','=','Activo'],
            ])
            ->get();
        $dataClass   = json_decode(json_encode($dataClass, JSON_FORCE_OBJECT),true);

        return view('welcome')
        ->with('creador', $dataCreator)
        ->with('cursos',$dataCurse)
        ->with('clases',$dataClass);
        
    }

    // return view('gfg')->with('articleName', $articleName)->
                // with('articlePublished', 'On GeeksforGeeks');
}








