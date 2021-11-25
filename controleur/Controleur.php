<?php

class Controleur
{
    private $rep;
    private $vues;

    function __construct()
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales
        $this->rep = $rep;
        $this->vues = $vues;

        session_start();

        $dVueEreur = array();

        try {
            $action = isset($_GET['action']);

            switch ($action) {

                case NULL:              //1 er appel
                    $this->init();
                    break;

                default:    //erreur
                    $dVueEreur[] =    "Erreur d'appel php";
                    require($rep . $vues['vuephp1']);
                    break;
            }
        } catch (PDOException $e) {
            $dVueEreur[] =    $e;
            require($rep . $vues['erreur']);
        } catch (Exception $e2) {
            $dVueEreur[] =    "Erreur inattendue!!! ";
            require($rep . $vues['erreur']);
        }

        exit(0);
    }


    function init()
    {
        $model = new Posts();
        $valeur = $model->get_data();

        require($this->rep . $this->vues['vuephp1']);
    }
}
