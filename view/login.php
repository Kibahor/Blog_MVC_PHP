<!-- Login Page-->
<body>
<div class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-4 pb-5">
                            <?php
                            if (isset($admin) && !$admin) {
                                ?>
                                <form method="post" action="index.php?action=connection">
                                    <h2 class="fw-bold mb-2 text-uppercase">Page de Connexion</h2>
                                    <p class="text-white-50 mb-5">Veuillez vous identifier !</p>
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" name="login" class="form-control form-control-lg"
                                               placeholder="Identifiant"/>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="password" name="password" class="form-control form-control-lg"
                                               placeholder="Mot de passe"/>
                                    </div>
                                    <div>
                                        <button class="btn btn-outline-light" type="submit" id="button" name="button">
                                            Login
                                        </button>
                                    </div>
                                </form>
                                <?php
                            } else {
                                echo '
                                            <h2 class="fw-bold mb-2 text-uppercase">Vous êtes connecté</h2>
                                            </br>
                                            <a class="btn btn-primary" href="index.php">Home</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>