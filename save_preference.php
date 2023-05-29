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
        $genre = mysqli_real_escape_string($conn, $_POST['genre']);
        # check if song is already present for user
        $query = "SELECT * FROM preferenze WHERE user_id = '$userid' AND movie_id = '$id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        # if song is already present, do nothing
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('ok' => true));
            
            exit;
        }

        # Eseguo
        $query = "INSERT INTO preferenze(movie_id,user_id, genere) VALUES('$id','$userid','$genre')";
        error_log($query);
        # Se corretta, ritorna un JSON con {ok: true}
        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => false));
    }
    ?>