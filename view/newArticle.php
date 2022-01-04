<body>
<div class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-4 pb-5">
                            <form method="post" action="index.php?action=addA">
                                <h2 class="fw-bold mb-2 text-md-center text-uppercase">Création du nouvel article</h2>
                                <br>
                                <div class="form-outline form-white mb-4">
                                    <input type="text" id="titre" name="titre" class="form-control form-control-lg"
                                           placeholder="Titre"/>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <textarea id="form7" name="content" class="md-textarea form-control" rows="3"
                                              placeholder="Laissez votre message"></textarea>
                                    <br>
                                </div>
                                <div class="justify-content-center">
                                    <button class="btn btn-outline-light" type="submit" id="button" name="button">
                                        Envoyer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>




