http://asel.net/cursos/register
@php $allCursos = CRUDBooster::allCursos(); 

@endphp

@php $paises = CRUDBooster::sacarPaises() @endphp

@extends('layouts.app')

@section('content')

<style>
    body{
        height: 100vh;
        background: #141414;
        animation: opacidad 1s alternate;
/*        background-image: url('uploads/1/2023-08/portada_de_video_clases.jpg');*/
/*        background-color: #cccccc;*/
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card estilo" >
            <div class="card-header">{{ __('Comienza registrándote') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        {{-- id_curso --}}
                        <div class="row mb-3">
                            <label for="id_curso" class="col-md-4 col-form-label text-md-end">{{ __('CURSOS A ELECCIÓN') }}</label>
                            <div class="col-md-6">
                                <select name="id_curso" id="id_curso" class="form-control @error('id_curso') is-invalid @enderror" value="{{ old('id_curso') }}" required autocomplete="id_curso" autofocus>
                                    @foreach($allCursos as $cursosAll)
                                        <option value="{{ $cursosAll['id'] }}">{{ $cursosAll['titulo_curso'] }}</option>
                                    @endforeach
                                </select>
                                @error('id_curso')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                        
                        {{-- name --}}
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre Apellido') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- cel_alumno --}}
                        <div class="row mb-3">
                            <label for="cel_alumno" class="col-md-4 col-form-label text-md-end">{{ __('Nro. Movil') }}</label>
                            <div class="col-md-6">
                                <input id="cel_alumno" type="text" class="form-control @error('cel_alumno') is-invalid @enderror" name="cel_alumno" value="{{ old('cel_alumno') }}" required autocomplete="cel_alumno" autofocus>
                                @error('cel_alumno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- pais_alumno --}}
                        <div class="row mb-3">
                            <label for="pais_alumno" class="col-md-4 col-form-label text-md-end">{{ __('Pais') }}</label>
                            <div class="col-md-6">
                                <select name="pais_alumno" id="pais_alumno" class="form-control @error('pais_alumno') is-invalid @enderror" value="{{ old('pais_alumno') }}" required autocomplete="pais_alumno" autofocus>
                                    @foreach($paises as $listado)
                                        <option value="{{ $listado['detalle_pais'] }}">{{ $listado['detalle_pais'] }}</option>
                                    @endforeach
                                </select>
                                @error('pais_alumno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- siglapais_alumno --}}
                        {{-- <div class="row mb-3">
                            <label for="siglapais_alumno" class="col-md-4 col-form-label text-md-end">{{ __('Sigla Pais') }}</label>
                            <div class="col-md-6">
                                <input id="siglapais_alumno" type="text" class="form-control @error('siglapais_alumno') is-invalid @enderror" name="siglapais_alumno" value="{{ old('siglapais_alumno') }}" required autocomplete="siglapais_alumno" autofocus>
                                @error('siglapais_alumno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}
                        {{-- email --}}
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electronico') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- codigo_alumno --}}
                        <div class="row mb-3">
                            <label for="codigo_alumno" class="col-md-4 col-form-label text-md-end">{{ __('Codigo Alumno') }}</label>
                            <div class="col-md-6">
                                <input id="codigo_alumno" type="text" class="form-control @error('codigo_alumno') is-invalid @enderror" name="codigo_alumno" value="{{ old('codigo_alumno') }}" required autocomplete="codigo_alumno" autofocus>
                                @error('codigo_alumno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- fecreg_acallumno --}}
                        <div class="row mb-3">
                            <label for="fecreg_acallumno" class="col-md-4 col-form-label text-md-end">{{ __('Fecha Registro') }}</label>
                            <div class="col-md-6">
                                <input id="fecreg_acallumno" type="text" class="form-control @error('fecreg_acallumno') is-invalid @enderror" name="fecreg_acallumno" value="{{ old('fecreg_acallumno') }}" required autocomplete="fecreg_acallumno" autofocus>
                                @error('fecreg_acallumno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- password --}}
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Clave') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Clave') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        {{-- status --}}
                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Estado') }}</label>
                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- boton para registro --}}
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


