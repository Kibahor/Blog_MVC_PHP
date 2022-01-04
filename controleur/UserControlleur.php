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
        global $rep, $vues;
        $this->rep = $rep;
        $this->vues = $vues;

        $this->article_model = new ArticleModel();
        $this->commentaires_model = new CommentaireModel();
        $this->admin_model = new AdminModel();


        try {
            switch ($action) {
                case NULL:              //1 er appel
                    $this->init();
                    break;
                case "search":
                    if (isset($_POST['query']) && !empty($_POST['query'])) {
                        $this::showHomeNews($this::searchNews(Validation::cleanString($_POST['query'])));
                    } else {
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
                    FrontControlleur::addError("Cette page n'existe pas !");
                    break;
            }
        } catch (PDOException $e) {
            FrontControlleur::addError($e);
        } catch (Exception $e2) {
            FrontControlleur::addError($e2);
        }
    }

    function init()
    {
        $tabArticle = $this::getHomeNews($this::getNumPage());
        $this::showHomeNews($tabArticle);
    }

    public function getHomeNews($page): array
    {
        return $this->article_model->getPageArticle($page);
    }

    public function getNumPage(): int
    {
        $page = 1;
        if (isset($_GET['page'])) {
            $page = Validation::cleanINT($_GET['page']);
        }
        return $page;
    }

    public function showHomeNews($tabArticle)
    {

        $admin = $this->admin_model->isadmin();

        $page = $this->getNumPage();
        $nbArticle = $this->article_model->Count();
        $nbCom = $this->getCompteur();
        if ($nbArticle <= ($page - 1) * 2 && $nbArticle != 0) {
            FrontControlleur::addError("Ce numéro de page n'existe pas");
        }
        $tabArticle = $this->article_model->cutArticle($tabArticle);
        require($this->rep . $this->vues['home']);

        //Affiche les boutons de page si le nombre d'articles par page est dépassé
        if ($nbArticle > 2) {
            require($this->rep . $this->vues['buttonPage']);
        }
    }

    public function getCompteur()
    {
        if (isset($_COOKIE['commentaires'])) {
            return Validation::cleanINT($_COOKIE['commentaires']);
        }
        return 0;
    }

    public function searchNews(string $key): array
    {
        $key = Validation::cleanString($key);
        return $this->article_model->searchArticle($key);
    }

    function getArticle()
    {
        if (!isset($_GET['id'])) {
            $this::init();
        }
        $cleanIntID = Validation::cleanINT($_GET['id']);

        $article = $this->article_model->getArticleId($cleanIntID);
        $com = $this->commentaires_model->getCommentaireId($cleanIntID);

        require($this->rep . $this->vues['one_article']);
        require($this->rep . $this->vues['commentaire']);

    }

    function addCommentaire()
    {
        $idArticle = Validation::cleanINT($_REQUEST['id']);

        if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo']))
            $pseudo = Validation::cleanString($_SESSION['pseudo']);
        else
            $pseudo = NULL;

        require($this->rep . $this->vues['newCommentaire']);

        if (isset($_REQUEST['button'])) {

            $pseudo = Validation::cleanString($_REQUEST['pseudo']);
            $content = Validation::cleanString($_REQUEST['content']);

            Validation::commentaire_form($pseudo, $content);

            if (empty(FrontControlleur::getError())) {
                try {
                    $this->commentaires_model->addCommentaire($pseudo, $content, $idArticle);
                    $this::incrCookie();
                    $_SESSION['pseudo'] = $pseudo;

                    header("Location: index.php?action=get&id=$idArticle");// ce header peut sans doute etre enlever, mais ca complique le boulot au niveau de la vue et ajoute des conditions.
                } catch (Exception $e) {
                    FrontControlleur::addError("Votre commentaire n'a pas été envoyé");
                }
            }
        }
    }

    function incrCookie()
    {
        $cpt = $this::getCompteur();
        setcookie("commentaires", $cpt + 1, time() + 365 * 24 * 3600);
    }

    function connexion()
    {
        $admin = $this->admin_model->isadmin();

        if (isset($_REQUEST['button']) && !$admin) {
            $nom = Validation::cleanString($_REQUEST['login']);
            $mdp = Validation::cleanString($_REQUEST['password']);

            Validation::connexion_form($nom, $mdp);

            if (empty(FrontControlleur::getError())) {
                $utilisateur = $this->admin_model->authentification($nom, $mdp);
                if (!isset($utilisateur)) {
                    FrontControlleur::addError("Mot de passe ou identifiant incorrect");
                } else {
                    $_SESSION['pseudo'] = $utilisateur->login;
                    $_SESSION['role'] = "admin";
                    header("Location: index.php");
                }
            }
        }

        require($this->rep . $this->vues['login']);


    }
}
