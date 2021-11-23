<?php

class Posts
{
    public $con;


    private $id;
    private $title;
    private $content;
    private $img;
    private $created;
    private $idCategory;
    private $idUser;


    function __construct(/*$id, $title, $content, $img, $created, $idCategory, $idUser*/)
    {
        global $base, $login, $mdp;
        $this->con = new Gateway(new Connection($base, $login, $mdp));

        /*$this->$id = $id;
        $this->$title = $title;
        $this->$content = $content;
        $this->$img = $img;
        $this->$created = $created;
        $this->$idCategory = $idCategory;
        $this->$idUser = $idUser;*/
    }


    public function get_data()
    {
        $cat = 'date';
        $order = 'ASC';
        $s = $this->con->getPosts($cat, $order);
        print_r($s);
        echo $s[1];
        return $s;
    }

    public function __toString()
    {
        return $this->con;
    }
}
