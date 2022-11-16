<?php

    include "adminMenuLogic.php";
    $model=new Model();
    $game_id=$_REQUEST['game_id'];
    $delete=$model->delete($game_id);

    if($delete){
        echo "<script>alert('deleted successfully');</script>";
        echo "<script>window.location.href='adminMenu.php';</script>";
    }




?>