<?php 
  
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $userid = mysqli_real_escape_string($conn, $userid);
    
   

        $query = "SELECT user_id AS userid, id AS movieid, content AS content from movies where user_id = $userid ORDER BY id DESC LIMIT 10";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $movieArray = array();
    while($entry = mysqli_fetch_assoc($res)) {
        // Scorro i risultati ottenuti e creo l'elenco di post
        $movieArray[] = array('userid' => $entry['userid'],
                            'movieid' => $entry['movieid'], 'content' => json_decode($entry['content']));
    }
    echo json_encode($movieArray);
    
    exit;


?>