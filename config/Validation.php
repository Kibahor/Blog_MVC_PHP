<?php

namespace config;

class Validation {

    public static function cleanString(string $str) :string
    {
        return filter_var($str,FILTER_SANITIZE_STRING);
    }

    public static function validateINT(int $nb) :bool
    {
        return filter_var($nb,filter:FILTER_VALIDATE_INT);
    }

    public static function cleanINT(int $nb){
        if($this::validateINT){
            $nb=filter_var(FILTER_SANITIZE_NUMBER_INT);
        }else{
            $nb=0;
        }
        return $nb;
    }

    static function val_action($action) {

        if (!isset($action)) {
            throw new Exception('pas d\'action');
        }
    }

    static function val_form(string &$nom, string &$age, &$dVueEreur) {

        if (!isset($nom)||$nom=="") {
            $dVueEreur[] =	"pas de nom";
            $nom="";
        }

        if ($nom != filter_var($nom, FILTER_SANITIZE_STRING))
        {
            $dVueEreur[] =	"injection de code ";
            $nom="";

        }

        if (!isset($age)||$age==""||!filter_var($age, FILTER_VALIDATE_INT)) {
            $dVueEreur[] =	"pas d'age ";
            $age=0;
        }

    }

}
?>