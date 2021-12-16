<?php

class FrontControlleur
{
    private $rep;
    private $vues;

    public function __construct()
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales
        $this->rep = $rep;
        $this->vues = $vues;

        $actionAdmin = array('supprimer', 'creer', 'deconnexion');
        try {
            $model = new AdminModel();
            $admin = $model->isadmin();

            if (isset($_GET['action']))
                $action = $_GET['action'];
            else
                $action = null;

            if (in_array($action, $actionAdmin)) {
                if ($admin == false) {
                    require($rep . $vues['login']);
                } else {
                    new AdminController();
                }
            } else {
                new UserControleur();
            }

        } catch
        (PDOException $e) {
            require($rep . $vues['erreur']);

        }
    }
}