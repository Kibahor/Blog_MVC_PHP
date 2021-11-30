<?php

class Commentaire
{
    public $con;
    public $gate;

    public $id;
    public $pseudo;
    public $content;
    public $date;
    public $idArticle;

    /**
     * @return mixed
     */
    public function getCon(){return $this->con;}

    /**
     * @param mixed $con
     */
    public function setCon($con){$this->con = $con;}

    /**
     * @return mixed
     */
    public function getGate(){return $this->gate;}

    /**
     * @param mixed $gate
     */
    public function setGate($gate){$this->gate = $gate;}

    /**
     * @return mixed
     */
    public function getId(){return $this->id;}

    /**
     * @param mixed $id
     */
    public function setId($id){$this->id = $id;}

    /**
     * @return mixed
     */
    public function getPseudo(){return $this->pseudo;}

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo){$this->pseudo = $pseudo;}

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
    public function getIdArticle(){return $this->idArticle;}

    /**
     * @param mixed $idArticle
     */
    public function setIdArticle($idArticle){$this->idArticle = $idArticle;}


    function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this, $f = '__construct' . $i))
            call_user_func_array(array($this, $f), $a);
    }

    //Constructeur pour insérer les données en retour de la requete sql !! modifier le nom
    function __construct5($id, $pseudo, $content,$date , $idArticle)
    {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->content = $content;
        $this->date = $date;
        $this->idArticle = $idArticle;
    }
}
