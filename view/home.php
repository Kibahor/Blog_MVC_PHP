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
                    <p><?php echo $content //Convertion bbcode html avec un parser?></p>
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
    <center>
    <form>
        <?php
        $maxPage = ceil(($val[0][0])/5);
        if($maxPage != 1) {
        echo '
    <a href="index.php?page=1">
        <input type="button" value="First">
    </a>';

        for ( $i=2; $i < $maxPage; $i++){
            echo '
    <a href="index.php?page='. $i .'">
        <input type="button" value="'. $i .'">
    </a>';
        }


        echo '
    <a href="index.php?page=' . $maxPage . '">
        <input type="button" value="Last">
    </a>';
    }
        ?>
    </form>
    </center>
</body>

<!-- Footer -->
<?php require($this->rep . $this->vues['footer']); ?>