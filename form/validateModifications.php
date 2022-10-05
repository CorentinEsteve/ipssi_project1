<?php

echo json_encode($_POST['name']);


if (!empty($_POST)){
    
    $errors = false;
    $errors_msg = "";

    $price_regex = '/^[0-9]*\.?[0-9]{2}+$/' ;
    $quantity_regex = '/^[0-9]*/';

    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];

    // vérification des erreurs

    if (!preg_match($price_regex, $price)){
        $errors = true;
        $errors_msg .= 'Le prix entré est incorrect, merci d\'entrer un nombre. <br />';
    }

    if (!preg_match($quantity_regex, $quantity)){
        $errors = true;
        $errors_msg .= 'La quantité entrée est incorrecte, merci d\'entrer un nombre entier. <br />';
    }

    if(!$errors){
        $success_message = "Le formulaire a été envoyé avec succès.";
    }

    if($errors == true){
        echo json_encode(['type'=>'error', 'msg'=>$errors_msg]);
    }
    else{
        echo json_encode(['type'=>'success', 'msg'=>$success_message]);
    }

}
else{
    echo json_encode(['type'=>'error', 'msg'=>'Aucune donnée envoyée']);
}

?>