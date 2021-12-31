<?php

class Validation {

    public static function cleanString(string $str) :string
    {
        return filter_var($str,FILTER_SANITIZE_STRING);
    }

    public static function cleanINT($nb)
    {
        if(!filter_var($nb,FILTER_VALIDATE_INT)){
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

    static function connexion_form(string &$nom, string &$mdp) {

        if (!isset($nom)||$nom=="") {
            FrontControlleur::$dVueErreur[] =	"Identifiant incorrect";
            $nom="";
        }

        if ($nom != filter_var($nom, FILTER_SANITIZE_STRING) || $mdp != filter_var($mdp, FILTER_SANITIZE_STRING))
        {
            FrontControlleur::$dVueErreur[] =	"tentative d'injection de code (attaque sécurité)";
            $nom="";
            $mdp="";
        }

        if (!isset($mdp)||$mdp=="") {
            FrontControlleur::$dVueErreur[] =	"Mot de passe invalide";
            $mdp="";
        }
    }

}
?>