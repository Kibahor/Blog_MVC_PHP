<?php
class PostsGateway
{
    private $con;

    public function __construct(Connection $con){
        $this->con=$con;
    }


    public function getPosts($cat, $order):array
    {
        $sql = "SELECT posts.id AS postsId,created, title, content, DATE_FORMAT(created, '%d/%m/%Y') AS date, category, firstName, lastName
                FROM posts
                LEFT JOIN categories c on posts.idCategory = c.id
                LEFT JOIN users u on posts.idUser = u.id
                ORDER BY {$cat} {$order}";
        $this->con->executeQuery($sql);
        
        foreach($this->con->getResults() as $post ){
            // Si plus de données a insérer dans le Posts redefinir le 2eme constructeur
            $tabResult[]= new Posts($post['postsId'],$post['title'],$post['date'],$post['content']);
        }

        return $tabResult;
    }
}

?>