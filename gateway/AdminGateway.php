<?php
class AdminGateway extends Connection
{

    public function add($firstName, $lastName, $mail, $login, $pass)
    {
        $sql = 'INSERT INTO admin (firstName, lastName, mail, login, pass)
                VALUES (:firstName, :lastName, :mail, :login, :pass)';
        $this->executeQuery($sql, array(
            ':firstName' => array($firstName, PDO::PARAM_STR),
            ':lastName' => array($lastName, PDO::PARAM_STR),
            ':mail' => array($mail, PDO::PARAM_STR),
            ':login' => array($login, PDO::PARAM_STR),
            ':pass' => array($pass, PDO::PARAM_STR)
        ));

        /*
         *      Ajout d'un utilisateur
         */
    }

    public function update($id, $firstName, $lastName, $mail, $login, $pass)
    {
        $sql = 'UPDATE admin
                SET firstName = :firstName,
                lastName = :lastName,
                mail = :mail,
                login = :login,
                pass = :pass
                WHERE id = :id';
        $this->executeQuery($sql, array(
            ':firstName' => array($firstName, PDO::PARAM_STR),
            ':lastName' => array($lastName, PDO::PARAM_STR),
            ':mail' => array($mail, PDO::PARAM_STR),
            ':login' => array($login, PDO::PARAM_STR),
            ':pass' => array($pass, PDO::PARAM_STR),
            ':id' => array($id, PDO::PARAM_INT)
        ));
        /*
         *      Mise a jour d'un utilisateur
         */
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM admin
                WHERE id = :id';
        $this->executeQuery($sql, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));
        /*
         *      Suppression d'un utilisateur
         */
    }

    public function get()
    {
        $sql = 'SELECT *
                FROM admin
                ORDER BY id ASC';
        $this->executeQuery($sql);

        foreach ($this->getResults() as $post) {
            // Si plus de données a insérer dans le article redefinir le 2eme constructeur
            $tabResult[] = new Admin($post['id'], $post['firstName'], $post['lastName'], $post['mail'], NULL, NULL);
        }

        return $tabResult;
        /*
         *      Liste de tous les admins
         */
    }

    public function getOne($login)
    {
        $sql = 'SELECT id, login
                FROM admin
                WHERE login = :login';
        $this->executeQuery($sql, array(
            ':login' => array($login, PDO::PARAM_STR)
        ));

        return $this->getResults()[0];
    }


    public function getLogin($login)
    {
        $sql = 'SELECT id, login,pass
                FROM admin
                WHERE login = :login';
        $this->executeQuery($sql, array(
            ':login' => array($login, PDO::PARAM_STR)
        ));

        return $this->getResults();
    }

    public function getPassword($login)
    {
        $sql = 'SELECT pass
                FROM admin
                WHERE login = :login';
        $this->executeQuery($sql, array(
            ':login' => array($login, PDO::PARAM_STR)
        ));

        return $this->getResults();
        /*
         *      Récupération du Password lié au login pour la connexion
         */
    }
}
