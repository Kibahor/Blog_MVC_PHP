<?php

class CommentaireGateway extends Connection
{
    //Ajouter un commentaire
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

    //Supprimer un commentaire
    public function supp($pseudo, $content, $idArticle)
    {
        $sql = 'DELETE FROM commentaires WHERE pseudo=:pseudo AND idArticle=:idArticle AND content=:content';
        $this->executeQuery($sql, array(
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
            ':content' => array($content, PDO::PARAM_STR),
            ':idArticle' => array($idArticle, PDO::PARAM_STR)
        ));
    }

    //Obtenir les 5 premiers commentaires
    public function getPage($start, $stop) :array
    {
        $sql = "SELECT id,pseudo, content, DATE_FORMAT(created, '%D %b %Y') AS date, idArticle
                FROM commentaires
                ORDER BY date DESC LIMIT {$start},{$stop}";
        $this->executeQuery($sql);
        $tabResult=array();
        foreach ($this->getResults() as $post) {
            $tabResult[] = new Commentaire($post['id'], $post['pseudo'], $post['content'], $post['date'], $post['idArticle']);
        }
        return $tabResult;
    }

    public function getId($id) : array
    {
        $sql = 'SELECT *
                FROM commentaires
                WHERE idArticle = :id';
        $this->executeQuery($sql, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));

        $tabResult = [];
        foreach ($this->getResults() as $post) {
            $tabResult[] = new Commentaire($post['id'], $post['pseudo'], $post['content'], $post['created'], $post['idArticle']);
        }

        return $tabResult;
    }
}
