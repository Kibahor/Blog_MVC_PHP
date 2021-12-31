<section class="container justify-content-center">
    <div class="row">
        <div class="col">
            <h2 class="h1-responsive font-weight-bold text-center my-4">Dernier Commentaires</h2>
            <?php
            if(isset($com) && !empty($com)){
                foreach($com as $p){
                    $id= $p->id;
                    $pseudo= $p->pseudo;
                    $content=$p->content;
                    $date=$p->date;
                    $idArticle=$p->idArticle;       // si on veut l'admin qui a crée l'article, il faut utiliser la gateway, a partir de cette id, ou modifier carrement le modele a voir si nécessaire

                    echo '
                        <div class="comment-row comment-text">
                            <h5>'.$pseudo.'</h5>
                            <span>' .$content. '</span>
                            <div>
                                <small class="fst-italic">Posté le : ' .$date. '</small><br>
                                <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                        <br>
                    ';
                }
            }else{
                echo '<div class="comment-row comment-text text-center"><p>Il n\'y a pas de commentaire !</p></div>';
            }
            if(isset($cleanIntID)){
                echo '<div class="text-center"><a class="btn btn-outline-dark" href="?action=addC&id='.$cleanIntID.'">Ajouter votre commentaire</a></div>';
                //echo '<h2 class="fw-bold mb-2 text-uppercase"><a href="?action=addC&id='.$cleanIntID.'">Ajouter votre commentaire</a></h2>';
            }
            ?>
        </div>
    </div>
</section>

