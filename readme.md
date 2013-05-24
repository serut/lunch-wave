## Installation du framework

-Utiliser composer pour installer Laravel et Lunch Wave
-Creer une base de donnée
-Configurer les hosts

## Installation de la base de donnée

Configurer le fichier de config pour la base de données (/app/config/development/database.php)
Lancer un shell et se positionner à la racine de ce fichier
Lancer "php artisan migrate::install --env=development"
puis "php artisan migrate --env=dev"
