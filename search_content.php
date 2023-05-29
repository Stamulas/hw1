<?php 

require_once 'auth.php';


if (!checkAuth()) exit;


header('Content-Type: application/json');

Movie();

function Movie() {
   
    // QUERY EFFETTIVA
    $query = urlencode($_GET["q"]);
    $url = 'https://imdb-api.com/en/API/AdvancedSearch/k_2njo15g7/?title='.$query;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $res=curl_exec($ch);
    curl_close($ch);

    echo $res;
}
?>