<?php
session_start();

// Check if the user is logged in, and if not, redirect to the login page
if (!isset($_SESSION['login'])) {
    header('Location: ../');
    exit();
}

// Check if the client ID is provided in the URL
if (!isset($_GET['clientId'])) {
    header('Location: ../client.php');
    exit();
}

// Include the database connection file
include_once 'connexion.php';

// Retrieve the client ID from the URL
$clientId = $_GET['clientId'];

try {
    // Prepare the SQL statement to delete the client
    $query = "DELETE FROM Client WHERE id = :clientId";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':clientId', $clientId);
    $stmt->execute();

    // Redirect to the client page after successful deletion
    header('Location: ../vue/client.php');
    exit();
} catch (Exception $e) {
    // Handle any errors that occur during the deletion process
    die("Erreur lors de la suppression du client : " . $e->getMessage());
}