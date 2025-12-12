@extends('Layouts.login')

@section('form-title', 'Première connexion, création du compte')

@section('form')
    <form method="POST" action="{{ route('post.admin.requestChangePassword') }}" class="login-form">
        @csrf
        <div class="form-group">
            <input type="text" id="email" name="email" class="form-input" placeholder="Votre Email"
                value="{{ old('name') }}" required autofocus>
            @error('email')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <a href="{{ route('login.index') }}" class="">
            <- Retour
        </a>

        <button type="submit" class="btn">
            Demander
        </button>
    </form>
@endsection