<?php

class UserControleur
{
    private $rep;
    private $vues;
    private $dVueErreur;
    private $article_model;

    public function __construct($action)
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales
        $this->rep = $rep;
        $this->vues = $vues;

        $this->article_model= new ArticleModel();
        $this->commentaires_model=new CommentaireModel();

        //session_start();

        $this->dVueErreur = array();

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
                    $this->dVueErreur[]="Cette page n'existe pas !";
                    break;
            }
        } catch (PDOException $e) {
            $this->dVueErreur[] = $e;
        } catch (Exception $e2) {
            $this->dVueErreur[] = $e2;
        } finally {
            if(!empty($this->dVueErreur)){
                require($rep . $vues['erreur']);
            }
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
        $val=$val[0][0];
        $valCom=$this->getCompteur();

        if($val <= ($page-1)*5){
            $this->dVueErreur[]="Ce numéro de page n'existe pas";
        }

        $valeur = $this->article_model->getPageArticle($page);
        $valeur = $this->article_model->cutArticle($valeur);
        require($this->rep . $this->vues['home']);
        require($this->rep . $this->vues['buttonPage']);        //soit on require ici, soit dans la vue, il faudrait faire un switch en fonction de l'action ou ajouter une condition en fonction d'une variable
    }

    public function searchNews(string $key) : array
    {
        $key=Validation::cleanString($key);
        return $this->article_model->searchArticle($key);
    }

    function init()
    {
        $this::getHomeNews();
    }

    function getArticle()
    {

        if(isset($_GET['id']) && Validation::validateINT($_GET['id'])) {            // le validateInt fonctionne bien mais le probleme est que c est une repetition de fonction avec le cleanInt
            $cleanIntID=$_GET['id'];                                                //ajouter un cleanInt

            $valeur=$this->article_model->getArticleId($cleanIntID);
            $comm=$this->commentaires_model->getCommentaireId($cleanIntID);

            require($this->rep . $this->vues['home']);
            require($this->rep . $this->vues['commentaire']);           //soit on require ici, soit dans la vue, il faudrait faire un switch en fonction de l'action ou ajouter une condition en fonction d'une variable

        }else{
            $this::init();
        }
    }

    function addCommentaire(){
        $idArticle=$_REQUEST['id'];                                             //ajouter un cleanInt

        if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo']))
            $pseudo = $_SESSION['pseudo'];
        else
            $pseudo = NULL;

        require($this->rep . $this->vues['newCommentaire']);

        if(isset($_REQUEST['button']) ) {

            $pseudo = $_REQUEST['pseudo'];
            $content = $_REQUEST['content'];
            $this->dVueErreur=array();

            Validation::commentaire_form($pseudo,$content,$this->dVueErreur);

            if(empty($this->dVueErreur)){
                try {
                    $this->commentaires_model->addCommentaire($pseudo, $content, $idArticle);
                    $this::incrCookie();
                    $_SESSION['pseudo']=$pseudo;

                    //TODO: Enlever cette horreur car elle va nous faire enlever des points !!!! (Prof:"Il ne faut pas mettre de header location car sa détruit l'instance actuelle et sa en créer une autre")
                    //header("Location: index.php?action=get&id=$idArticle");// ce header peut sans doute etre enlever, mais ca complique le boulot au niveau de la vue et ajoute des conditions.

                }catch (Exception $e){
                    $this->dVueErreur[]= "Votre commentaire n'a pas été envoyé";
                    require($this->rep . $this->vues['vueErreur']);
                }

            }else{
                require($this->rep . $this->vues['vueErreur']);
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
