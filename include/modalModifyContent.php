 <!-- Modal -->
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
                    <select class="form-select" id="Status" name="Status">
                        <option value="disponible" selected>Disponible</option>
                        <option value="indisponible">Indisponible</option>
                    </select>
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