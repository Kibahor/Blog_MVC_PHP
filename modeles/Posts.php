<?php

class Posts
{
    public $con;


    public $id;
    public $title;
    private $content;
    private $img;
    private $created;
    private $idCategory;
    private $idUser;


    function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this, $f = '__construct' .$i))
            call_user_func_array(array($this, $f), $a);
    }

    function __construct2($id, $title)
    {
        //echo $id;
        $this->id = $id;
        $this->title = $title;
        /*
        $this->content = $content;
        $this->img = $img;
        $this->created = $created;
        $this->idCategory = $idCategory;
        $this->idUser = $idUser;
        */
    }

    public function connectBDD()
    {
        global $base, $login, $mdp;
        $this->con = new Gateway(new Connection($base, $login, $mdp));
    }

    public function get_data()
    {
        $this->connectBDD();
        $cat = 'date';
        $order = 'ASC';
        return $this->con->getPosts($cat, $order);
    }
}

?>