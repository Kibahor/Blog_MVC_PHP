<div class="justify-content-center">
<?php
if(isset($val)){
    $maxPage = ceil(($val/5));
    if($maxPage != 1) {
        echo '
    <a href="index.php?page=1">
        <input type="button" value="First">
    </a>';

        for ( $i=2; $i < $maxPage; $i++){
            echo '
    <a href="index.php?page='. $i .'">
        <input type="button" value="'. $i .'">
    </a>';
        }


        echo '
    <a href="index.php?page=' . $maxPage . '">
        <input type="button" value="Last">
    </a>';
    }
}
?>
</div>
