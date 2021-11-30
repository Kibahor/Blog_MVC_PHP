<?php

$rep=__DIR__.'/../';

//BD
$base="mysql:dbname=dblublouin1;host=berlin.iut.local";
$login="lublouin1";
$mdp="achanger";

//Elements
$vues['head']='view/Elements/head.php';
$vues['nav']='view/Elements/nav.php';
$vues['footer']='view/Elements/footer.php';

//Home
$vues['home']='view/Home/index.php';

//Login
$vues['login']='view/Login/index.html';

//Post
$vues['posts']='view/Post/index.php';

$vues['erreur']='view/erreur.php';

?>