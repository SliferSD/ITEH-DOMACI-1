<?php 

    require_once 'adminMenuLogic.php';
    $model = new Model();

    if($_POST['sortType']){
        
        $games = $model->sortGamesByTitle();
        echo json_encode($games);

    }