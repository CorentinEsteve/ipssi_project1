<?php

// Initialisation du cURL
$curl = curl_init();

// Spécifie l'URL sur laquelle pointer - fournie par Airtable
// curl_setopt($curl, CURLOPT_URL, 'https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content');
include('requests/getAllCategories.php');

$certificate = "C:\wamp64\cacert.pem";
curl_setopt($curl, CURLOPT_CAINFO, $certificate);
curl_setopt($curl, CURLOPT_CAPATH, $certificate);

// Evite d'afficher sur la page le résultat 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//
$authorization = "Authorization: Bearer keyVpYYBeW1Ou7uuY";

// Envoie en header l'authorisation (clé API)
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json', $authorization));

// Execute la session cURL
$resultat = curl_exec($curl);

// Ferme la session cURL
curl_close($curl);

// Converti en PHP le JSON
$resultat = json_decode($resultat, true);



// Affiche le resultat (comme echo mais affiche un tableau)
//le <pre> permet d'afficher le tableau de manière lisible
// echo '<pre>';
//     var_dump($resultat);
// echo '</pre>';

?>