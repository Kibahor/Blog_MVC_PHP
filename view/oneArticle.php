<?php
$date= $p->date;
$title=$p->title;
$content=$p->content;
?>
<!-- Titre -->
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1><?php echo $title ?></h1>
                    <h2 class="subheading">Problems look mighty small from 150 miles up</h2>
                    <span class="meta">Poster par $USER le <?php echo $date ?></span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-20 col-lg-16 col-xl-14">
                <p><?php echo $content //Convertion bbcode html avec un parser + n'afficher que les 10 premières lignes?></p>
                <p class="post-meta"></p>
            </div>
        </div>
    </div>
</article>

<!-- Commentaire déjà publier -->
<section class="container justify-content-center">
    <div class="row">
        <div class="col">
            <h2 class="h1-responsive font-weight-bold text-center my-4">Dernier Comentaires</h2>
            <div class="comment-row comment-text">
                <h5>Jean-Michel Rageux</h5>
                <span>J'aime pas cette article, en plus le site est moche </span>
                <div>
                    <small class="fst-italic">Poster le : 21/09/11</small><br>
                    <button type="button" class="btn btn-warning btn-sm">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
            <br>
            <div class="comment-row comment-text">
                <h5>Jean-Michel Rageux</h5>
                <span>J'aime pas cette article, en plus le site est moche </span>
                <div>
                    <small class="fst-italic">Poster le : 21/09/11</small><br>
                    <button type="button" class="btn btn-warning btn-sm">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
            <br>
            <div class="comment-row comment-text">
                <h5>Jean-Michel Rageux</h5>
                <span>J'aime pas cette article, en plus le site est moche </span>
                <div>
                    <small class="fst-italic">Poster le : 21/09/11</small><br>
                    <button type="button" class="btn btn-warning btn-sm">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Commentaire -->
<section class="container text-center">
    <h2 class="h1-responsive font-weight-bold text-center my-4">Laisser un commentaire</h2>
    <div class="row px-4 px-lg-5">
        <div class="container">
            <form class="form">
                <div class="md-form mb-1">
                    <input type="text" name="Nom" class="form-control" placeholder="Nom" required="">
                </div>
                <br>
                <div class="md-form">
                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" placeholder="Message ..." required=""></textarea>
                </div>
            </form>
            <br>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
            <br>
        </div>
    </div>
</section>