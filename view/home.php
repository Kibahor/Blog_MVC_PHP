<!-- Page Header-->
<header class="masthead" style="background-image: url('view/res/img/home-bg.jpg')">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Blog PHP</h1>
                    <span class="subheading">Projet de Blog PHP en MVC</span>
                </div>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 justify-content-center pt-5">
            <form class="form-inline col-md-10 col-lg-8 col-xl-7" action="index.php?action=search" method="POST">
                <input class="form-control mr-2" type="text" name="query" placeholder="Rechercher" aria-label="Rechercher"/>
            </form>
        </div>
    </div>
</header>

<!-- Navbar -->
<?php require($this->rep . $this->vues['nav']); ?>

<!-- Main Content-->
<body>
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-20 col-lg-16 col-xl-14">
            <?php

            if(isset($admin) && $admin){
                echo '<a class="btn btn-primary" href="index.php?action=addA">Ajouter un article</a>';
            }

            if (isset($nbArticle)&&isset($nbCom)) {
                echo '
                <p>
                    Nombre article en BD :  '.$nbArticle.' <br>
                    Nombre de commentaire par cookie : '.$nbCom.'
                </p>
                ';
            }

            if(isset($tabArticle) && !empty($tabArticle)){
                foreach($tabArticle as $article){
                    $id= $article->id;
                    $date= $article->date;
                    $title=$article->title;
                    $content=$article->content;
                    $idAdmin=$article->idAdmin;       // si on veut l'admin qui a crée l'article, il faut utiliser la gateway, a partir de cette id, ou modifier carrement le modele a voir si nécessaire

                    echo '
                        <div class="post-preview">
                            <h2 class="post-title" ><a href="index.php?action=get&id='.$id.'">' .$title. '</a></h2>
                            <p>' .$content. '</p>                                    
                            <p class="post-meta">Posté le ' .$date. '</p>
                        </div>
                        <!-- Divider-->
                        
                    ';
                    if(isset($admin) && $admin) {
                        echo '<a class="btn btn-primary" href="index.php?action=delete&id=' . $id . '">Delete Article</a>';
                    }
                    echo '<hr class="my-4" /> ';
                }
            }else{
                echo "<p>Il n'y a pas d'article !</p>";
            }
            ?>
        </div>
    </div>
</div>

