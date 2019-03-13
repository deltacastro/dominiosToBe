@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col l6 offset-l3 m8 offset-m2 s12">
            <div class="card-panel">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="input-field">
                        <label for="email">Correo</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="helper-text" data-error="wrong" data-success="right">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="input-field">
                        <label for="password">Contraseña</label>
                        <input id="password" type="password" name="password" required>
                        @if ($errors->has('password'))
                            <span class="helper-text" data-error="wrong" data-success="right">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="center-align">
                        <button type="submit" class="btn">
                            Iniciar Sesión
                        </button>
                    </div>
                </form>
            </div>               
        </div>
    </div>
</div>
@endsection
