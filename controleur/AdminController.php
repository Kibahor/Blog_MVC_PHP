<?php

class AdminController
{
    private $rep;
    private $vues;
    private $admin_model;
    private $article_model;

    public function __construct($action)
    {
        global $rep, $vues;
        $this->rep = $rep;
        $this->vues = $vues;

        $this->admin_model = new AdminModel();
        $this->article_model = new ArticleModel();

        try {
            switch ($action) {
                case NULL:
                    FrontControlleur::addError("Une erreur est survenue");
                    break;
                case "delete":
                    $this::delete();
                    break;
                case "addA":
                    $this::add();
                    break;
                case "deconnection":
                    session_destroy();
                    require($this->rep . $this->vues['deconnection']);
                    break;
                default:
                    break;
            }
        } catch (PDOException $e) {
            FrontControlleur::addError($e);
        } catch (Exception $e2) {
            FrontControlleur::addError($e2);
        }
    }

    /**
     * Suppression d'article
     */
    public function delete()
    {
        $cleanIntID = Validation::cleanINT(Validation::cleanINT($_GET['id']));
        $this->article_model->deleteArticle($cleanIntID);               //pas besoin de faire de message d'erreur pour article non trouvé
        new UserControlleur(NULL);
    }

    /**
     * Ajout d'article
     */
    public function add()
    {

        require($this->rep . $this->vues['newArticle']);

        if (isset($_REQUEST['button'])) {
            $titre = Validation::cleanString($_REQUEST['titre']);
            $content = Validation::cleanString($_REQUEST['content']);
            $content = $this->article_model->bbc2html($content);
            Validation::article_form($titre, $content);

            if (empty(FrontControlleur::getError())) {
                try {
                    $pseudo = Validation::cleanString($_SESSION['pseudo']);
                    $idAdmin = $this->admin_model->getIdAdmin($pseudo)[0];

                    $this->article_model->ajoutArticle($titre, $content, $idAdmin);

                    header("Location: index.php");// ce header peut sans doute etre enlever, mais ca complique le boulot au niveau de la vue et ajoute des conditions.
                } catch (Exception $e) {
                    FrontControlleur::addError($e);
                }
            }

        }
    }
}