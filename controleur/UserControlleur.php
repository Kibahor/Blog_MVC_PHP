<?php

class UserControlleur
{
    private $rep;
    private $vues;

    private $admin_model;
    private $article_model;
    private $commentaires_model;

    public function __construct($action)
    {
        global $rep, $vues;// nécessaire pour utiliser variables globales
        $this->rep = $rep;
        $this->vues = $vues;

        $this->article_model= new ArticleModel();
        $this->commentaires_model=new CommentaireModel();
        $this->admin_model=new AdminModel();


        try {
            switch ($action) {
                case NULL:              //1 er appel
                    $this->init();
                    break;
                case "search":
                    if(isset($_POST['query']) && !empty($_POST['query'])){
                        $this::showHomeNews($this::searchNews($_POST['query']));
                    }else{
                        $this::init();
                    }
                    break;
                case "get":
                    $this->getArticle();
                    break;
                case "addC":
                    $this->addCommentaire();
                    break;
                case "connection":
                    $this->connexion();
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
        $numPage=$this::getNumPage();
        $tabArticle=$this::getHomeNews($numPage);
        $this::showHomeNews($tabArticle);
    }
    public function getHomeNews($page) :array
    {
        return $this->article_model->getPageArticle($page);
    }

    public function showHomeNews($tabArticle){
        $page=$this->getNumPage();
        $nb_article_page=5;
        $nbArticle=$this->article_model->Count();
        $nbArticle=$nbArticle[0][0];
        $nbCom=$this->getCompteur();
        if($nbArticle <= ($page-1)*$nb_article_page && $nbArticle!=0){
            FrontControlleur::$dVueErreur[]="Ce numéro de page n'existe pas";
        }
        $this->article_model->cutArticle($tabArticle);
        require($this->rep . $this->vues['home']);

        //Affiche les boutons de page si le nombre d'articles par page est dépassé
        if($nbArticle > $nb_article_page){
            require($this->rep . $this->vues['buttonPage']);
        }
    }

    public function getNumPage() :int
    {
        $page=1;
        if(isset($_GET['page'])) {
            $page = Validation::cleanINT($_GET['page']);
        }
        return $page;
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

    function connexion() {
        require ($this->rep.$this->vues['login']);

        if(isset($_REQUEST['button'])){
        $nom=$_REQUEST['login'];
        $mdp=$_REQUEST['password'];

        Validation::connexion_form($nom, $mdp);


        if(empty(FrontControlleur::$dVueErreur)){
            $utilisateur=$this->admin_model->authentification($nom,$mdp);
            if(!isset($utilisateur)) {
                FrontControlleur::$dVueErreur[] =	"Mot de passe ou identifiant incorrect";
            }else{
                $_SESSION['pseudo'] = $utilisateur;                                                 //connecté, tu peux faire la redirection ici
            }
        }
    }
    }
}
