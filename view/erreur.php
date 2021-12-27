<?php
        if (isset($this->dVueErreur)) {
            foreach ($this->dVueErreur as $value) {
                $e=$value;
    ?>
    <div class="alert alert-danger">
        <strong>Erreur :</strong> <?php echo $e ;?>
    </div>
    <?php
            }
        }
    ?>
