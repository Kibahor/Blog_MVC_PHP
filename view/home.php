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
            <form class="form-inline col-md-10 col-lg-8 col-xl-7">
                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
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

                foreach($valeur as $p){
                    $date= $p->date;
                    $title=$p->title;
                    $content=$p->content;
                ?>
                <!-- Post preview-->
                <div class="post-preview">
                    <h2 class="post-title" ><?php echo $title ?></h2>
                    <p><?php echo $content //Convertion bbcode html avec un parser + n'afficher que les 10 premières lignes?></p>
                    <p class="post-meta">Poster par $USER le <?php echo $date ?></p>
                </div>
                <!-- Divider-->
                <hr class="my-4" />
                <?php
                 }
                ?>
            </div>
        </div>
    </div>
</body>

<!-- Footer -->
<?php require($this->rep . $this->vues['footer']); ?>