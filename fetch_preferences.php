
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

    $query = "SELECT genere, COUNT(genere) FROM preferenze GROUP BY genere HAVING COUNT(genere)=( SELECT MAX(mycount) FROM ( SELECT genere, COUNT(genere) AS mycount FROM preferenze GROUP BY genere) as result);";
    
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    while($row=mysqli_fetch_assoc($res)){
        $results[]=$row;
    }
   echo json_encode($results);

}
?>