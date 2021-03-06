# Projet PHP (Blog en MVC)

![Home](https://github.com/Kibahor/Blog_MVC_PHP/blob/main/Screenshot.png "Home")

## Introduction
Ce projet a été réalisé durant la deuxième année de DUT Informatique, afin d'apprendre le PHP et l'architecture MVC (Model View Controller)

## Sujet
Le but du projet est de proposer la gestion complète d'un blog (journal de "news" ajoutées par date) en PHP. La page
principale du blog est composée d'une première partie supérieure (ou d'un menu), permettant d'adminiproutr son blog, et
d'une seconde partie composée des news affichées de la sorte: date : news. Cette page principale doit être découpée en
plusieurs pages appelées par des liens, si le blog est trop important.

L'ensemble des news doivent être sauvegardées dans une base de données. Une news peut être écrite par des
administrateurs. Les utilisateurs normaux ne peuvent qu'ajouter des commentaires. Une news correspond à du texte écrit
en HTML. La partie supérieure (ou le menu) est composée au moins:

- d'un lien ajout de commentaire: celui-ci fait appel à une nouvelle page demandant un pseudo et le message à ajouter
  dans le blog. Si le client ajoute plusieurs commentaires, le champ pseudo doit contenir le pseudo précédemment donné (
  utilisez une session)

- d'un lien administration: celui-ci fait appel à une page demandant un login et un mot de passe. La page suivante
  correspond soit à une page d'erreur (login, password erroné) soit à la page principale (c'est à dire l'ensemble des
  news par date) avec un bouton supplémentaire "effacer" par news qui permet de supprimer la news du blog et d'un
  boutton ajouter news.

- d'un bouton rechercher qui permet de rechercher et d'afficher une news par date

- de 2 compteurs donnant le nombre de messages du blog (appel bd) et le nombre de messages du client actuellement
  connecté (via un cookie)
- optionnel : les champs tels que login, mot de passe, titre de news, peuvent aussi etre vérifiés en javascript. Un news
  peut être écrite en BBcode (bbcode) qui doit être traduit en HTML(ex: <b> </b>doit afficher du texte en gras) et
  optionnellement des smileys

**La gestion d'erreurs doit être complète. (champs vérifiés, connection à la BD,etc.)**

