<?php
class CommentaireGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }


    //ajouter un commentaires
    public function add($pseudo, $content, $idArticle)
    {
        $sql = 'INSERT INTO commentaires (pseudo, content, created, idArticle)
                VALUES (:pseudo, :content, NOW(), :idAdmin)';
        $this->con->executeQuery($sql, array(
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
            ':content' => array($content, PDO::PARAM_STR),
            ':idArticle' => array($idArticle, PDO::PARAM_STR)
        ));
    }

    //supprimer un commentaires
    public function supp($pseudo, $content, $idArticle)
    {
        $sql = 'INSERT INTO commentaires (pseudo, content, created, idArticle)
                VALUES (:pseudo, :content, NOW(), :idArticle)';
        $this->con->executeQuery($sql, array(
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
            ':content' => array($content, PDO::PARAM_STR),
            ':idArticle' => array($idArticle, PDO::PARAM_STR)
        ));
    }

    //Fonction pour obtenir les 5 premier commentaires
    public function getPage($start, $stop)
    {
        $sql = "SELECT id,pseudo, content, DATE_FORMAT(created, '%D %b %Y') AS date, idArticle
                FROM commentaires
                ORDER BY date DESC LIMIT {$start},{$stop}";
        $this->con->executeQuery($sql);

        foreach ($this->con->getResults() as $post) {
            // Si plus de données a insérer dans le article redefinir le 2eme constructeur
            $tabResult[] = new Commentaire($post['id'], $post['pseudo'], $post['content'], $post['date'], $post['idArticle']);
        }
        return $tabResult;
    }

    public function get($id)
    {
        $sql = 'SELECT *
                FROM commentaires
                WHERE id = :id';
        $this->con->executeQuery($sql, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));

        foreach ($this->con->getResults() as $post) {
            // Si plus de données a insérer dans le article redefinir le 2eme constructeur
            $tabResult[] = new Commentaire($post['id'], $post['pseudo'], $post['content'], $post['date'], $post['idArticle']);
        }

        return $tabResult;
    }
}
