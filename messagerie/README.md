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
