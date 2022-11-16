<?php 

require_once 'adminMenuLogic.php';
$model = new Model();

if(isset($_POST['search'])){        
    $games = $model->searchGames($_POST['search']);
    echo json_encode($games);
}