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

    /**
     * Fonction qu'on appelle sans action
     * (pratique pour faire des tests)
     */
    function init()
    {
        $tabArticle = $this::getHomeNews($this::getNumPage());
        $this::showHomeNews($tabArticle);
    }

    /** a partir du id page de l'url on retourne les articles
     * @param $page
     * @return array
     */
    public function getHomeNews($page): array
    {
        return $this->article_model->getPageArticle($page);
    }

    /**Recupere et retourne un clean int de l'url (n° page)
     * @return int
     */
    public function getNumPage(): int
    {
        $page = 1;
        if (isset($_GET['page'])) {
            $page = Validation::cleanINT($_GET['page']);
        }
        return $page;
    }

    /** Affichage de la page principale
     * @param array $tabArticle
     */
    public function showHomeNews(array $tabArticle)
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

    /**Recupere compteur cookie
     * @return int
     */
    public function getCompteur():int
    {
        if (isset($_COOKIE['commentaires'])) {
            return Validation::cleanINT($_COOKIE['commentaires']);
        }
        return 0;
    }

    /** Recherche Article BDD
     * @param string $key
     * @return array
     */
    public function searchNews(string $key): array
    {
        $key = Validation::cleanString($key);
        return $this->article_model->searchArticle($key);
    }

    /**
     * Affichage et recherche d'un article particulier
     */
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

    /**
     * Affichage et ajout d'un nouveau commentaire + incrementation cookie
     */
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

                    /**
                     * On peut utiliser la meme methode que lors de la connection, mais le header location permet de reecricre l'URL
                     */
                    header("Location: index.php?action=get&id=$idArticle");
                } catch (Exception $e) {
                    FrontControlleur::addError("Votre commentaire n'a pas été envoyé");
                }
            }
        }
    }

    /**
     * Incrementation cookie
     */
    function incrCookie()
    {
        $cpt = $this::getCompteur();
        setcookie("commentaires", $cpt + 1, time() + 365 * 24 * 3600);
    }

    /**
     * Affichage formulaire et traitement de la connexion
     */
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

                    /**
                     * A la place de utiliser le header location, on utilise cette methode qui NE reecrit pas L'URL !!
                     * header("Location: index.php");
                     */
                    $_GET['action']=null;
                    new UserControlleur(null);
                }
            }
        }
        require($this->rep . $this->vues['login']);
    }
}
