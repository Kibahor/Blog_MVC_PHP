<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Accueil</a>
        </div>
        <div class="navbar-right">
            <?php

            if(isset($_SESSION['role'])){
                echo '<a class="btn btn-primary" href="index.php?action=deconnection">Deconnection</a>';
            }else{
                echo '<a class="btn btn-primary" href="index.php?action=connection">Administration</a>';
            }

            ?>
        </div>
    </div>
</nav>