<div class="text-center">
    <?php
    if (isset($nbArticle) && isset($page)) {
        $maxPage = ceil(($nbArticle / 5));
        if ($maxPage != 1) {
            //First Button
            echo '<a class="btn btn-dark" href="index.php?page=1">First</a>';

            //Previous
            $pagePrec = $page - 1;
            if ($pagePrec < 1 || $pagePrec > $maxPage) {
                $pagePrec = $page;
            }
            echo '<a class="btn btn-dark" href="index.php?page=' . $pagePrec . '">Previous</a>';

            //Page actuel
            echo '<span class="btn btn-light">' . $page . '/' . $maxPage . '</span>';

            //Next
            $pageNext = $page + 1;
            if ($pageNext < 1 || $pageNext > $maxPage) {
                $pageNext = $page;
            }
            echo '<a class="btn btn-dark" href="index.php?page=' . $pageNext . '">Next</a>';

            //Last Button
            echo '<a class="btn btn-dark" href="index.php?page=' . $maxPage . '">Last</a>';
        }
    }
    ?>
</div>
