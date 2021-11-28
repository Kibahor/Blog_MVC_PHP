<?php
class ArticleGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    //Récuperer tout les articles
    public function getArticle($cat, $order): array
    {
        $sql = "SELECT article.id AS articleId,created, title,content, DATE_FORMAT(created, '%d/%m/%Y') AS date, u.id AS idAdmin
                FROM article
                LEFT JOIN admin u on article.idAdmin = u.id
                ORDER BY {$cat} {$order}";
        $this->con->executeQuery($sql);

        foreach ($this->con->getResults() as $post) {
            // Si plus de données a insérer dans le article redefinir le 2eme constructeur
            $tabResult[] = new Article($post['articleId'], $post['title'], $post['date'], $post['content'], $post['idAdmin']);
        }
        return $tabResult;
    }

    //ajouter un Article
    public function addArticle($title, $content, $idAdmin)
    {
        $sql = 'INSERT INTO article (title, content, created, idAdmin)
                VALUES (:title, :content, NOW(), :idAdmin)';
        $this->con->executeQuery($sql, array(
            ':title' => array($title, PDO::PARAM_STR),
            ':content' => array($content, PDO::PARAM_STR),
            ':idAdmin' => array($idAdmin, PDO::PARAM_STR)
        ));
    }

    public function modifArticle($id, $title, $content)
    {
        $sql = 'UPDATE posts
                SET title = :title,
                content = :content
                WHERE id = :id';
        $this->con->executeQuery($sql, array(
            ':title' => array($title, PDO::PARAM_STR),
            ':content' => array($content, PDO::PARAM_STR),
            ':id' => array($id, PDO::PARAM_INT)
        ));
    }

    //Fonction pour obtenir les 5 premier Articles
    public function getPage($start, $stop)
    {
        $sql = "SELECT id,title, content, DATE_FORMAT(created, '%D %b %Y') AS date, idAdmin
                FROM article
                ORDER BY date DESC LIMIT {$start},{$stop}";
        $this->con->executeQuery($sql);

        foreach ($this->con->getResults() as $post) {
            // Si plus de données a insérer dans le article redefinir le 2eme constructeur
            $tabResult[] = new Article($post['id'], $post['title'], $post['content'], $post['date'], $post['idAdmin']);
            
        }

        return $tabResult;
    }


    public function getSearch($search, $cat, $order)
    {
        $sql = "SELECT article.id AS articleId, title,content, DATE_FORMAT(created, '%D %b %Y') AS date, idAdmin
                FROM article
                LEFT JOIN admin u on article.idAdmin = u.id
                WHERE title like :search
                ORDER BY {$cat} {$order}";

        $this->con->executeQuery($sql, array(
            ':search' => array($search, PDO::PARAM_STR)
        ));

        foreach ($this->con->getResults() as $post) {
            // Si plus de données a insérer dans le article redefinir le 2eme constructeur
            $tabResult[] = new Article($post['articleId'], $post['title'], $post['date']);
        }
        return $tabResult;
    }

    public function getOne($id)
    {
        $sql = "SELECT article.id AS articleId, title, content, DATE_FORMAT(created, '%D %b %Y') AS date, idAdmin
                FROM article
                LEFT JOIN admin u on article.idAdmin = u.id
                WHERE article.id like :id";

        $this->con->executeQuery($sql, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));

        foreach ($this->con->getResults() as $post) {
            // Si plus de données a insérer dans le article redefinir le 2eme constructeur
            $tabResult[] = new Article($post['articleId'], $post['title'], $post['date']);
        }

        return $tabResult;
    }
}
