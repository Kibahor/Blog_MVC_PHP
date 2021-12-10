<?php

class Validation {

    public static function cleanString(string $str) :string
    {
        return filter_var($str,FILTER_SANITIZE_STRING);
    }

    public static function validateINT(int $nb) :bool
    {
        return filter_var($nb,FILTER_VALIDATE_INT);
    }

    public static function cleanINT(int $nb)
    {
        if(Validation::validateINT($nb)){
            $nb=filter_var(FILTER_SANITIZE_NUMBER_INT);
        }else{
            $nb=0;
        }
        return $nb;
    }

}
?>