<?php

$airtableToken = "keyVpYYBeW1Ou7uuY";

function airtablerequest($url, $token){
    $curl = curl_init();

    // Spécifie l'URL sur laquelle pointer - fournie par Airtable
    curl_setopt($curl, CURLOPT_URL,$url);

    // Evite d'afficher sur la page le résultat 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //
    $authorization = "Authorization: Bearer ".$token;

    // Envoie en header l'authorisation (clé API)
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json', $authorization));

    // Execute la session cURL
    $resultat = curl_exec($curl);

    // Ferme la session cURL
    curl_close($curl);

    // Converti en PHP le JSON
    $resultat = json_decode($resultat, true);
    return $resultat;
}

?>

<html> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super-Vêtements</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="assets/img/db5b8641-bdd9-43df-924e-d2928e927f4a.jpg"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor03">
            </div>
        </div>
    </nav>
 
    <div class="container-cards">

        <div class="card text-white bg-dark mb-3 mt-3" style="max-width: 20rem;">
            <div class="card-header">Ajouter un élément</div>
            <div class="card-body">
                <button type="button" class="btn btn-success add" data-bs-toggle="modal" data-bs-target="#modal2">Ajouter un élément</button>
            </div>
        </div>

        <?php
            require('include/displayContent.php');
        ?>
    
    </div>

    <?php
        require('include/modalModifyContent.php');
        require('include/modalAddContent.php');
    ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/addContent.js"></script>
<script src="assets/js/deleteContent.js"></script>
<script src="assets/js/modifyContent.js"></script>

</body>

</html>