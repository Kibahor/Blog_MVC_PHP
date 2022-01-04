<?php
if (isset($article)) {
    $title = $article->title;
    $content = $article->content;
    $date = $article->date;
} else {
    $title = "Title";
    $content = "Content";
    $date = "";
    FrontControlleur::addError("Une erreur est survenu lors de la récupération de l'article");
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
<body>
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-20 col-lg-16 col-xl-14">
                <p><?php echo $content ?></p>
                <p class="post-meta"></p>
            </div>
        </div>
    </div>
</article>
</body>