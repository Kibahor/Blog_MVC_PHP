<?php

class AdminModel
{
    public $gate;

    public function __construct()
    {
        $this->gate = new AdminGateway();
    }

    /**
     * Fonction d'inscription ATTENTION ne pas créer plusieurs fois le méme admin (meme login)
     * @param $firstName
     * @param $lastName
     * @param $mail
     * @param $login
     * @param $pass
     * //$this->admin_model->addAdmin("Matteo","Broquet","matteobroquete@gmail.com","admin","admin");
     */
    public function addAdmin($firstName, $lastName, $mail, $login, $pass)
    {
        $pass=password_hash($pass, PASSWORD_ARGON2ID);
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


    public function getIdAdmin($login)
    {
        return $this->gate->getOne($login);
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
        if(is_array($row)){
            $row=$row[0];
        }
        if($row==NULL) return NULL;
        if (password_verify($mdp, $row['pass']) || $mdp == $row['pass']) {      // la premiere condition est pour un hash la deuxiéme sans le hash
            return new Admin($row['id'], $login);
        }
        return NULL; // Si mot de passe incorrect
    }

    public function isadmin() : bool
    {
        return (isset($_SESSION['role']) && Validation::cleanString($_SESSION['role']== "admin"));
    }
}
