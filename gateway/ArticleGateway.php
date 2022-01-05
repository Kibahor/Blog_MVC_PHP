<?php

class ArticleGateway extends Connection
{

    public function getArticle(string $cat, string $order): array
    {
        $sql = "SELECT article.id AS articleId,created, title,content, DATE_FORMAT(created, '%d/%m/%Y') AS date, u.id AS idAdmin
                FROM article
                LEFT JOIN admin u on article.idAdmin = u.id
                ORDER BY {$cat} {$order}";
        $this->executeQuery($sql);

        $tabResult = [];
        foreach ($this->getResults() as $post) {
            $tabResult[] = new Article($post['articleId'], $post['title'], $post['date'], $post['content'], $post['idAdmin']);
        }
        return $tabResult;
    }


    public function addArticle(string $title, string $content, int $idAdmin)
    {
        $sql = 'INSERT INTO article (title, content, created, idAdmin)
                VALUES (:title, :content, NOW(), :idAdmin)';

        $this->executeQuery($sql, array(
            ':title' => array($title, PDO::PARAM_STR),
            ':content' => array($content, PDO::PARAM_STR),
            ':idAdmin' => array($idAdmin, PDO::PARAM_INT)
        ));

    }

    public function modifArticle(int $id, string $title, string $content)
    {
        $sql = 'UPDATE posts
                SET title = :title,
                content = :content
                WHERE id = :id';
        $this->executeQuery($sql, array(
            ':title' => array($title, PDO::PARAM_STR),
            ':content' => array($content, PDO::PARAM_STR),
            ':id' => array($id, PDO::PARAM_INT)
        ));
    }


    public function getPage(int $start, int $stop, string $order): array
    {
        $sql = "SELECT id,title, content, DATE_FORMAT(created, '%D %b %Y') AS date, idAdmin
                FROM article
                ORDER BY date {$order} LIMIT {$start},{$stop}";
        $this->executeQuery($sql);

        $tabResult = [];
        foreach ($this->getResults() as $post) {
            $tabResult[] = new Article($post['id'], $post['title'], $post['content'], $post['date'], $post['idAdmin']);

        }
        return $tabResult;
    }


    public function getSearch(string $search, string $cat, string $order): array
    {
        //$search='*'.$search.'*'; //Le REGEX de MYSQL ne marche pas très bien malheureusement ... Il faudrait utiliser PostGres
        $sql = "SELECT article.id AS articleId, title,content, DATE_FORMAT(created, '%D %b %Y') AS date, idAdmin
                FROM article
                LEFT JOIN admin u on article.idAdmin = u.id
                WHERE title RLIKE :search
                ORDER BY {$cat} {$order}";

        $this->executeQuery($sql, array(
            ':search' => array($search, PDO::PARAM_STR)
        ));

        $tabResult = [];
        foreach ($this->getResults() as $post) {
            $tabResult[] = new Article($post['articleId'], $post['title'], $post['content'], $post['date'], $post['idAdmin']);
        }
        return $tabResult;
    }

    public function getOne(int $id): Article
    {
        $sql = "SELECT article.id AS id, title, content, DATE_FORMAT(created, '%D %b %Y') AS date, idAdmin
                FROM article
                LEFT JOIN admin u on article.idAdmin = u.id
                WHERE article.id like :id";

        $this->executeQuery($sql, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));

        $post = $this->getResults()[0];
        return new Article($post['id'], $post['title'], $post['content'], $post['date'], $post['idAdmin']);
    }

    public function Count():int
    {
        $sql = "SELECT COUNT(*) FROM article";
        $this->executeQuery($sql);
        return $this->getResults();
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM article
                WHERE id = :id';
        $this->executeQuery($sql, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));
    }
}
