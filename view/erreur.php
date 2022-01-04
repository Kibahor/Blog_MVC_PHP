<?php
    foreach (FrontControlleur::getError() as $e) {
        echo '
                <div class="alert alert-danger">
                    <strong>Erreur :</strong> '.$e.'
                </div>
                ';
    }

