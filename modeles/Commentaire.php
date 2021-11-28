<?php

class Commentaire //FAIRE DES GETTEUR ET SETTEUR
{
    public $con;
    public $gate;

    public $id;
    public $pseudo;
    public $content;
    public $date;
    public $idArticle;


    function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this, $f = '__construct' . $i))
            call_user_func_array(array($this, $f), $a);
    }

    //Constructeur pour insérer les données en retour de la requete sql !! modifier le nom
    function __construct4($id, $title, $date, $content, $idArticle)
    {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->content = $content;
        $this->idArticle = $idArticle;
    }

    public function connectBDD()
    {
        global $base, $login, $mdp;
        $this->con = new Connection($base, $login, $mdp);
        $this->gate = new ArticleGateway($this->con);
    }

    public function get_data()
    {
        $this->connectBDD();
        $cat = 'date';
        $order = 'ASC';
        return $this->gate->getArticle($cat, $order);
    }
}
