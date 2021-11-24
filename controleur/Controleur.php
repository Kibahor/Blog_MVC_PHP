<?php

class Controleur
{

    function __construct ()
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales
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
            //si erreur BD, pas le cas ici
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
        global $rep, $vues;

        $model = new Posts();
        $model->get_data();
        
        require($rep . $vues['vuephp1']);
    }
}
