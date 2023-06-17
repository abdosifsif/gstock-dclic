<?php
session_start();

// Check if the user is logged in, and if not, redirect to the login page
if (!isset($_SESSION['login'])) {
    header('Location: ../');
    exit();
}

// Check if the categorie ID is provided in the URL
if (!isset($_GET['CategorieId'])) {
    header('Location: ../categorie.php');
    exit();
}

// Include the database connection file
include_once 'connexion.php';

// Retrieve the categorie ID from the URL
$CategorieId = $_GET['CategorieId'];

try {
    // Prepare the SQL statement to delete the categorie
    $query = "DELETE FROM categorie_article WHERE id = :CategorieId";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':CategorieId', $CategorieId);
    $stmt->execute();

    // Redirect to the categorie page after successful deletion
    header('Location: ../vue/categorie.php');
    exit();
} catch (Exception $e) {
    // Handle any errors that occur during the deletion process
    die("Erreur lors de la suppression du categorie : " . $e->getMessage());
}