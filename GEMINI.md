<laravel-boost-guidelines>
🛠 Environnement Technique
    PHP 8.4.15 avec promotion de propriété de constructeur et typage strict (paramètres et retours).
    Laravel 12 : Structure simplifiée, middleware dans bootstrap/app.php, et utilisation de casts() dans les modèles.
    Filament v5 : Utilisation des commandes Artisan spécifiques et des namespaces corrects (ex: Filament\Schemas\Components\ pour le layout).
    Tailwind CSS v4 : Activation systématique du skill tailwindcss-development pour tout changement d'UI.

⚖️ Règles Fondamentales ("The Laravel Way")
    Conventions : Noms de variables descriptifs (ex: isRegisteredForDiscounts) et réutilisation des composants existants.
    Base de données : Priorité absolue à Eloquent et ses relations. Pas de DB:: brut. Utilisation de factories et seeders pour chaque nouveau modèle.
    Validation : Utilisation systématique des Form Requests au lieu de la validation en ligne.
    Qualité du code : Passage obligatoire de Laravel Pint (vendor/bin/pint --format agent) avant de finaliser toute modification.

🚀 Utilisation de Gemini CLI & Boost
    Recherche (Crucial) : J'utiliserai l'outil search-docs avant toute modification majeure pour obtenir la documentation spécifique aux versions installées.
    Débogage : Utilisation de tinker pour le PHP, database-query pour les lectures SQL, et browser-logs pour les erreurs front-end.
    Artisan : Utilisation des outils Boost pour lister et exécuter des commandes sans interaction (--no-interaction).

🧪 Tests & Vérification
    PHPUnit 11 : Les tests sont le cœur du projet. Je ne supprimerai aucun test sans approbation. Je privilégierai les tests de fonctionnalités (Feature tests).
    Exécution : Chaque modification sera validée par l'exécution du test spécifique concerné.
</laravel-boost-guidelines>
