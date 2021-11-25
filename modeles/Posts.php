<?php

class Posts
{
    public $con;
    public $gate;

    public $id;
    public $title;
    public $date;
    /*
    private $content;
    private $img;

    private $idCategory;
    private $idUser;
    */

    function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this, $f = '__construct' .$i))
            call_user_func_array(array($this, $f), $a);
    }

    //Constructeur pour insérer les données en retour de la requete sql !! modifier le nom
    function __construct3($id, $title, $date)
    {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        /*
        $this->content = $content;
        $this->img = $img;
        $this->idCategory = $idCategory;
        $this->idUser = $idUser;
        */
    }

    public function connectBDD()
    {
        global $base, $login, $mdp;
        $this->con = new Connection($base, $login, $mdp);
        $this->gate = new PostsGateway($this->con);
    }

    public function get_data()
    {
        $this->connectBDD();
        $cat = 'date';
        $order = 'ASC';
        return $this->gate->getPosts($cat, $order);
    }
}

?>