<?php

class Article
{
    public $id;
    public $title;
    public $content;
    public $date;
    public $idAdmin;

    /**
     * @return mixed
     */
    public function getId(){return $this->id;}

    /*** @param mixed $id
     */
    public function setId($id){$this->id = $id;}

    /**
     * @return mixed
     */
    public function getTitle(){return $this->title;}

    /**
     * @param mixed $title
     */
    public function setTitle($title){$this->title = $title;}

    /**
     * @return mixed
     */
    public function getContent(){return $this->content;}

    /**
     * @param mixed $content
     */
    public function setContent($content){$this->content = $content;}

    /**
     * @return mixed
     */
    public function getDate(){return $this->date;}

    /**
     * @param mixed $date
     */
    public function setDate($date){$this->date = $date;}

    /**
     * @return mixed
     */
    public function getIdAdmin(){return $this->idAdmin;}

    /**
     * @param mixed $idAdmin
     */
    public function setIdAdmin($idAdmin){$this->idAdmin = $idAdmin;}


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
}
