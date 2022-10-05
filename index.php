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
        </div>
    </div>
    </nav>
 
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal2">Ajouter</button>

    <div class="container-cards">
        <?php 

        $contentReq = airtableRequest("https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content", $airtableToken);
        
        foreach($contentReq['records'] as $r) {
            echo '
                <div class="card bg-light mb-3';
                if ($r['fields']['Status'] == "indisponible"){
                    echo ' card-unavailable';
                }
                ?>
                <?php
                echo '" style="max-width: 30rem;" data-id="' . $r['id'] . '">
                    <div class="card-header"><h6 class="card-title">'. $r['fields']['Name'] .' </h6> <button type="button" class="btn btn-secondary disabled">'. $r['fields']['Status'] .'</button>' . '</div>
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
                  <button type="button" class="btn btn-warning modifier" data-bs-toggle="modal" data-bs-target="#exampleModal">Modifier</button>
                  <button type="button" class="btn btn-danger supprimer" onClick="window.location.reload();">Supprimer</button>
                </div>';
        }

        ?>
    </div>

    <!-- Modal -->
    <?php var_dump($r['fields']['Material'][0]); ?>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier l'article</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form">
            <div class="mb-3">
                <label for="Name" class="col-form-label">Nom</label>
                <input type="text" name="Name" class="form-control" id="Name">
            </div>
            <div class="mb-3">
                <label for="Price" class="col-form-label">Prix</label>
                <input type="text" name="Price" class="form-control" id="Price">
            </div>
            <div class="mb-3">
                <label for="Quantity" class="col-form-label">Quantité</label>
                <input type="text" name="Quantity" class="form-control" id="Quantity"></input>
            </div>
            <div class="mb-3">
                <label for="Status" class="col-form-label">Disponibilité</label>
                <input type="text" name="Status" class="form-control" id="Status"></input>
            </div>
            <div class="container-form">
                <div class="form-group">
                    <label for="Category" class="form-label mt-4">Catégorie</label>
                    <select class="form-select modificationForm" id="Category" name="Category">
                    <option value="selected" selected>Sélectionner</option>
                        <?php
                            $categoriesReq = airtableRequest("https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Category?fields%5B%5D=Name", $airtableToken);
                            foreach( $categoriesReq['records'] as $r) {

                                echo '<option class="option" value="'.$r['id'].'">'.$r['fields']['Name'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Color" class="form-label mt-4" >Couleur</label>
                    <select class="form-select modificationForm" name="Color" id="Color">
                    <option value="selected" selected>Sélectionner</option>
                        <?php
                            $colorsReq = airtableRequest("https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Color?fields%5B%5D=Name", $airtableToken);
                            foreach( $colorsReq['records'] as $r) {
                                echo '<option value="'.$r['id'].'">'.$r['fields']['Name'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <?php
                echo($r['fields']['Material'][0]);
                ?>
                <div class="form-group">
                    <label for="Material" class="form-label mt-4" >Matière</label>
                    <select class="form-select modificationForm" name="Material" id="Material">
                    <option value="selected" selected>Sélectionner</option>
                        <?php
                            $materialsReq = airtableRequest("https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Material?fields%5B%5D=Name", $airtableToken);
                            foreach( $materialsReq['records'] as $r) {
                                echo '<option value="'.$r['id'].'">'.$r['fields']['Name'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="button" class="btn btn-primary envoyer" onClick="window.location.reload();">Envoyer</button>
        </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un article</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form2">
                <div class="mb-3">
                    <label for="Name" class="col-form-label">Nom</label>
                    <input type="text" name="Name" class="form-control" id="Name">
                </div>
                <div class="mb-3">
                    <label for="Price" class="col-form-label">Prix</label>
                    <input type="text" name="Price" class="form-control" id="Price">
                </div>
                <div class="mb-3">
                    <label for="Quantity" class="col-form-label">Quantité</label>
                    <input type="text" name="Quantity" class="form-control" id="Quantity"></input>
                </div>
                <div class="mb-3">
                    <label for="Status" class="col-form-label">Disponibilité</label>
                    <input type="text" name="Status" class="form-control" id="Status"></input>
                </div>
                <div class="container-form">
                    <div class="form-group">
                        <label for="Category" class="form-label mt-4">Catégorie</label>
                        <select class="form-select" id="Category" name="Category">
                        <option value="selected" selected>Sélectionner</option>
                            <?php
                                foreach( $categoriesReq['records'] as $r) {
                                    echo '<option class="option" value="'.$r['id'].'">'.$r['fields']['Name'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Color" class="form-label mt-4" >Couleur</label>
                        <select class="form-select" name="Color" id="Color">
                        <option value="selected" selected>Sélectionner</option>
                            <?php
                                foreach( $colorsReq['records'] as $r) {
                                    echo '<option value="'.$r['id'].'">'.$r['fields']['Name'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Material" class="form-label mt-4">Matière</label>
                        <select class="form-select modificationForm" name="Material" id="Material">
                        <option value="selected" selected>Sélectionner</option>
                            <?php
                                foreach( $materialsReq['records'] as $r) {
                                    echo '<option value="'.$r['id'].'">'.$r['fields']['Name'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="button" class="btn btn-primary ajouter" onClick="window.location.reload();">Envoyer</button>
        </div>
        </div>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<script src="assets/js/main.js"></script>
<!-- <script src="assets/js/getAllContent.js"></script> -->
<script src="assets/js/script.js"></script>
<!-- <script src="assets/js/getAllContent.js"></script> -->


</body>

</html>