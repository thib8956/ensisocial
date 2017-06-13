# Ensisocial

## Installation

Pour fonctionner ce à besoin d'un serveur XAMP/LAMP (Apache, MySQL, php) fonctionnel.
- Créer une base de données "ensisocial" ayant pour interclassement ``utf8mb4_unicode_520_ci``
- Importer le fichier ``ensisocial.sql`` du dossier SQL.
- Pour tester les différentes fonctionnalités, la base de données est prérempli avec des utilisateurs.
Tous les mots de passe par défaut sont "azerty". Par exemple les comptes suivants sont disponibles :
```
gabin.michalet@uha.fr
persouha@uha.fr
antoine.benard@uha.fr
myriam.invetion@uha.fr
ptitvictor@uha.fr
alternant@uha.fr
alternant@uha.fr
```

## Inscription

Pour s'inscrire :
(sur le site)

1. Cliquer sur Inscription
2. Remplir les champs du formulaire
3. Suivre les instructions pour corriger les erreurs de remplissage du formulaire (adresse UHA seulement)
3. Soumettre le formulaire et vous êtes inscrit (un mail vous est envoyé sur l'adresse saisie)

## Connexion à un compte existant

1. Rentrez les identifiants du compte
2. Si vous ne vous rappelez pas de vos identifiants, cliquez sur "Mot de passe oublié" et rentrez votre mail pour recevoir un nouveau mot de passe temporaire pour le compte
3. Vous arriverez sur la page de publication générale

## Pièces jointes de publication

1. Allez dans Uploads
2. Recherchez ce que vous voulez importer (Images: jpg, jpeg, bmp, gif ,png
					   Vidéos: mp4, mpeg(mkv), wav
					   Musiques: mp3
					   Fichiers: pdf)
3. Récupérez le chemin vers le fichier qui s'affiche alors pour le copier dans votre publication

Il est aussi possible de publier directement le lien d'une vidéo YouTube ou Dailymotion (avant le premier underscore si vous ne voulez pas afficher le titre de la vidéo dans votre publication. Exemple: [http://www.dailymotion.com/video/x3almnz])

## Créer une publication

1. Accédez à la page
2. Remplir les champs pour la publication et l'envoyer

## Pages disponibles

1. Page générale accessible via le logo du site
2. Page personnelle accessible via "Profil"
3. Page personnelle des autres utilisateurs accessibles via leurs photos de profil/via la barre de recherche (en rentrant leur nom)
4. Pages des groupes accessible via "Mes groupes"

## Actions sur les publications

1. Supprimer : Disponible sur ses propres publications
2. Ajouter un commentaire : via le champ sous la publication
3. Afficher plus ou moins de commentaires avec "Voir plus de commentaires" ou "Réduire les commentaires"
4. Ajouter un vote +1 ou -1 ou l'annuler via les pouces

## Voir les informations d'une page

1. Aller sur la page
2. Appuyer sur la photo de la page, en haut à gauche

## Modification des informations personneles

1. Une fois connecté, appuyer sur "Modifier mes informations"
2. Une fois sur la page de profil, appuyer sur modifier sur l'information que vous voulez changer
3. Remplir le champ qui apparait avec les nouvelles informations et cliquer sur Valider

## Utilisation du chat

### Mise en place
1. Décommenter extension=php_sockets.dll dans php.ini situé xampp/php/php.ini
2. Ouvrir le shell du serveur
3. Executer :
```
php -q /path_to_ensisocial/messagerie/server.php
```

Pour utiliser le chat sur plusieurs machines, il est nécessaire d'indiquer la bonne adresse ip du serveur au client.
Pour cela, modifier la ligne suivante ``messagerie/client.js``, en remplaçant l'adresse IP adaptée.
```
"ws://192.168.0.25:9000/ensisocial/messagerie/server.php"
```

### Fonctionnement

Le chat est composé d'un salon de discution public et de discutions privées. Il est possible de choisir à qui adresser
son message via la liste des membres située dans la fenêtre de chat.
