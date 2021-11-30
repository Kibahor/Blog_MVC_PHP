<!-- Head -->
<?php require($this->rep . $this->vues['head']); ?>

<!-- Page Header-->
<header class="masthead" style="background-image: url('view/res/img/home-bg.jpg')">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Blog PHP</h1>
                    <span class="subheading">Projet de Blog PHP en MVC</span>
                </div>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 justify-content-center pt-5">
            <form class="form-inline col-md-10 col-lg-8 col-xl-7">
                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>
    </div>
</header>

<!-- Navbar -->
<?php require($this->rep . $this->vues['nav']); ?>

<body>
    <?php
        if (isset($dVueEreur)) {
            foreach ($dVueEreur as $value) {
                $e=$value;
    ?>
    <div class="alert alert-danger">
        <strong>Erreur Fatal !</strong> <?php echo $e ;?>
    </div>
    <?php
            }
        }
    ?>
</body>
<?php require($this->rep . $this->vues['footer']); ?>
