--CLAVEAU Alexandre - LE CORRE Guillaume - CIR 3 ALT--

INSTRUCTIONS D'INSTALATION

1 FACULTATIF
Utiliser notre script SQL pour créer la base de donnée. Nous n’avons fait aucune modification, nous avons uniquement ajouté des données personnelles pour le test.

2
Placer le dossier de notre application (admin) à l’intérieur de votre application de rentrée, au même niveau que l’index (c’est important). Vous y accéderez à l’adresse suivante : http://localhost/rentree/admin

3
Ouvrir le fichier config-admin.php et entrer les bonnes informations de la base de donnée.

4 UNIQUEMENT SOUS LINUX

Depuis un terminal, se placer dans votre application de rentrée (au niveau de l’index) et saisir les commandes suivantes:

sudo chmod o+w config.php
sudo chmod –R o+w pdf

La première commande est nécessaire pour enregistrer de nouvelles promotions depuis l’interface. La seconde est nécessaire pour pouvoir ajouter/modifier des fichiers (car sinon other n’a pas les droits suffisants).

5 FACULTATIF - UNIQUEMENT SI VOTRE APPLICATION RENTREE N’EST PAS PLACEE A LA RACINE DU SERVEUR

Dans index.html de l’application d’administration (admin), remplacer $baseurl par l’url de l’application de rentrée suivi d’un / :

Exemple :
$baseurl = 'http://127.0.0.1/CHEMIN/rentree/';
