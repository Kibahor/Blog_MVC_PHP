<?php

class User //FAIRE DES GETTEUR ET SETTEUR
{
    public $con;
    public $gate;

    public $pseudo;

    function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this, $f = '__construct' .$i))
            call_user_func_array(array($this, $f), $a);
    }

    //Constructeur pour insérer les données en retour de la requete sql !! modifier le nom
    function __construct1($pseudo)
    {
        $this->id = $pseudo;
    }

    public function connectBDD()
    {
        global $base, $login, $mdp;
        $this->con = new Connection($base, $login, $mdp);
        $this->gate = new ArticleGateway($this->con);
    }

}

?>