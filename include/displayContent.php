<?php 

    $contentReq = airtableRequest("https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content", $airtableToken);
    
    foreach($contentReq['records'] as $r) {
        echo '
            <div class="card bg-light mb-3 mt-3';
            if ($r['fields']['Status'] == "indisponible"){
                echo ' card-unavailable';
            }

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
                <div>
                <button type="button" class="btn btn-warning modifier m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Modifier</button>
                <button type="button" class="btn btn-danger supprimer m-1" onClick="window.location.reload();">Supprimer</button>
                </div>
            </div>';
    }

    ?>