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

        $this->admin_model= new AdminModel();
        $this->article_model= new ArticleModel();

        try {
            switch ($action) {
                case NULL:
                    //$this->init();
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
            FrontControlleur::$dVueErreur[] = $e;
        } catch (Exception $e2) {
            FrontControlleur::$dVueErreur[] = $e2;
        }
    }

    public function delete(){
        $cleanIntID=Validation::cleanINT(Validation::cleanINT($_GET['id']));
        $this->article_model->deleteArticle($cleanIntID);               //pas besoin de faire de message d'erreur pour article non trouvé
        new UserControlleur(NULL);
    }

    public function add(){

        require($this->rep . $this->vues['newArticle']);

        if(isset($_REQUEST['button'])) {
            $titre = $_REQUEST['titre'];
            $content = $_REQUEST['content'];

            Validation::article_form($titre, $content);

            if (empty(FrontControlleur::$dVueErreur)) {
                try {
                    $pseudo = Validation::cleanString($_SESSION['pseudo']);
                    $idAdmin = $this->admin_model->getIdAdmin($pseudo)[0];

                    $this->article_model->ajoutArticle($titre, $content, $idAdmin);


                } catch (Exception $e) {
                    FrontControlleur::$dVueErreur[] = $e;
                }
            }
        }
    }
}