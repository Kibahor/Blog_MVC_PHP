<body>
<div class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white text-center" style="border-radius: 1rem;">
                    <?php
                    if(isset($idArticle)){
                        echo '<form method="post" action="index.php?action=addC&id='.$idArticle.'">';
                    }
                    ?>
                    <div class="mb-md-5 mt-md-4 pb-3">
                        <h2 class="fw-bold mb-2 text-md-center text-uppercase">Ajouter votre commentaire</h2>
                        <br>
                        <div class="form-outline mb-1 col-md-6">
                            <?php
                            if(isset($pseudo)){
                                echo '<input type="text" id="pseudo" name="pseudo" class="form-control form-control-lg" placeholder="Pseudo" value="'.$pseudo.'" />';
                            }else{
                                echo '<input type="text" id="pseudo" name="pseudo" class="form-control form-control-lg" placeholder="Pseudo" />';
                            }

                            ?>
                        </div>
                        <div class="md-form">
                            <textarea id="form7" name="content" class="md-textarea form-control" rows="3" placeholder="Laissez votre message"></textarea>
                            <br>
                        </div>
                        <!--
                        <div class="form-outline form-white mb-4">
                            <input type="text" id="content" name="content" class="form-control form-control-lg" placeholder="Content" />
                        </div> -->
                        <button class="btn btn-outline-light justify-content-center" type="submit" id="button" name="button">Envoyer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



