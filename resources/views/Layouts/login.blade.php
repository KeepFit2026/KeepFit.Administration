<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Dashboard Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @livewireStyles
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        'primary-dark': '#2563eb',
                        secondary: '#10b981',
                        danger: '#ef4444',
                        warning: '#f59e0b',
                        dark: '#1f2937',
                        light: '#f8fafc',
                    },
                    animation: { 'fade-in-up': 'fadeInUp 0.6s ease-out' },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-[Inter,sans-serif] bg-gradient-to-br from-[#dddfe0] to-[#e2e7ec] text-dark leading-relaxed min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-[420px] animate-fade-in-up">
        <div class="relative bg-white p-10 rounded-2xl shadow-xl text-center border border-gray-200 overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-secondary"></div>

            <div class="mb-8">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <i class="fas fa-chart-line text-3xl text-primary"></i>
                    <h1 class="text-3xl font-bold text-dark">Admin Panel</h1>
                </div>
                <p class="text-gray-500 text-sm">Connectez-vous à votre compte administrateur</p>
            </div>

            {{ $slot }}

            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-gray-500 text-sm">© {{ date('Y') }} Admin Panel. Tous droits réservés.</p>
            </div>
        </div>
    </div>

    @livewire('notifications')
    @livewireScripts
</body>
</html>