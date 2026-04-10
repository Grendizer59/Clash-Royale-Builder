# Clash-Royale-Builder
Site web  de création de deck pour le jeu vidéo Clash Royale

## Ce que fait le site

* **Gestion de decks :** Chaque utilisateur peut gérer jusqu'à 10 decks. On choisit 8 cartes et le site calcule automatiquement la moyenne d'élixir. On peut aussi définir un deck en "Favori".
* **Partage social :** Possibilité de publier un deck sous forme d'annonce avec un titre et une description tactique. Les autres joueurs peuvent liker les posts.
* **Explorateur :** Un flux de tous les decks partagés avec un système de tri (par likes, par date ou par coût d'élixir).
* **Panel Admin :** Système complet pour gérer la base de données des cartes et modérer les utilisateurs (gestion des signalements et bannissements définitifs).

## Setup technique

1.  **Serveur :** PHP (PDO pour la BDD) et MySQL.
2.  **Base de données :** Importer le fichier `projet_web.sql`. Il contient les 7 tables nécessaires (users, cards, decks, posts, etc.).
3.  **Config :** La connexion se gère dans `header.php`. Par défaut, c'est configuré pour du local (root / sans mdp).
4.  **Design :** Full CSS maison avec l'utilisation des polices *Lilita One* et *Roboto* pour coller à l'univers du jeu.

## Structure du code

* `explorateur.php` : Cœur de la partie communautaire (flux de posts).
* `mes_decks.php` : Interface de gestion personnelle.
* `gestion_users.php` / `detail_signalements.php` : Outils de modération admin.
* `style.css` : Toutes les animations et le design responsive.

