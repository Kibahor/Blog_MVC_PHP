<?php

$rep = __DIR__ . '/../';

//BD
$base = "mysql:dbname=blog;host=localhost";
$login = "user";
$mdp = "mdp";

//Elements
$vues['head'] = 'view/head.php';
$vues['nav'] = 'view/nav.php';
$vues['footer'] = 'view/footer.php';

$vues['home'] = 'view/home.php';
$vues['buttonPage'] = 'view/buttonPage.php';
$vues['commentaire'] = 'view/commentaire.php';
$vues['newCommentaire'] = 'view/newCommentaire.php';
$vues['newArticle'] = 'view/newArticle.php';
$vues['login'] = 'view/login.php';
$vues['deconnection'] = 'view/deconnection.php';
$vues['one_article'] = 'view/oneArticle.php';

$vues['erreur'] = 'view/erreur.php';

?>