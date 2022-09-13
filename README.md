# projet-demande-achat
Laravel Microservices

Dans chaque repertoire, lancer la commande suivante :

`composer install`

puis modifier les variables DB_DATABASE, DB_USERNAME & DB_PASSWORD dans les fichiers .env (et de même dans le fichier docker-compose.yml dans le repertoire racine) et lancer la commande suivante dans chaque repertoire :

`php artisan migrate`

verifier que Docker est installé et ouvert sur la machine puis lancer dans le repertoire racine la commande suivante :

`docker-compose up` 

Cette commande prend plus de temps la premiére fois, car docker doit installer l'image utilisé dans le projet si elle n'est pas installé
et ça sera la seule commande nécessaire pour la prochaine fois.
