<?php

class Controleur
{
    private $rep;
    private $vues;
    private $article_model;

    public function __construct()
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales
        $this->rep = $rep;
        $this->vues = $vues;

        $this->article_model= new ArticleModel();

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
            $dVueEreur[] = $e2;
            require($rep . $vues['erreur']);
        }

        exit(0);
    }

    public function getNews()
    {
        $model = new ArticleModel();
        $page=0;
        if(isset($_GET['page'])) {
            $page = Validation::cleanINT($_GET['page']);
        }else{
            $page=1;
        }
        $val =$model->Count();
        if($val[0][0] < $page)
            throw new Exception("Cette page n'existe pas ");

        $valeur = $model->getPageArticle($page);
        require($this->rep . $this->vues['home']);
    }

    public function searchNews(string $key) :array
    {
        $key=Validation::cleanString($key);
        return $this->article_model::searchArticle($key);
    }

    function init()
    {
        $this::getNews();
        //var_dump($valeur);
        //require($this->rep . $this->vues['one_article']);
    }



}
