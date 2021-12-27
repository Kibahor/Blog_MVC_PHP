<?php
if(isset($comm)){
    foreach($comm as $p){
        $id= $p->id;
        $pseudo= $p->pseudo;
        $content=$p->content;
        $date=$p->date;
        $idArticle=$p->idArticle;       // si on veut l'admin qui a crée l'article, il faut utiliser la gateway, a partir de cette id, ou modifier carrement le modele a voir si nécessaire

        echo '
                <div class="post-preview">
                    <h2 class="post-title" >Ceci est un commentaire de : ' .$pseudo. '</h2>
                    <p>' .$content. '</p>                                    
                    <p class="post-meta">Posté le ' .$date. '</p>
                </div>
                <!-- Divider-->
                <hr class="my-4" />';

    }
    if(isset($cleanIntID)){
        echo '<h2 class="fw-bold mb-2 text-uppercase"><a href="?action=addC&id='.$cleanIntID.'">Ajouter votre commentaire</a></h2>';
    }
}

