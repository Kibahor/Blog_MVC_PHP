<?php

class FrontControlleur
{
    private $rep;
    private $vues;

    public static $dVueErreur;

    public function __construct()
    {
        session_start();
        global $rep, $vues; // nécessaire pour utiliser variables globales
        $this->rep = $rep;
        $this->vues = $vues;

        self::$dVueErreur=array();

        require($this->rep . $this->vues['head']);
        $actionAdmin = array('supprimer', 'creer', 'deconnexion');
        try {
            $model = new AdminModel();
            $admin = $model->isadmin();

            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
                $action = $_REQUEST['action'];
            } else {
                $action = NULL;
            }

            if (in_array($action, $actionAdmin)) {
                if ($admin == false) {
                    require($rep . $vues['login']);
                } else {
                    new AdminController($action);
                }
            } else {
                new UserControlleur($action);
            }
        } catch (PDOException $e) {
            self::$dVueErreur[] = $e;
        } finally {
            if(!empty(self::$dVueErreur)){
                require($rep . $vues['erreur']);
            }
            require ($this->rep . $this->vues['footer']);
        }
    }
}