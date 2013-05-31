
## Installation du framework
- télécharger le laravel master http://laravel.com/docs/installation
- installer composer http://getcomposer.org/
- Lancer un shell et se positionner à la racine commune à ce fichier ( J:\xampp2\htdocs\lara_vieassoc\Dropbox\Dev\www-vieassoc chez moi ) ( raccourcis MAJ + Clic droit dans le dossier pour pouvoir ouvrir le shell direct dans le dossier )
- faire "composer install" dans ce shell
- puis "composer update"
- mettre les fichiers du git dans le dossier
- Creer une base de donnée ( via phpmyadmin par exemple )
- Configuer les hosts ( voir en dessous )
- Changer le lien dans le fichier de conf pour la base de données (/app/config/database.php)
- Lancer "php artisan migrate:install" dans le shell
- puis "php artisan migrate"

C'est fini ! Vous pouvez tester en tapant le nom du host dans votre firefox ! ;)
## Le VHost 

Il faut aussi configurer apache2 pour que ca marche ! Ajoutez ceci à votre fichier de virtualhost
<code>
	<VirtualHost URL:80>
	    DocumentRoot "PATH TO THE PUBLIC FOLDER/public"
	    ServerName URL
	    ServerAlias www.URL
	</VirtualHost>
</code>