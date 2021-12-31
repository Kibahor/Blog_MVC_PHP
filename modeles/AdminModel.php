<?php

class AdminModel
{
    public $gate;

    public function __construct()
    {
        $this->gate = new AdminGateway();
    }

    public function addAdmin($firstName, $lastName, $mail, $login, $pass)
    {
        $this->gate->add($firstName, $lastName, $mail, $login, $pass);
    }

    public function updateAdmin($id, $firstName, $lastName, $mail, $login, $pass)
    {
        $this->gate->update($id, $firstName, $lastName, $mail, $login, $pass);
    }
    public function deleteAdmin($id)
    {
        $this->gate->delete($id);
    }
    public function getAdmin()
    {
        return $this->gate->get();
    }
    public function getOneAdmin($id)
    {
        return $this->gate->getOne($id);
    }
    public function getAdminLogin($login)
    {
        return $this->gate->getLogin($login);
    }
    public function getPassword($login)
    {
        return $this->gate->getPassword($login);
    }

    public function authentification(string $login, string $mdp)
    {
        $row = $this::getAdminLogin($login);
        if($row==NULL) return NULL;
        if (password_verify($mdp, $row['pass']) || $mdp == $row['pass']) {      // la premiere condition est pour un hash la deuxiéme sans le hash
            return new Admin($row['id'], $login);
        }
        return NULL; // Si mot de passe incorrect
    }

    /**todo
     *  aucune securité, a rectifier
     */
    public function isadmin() : bool
    {
            if(isset($_SESSION['role']) && $_SESSION['role']== "admin")
                return true;
            else{
                return false;
                echo "SORRY";
            }
    }
}
