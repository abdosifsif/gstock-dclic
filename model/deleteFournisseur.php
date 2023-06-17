<?php
session_start();

// Check if the user is logged in, and if not, redirect to the login page
if (!isset($_SESSION['login'])) {
    header('Location: ../');
    exit();
}

// Check if the fournisseur ID is provided in the URL
if (!isset($_GET['fournisseurId'])) {
    header('Location: ../fournisseur.php');
    exit();
}

// Include the database connection file
include_once 'connexion.php';

// Retrieve the fournisseur ID from the URL
$fournisseurId = $_GET['fournisseurId'];

try {
    // Prepare the SQL statement to delete the fournisseur
    $query = "DELETE FROM Fournisseur WHERE id = :fournisseurId";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':fournisseurId', $fournisseurId);
    $stmt->execute();

    // Redirect to the fournisseur page after successful deletion
    header('Location: ../vue/fournisseur.php');
    exit();
} catch (Exception $e) {
    // Handle any errors that occur during the deletion process
    die("Erreur lors de la suppression du fournisseur : " . $e->getMessage());
}