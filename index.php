<?php
// require('bdd.php');
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
        <!-- <ul class="navbar-nav me-auto">
            <li class="nav-item">
            <a class="nav-link active" href="#">Home
                <span class="visually-hidden">(current)</span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item dropdown">
            </li>
        </ul> -->
        <!-- <form class="d-flex">
            <input class="form-control me-sm-2" type="text" placeholder="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form> -->
        </div>
    </div>
    </nav>

    <div class="container-form">
        <div class="form-group">
            <label for="exampleSelect1" class="form-label mt-4">Catégorie</label>
            <select class="form-select" id="exampleSelect1">
                <?php
                    $categoriesReq = airtableRequest("https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Category?fields%5B%5D=Name", $airtableToken);
                    foreach( $categoriesReq['records'] as $r) {

                        echo '<option class="option" value="'.$r['fields']['Name'].'">'.$r['fields']['Name'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleSelect1" class="form-label mt-4">Couleur</label>
            <select class="form-select" id="exampleSelect1">
                <?php
                    $colorsReq = airtableRequest("https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Color?fields%5B%5D=Name", $airtableToken);
                    foreach( $colorsReq['records'] as $r) {
                        echo '<option value="'.$r['fields']['Name'].'">'.$r['fields']['Name'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleSelect1" class="form-label mt-4">Matière</label>
            <select class="form-select" id="exampleSelect1">
                <?php
                    $materialsReq = airtableRequest("https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Material?fields%5B%5D=Name", $airtableToken);
                    foreach( $materialsReq['records'] as $r) {
                        echo '<option value="'.$r['fields']['Name'].'">'.$r['fields']['Name'].'</option>';
                    }
                ?>
            </select>
        </div>
        <button id="btn">Get the Selected Value</button>
    </div>
 
    <div class="container-cards">
        <?php 
        // $tags = array();

        // $contentReq = airtableRequest("https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content", $airtableToken);

        // foreach($contentReq['records'] as $c) {
        //     array_push($tags, $c['fields']['Name (from Category)']);
        // }
        
        // $id = 0;
        // foreach($contentReq['records'] as $r) {
        //     echo '
        //         <div class="card bg-light mb-3" style="max-width: 20rem;">
        //             <div class="card-header"><h5 class="card-title">'. $r['fields']['Name'] .'</h5></div>
        //             <div class="card-body">
        //                 <p class="card-text">Description de l\'article.</p>
        //                 <button type="button" class="btn btn-info">'. $tags[$id][0] .'</button>
        //             </div>
        //         </div>';
        //         $id++;
        // }

        $contentReq = airtableRequest("https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content", $airtableToken);
        
        foreach($contentReq['records'] as $r) {
            echo '
                <div class="card bg-light mb-3';
                if ($r['fields']['Status'] == "indisponible"){
                    echo ' card-unavailable';
                }
                echo '" style="max-width: 30rem;">
                    <div class="card-header"><h6 class="card-title">'. $r['fields']['Name'] . ' </h6> <button type="button" class="btn btn-secondary disabled">'. $r['fields']['Status'] .'</button>' . '</div>
                    <div class="card-body">
                        <p class="card-text">Prix de l\'article : ' . $r['fields']['Price'] . ' €</p>';
                    echo '</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Catégorie : ' . $r['fields']['Name (from Category)'][0] . '</li>
                        <li class="list-group-item">Matière : ';
                        foreach($r['fields']['Name (from Material)'] as $m){
                            echo $m;
                        }
                         echo '</li>
                        <li class="list-group-item">Couleur(s) : ';
                        foreach($r['fields']['Name (from Color)'] as $c) {
                            echo  $c . " ";
                        }
                        echo '</li>
                    </ul>
                    <div class="card-footer text-muted">
                    Quantité : ' . $r['fields']['Quantity'] . '
                  </div>
                </div>';
                
        }

        ?>
    </div>

    <pre>
        <?php
            var_dump($contentReq)
        ?>
    </pre>

<script src="assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

</html>