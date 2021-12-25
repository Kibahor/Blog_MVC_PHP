<?php
class ArticleGateway extends Connection
{

    public function getArticle($cat, $order): array
    {
        $sql = "SELECT article.id AS articleId,created, title,content, DATE_FORMAT(created, '%d/%m/%Y') AS date, u.id AS idAdmin
                FROM article
                LEFT JOIN admin u on article.idAdmin = u.id
                ORDER BY {$cat} {$order}";
        $this->executeQuery($sql);

        $tabResult=[];
        foreach ($this->getResults() as $post) {
            $tabResult[] = new Article($post['articleId'], $post['title'], $post['date'], $post['content'], $post['idAdmin']);
        }
        return $tabResult;
    }

    //ajouter un Article
    public function addArticle($title, $content, $idAdmin) //TODO Return bool en cas de success
    {
        $sql = 'INSERT INTO article (title, content, created, idAdmin) :bool
                VALUES (:title, :content, NOW(), :idAdmin)';
        return $this->executeQuery($sql, array(
            ':title' => array($title, PDO::PARAM_STR),
            ':content' => array($content, PDO::PARAM_STR),
            ':idAdmin' => array($idAdmin, PDO::PARAM_STR)
        ));

    }

    public function modifArticle($id, $title, $content) :bool
    {
        $sql = 'UPDATE posts
                SET title = :title,
                content = :content
                WHERE id = :id';
        return $this->executeQuery($sql, array(
            ':title' => array($title, PDO::PARAM_STR),
            ':content' => array($content, PDO::PARAM_STR),
            ':id' => array($id, PDO::PARAM_INT)
        ));
    }

    //Fonction pour obtenir les 5 premier Articles
    public function getPage($start, $stop) :array
    {
        $sql = "SELECT id,title, content, DATE_FORMAT(created, '%D %b %Y') AS date, idAdmin
                FROM article
                ORDER BY date DESC LIMIT {$start},{$stop}";
        $this->executeQuery($sql);

        $tabResult=[];
        foreach ($this->getResults() as $post) {
            $tabResult[] = new Article($post['id'], $post['title'], $post['content'], $post['date'], $post['idAdmin']);
            
        }
        return $tabResult;
    }


    public function getSearch($search, $cat, $order) : array
    {
        $sql = "SELECT article.id AS articleId, title,content, DATE_FORMAT(created, '%D %b %Y') AS date, idAdmin
                FROM article
                LEFT JOIN admin u on article.idAdmin = u.id
                WHERE title like :search
                ORDER BY {$cat} {$order}";

        $this->executeQuery($sql, array(
            ':search' => array($search, PDO::PARAM_STR)
        ));

        $tabResult=[];
        foreach ($this->getResults() as $post) {
            $tabResult[] = new Article($post['articleId'], $post['title'], $post['date']);
        }
        return $tabResult;
    }

    public function getOne($id) :array
    {
        $sql = "SELECT article.id AS id, title, content, DATE_FORMAT(created, '%D %b %Y') AS date, idAdmin
                FROM article
                LEFT JOIN admin u on article.idAdmin = u.id
                WHERE article.id like :id";

        $this->executeQuery($sql, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));

        $tabResult=[];
        foreach ($this->getResults() as $post) {
            $tabResult[] = new Article($post['id'], $post['title'], $post['content'], $post['date'], $post['idAdmin']);
        }

        return $tabResult;
    }
    public function Count()
    {
        $sql = "SELECT COUNT(*) FROM article;";

        $this->executeQuery($sql);


        return $this->getResults() ;
    }
}
