<?php
session_start();
require 'header.php';

// Vérifier que l'utilisateur est connecté et n'est pas invité
if (!isset($_SESSION['user_id']) || $_SESSION['role'] === 'guest' || $_SESSION['etat'] == 1) {
    header('Location: explorateur.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'recent';

if ($post_id > 0) {
    // Vérifier si l'utilisateur a déjà liké
    $stmt = $bdd->prepare('SELECT 1 FROM post_likes WHERE user_id = ? AND post_id = ?');
    $stmt->execute([$user_id, $post_id]);
    $has_liked = $stmt->fetch() !== false;
    
    if ($has_liked) {
        // Retirer le like
        $stmt = $bdd->prepare('DELETE FROM post_likes WHERE user_id = ? AND post_id = ?');
        $stmt->execute([$user_id, $post_id]);
        
        // Décrémenter le compteur
        $stmt = $bdd->prepare('UPDATE posts SET likes = likes - 1 WHERE id = ? AND likes > 0');
        $stmt->execute([$post_id]);
    } else {
        // Ajouter le like
        $stmt = $bdd->prepare('INSERT INTO post_likes (user_id, post_id) VALUES (?, ?)');
        $stmt->execute([$user_id, $post_id]);
        
        // Incrémenter le compteur
        $stmt = $bdd->prepare('UPDATE posts SET likes = likes + 1 WHERE id = ?');
        $stmt->execute([$post_id]);
    }
}

// Rediriger avec le même tri
header('Location: explorateur.php?sort=' . $sort);
exit();
?>