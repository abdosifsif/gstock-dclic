<?php
include 'connexion.php';
if (
    !empty($_POST['nom_du_service'])
    && !empty($_POST['telephone'])
    && !empty($_POST['adresse'])
) {

$sql = "INSERT INTO client(nom_du_service	, telephone, adresse)
        VALUES( ?, ?, ?)";
    $req = $connexion->prepare($sql);
    
    $req->execute(array(
        $_POST['nom_du_service'],
        $_POST['telephone'],
        $_POST['adresse']
    ));
    
    if ( $req->rowCount()!=0) {
        $_SESSION['message']['text'] = "service ajouté avec succès";
        $_SESSION['message']['type'] = "success";
    }else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout du client";
        $_SESSION['message']['type'] = "danger";
    }

} else {
    $_SESSION['message']['text'] ="Une information obligatoire non rensignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/client.php');