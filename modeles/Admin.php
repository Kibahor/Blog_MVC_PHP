<?php

class Admin //FAIRE DES GETTEUR ET SETTEUR
{
    public $con;
    public $gate;

    public $id;
    public $firstName;
    public $lastName;
    public $mail;
    public $login;
    public $pass;

    function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this, $f = '__construct' . $i))
            call_user_func_array(array($this, $f), $a);
    }

    function __construct1($login)
    {
        $this->login = $login;
    }

    //Constructeur pour insérer les données en retour de la requete sql !! modifier le nom
    function __construct6($id, $firstName, $lastName, $mail, $login, $pass)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->mail = $mail;
        $this->login = $login;
        $this->pass = $pass;
    }

    public function connectBDD()
    {
        global $base, $login, $mdp;
        $this->con = new Connection($base, $login, $mdp);
        $this->gate = new AdminGateway($this->con);
    }

    public function addAdmin($firstName, $lastName, $mail, $login, $pass)
    {
        $this->connectBDD();
        $this->gate->add($firstName, $lastName, $mail, $login, $pass);
    }

    public function updateAdmin($id, $firstName, $lastName, $mail, $login, $pass)
    {
        $this->connectBDD();
        $this->gate->update($id, $firstName, $lastName, $mail, $login, $pass);
    }
    public function deleteAdmin($id)
    {
        $this->connectBDD();
        $this->gate->delete($id);
    }
    public function getAdmin()
    {
        $this->connectBDD();
        $this->gate->get();
    }
    public function getOneAdmin($id)
    {
        $this->connectBDD();
        $this->gate->getOne($id);
    }
    public function getAdminId($login)
    {
        $this->connectBDD();
        $this->gate->getId($login);
    }
    public function getPassword($login)
    {
        $this->connectBDD();
        $this->gate->getPassword($login);
    }
}
