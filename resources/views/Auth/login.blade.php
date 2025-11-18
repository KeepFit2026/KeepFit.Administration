@extends('Layouts.login')

@section('form')
    <form method="POST" action="{{ route('login.post.loginWebPortal') }}" class="login-form">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="votre@email.com"
                value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" id="password" name="password" class="form-input" placeholder="Votre mot de passe"
                required>
            @error('password')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-options">
            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Se souvenir de moi</label>
            </div>
            @if (Route::has('password.request'))
                <a href="#" class="forgot-password">
                    Mot de passe oublié?
                </a>
            @endif
        </div>

        <button type="submit" class="btn">
            Se connecter
        </button>
    </form>
@endsection