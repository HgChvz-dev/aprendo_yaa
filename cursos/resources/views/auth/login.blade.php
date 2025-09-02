@extends('layouts.app')

@section('content')
<style>
    .imgDiv{
          background-image: url('uploads/miu/foto_creador.png');;
    }
</style>
<div class="container">
    <div class="row d-flex justify-content-evenly aligne-items-center generalDiv">
        <div class="col-md-5 imgDiv align-self-center"></div>
        <div class="col-md-6 textDiv align-self-center flex-grow-1">
            <div class="card mi__card">
                <div class="card-header text-uppercase text-center ">
                    {{-- {{ __('Ingreso al Sistema') }} --}}
                    <h6>
                        Para una mejor experiencia<br>
                        <a href="https://aprendoyaa.com/aula/login/belleza">pincha aquí</a>
                    </h6>
                </div>
                {{-- <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electronico') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Recuérdame') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ingresar') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Recuperar contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection

