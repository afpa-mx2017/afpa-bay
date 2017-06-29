# afpa-bay
Premier projet php: Liste de films, avec système de bookmarking.

Ajout en v0.4 du système de routage, templating MVC

## Pré-requis

 - `>=php 5.6 `
 - (composer)[https://getcomposer.org/] 

## Installation
`git clone https://github.com/afpa-mx2017/afpa-bay.git`

`cd afpa-bay`

`composer install` #installation des dépendances

Créer une base de de donnée, importer le script `resources/film.sql`.
Adapter les paramètres dans le fichier de configuration `config.inc.php`

## Tests

`php -S localhost:8000 "public/router-dev.php"`