<?php

class UserControlleur
{
    private $rep;
    private $vues;

    private $article_model;
    private $commentaires_model;

    public function __construct($action)
    {
        global $rep, $vues;// nécessaire pour utiliser variables globales
        $this->rep = $rep;
        $this->vues = $vues;

        $this->article_model= new ArticleModel();
        $this->commentaires_model=new CommentaireModel();

        //session_start();

        try {
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
                case "addC":
                    $this->addCommentaire();
                    break;
                default:
                    FrontControlleur::$dVueErreur[]="Cette page n'existe pas !";
                    break;
            }
        } catch (PDOException $e) {
            FrontControlleur::$dVueErreur[] = $e;
        } catch (Exception $e2) {
            FrontControlleur::$dVueErreur[] = $e2;
        }
    }

    function init()
    {
        $this::getHomeNews();
    }
    public function getHomeNews()
    {
        $nb_article_page=5;
        $page=0;
        if(isset($_GET['page'])) {
            $page = Validation::cleanINT($_GET['page']);
        }else{
            $page=1;
        }
        $val =$this->article_model->Count();
        $val=$val[0][0];
        $valCom=$this->getCompteur();

        if($val <= ($page-1)*$nb_article_page && $val!=0){
            FrontControlleur::$dVueErreur[]="Ce numéro de page n'existe pas";
        }

        $valeur = $this->article_model->getPageArticle($page);
        $valeur = $this->article_model->cutArticle($valeur);
        require($this->rep . $this->vues['home']);

        //Affiche les boutons de page si le nombre d'articles par page est dépassé
        if($val > $nb_article_page){
            require($this->rep . $this->vues['buttonPage']);
        }
    }

    public function searchNews(string $key) : array
    {
        $key=Validation::cleanString($key);
        return $this->article_model->searchArticle($key);
    }

    function getArticle()
    {
        if(isset($_GET['id'])) {
            $cleanIntID=Validation::cleanINT($_GET['id']);

            $valeur=$this->article_model->getArticleId($cleanIntID);
            $comm=$this->commentaires_model->getCommentaireId($cleanIntID);

            //Il faut utiliser la vue qui été prévu pour à la base : oneArticle.php
            require($this->rep . $this->vues['home']);
            require($this->rep . $this->vues['commentaire']);           //soit on require ici, soit dans la vue, il faudrait faire un switch en fonction de l'action ou ajouter une condition en fonction d'une variable

        }else{
            $this::init();
        }
    }

    function addCommentaire()
    {
        $idArticle =Validation::cleanINT($_REQUEST['id']);

        if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo']))
            $pseudo = $_SESSION['pseudo'];
        else
            $pseudo = NULL;

        require($this->rep . $this->vues['newCommentaire']);

        if (isset($_REQUEST['button'])) {

            $pseudo = $_REQUEST['pseudo'];
            $content = $_REQUEST['content'];

            Validation::commentaire_form($pseudo, $content);

            if (empty(FrontControlleur::$dVueErreur)) {
                try {
                    $this->commentaires_model->addCommentaire($pseudo, $content, $idArticle);
                    $this::incrCookie();
                    $_SESSION['pseudo'] = $pseudo;

                    //TODO: Enlever cette horreur car elle va nous faire enlever des points !!!! Le Prof a dit:"Il ne faut pas mettre de header location car sa détruit l'instance actuelle et sa en créer une autre" => En Gros sa casse tout !!
                    header("Location: index.php?action=get&id=$idArticle");// ce header peut sans doute etre enlever, mais ca complique le boulot au niveau de la vue et ajoute des conditions.
                } catch (Exception $e) {
                    FrontControlleur::$dVueErreur[] = "Votre commentaire n'a pas été envoyé";
                }
            }
        }
    }
    public function getCompteur()
    {
        if (isset($_COOKIE['commentaires'])) {
            return Validation::cleanINT($_COOKIE['commentaires']);
        }
        return 0;
    }

    function incrCookie(){
            $cpt=$this::getCompteur();
            setcookie("commentaires",$cpt+1,time()+365*24*3600);
    }
}
