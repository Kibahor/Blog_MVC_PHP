<?php

echo "Ceci est la vue de la liste <br>";

foreach($valeur as $p){
    echo $p->date.": ";
    echo $p->title;
    echo '<br>';
}

?>