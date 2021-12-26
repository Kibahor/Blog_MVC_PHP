<?php
class CommentaireGateway extends Connection
{
    //ajouter un commentaires
    public function add($pseudo, $content, $idArticle)
    {
        $sql = 'INSERT INTO commentaires (pseudo, content, created, idArticle)
                VALUES (:pseudo, :content, NOW(), :idArticle)';
        $this->executeQuery($sql, array(
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
            ':content' => array($content, PDO::PARAM_STR),
            ':idArticle' => array($idArticle, PDO::PARAM_INT)
        ));
    }

    //supprimer un commentaires
    public function supp($pseudo, $content, $idArticle)
    {
        $sql = 'INSERT INTO commentaires (pseudo, content, created, idArticle)
                VALUES (:pseudo, :content, NOW(), :idArticle)';
        $this->executeQuery($sql, array(
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
        $this->executeQuery($sql);

        foreach ($this->getResults() as $post) {
            // Si plus de données a insérer dans le article redefinir le 2eme constructeur
            $tabResult[] = new Commentaire($post['id'], $post['pseudo'], $post['content'], $post['date'], $post['idArticle']);
        }
        return $tabResult;
    }

    public function getId($id)
    {
        $sql = 'SELECT *
                FROM commentaires
                WHERE idArticle = :id';
        $this->executeQuery($sql, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));

        $tabResult=[];
        foreach ($this->getResults() as $post) {
            $tabResult[] = new Commentaire($post['id'], $post['pseudo'], $post['content'], $post['created'], $post['idArticle']);
        }

        return $tabResult;
    }
}
