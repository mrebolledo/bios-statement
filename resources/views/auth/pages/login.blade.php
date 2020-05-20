@extends('auth.main')
@section('auth-title','Ingresa con tu cuenta')
@section('auth-content')
 <form class="my-5" method="POST" action="{{ route('login') }}">
     @csrf
        <div class="form-group">
            <label class="form-label">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label d-flex justify-content-between align-items-end">
                <div>Password</div>
                <a href="{{ route('view.forgot-password') }}" class="d-block small">Olvidó su contraseña?</a>
            </label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-flex justify-content-between align-items-center m-0">
            <label class="custom-control custom-checkbox m-0">
                <input type="checkbox" class="custom-control-input" name="remember">
                <span class="custom-control-label">Recordarme</span>
            </label>
            <button type="submit" class="btn btn-primary">Loguear</button>
        </div>
    </form>
    <div class="text-center text-muted">
        No tienes una cuenta? <a href="{{ route('view.register')}}">Regístrate</a>
    </div>
@endsection
