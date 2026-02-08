<div class="sticky bottom-0 w-full border-t border-gray-700 p-5 z-20">
    <button 
        wire:click="logout"
        wire:loading.attr="disabled"
        class="group w-full flex items-center justify-center gap-3 px-4 py-3 
               text-white rounded-lg font-bold 
               transition-all duration-200 
               shadow-md hover:shadow-lg hover:brightness-110 
               disabled:opacity-70 disabled:cursor-not-allowed
               active:scale-95 bg-red-700 opacity-75" 
    >
        <!-- Spinner de chargement -->
        <svg 
            wire:loading 
            wire:target="logout" 
            class="animate-spin h-5 w-5 text-white" 
            xmlns="http://www.w3.org/2000/svg" 
            fill="none" 
            viewBox="0 0 24 24"
        >
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        
        <!-- Icône de déconnexion -->
        <svg 
            wire:loading.remove 
            wire:target="logout" 
            xmlns="http://www.w3.org/2000/svg" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke-width="2.5" 
            stroke="currentColor" 
            class="w-6 h-6"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
        </svg>
        
        <span wire:loading.remove wire:target="logout" class="text-base tracking-wide">
            Déconnexion
        </span>
        
        <span wire:loading wire:target="logout" class="text-base tracking-wide">
            Déconnexion en cours...
        </span>
    </button>
</div>