<?php
class Gateway
{
    private $con;

    public function __construct(Connection $con){
        $this->con=$con;
    }


    public function getPosts($cat, $order)//:array
    {
        $sql = "SELECT posts.id AS postsId, title, DATE_FORMAT(created, '%d/%m/%Y') AS date, category, firstName, lastName
                FROM posts
                LEFT JOIN categories c on posts.idCategory = c.id
                LEFT JOIN users u on posts.idUser = u.id
                ORDER BY {$cat} {$order}";
        $this->con->executeQuery($sql);
        
        foreach($this->con->getResults() as $post ){
            //$tabResult[]= new Posts();
            echo $post['firstName'];
        }

        return $tabResult[]=NULL;
    }
}

?>