<?php

class Validation {

    public static function cleanString(string $str) :string
    {
        return filter_var($str,FILTER_SANITIZE_STRING);
    }

    public static function validateINT($nb) :bool
    {
        return filter_var($nb,FILTER_VALIDATE_INT);
    }

    public static function cleanINT($nb)
    {
        if(Validation::validateINT($nb)){
            //$nb=filter_var(FILTER_SANITIZE_NUMBER_INT); // eclaté au sol il ne retourne pas du tout la bonne valeur
        }else{
            $nb=0;
        }
        return $nb;
    }

}
?>