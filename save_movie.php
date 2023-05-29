<?php
    /*******************************************************
        Inserisce nel database il post da pubblicare 
    ********************************************************/
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    Movie();

    function Movie() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        # Costruisco la query
        $userid = mysqli_real_escape_string($conn, $userid);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);

        # check if movie is already present for user
        $query = "SELECT * FROM movies WHERE user_id = '$userid' AND id = '$id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        # if movie is already present, do nothing
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('ok' => true));
            
            exit;
        }

        # Eseguo
        $query = "INSERT INTO movies(id,user_id, content) VALUES('$id','$userid', JSON_OBJECT('id', '$id', 'title', '$title', 'image', '$image'))";
        error_log($query);
        
        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => false));
    }
    ?>