<?php

class ArticleModel
{
    public $gate;

    public function __construct()
    {
        $this->gate = new ArticleGateway();
    }

    public function get_articles($order): array
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

    public function getPageArticle($start): array
    {
        $start = ($start-1) * 5 ;
        $nb = 5;

        return $this->gate->getPage($start,$nb);
    }
    public function count(): array
    {
        return $this->gate->Count();
    }

    public function searchArticle($key): array
    {
        return $this->gate->getSearch($key, "date", "ASC");
    }

    public function getArticleId($id): array
    {
        return $this->gate->getOne($id);
    }
}
