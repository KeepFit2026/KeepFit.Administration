<x-filament-widgets::widget>
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div class="text-left">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">
                    {{ $title }}
                </p>
                <p class="text-4xl font-bold text-gray-900 dark:text-white mt-2">
                    {{ $value }}
                </p>
                <p class="text-sm text-gray-500 mt-1 italic">
                    {{ $description }}
                </p>
            </div>

            @php
                $bgClasses = [
                    'emerald' => 'bg-emerald-500',
                    'blue'    => 'bg-blue-500',
                    'red'     => 'bg-red-500',
                    'orange'  => 'bg-orange-500',
                    'purple'  => 'bg-purple-500',
                ];
                $bgColor = $bgClasses[$color] ?? 'bg-gray-500';
            @endphp

            <div class="w-14 h-14 {{ $bgColor }} rounded-xl flex items-center justify-center shadow-lg transition-transform hover:scale-110">
                <i class="bi {{ $icon }} text-2xl text-white"></i>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>