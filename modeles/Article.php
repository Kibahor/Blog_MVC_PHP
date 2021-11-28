<?php

class Article //FAIRE DES GETTEUR ET SETTEUR
{
    public $con;
    public $gate;

    public $id;
    public $title;
    public $content;
    public $date;
    public $idAdmin;


    function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this, $f = '__construct' . $i))
            call_user_func_array(array($this, $f), $a);
    }

    //Constructeur pour insérer les données en retour de la requete sql !! modifier le nom
    function __construct5($id, $title, $date, $content, $idAdmin)
    {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->content = $content;
        $this->idAdmin = $idAdmin;
    }

    public function connectBDD()
    {
        global $base, $login, $mdp;
        $this->con = new Connection($base, $login, $mdp);
        $this->gate = new ArticleGateway($this->con);
    }

    public function get_articles($order)
    {
        $this->connectBDD();
        $cat = 'date';
        $order = 'ASC';
        return $this->gate->getArticle($cat, $order);
    }

    public function ajoutArticle($title, $content, $idUser)
    {
        $this->connectBDD();
        $this->gate->addArticle($title, $content, $idUser);
    }

    public function updateArticle($title, $content, $idUser)
    {
        $this->connectBDD();
        $this->gate->modifArticle($title, $content, $idUser);
    }

    public function getPageArticle($start)
    {
        $this->connectBDD();
        $stop = $start + 5;
        return $this->gate->getPage($start, $stop);
    }

    public function getArticle($id)
    {
        $this->connectBDD();
        return $this->gate->getOne($id);
    }
}
