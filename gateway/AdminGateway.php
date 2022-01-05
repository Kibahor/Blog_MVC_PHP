<?php

class AdminGateway extends Connection
{
    /*** Ajout d'un Admin (non utilisé dans le site, mais dans la phase de production)
     * @param $firstName
     * @param $lastName
     * @param $mail
     * @param $login
     * @param $pass
     */
    public function add(string $firstName, string $lastName, string $mail, string $login, string $pass)
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
    }

    /** Modification d'un admin (non implémenté)
     * @param $id
     * @param $firstName
     * @param $lastName
     * @param $mail
     * @param $login
     * @param $pass
     */
    public function update(int $id, string $firstName, string $lastName, string $mail, string $login, string $pass)
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
    }

    /**Delete admin par ID
     * @param $id
     */
    public function delete(int $id)
    {
        $sql = 'DELETE FROM admin
                WHERE id = :id';
        $this->executeQuery($sql, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));
    }

    /** Affichage de tout les ADMIN (non implémenté)
     * @return array
     */
    public function get():array
    {
        $sql = 'SELECT *
                FROM admin
                ORDER BY id ASC';
        $this->executeQuery($sql);

        foreach ($this->getResults() as $post) {
            $tabResult[] = new Admin($post['id'], $post['firstName'], $post['lastName'], $post['mail'], NULL);
        }

        return $tabResult;
    }

    /** Get 1 admin par le login (premier arrivé premier servi)
     * @param $login
     * @return mixed
     */
    public function getOne(string $login)
    {
        $sql = 'SELECT id, login
                FROM admin
                WHERE login = :login';
        $this->executeQuery($sql, array(
            ':login' => array($login, PDO::PARAM_STR)
        ));

        return $this->getResults()[0];
    }

    /** Récupére tout les admin du même login
     * @param $login
     * @return array
     */
    public function getLogin(string $login) :array
    {
        $sql = 'SELECT id, login,pass
                FROM admin
                WHERE login = :login';
        $this->executeQuery($sql, array(
            ':login' => array($login, PDO::PARAM_STR)
        ));

        return $this->getResults();
    }

    /**Récuperation du mdp pour un admin précis (id)
     * @param $id
     * @return array
     */
    public function getPassword(int $id):array
    {
        $sql = 'SELECT pass
                FROM admin
                WHERE id = :id';
        $this->executeQuery($sql, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));

        return $this->getResults();
    }
}
