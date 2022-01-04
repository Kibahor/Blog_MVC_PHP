<?php

class Admin
{
    public $id;
    public $firstName;
    public $lastName;
    public $mail;
    public $login;


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
    public function getFirstName(){return $this->firstName;}

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName){$this->firstName = $firstName;}

    /**
     * @return mixed
     */
    public function getLastName(){return $this->lastName;}

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName){$this->lastName = $lastName;}

    /**
     * @return mixed
     */
    public function getMail(){return $this->mail;}

    /**
     * @param mixed $mail
     */
    public function setMail($mail){$this->mail = $mail;}

    /**
     * @return mixed
     */
    public function getLogin(){return $this->login;}

    /**
     * @param mixed $login
     */
    public function setLogin($login){$this->login = $login;}

    /**
     * @return mixed
     */
    public function getPass(){return $this->pass;}

    /**
     * @param mixed $pass
     */
    public function setPass($pass){$this->pass = $pass;}




    function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this, $f = '__construct' . $i))
            call_user_func_array(array($this, $f), $a);
    }

    function __construct2($id,$login)
    {
        $this->id = $id;
        $this->login = $login;
    }

    //Constructeur pour insérer les données en retour de la requete sql !! modifier le nom
    function __construct5($id, $firstName, $lastName, $mail, $login)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->mail = $mail;
        $this->login = $login;
    }
}
