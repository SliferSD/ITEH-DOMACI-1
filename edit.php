<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamER</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!--  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <!--  -->

    <link rel="stylesheet" href="editStyle.css">

</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="containter-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=#>
                    <img src="images/logo.png" class="image-logo">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-main">
                <ul class="nav navbar-nav navbar-right">


                    <li><a class="active" href="adminMenu.php">Back</a></li>

                    <!-- ADMIN MENU -->
                    <?php if (!isset($_SESSION['id'])) {
                        echo "<li><a href='register.php'>Register</a></li>
                        <li><a href='login.php'>Login</a></li>";
                    }
                    ?>


                    <?php if (isset($_SESSION['id'])) {
                        echo "<li><a href='logout.php'>Logout</a></li>";
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar -->


    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-6" id="addGameForm">
                    <!-- change game -->
                    <?php

                    include_once "adminMenuLogic.php";
                    $model = new Model();
                    $game_id = $_REQUEST['game_id'];
                    $row = $model->edit($game_id);

                    if (isset($_POST['update'])) {
                        if (isset($_POST['gamename']) && isset($_POST['developer']) && isset($_POST['genre']) && isset($_POST['edition'])) {
                            if (!empty($_POST['gamename']) && !empty($_POST['developer']) && !empty($_POST['genre']) && !empty($_POST['edition'])) {

                                $data['game_id']=$game_id;
                                $data['game_name'] = $_POST['gamename'];
                                $data['developer'] = $_POST['developer'];
                                $data['genre'] = $_POST['genre'];
                                $data['edition'] = $_POST['edition'];

                                $update=$model->update($data);

                                if($update){
                                    echo "<script>alert('game updated successfully');</script>";
                                    echo "<script>window.location.href='adminMenu.php';</script>";
                                
                                }else{
                                    echo "<script>alert('update failed');</script>";
                                    echo "<script>window.location.href='edit.php.php';</script>";
                                }
                                

                            } else {
                                echo "<script>alert('empty');</script>";
                                
                            }
                        }
                    }

                    ?>

                    <form class="col-12" method="POST" action="">

                        <div class="form-group">
                            <h1>EDIT GAME</h1>
                            <hr class="dbt">
                        </div>

                        <div class="form-group">
                            <h3>game name</h3>
                            <input type="text" name="gamename" value="<?php echo $row['game_name']; ?>" class="form-control" placeholder="GameName">
                        </div>

                        <div class="form-group">
                            <h3>developer</h3>
                            <input type="text" name="developer" value=" <?php echo $row['developer']; ?>" class="form-control" placeholder="Developer">
                        </div>

                        <div class="form-group">
                            <h3>genre</h3>
                            <input type="text" name="genre" value="<?php echo $row['genre']; ?>" class="form-control" placeholder="Genre">
                        </div>

                        <div class="form-group">
                            <h3>edition</h3>
                            <input type="text" name="edition" class="form-control" value="<?php echo $row['edition']; ?>" placeholder="Edition">
                        </div>

                        
                         <button type="submit" class="btn" name="update"><i class="fas fa-book"></i>Confirm changes</button>

                    </form>
                    <!-- change game -->
                </div>

                <div class="col-sm-6" id="table">
                    <!-- games database -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Choosen Game Documentation</h1>
                                <hr class="dbt">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 mx-auto">
                                <?php
                                include_once "adminMenuLogic.php";
                                $model = new Model();
                                $game_id = $_REQUEST['game_id'];
                                $row = $model->fetch_single($game_id);
                                if (!empty($row)) {

                                ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <p>GameID: <?php echo  $row['game_id']; ?></p>
                                            <p>Game name: <?php echo $row['game_name']; ?></p>
                                            <p>Developer: <?php echo $row['developer']; ?></p>
                                            <p>Genre: <?php echo $row['genre']; ?></p>
                                            <p>Edition: <?php echo $row['edition']; ?></p>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                    echo "no data";
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- games database -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <script src="script.js"></script>


</body>

</html>