<form wire:submit.prevent="authenticate" class="text-left">
    @csrf

    <div class="mb-6">
        <label for="email" class="block mb-2 font-medium text-dark">Adresse email</label>
        <input type="email" id="email" wire:model.blur="data.email"
            class="w-full px-4 py-3 bg-light border border-gray-200 rounded-lg text-base text-dark shadow-sm transition-all duration-300 placeholder-gray-400 focus:outline-none focus:border-primary focus:ring-3 focus:ring-blue-500/10 focus:bg-white"
            placeholder="votre@email.com" required autofocus>

        @error('data.email')
            <span class="text-danger text-sm mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-6">
        <label for="password" class="block mb-2 font-medium text-dark">Mot de passe</label>
        <input type="password" id="password" wire:model="data.password"
            class="w-full px-4 py-3 bg-light border border-gray-200 rounded-lg text-base text-dark shadow-sm transition-all duration-300 placeholder-gray-400 focus:outline-none focus:border-primary focus:ring-3 focus:ring-blue-500/10 focus:bg-white"
            placeholder="Votre mot de passe" required>

        @error('data.password')
            <span class="text-danger text-sm mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-2">
            <input type="checkbox" id="remember" wire:model="data.remember" class="w-4 h-4 accent-primary">
            <label for="remember" class="text-sm text-gray-500 cursor-pointer">Se souvenir de moi</label>
        </div>
    </div>

    <button type="submit"
        class="inline-block w-full py-3.5 px-6 bg-primary text-white rounded-lg text-base font-medium text-center shadow-sm transition-all duration-300 hover:bg-primary-dark hover:-translate-y-0.5 hover:shadow-md active:translate-y-0">
        <span wire:loading.remove>Se connecter</span>
        <span wire:loading>Connexion...</span>
    </button>
</form>