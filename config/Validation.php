<?php

class Validation
{

    public static function cleanINT(int $nb):int
    {
        if (!filter_var($nb, FILTER_VALIDATE_INT)) {
            $nb = 0;
        }
        return $nb;
    }

    public static function cleanString(string $str): string
    {
        return filter_var($str, FILTER_SANITIZE_STRING);
    }

    /** Verification du formulaire commentaire
     * @param string $pseudo
     * @param string $content
     */
    public static function commentaire_form(string &$pseudo, string &$content)
    {

        if (!isset($pseudo) || empty($pseudo)) {
            FrontControlleur::addError("Identifiant vide");
            $pseudo = "";
        }

        if (!isset($content) || empty($content)) {
            FrontControlleur::addError("Contenue vide");
            $content = "";
        }

        if ($pseudo != self::cleanString($pseudo) || $content != self::cleanString($content)) {
            FrontControlleur::addError("erreur sur la nature du commentaire");
            $pseudo = "";
            $content = "";
        }
    }

    /** Verification du formulaire Article
     * @param string $titre
     * @param string $content
     */
    public static function article_form(string &$titre, string &$content)
    {

        if (!isset($titre) || empty($titre)) {
            FrontControlleur::addError("Titre de l'article vide");
            $pseudo = "";
        }

        if (!isset($titre) && strlen($titre) < 120) {
            FrontControlleur::addError("Titre de l'article trop long (maximum 120 caractères)");
        }

        if (!isset($content) || empty($content)) {
            FrontControlleur::addError("Contenue vide");
            $content = "";
        }

    }

    /**Verification du formulaire connection
     * @param string $nom
     * @param string $mdp
     */
    static function connexion_form(string &$nom, string &$mdp)
    {

        if (!isset($nom) || $nom == "") {
            FrontControlleur::addError("Identifiant incorrect");
            $nom = "";
        }

        if ($nom != filter_var($nom, FILTER_SANITIZE_STRING) || $mdp != filter_var($mdp, FILTER_SANITIZE_STRING)) {
            FrontControlleur::addError("tentative d'injection de code (attaque sécurité)");
            $nom = "";
            $mdp = "";
        }

        if (!isset($mdp) || $mdp == "") {
            FrontControlleur::addError("Mot de passe invalide");
            $mdp = "";
        }
    }

}

?>