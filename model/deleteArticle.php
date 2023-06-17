<?php
session_start();

// Check if the user is logged in, and if not, redirect to the login page
if (!isset($_SESSION['login'])) {
    header('Location: ../');
    exit();
}

// Check if the article ID is provided in the URL
if (!isset($_GET['ArticleId'])) {
    header('Location: ../article.php');
    exit();
}

// Include the database connection file
include_once 'connexion.php';

// Retrieve the article ID from the URL
$ArticleId = $_GET['ArticleId'];

try {
    // Prepare the SQL statement to delete the article
    $query = "DELETE FROM Article WHERE id = :ArticleId";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':ArticleId', $ArticleId);
    $stmt->execute();

    // Redirect to the article page after successful deletion
    header('Location: ../vue/article.php');
    exit();
} catch (Exception $e) {
    // Handle any errors that occur during the deletion process
    die("Erreur lors de la suppression du article : " . $e->getMessage());
}