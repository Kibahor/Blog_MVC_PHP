<?php
if (isset(FrontControlleur::$dVueErreur)) {
    foreach (FrontControlleur::$dVueErreur as $e) {
        echo '
                <div class="alert alert-danger">
                    <strong>Erreur :</strong> '.$e.'
                </div>
                ';
    }
}
