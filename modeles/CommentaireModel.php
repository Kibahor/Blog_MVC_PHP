<?php

class CommentaireModel
{
    public $gate;

    public function __construct()
    {
        $this->gate = new CommentaireGateway();
    }

    public function get_data()
    {
        $cat = 'date';
        $order = 'ASC';
        return $this->gate->getArticle($cat, $order);
    }

    public function suppCommentaire($pseudo, $content, $idArticle){
        return $this->gate->supp($pseudo, $content, $idArticle);
    }

    public function getPageCommentaire($start){
        $stop=$start+5;
        return $this->gate->getPage($start, $stop);
    }

    public function getCommentaireId($id){
        return $this->gate->getId($id);
    }

    public function addCommentaire($pseudo,$content,$idArticle){
        return $this->gate->add($pseudo,$content,$idArticle);
    }
}
