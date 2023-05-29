<?php
require_once 'auth.php';

// Se la sessione è scaduta, esco
if (!$userid = checkAuth()) exit;

// Imposto l'header della risposta
header('Content-Type: application/json');


Events();
 
function Events(){
    global $dbconfig, $userid;
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $id =$_GET["q"];
    
    $query = "DELETE  FROM prenotazioni WHERE id ='$id'";
    
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    mysqli_close($conn);
}
?>