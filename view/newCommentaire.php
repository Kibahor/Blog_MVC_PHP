<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Un blog fait en php utilisant le MVC" />
    <meta name="author" content="Lukas Blouin | Matthéo Broquet" />
    <title>Blog PHP</title>
    <link rel="icon" type="image/x-icon" href="res/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="res/css/styles.css" rel="stylesheet" />
</head>
<!-- Login Page-->
<body>
<div class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <?php
                    if(isset($idArticle)){
                        echo '<form method="post" action="index.php?action=addC&id='.$idArticle.'">';
                    }
                    ?>
                    <div class="mb-md-5 mt-md-4 pb-3">

                        <h2 class="fw-bold mb-2 text-uppercase">AJouter votre commentaire</h2>
                        <p class="text-white-50 mb-5">Please enter your login and password!</p>

                        <div class="form-outline form-white mb-2">
                            <?php
                            if(isset($pseudo)){
                                echo '<input type="text" id="pseudo" name="pseudo" class="form-control form-control-lg" placeholder="Pseudo" value="' .$_SESSION['pseudo']. '"/>';
                            }else{
                                echo '<input type="text" id="pseudo" name="pseudo" class="form-control form-control-lg" placeholder="Pseudo" />';
                            }
                            ?>

                        </div>

                        <div class="form-outline form-white mb-4">
                            <input type="text" id="content" name="content" class="form-control form-control-lg" placeholder="Content" />
                        </div>

                        <button  type="submit" id="button" name="button">Envoyer</button>

                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

