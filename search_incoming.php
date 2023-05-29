<?php 
/*******************************************************
    Ritorna un JSON con i risultati dell'API selezionata
********************************************************/
require_once 'auth.php';


if (!checkAuth()) exit;

header('Content-Type: application/json');

Movie();

function Movie() {
   
    // QUERY EFFETTIVA
    
    $url = "https://imdb-api.com/en/API/ComingSoon/k_2njo15g7";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $res=curl_exec($ch);
    curl_close($ch);

    echo $res;
}
?>