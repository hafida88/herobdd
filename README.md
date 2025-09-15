# herobdd
# 📘 Documentation Projet Docker PHP + Nginx + MariaDB

Ce projet utilise Docker pour exécuter une application PHP procédurale avec Nginx comme serveur web et MariaDB comme base de données.


Il est organisé autour de trois fichiers principaux : **Dockerfile**, **docker-compose.yml** et **nginx.conf**.

## 🐘 Dockerfile

* **FROM php:8.2-fpm** 
    * On utilise l’image officielle PHP avec FPM (FastCGI Process Manager).  
    * ⚠️ Contrairement à php:apache, ici c’est Nginx qui servira les pages, et PHP-FPM exécutera uniquement le code PHP.


* **RUN docker-php-ext-install pdo pdo_mysql** :  
    * Installe l’extension PDO MySQL pour pouvoir se connecter à une base de données MariaDB/MySQL en PHP.  


* **RUN ln -snf /usr/share/zoneinfo/Europe/Paris** ... :  
    * Configure le fuseau horaire du serveur Docker sur Europe/Paris, pratique pour les logs et la cohérence des dates.  


* **WORKDIR /var/www/html et COPY . /var/www/html** :  
    * Définit le répertoire de travail et copie le projet PHP dans le conteneur.  


## 🐳 docker-compose.yml

* **services** : 
    * Définit les conteneurs qui vont tourner ensemble.  
  

* **php** :

    * Construit l’image avec le Dockerfile (donc avec PDO MySQL et timezone).

    * Monte le dossier du projet dans /var/www/html.
  

* **nginx** :

    * Utilise l’image officielle Nginx.

    * Expose le site sur le port 8080.

    * Monte le code du projet et la config nginx.conf.


* **depends_on:** 
    * php → garantit que PHP démarre avant Nginx.
  

* **db** :

    * Utilise MariaDB comme base de données.

    * Définit les identifiants de connexion (root, user, password).

    * Sauvegarde les données dans un volume db_data pour éviter de tout perdre à chaque redémarrage.


  * **volumes** :
    * Stockage persistant des données de la base (db_data).


## 🌐 nginx.conf

* **listen 80;** 
    * Le serveur écoute sur le port 80 (redirection vers 8080 côté docker-compose).


* **root /var/www/html;** 
    * Dossier où se trouve ton projet PHP.


* **location / { try_files ... }** 
    * Permet la réécriture des URL → si un fichier n’existe pas, la requête est envoyée à index.php (parfait pour un routeur PHP).


* **location ~ \.php$ { ... }**
    * Configuration pour envoyer les fichiers PHP au conteneur php (via PHP-FPM sur le port 9000).


* **location ~ /\.ht { deny all; }**
    * Sécurité → empêche l’accès aux fichiers .htaccess.

## 🚀 Lancer le projet

Dans le terminal, exécute :
```
    docker-compose up --build
```
Ensuite :

Accède au site sur http://localhost:8080

Vérifie que pdo_mysql est activé et que le fuseau horaire est correct avec un fichier phpinfo.php :
```
<?php phpinfo(); ?>
```