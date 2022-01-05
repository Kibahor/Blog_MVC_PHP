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
    public function addAdmin(string $firstName, string $lastName, string $mail, string $login, string $pass)
    {
        $pass = password_hash($pass, PASSWORD_ARGON2ID);
        $this->gate->add($firstName, $lastName, $mail, $login, $pass);
    }

    public function updateAdmin(int $id, string $firstName, string $lastName, string $mail, string $login, string $pass)
    {
        $this->gate->update($id, $firstName, $lastName, $mail, $login, $pass);
    }

    public function deleteAdmin(int $id)
    {
        $this->gate->delete($id);
    }

    public function getIdAdmin(string $login)
    {
        return $this->gate->getOne($login);
    }

    /** Fonction pour obtenir seulement le mdp
     * @param $login
     * @return array
     */
    public function getPassword(string $login)
    {
        return $this->gate->getPassword($login);
    }

    public function getAdminLogin(string $login)
    {
        return $this->gate->getLogin($login);
    }

    /** Connexion (utlisation du getAdminLogin) pour éviter plusiers requête sql (en impliquant qu'il n'existe pas de doublon d'Admin)
     * @param string $login
     * @param string $mdp
     * @return Admin|null
     */
    public function authentification(string $login, string $mdp)
    {
        $row = $this::getAdminLogin($login);
        if ( (is_array($row) && sizeof($row)>0)|| $row!=NULL) {
            $row = $row[0];
        }else{
            return NULL;
        }
        if (password_verify($mdp, $row['pass']) || $mdp == $row['pass']) {      // la premiere condition est pour un hash la deuxiéme sans le hash
            return new Admin($row['id'], $login);
        }
        return NULL; // Si mot de passe incorrect
    }

    /**Verification si admin
     * @return bool
     */
    public function isadmin(): bool
    {
        return (isset($_SESSION['role']) && Validation::cleanString($_SESSION['role'] == "admin"));
    }
}
