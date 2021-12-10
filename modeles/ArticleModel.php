<?php

class ArticleModel
{
    public $gate;

    public function __construct()
    {
        $this->gate = new ArticleGateway();
    }

    public function get_articles($order)
    {
        $cat = 'date';
        $order = 'ASC';
        return $this->gate->getArticle($cat, $order);
    }

    public function ajoutArticle($title, $content, $idUser)
    {
        $this->gate->addArticle($title, $content, $idUser);
    }

    public function updateArticle($title, $content, $idUser)
    {
        $this->gate->modifArticle($title, $content, $idUser);
    }

    /**
     * @throws Exception
     */
    public function getPageArticle($start)
    {
        $start = ($start-1) * 5 ;
        $nb = 5;

        return $this->gate->getPage($start,$nb);
    }
    public function count()
    {
        return $this->gate->Count();
    }

    public function searchArticle($key)
    {
        return $this->gate->getSearch($key, "date", "ASC");
    }

    public function getArticleId($id)
    {
        return $this->gate->getOne($id);
    }
}
