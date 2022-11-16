<?php

class Model
{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "itehdomaci";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        } catch (Exception $e) {
            echo "connection failed" . $e->getMessage();
        }
    }


    public function insert()
    {
        if (isset($_POST['submit'])) {
            if (isset($_POST['gamename']) && isset($_POST['developer']) && isset($_POST['genre']) && isset($_POST['edition'])) {
                if (!empty($_POST['gamename']) && !empty($_POST['developer']) && !empty($_POST['genre']) && !empty($_POST['edition'])) {

                    $gamename = $_POST['gamename'];
                    $developer = $_POST['developer'];
                    $genre = $_POST['genre'];
                    $edition = $_POST['edition'];

                    $query = "INSERT INTO games (game_name,developer,genre,edition) VALUES ('$gamename','$developer','$genre','$edition')";

                    if ($sql = $this->conn->query($query)) {
                        echo "<script>alert('record added successfully');</script>";
                        echo "<script>window.location.href='adminMenu.php';</script>";
                    } else {
                        echo "<script>alert('failed');</script>";
                        echo "<script>window.location.href='adminMenu.php';</script>";
                    }
                } else {
                    echo "<script>alert('empty');</script>";
                    echo "<script>window.location.href='adminMenu.php';</script>";
                }
            }
        }
    }

    public function fetch()
    {
        $data = [];

        $query = "SELECT *
            FROM games
            LEFT JOIN users ON games.user_id=users.id;";

        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        shuffle($data);
        
        return $data;
    }


    public function delete($id)
    {
        $query = "DELETE FROM games
            WHERE game_id = '$id' ";
        if ($sql = $this->conn->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function fetch_single($id)
    {

        $data = null;

        $query = "SELECT* FROM games WHERE game_id='$id'";
        if ($sql = $this->conn->query($query)) {
            while ($row = $sql->fetch_assoc()) {
                $data = $row;
            }
        }
        return $data;
    }


    public function edit($id)
    {

        $data = null;

        $query = "SELECT* FROM games WHERE game_id='$id'";
        if ($sql = $this->conn->query($query)) {
            while ($row = $sql->fetch_assoc()) {
                $data = $row;
            }
        }
        return $data;
    }

    public function update($data)
    {
        $query = " UPDATE games SET game_name='$data[game_name]', developer='$data[developer]', genre='$data[genre]', edition='$data[edition]'
             WHERE game_id='$data[game_id]'";
        if ($sql = $this->conn->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function update2($data)
    {
        $query = "UPDATE games SET user_id='$data[user_id]'
            WHERE game_id='$data[game_id]'";
        if ($sql = $this->conn->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function sortGamesByTitle()
    {
        $data = null;

        $query = "SELECT * FROM games ORDER BY game_name";

        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function searchGames($text)
    {
        $data = [];

        $query = "SELECT * FROM games WHERE game_name LIKE '%" . $text . "%'";

        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }
        return $data;
    }
}
