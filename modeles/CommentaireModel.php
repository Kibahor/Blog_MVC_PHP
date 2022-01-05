<?php

class CommentaireModel
{
    public $gate;

    public function __construct()
    {
        $this->gate = new CommentaireGateway();
    }

    public function suppCommentaire(string $pseudo, string $content, int $idArticle)
    {
        return $this->gate->supp($pseudo, $content, $idArticle);
    }

    public function getPageCommentaire(int $start): array
    {
        $stop = $start + 5;
        return $this->gate->getPage($start, $stop);
    }

    public function getCommentaireId(int $id): array
    {
        return $this->gate->getId($id);
    }

    public function addCommentaire(string $pseudo, string $content, int $idArticle)
    {
        return $this->gate->add($pseudo, $content, $idArticle);
    }
}
