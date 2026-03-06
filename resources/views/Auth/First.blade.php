@extends('Layouts.login')

@section('form-title', 'Première connexion, création du compte')

@section('form')
    <form method="POST" action="{{ route('login.register') }}" class="text-left">
        @csrf

        <div class="mb-6">
            <label for="name" class="block mb-2 font-medium text-dark">Nom d'utilisateur</label>
            <input type="text" id="name" name="name"
                class="w-full px-4 py-3 bg-light border border-gray-200 rounded-lg text-base text-dark shadow-sm transition-all duration-300 placeholder-gray-400 focus:outline-none focus:border-primary focus:ring-3 focus:ring-blue-500/10 focus:bg-white"
                placeholder="Votre Nom"
                value="{{ old('name') }}" required autofocus>
            @error('name')
                <span class="text-danger text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block mb-2 font-medium text-dark">Votre mot de passe</label>
            <input type="password" id="password" name="password"
                class="w-full px-4 py-3 bg-light border border-gray-200 rounded-lg text-base text-dark shadow-sm transition-all duration-300 placeholder-gray-400 focus:outline-none focus:border-primary focus:ring-3 focus:ring-blue-500/10 focus:bg-white"
                placeholder="Votre mot de passe"
                required>
            @error('password')
                <span class="text-danger text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-8">
            <label for="password_confirmation" class="block mb-2 font-medium text-dark">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="w-full px-4 py-3 bg-light border border-gray-200 rounded-lg text-base text-dark shadow-sm transition-all duration-300 placeholder-gray-400 focus:outline-none focus:border-primary focus:ring-3 focus:ring-blue-500/10 focus:bg-white"
                placeholder="Votre mot de passe"
                required>
            @error('password_confirmation')
                <span class="text-danger text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
            class="inline-block w-full py-3.5 px-6 bg-primary text-white rounded-lg text-base font-medium text-center shadow-sm transition-all duration-300 hover:bg-primary-dark hover:-translate-y-0.5 hover:shadow-md active:translate-y-0">
            Créer le compte et se connecter
        </button>
    </form>
@endsection