<?php

$actionAdmin=array('supprimer','creer');

try {
    $model = new AdminModel();
    $admin=$model->isadmin();

    if(isset($_GET['action']))
        $action=$_GET['action'];
    else
        $action=null;

    if(in_array($action,$actionAdmin)){
        if($admin == false) {
            require('login.php');
        }
        else {
            new AdminController();
        }
    }else{
        new UserControleur();
    }

}catch (PDOException $e){
    require ('404.php');

}