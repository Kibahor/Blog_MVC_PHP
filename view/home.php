<!-- Head -->
<?php require($this->rep . $this->vues['head']); ?>

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
            <form class="form-inline col-md-10 col-lg-8 col-xl-7" action="index.php?action=search&" method="POST">
                <input class="form-control mr-2" type="text" name="query" placeholder="Search" aria-label="Search"/>
            </form>
            <!--
            <form class="form-inline col-md-10 col-lg-8 col-xl-7" method="get" action="index.php">
                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
            </form> -->
        </div>
    </div>
</header>

<!-- Navbar -->
<?php require($this->rep . $this->vues['nav']); ?>

<!-- Main Content-->
<body>
<?php
if(isset($val)){
    $nbArticle = $val;
    echo '<p>Nombre article en BD :' .$nbArticle.'</p>';
}
?>

<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-20 col-lg-16 col-xl-14">
            <?php

            foreach($valeur as $p){
                $id= $p->id;
                $date= $p->date;
                $title=$p->title;
                $content=$p->content;
                $idAdmin=$p->idAdmin;       // si on veut l'admin qui a crée l'article, il faut utiliser la gateway, a partir de cette id, ou modifier carrement le modele a voir si nécessaire

                echo '
                <div class="post-preview">
                    <h2 class="post-title" ><a href="index.php?action=get&id='.$id.'">' .$title. '</a></h2>
                    <p>' .$content. '</p>                                    
                    <p class="post-meta">Posté le ' .$date. '</p>
                </div>
                <!-- Divider-->
                <hr class="my-4" />';

            }                      //Convertion bbcode html avec un parser
            ?>
        </div>
    </div>
</div>


</body>

<!-- Footer -->
<?php require($this->rep . $this->vues['footer']); ?>