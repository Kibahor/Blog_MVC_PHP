<?php

class AdminController
{
    public function __construct($action)
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales
        $this->rep = $rep;
        $this->vues = $vues;

        $this->admin_model= new AdminModel();

        $this->dVueErreur = array();

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
            $this->dVueErreur[] = $e;
            require($rep . $vues['erreur']);
        } catch (Exception $e2) {
            $this->dVueErreur[] = $e2;
            require($rep . $vues['erreur']);
        }

        exit(0);

    }
}