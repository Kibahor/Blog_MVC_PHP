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
                case "add":
                    //$this::delete();
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
        $cleanIntID=Validation::cleanINT($_GET['id']);
        $this->article_model->deleteArticle($cleanIntID);               //pas besoin de faire de message d'erreur pour article non trouvé
        new UserControlleur(NULL);
    }
}