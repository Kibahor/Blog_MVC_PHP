<?php
class AdminGateway extends Connection
{

    public function add($firstName, $lastName, $mail, $login, $pass)
    {
        $sql = 'INSERT INTO users (firstName, lastName, mail, login, pass)
                VALUES (:firstName, :lastName, :mail, :login, :pass)';
        $this->executeQuery($sql, array(
            ':firstName' => array($firstName, PDO::PARAM_STR),
            ':lastName' => array($lastName, PDO::PARAM_STR),
            ':mail' => array($mail, PDO::PARAM_STR),
            ':login' => array($login, PDO::PARAM_STR),
            ':pass' => array($pass, password_hash($pass, PASSWORD_DEFAULT), PDO::PARAM_INT)
        ));

        /*
         *      Ajout d'un utilisateur
         */
    }

    public function update($id, $firstName, $lastName, $mail, $login, $pass)
    {
        $sql = 'UPDATE users
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
        $sql = 'DELETE FROM users
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
                FROM users
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

    public function getOne($id)
    {
        $sql = 'SELECT *
                FROM users
                WHERE id = :id';
        $this->executeQuery($sql, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));

        return $this->getResults();
    }


    public function getId($login)
    {
        $sql = 'SELECT id
                FROM users
                WHERE login = :login';
        $this->executeQuery($sql, array(
            ':login' => array($login, PDO::PARAM_INT)
        ));

        return $this->getResults();
    }

    public function getPassword($login)
    {
        $sql = 'SELECT pass
                FROM users
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
