
<?php
require_once 'auth.php';

// Se la sessione è scaduta, esco
if (!$userid = checkAuth()) exit;

// Imposto l'header della risposta
header('Content-Type: application/json');

Events();

function Events(){
    global $dbconfig, $userid;
    $results = array();
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);

    $query = "SELECT * FROM prenotazioni WHERE user_id ='$userid'";
    
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    while($row=mysqli_fetch_assoc($res)){
        $results[]=$row;
    }
   echo json_encode($results);

}
?>