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
                    $dVueEreur[]="Erreur d'appel php";
                    require($rep . $vues['posts']);
                    break;
            }
        } catch (PDOException $e) {
            $dVueEreur[] = $e;
            echo $e;
            require($rep . $vues['erreur']);
        } catch (Exception $e2) {
            $dVueEreur[] = "Erreur inattendue!!! ";
            require($rep . $vues['erreur']);
        }

        exit(0);
    }


    function init()
    {
        $model = new Article();
        $valeur = $model->get_articles(NULL);

        /*
        require($this->rep . $this->vues['head']);
        require($this->rep . $this->vues['nav']);
        if(false){
            require($this->rep . $this->vues['header']);
            require($this->rep . $this->vues['posts']);
        }else{
            $p=$valeur[0];
            require($this->rep . $this->vues['oneArticle']);
        }
        require($this->rep . $this->vues['footer']);
        */
    }
}
