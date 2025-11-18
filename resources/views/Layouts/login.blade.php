<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <i class="fas fa-chart-line"></i>
                    <h1>Admin Panel</h1>
                </div>
                <p class="login-subtitle">@yield('form-title','Connectez-vous à votre compte administrateur')</p>
            </div>

            @yield('form')

            <div class="login-footer">
                <p>© {{ date('Y') }} Admin Panel. Tous droits réservés.</p>
            </div>
        </div>
    </div>
</body>
</html>