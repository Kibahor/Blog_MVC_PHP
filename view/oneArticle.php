<?php
if(isset($article)){
    $title= $article->title;
    $content= $article->content;
    $date= $article->date;
}else{
    $title="Title";
    $content="Content";
    $date="";
    FrontControlleur::$dVueErreur[]="Une erreur est survenu lors de la récupération de l'article";
}
?>
<!-- header -->
<header class="masthead" style="background-image: url('view/res/img/article.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1><?php echo $title ?></h1>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Navbar -->
<?php require($this->rep . $this->vues['nav']); ?>

<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-20 col-lg-16 col-xl-14">
                <p><?php echo $content?></p>
                <p class="post-meta"></p>
            </div>
        </div>
    </div>
</article>

<!-- Commentaire
<section class="container text-center">
    <h2 class="h1-responsive font-weight-bold text-center my-4">Laisser un commentaire</h2>
    <div class="row px-4 px-lg-5">
        <div class="container">
            <form class="form">
                <div class="md-form mb-1">
                    <input type="text" name="Nom" class="form-control" placeholder="Nom" required=""/>
                </div>
                <br>
                <div class="md-form">
                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" placeholder="Message ..." required=""/>
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
-->
