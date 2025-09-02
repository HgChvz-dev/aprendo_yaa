<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\t_result;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:80'],
            // 'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /*
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
    */
    protected function create(array $data)
    {
        // print('<pre>');
        // print_r($postdata);
        // print('</pre>');
        // print($postdata['email']);
        exit();

        // Array
        // (
        //     [id_curso] => 1
        //     [name] => Prueba 2
        //     [cel_alumno] => 12345678
        //     [pais_alumno] => 1
        //     [siglapais_alumno] => 1
        //     [email] => b@b.com
        //     [codigo_alumno] => 1
        //     [fecreg_alumno] => 2023-09-17
        //     [password] => $2y$10$y0pHR41/XrAgGztrHdpVy.sHDeKVDvyvOZv2R0aXPd2CKncLLTkV6
        //     [status] => Activo
        //     [created_at] => 2023-09-28 15:12:27
        // )            

        $existe = CRUDBooster::buscaEmail($postdata['email']);
            // print('<pre>');
            // print_r($existe);
            // print('</pre>');
            // print($existe[0]['idUser']);

            // exit();
        $conteo = count($existe);

        if ($conteo > 0) {
            print($existe[0]['idUser']);
            // return;
            // $actualiza = CRUDBooster::updateUser();
            // if ($positivo > 0) {
                // $insertAlumCurso = CRUDBooster::insertAlumCurso();
            // }
        } else {
            print("No existe");
        }




        // return User::create([
        //     'id_curso' => $data['id_curso'],
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     'cel_alumno' => $data['cel_alumno'],
        //     'pais_alumno' => $data['pais_alumno'],
        //     // 'siglapais_alumno' => $data['siglapais_alumno'],
        //     'codigo_alumno' => $data['codigo_alumno'],
        //     'fecreg_alumno' => $data['fecreg_alumno'],
        //     'status' => $data['status'],
        // ]);

        // id_alumno
        // id_curso
    }
}
