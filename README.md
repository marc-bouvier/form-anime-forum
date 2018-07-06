# form-anime-forum
Générateur d'html pour inclure dans un forum

* generator.html : nouveau générateur utilisant vue.js sans php
* proxy.php : proxy permettant de charger une page d'un site externe pour contourner [les limitations CORS](https://fr.wikipedia.org/wiki/Cross-origin_resource_sharing)
* generator_old.php : générateur original (legacy) utilisant jsRender et jsView
* icotaky-loader.php : permet de précharger une fiche à partir de icotaku pour generator_old.php

## TODO
* Gestion du multi compte pour Uptobox
* Loader Icotaku, récupération du nombre d'épisode en fonction d'une serie ou d'un OAV ou d'un film, meme chose pour la durée, du studio et de l'histoire.
* Loader pour MyAnimeListe.com afin de récupérer l'image et le score.
* Gestion du masquage en fonction du service de simulcast (```<adn></adn> / <waka></waka> / <crunch></crunch> / <netflix></netflix> / <amazon></amazon>```) a ajouter après et avant [hide] / [/hide]
* Isoler le Javascript

## Lancer localement avec Docker
Pour éviter d'avoir à installer PHP, il est possible de lancer le projet avec docker.
Prérequis : avoir docker installé.

Se positionner dans la racine du projet. L'image Docker est décrite par le fichier Dockerfile.
Celui-ci se base sur PHP avec Apache 2. Elle se contente de copier les fichiers du projet dans 
le dossier /var/www du conteneur docker.

Construire l'image docker. 
`̀``
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
> docker run generator-anime
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.17.0.2. Set the 'ServerName' directive globally to suppress this message
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.17.0.2. Set the 'ServerName' directive globally to suppress this message
[Thu May 10 07:39:11.699733 2018] [mpm_prefork:notice] [pid 1] AH00163: Apache/2.4.10 (Debian) PHP/7.0.30 configured --resuming normal operations
[Thu May 10 07:39:11.699793 2018] [core:notice] [pid 1] AH00094: Command line: 'apache2 -D FOREGROUND'
```

Le serveur est accessible à l'adresse 172.17.0.2