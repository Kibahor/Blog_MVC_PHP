<?php



echo "Ceci est la vue de la liste";

echo $model;
foreach($model as $p){
    echo $p['title'];
}


?>