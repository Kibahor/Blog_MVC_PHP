<?php

class CommentaireModel
{
    public $gate;

    public function __construct()
    {
        $this->gate = new CommentaireGateway();
    }

    public function suppCommentaire($pseudo, $content, $idArticle)
    {
        return $this->gate->supp($pseudo, $content, $idArticle);
    }

    public function getPageCommentaire($start): array
    {
        $stop = $start + 5;
        return $this->gate->getPage($start, $stop);
    }

    public function getCommentaireId($id): array
    {
        return $this->gate->getId($id);
    }

    public function addCommentaire($pseudo, $content, $idArticle)
    {
        return $this->gate->add($pseudo, $content, $idArticle);
    }
}
