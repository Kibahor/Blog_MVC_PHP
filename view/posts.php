<!-- Main Content-->
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
                <p>
                    <?php echo $content //Convertion bbcode html avec un parser + n'afficher que les 10 premières lignes?>
                </p>
                <p class="post-meta">
                    Poster par $USER le <?php echo $date ?>
                </p>
            </div>
            <!-- Divider-->
            <hr class="my-4" />
            <?php
             }
            ?>
        </div>
    </div>
</div>
