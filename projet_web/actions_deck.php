<?php
session_start();
require_once 'header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] === 'guest' || $_SESSION['etat'] == 1) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Action : Mettre en favori
if (isset($_POST['favorite']) && isset($_POST['deck_id'])) {
    $deck_id = intval($_POST['deck_id']);
    
    // Vérifier que le deck appartient à l'utilisateur
    $stmt = $bdd->prepare('SELECT id, is_favorite FROM decks WHERE id = ? AND user_id = ?');
    $stmt->execute([$deck_id, $user_id]);
    $deck = $stmt->fetch();
    
    if ($deck) {
        // Enlever tous les favoris de l'utilisateur
        $stmt = $bdd->prepare('UPDATE decks SET is_favorite = 0 WHERE user_id = ?');
        $stmt->execute([$user_id]);
        
        // Si le deck n'était pas déjà favori, le mettre en favori
        if (!$deck['is_favorite']) {
            $stmt = $bdd->prepare('UPDATE decks SET is_favorite = 1 WHERE id = ?');
            $stmt->execute([$deck_id]);
        }
    }
    
    header('Location: mes_decks.php?deck=' . $deck_id);
    exit();
}

// Redirection par défaut
header('Location: mes_decks.php');
exit();
?>