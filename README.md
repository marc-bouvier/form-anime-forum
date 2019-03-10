# form-anime-forum
Générateur d'html pour inclure dans un forum

* generator.html : générateur utilisant vue.js sans php
* proxy.php : proxy permettant de charger une page d'un site externe pour contourner [les limitations CORS](https://fr.wikipedia.org/wiki/Cross-origin_resource_sharing)

## Configuration du parser

Pour fonctionner, le parser doit lire un fichier `secret.php` qui contient les tokens des comptes utilisateur uptobox.
Pour des raisons de confidentialité ce fichier n'est pas commit sur GIT.

Il faut le créer : sur le serveur qui héberge l'application PHP.

`secret.php`
```php
<?php
// Confidentiel! A ne pas commit sur git!!!
define("SECRET",  array(
    "0"=>array("name"=>"OTF1","token"=>"recupereCeTokenSurUptobox"),
    "1"=>array("name"=>"OTF2","token"=>"recupereCeTokenSurUptobox"),
    "2"=>array("name"=>"Mazulis","token"=>"recupereCeTokenSurUptobox")));
?>
```

Remplaceer les valeur `"recupereCeTokenSurUptobox"` par des valeurs réelles

## Utilisation du parser

* `acc_id` : numéro du compte défini dans le fichier `secret.php`. Par exemple : `1` pour OTF2
* `uptobox_path` : chemin du dossier où lister les fichiers. Par exemple `//Animations Japonaise/Animes Lettre O/One Piece/One Piece - Saga 01 - East Blue/One Piece - Arc 01 - Romance Dawn`
* `recursive` : (optionnel) permet de cherche les fichiers dans les sous dossiers. Désactivé par défaut. Par exemple : `true`
* `direct` : (optionnel) calcule et affiche les liens de téléchargement direct. Désactivé par défaut. Par exemple : `true`

```
http://domaine.truc/parser/parser.php?acc_id=1&recursive=true&direct=true&uptobox_path=//Animations Japonaise/Animes Lettre O/One Piece/One Piece - Saga 01 - East Blue/One Piece - Arc 01 - Romance Dawn
```

## TODO
* Gestion du multicompte pour Uptobox
* Loader pour MyAnimeListe.com afin de récupérer l'image et le score.
* Précharger les services de Simulcast via Icotaku (Champ "Licence VOD")
* Isoler le Javascript

## Lancer localement avec Docker
Pour éviter d'avoir à installer PHP, il est possible de lancer le projet avec docker.

Prérequis : avoir docker installé.
La première fois : `chmod +x run.sh`

```
./run.sh
```

Détail du script.

Se positionner dans la racine du projet. L'image Docker est décrite par le fichier Dockerfile.
Celui-ci se base sur PHP avec Apache 2. Elle se contente de copier les fichiers du projet dans 
le dossier /var/www du conteneur docker.

Construire l'image docker. 
```
> docker build -t generator-anime .
Sending build context to Docker daemon  9.603MB
Step 1/2 : FROM php:7.0-apache
 ---> 0eeaf7f569ff
Step 2/2 : COPY ./ /var/www/html/
 ---> 239c1d48c3fa
Successfully built 239c1d48c3fa
Successfully tagged generator-anime:latest
```

Il faut construire l'image à chaque fois qu'une modification est faite.

Lancer l'image dans un conteneur.
```
> docker run -p 81:80 generator-anime 
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.17.0.2. Set the 'ServerName' directive globally to suppress this message
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.17.0.2. Set the 'ServerName' directive globally to suppress this message
[Thu May 10 07:39:11.699733 2018] [mpm_prefork:notice] [pid 1] AH00163: Apache/2.4.10 (Debian) PHP/7.0.30 configured --resuming normal operations
[Thu May 10 07:39:11.699793 2018] [core:notice] [pid 1] AH00094: Command line: 'apache2 -D FOREGROUND'
```

Le serveur est accessible à l'adresse 172.17.0.2 et http://localhost:81
