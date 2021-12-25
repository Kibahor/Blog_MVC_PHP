<?php

class UserControleur
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
        $this->commentaires_model=new CommentaireModel();

        //session_start();

        $dVueEreur = array();

        try {
            $action=NULL;
            if(isset($_GET['action'])) {
                $action = $_GET['action'];
            }
            switch ($action) {
                case NULL:              //1 er appel
                    $this->init();
                    break;
                case "search":
                    if(isset($_POST['query'])){
                        echo $_POST['query'];
                        var_dump($this::searchNews($_POST['query']));
                    }else{
                        $this::getHomeNews();
                    }
                    break;
                case "get":
                    $this->getArticle();
                    break;
                default:    //erreur //Page 404
                    $dVueEreur[]="Erreur d'appel php";
                    require($rep . $vues['erreur']);
                    break;
            }
        } catch (PDOException $e) {
            $dVueEreur[] = $e;
            require($rep . $vues['erreur']);
        } catch (Exception $e2) {
            $dVueEreur[] = $e2;
            require($rep . $vues['erreur']);
        }

        exit(0);
    }

    public function getHomeNews()
    {
        $page=0;
        if(isset($_GET['page']) && Validation::validateINT($_GET['page'])) {            // le validateInt fonctionne bien mais le probleme est que c est une repetition de fonction avec le cleanInt
            $page = Validation::cleanINT($_GET['page']);   // ce cleanInt est cassé il ne retourne pas du tout la bonne valeur
        }else{
            $page=1;
        }
        $val =$this->article_model->Count();

        if($val[0][0] <= ($page-1)*5)
            throw new Exception("Cette page n'existe pas, ( il n y as pas assez d'article pour cette page ) ");

        $valeur = $this->article_model->getPageArticle($page);
        $valeur = $this->article_model->cutArticle($valeur);
        require($this->rep . $this->vues['home']);
    }

    public function searchNews(string $key) : array
    {
        $key=Validation::cleanString($key);
        return $this->article_model->searchArticle($key);
    }

    function init()
    {
        $this::getHomeNews();
        //var_dump($valeur);
        //require($this->rep . $this->vues['one_article']);
    }

    function getArticle()
    {

        if(isset($_GET['id']) && Validation::validateINT($_GET['id'])) {            // le validateInt fonctionne bien mais le probleme est que c est une repetition de fonction avec le cleanInt
            $cleanIntID=$_GET['id'];                                                            //ajouter un cleanInt
            $valeur=$this->article_model->getArticleId($cleanIntID);
            $comm=$this->commentaires_model->getCommentaireId($cleanIntID);                                                 //il faut les commentaires
            require($this->rep . $this->vues['home']);
        }else{

        }
    }


}
