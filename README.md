# Sortir.com

1 - Installer un serveur (exemple wamp pour le serveur Apache). <br>
2 - Déplacer le répertoire dans Wamp64/www ou Wamp32/www situé dans le disque dur à la racine en fonction de votre version.<br>
ATTENTION : Le wamp doit être vert.<br>
3 - Lancer l'invite de commande en mode administrateur (Pour Windows raccourci : Win + X puis appyez sur la touche A )<br>
4 - Faire la commande cd .. jusqu'à ce que vous voyez seulement la lettre de votre lecteur. (exemple C:\>) <br>
5 - Faire cd Wamp64/www/Sortir pour la version 64bit ou Wamp32/www/Sortir pour la version 32bit <br>
6 - Lancer la commande : php bin/console doctrine:database:create (Création de la base de données) <br>
7 - Lancer la commande : php bin/console doctrine:schema:update --force (Création des tables) <br>
8 - Lancer la commande : php bin/console doctrine:fixtures:load => Faire yes(Chargement des données) <br>
9 - Lancer la commande : php bin/console server:run (Démarrage du serveur) <br>
10 - Dans la console vous devez voir l'adresse ip à laquel vous connectez par exemple 127.0.0.1:8000 <br>
11 - Connectez-vous : 3 identifiant disponible 

<ul>
<li>Identifiant => wtenaud Mot de passe => 123</li>
<li>Identifiant => qbaudry Mot de passe => 123</li>
<li>Identifiant => blelodet Mot de passe => 123</li>
</ul>

Les fonctionnalitées présentes sont : 


<ul>
<li>Créer une sortie</li>
<li>Afficher une sortie</li>
<li>S'inscrire à une sortie</li>
<li>Se désister d'une sortie</li>
<li>Publier une sortie</li>
<li>Modifier son profil</li>
<li>Upload une image de profil</li>
<li>Consulter le profil des utilisateurs</li>
<li>Annuler une sortie</li>
<li>Trier les sorties</li>
<li>Inscrire des utilisateurs</li>
</ul>

Prochainement : 

<ul>
<li>Importer des utilisateurs par fichier .csv</li>
<li>Mot de passe oublié avec email</li>
<li>Gérer les lieux</li>
<li>Désactiver des utilisateurs</li>
<li>Supprimer des utilisateurs</li>
<li>Annuler une sortie en tant qu'administrateur</li>
<li>Gérer les villes</li>
<li>Gérer des groupes privés</li>
</ul>
