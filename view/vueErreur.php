<?php
    if(isset($this->dVueErreur) && count($this->dVueErreur) > 0){
        $dateVueErreur = array_unique($this->dVueErreur);
        foreach ($dateVueErreur as $value){
            echo "$value ! <br>";
        }
    }
    ?>