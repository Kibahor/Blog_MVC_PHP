<?php

class AdminController
{
    private $rep;
    private $vues;

    private $admin_model;
    public function __construct($action)
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales
        $this->rep = $rep;
        $this->vues = $vues;

        $this->admin_model= new AdminModel();

        try {
            switch ($action) {
                case NULL:
                    //$this->init();
                    break;
                case "supprimer":
                    break;
                case "ajouter":
                    break;
                case "deconnexion":
                    break;
                default:
                    break;
            }
        } catch (PDOException $e) {
            FrontControlleur::$dVueErreur[] = $e;
        } catch (Exception $e2) {
            FrontControlleur::$dVueErreur[] = $e2;
        }
    }
}