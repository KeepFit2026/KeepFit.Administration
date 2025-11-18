@extends('Layouts.login')

@section('form-title', 'Première connexion, création du compte')

@section('form')
    <form method="POST" action="{{ route('login.post.first-connexion') }}" class="login-form">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Nom d'utilisateur</label>
            <input type="text" id="name" name="name" class="form-input" placeholder="Pierrick"
                value="{{ old('name') }}" required autofocus>
            @error('name')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Votre mot de passe</label>
            <input type="password" id="password" name="password" class="form-input" placeholder="Votre mot de passe"
                required>
            @error('password')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Votre mot de passe"
                required>
            @error('password_confirmation')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn">
            Se connecter
        </button>
    </form>
@endsection