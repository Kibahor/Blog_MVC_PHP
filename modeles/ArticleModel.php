<?php

class ArticleModel
{
    public $gate;

    public function __construct()
    {
        $this->gate = new ArticleGateway();
    }

    public function ajoutArticle($title, $content, $idUser)
    {
        $this->gate->addArticle($title, $content, $idUser);
    }

    public function updateArticle($title, $content, $idUser)
    {
        $this->gate->modifArticle($title, $content, $idUser);
    }

    public function deleteArticle($id)
    {
        $this->gate->delete($id);
    }

    public function getPageArticle($start): array
    {
        $start = ($start - 1) * 5;
        $nb = 5;
        $order = 'DESC';
        return $this->gate->getPage($start, $nb, $order);
    }

    public function count(): int
    {
        return $this->gate->Count()[0][0];
    }

    public function searchArticle($key): array
    {
        return $this->gate->getSearch($key, "date", "ASC");
    }

    public function getArticleId($id): Article
    {
        return $this->gate->getOne($id);
    }

    public function cutArticle($tab): array
    {
        $tab2 = array();
        foreach ($tab as $article) {
            $article->content = $this::substrwords($article->content, 300);
            array_push($tab2, $article);
        }
        return $tab2;
    }

    private function substrwords($text, $maxchar, $end = '...')
    {
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\s/', $text);
            $output = '';
            $i = 0;
            while (1) {
                $length = strlen($output) + strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                } else {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        } else {
            $output = $text;
        }
        return $output;
    }

    function bbc2html($content)
    {
        $search = array(
            '/(\[b\])(.*?)(\[\/b\])/',
            '/(\[i\])(.*?)(\[\/i\])/',
            '/(\[u\])(.*?)(\[\/u\])/',
            '/(\[ul\])(.*?)(\[\/ul\])/',
            '/(\[[*]-\])(.*?)/',
            '/(\[url=)(.*?)(\])(.*?)(\[\/url\])/',
            '/(\[url\])(.*?)(\[\/url\])/',
            '/(\[img\])(.*?)(\[\/img\])/',
            '/(\[video\])(.*?)(\[\/video\])/',
            '/(\[p\])(.*?)(\[\/p\])/',
        );

        $replace = array(
            '<strong>$2</strong>',
            '<em>$2</em>',
            '<u>$2</u>',
            '<ul>$2</ul>',
            '<li>$2</li>',
            '<a href="$2" target="_blank">$4</a>',
            '<a href="$2" target="_blank">$2</a>',
            '<img src="$2">',
            '<iframe width="560" height="315" src="$2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
            '<p>$2</p>'
        );

        return preg_replace($search, $replace, $content);
    }
}
