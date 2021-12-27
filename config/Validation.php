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

    public static function commentaire_form(string &$pseudo,string &$content){

        if(!isset($pseudo) || empty($pseudo)){
            FrontControlleur::$dVueErreur[] = "Identifiant vide";
            $pseudo="";
        }

        if(!isset($content) || empty($content)){
            FrontControlleur::$dVueErreur[] = "Contenue vide";
            $content="";
        }

        if($pseudo!=self::cleanString($pseudo) || $content!=self::cleanString($content)){
            FrontControlleur::$dVueErreur[] = "erreur sur la nature du commentaire";
            $pseudo="";
            $content="";
        }
    }



    public static function getUrl(){
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        {
            $url = "https";
        }
        else
        {
            $url = "http";
        }

        $url .= "://";
        $url .= $_SERVER['HTTP_HOST'];
        $url .= $_SERVER['REQUEST_URI'];

        return $url;
    }
}
?>