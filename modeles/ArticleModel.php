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

    public function getPageArticle($start)
    {
        $stop = $start + 5;
        return $this->gate->getPage($start, $stop);
    }

    public function getArticleId($id)
    {
        return $this->gate->getOne($id);
    }
}
