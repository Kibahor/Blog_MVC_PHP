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

    private function substrwords($text, $maxchar, $end='...') {
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\s/', $text);
            $output = '';
            $i      = 0;
            while (1) {
                $length = strlen($output)+strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                }
                else {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        }
        else {
            $output = $text;
        }
        return $output;
    }

    public function cutArticle($tab): array
    {
        $tab2=array();
        foreach($tab as $article){
            $article->content=$this::substrwords($article->content,300);
            array_push($tab2,$article);
        }
        return $tab2;
    }
}
