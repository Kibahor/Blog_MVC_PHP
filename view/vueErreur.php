<?php
    if(isset($dVueEreur) && count($dVueEreur) > 0){
        $dateVueErreur = array_unique($dVueEreur);
        foreach ($dateVueErreur as $value){
            echo "$value ! <br>";
        }
    }

    ?>