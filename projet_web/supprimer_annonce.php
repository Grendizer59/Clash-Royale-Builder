<?php
session_start();
require_once 'header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] === 'guest') {
    header('Location: explorateur.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
$is_admin = isset($_POST['admin']) && $_POST['admin'] == 1;

if ($post_id > 0) {
    // Vérifier que le post existe
    $stmt = $bdd->prepare('SELECT user_id FROM posts WHERE id = ?');
    $stmt->execute([$post_id]);
    $post = $stmt->fetch();
    
    if ($post) {
        // Vérifier les permissions
        $can_delete = false;
        
        // Admin peut tout supprimer
        if ($role === 'admin' && $is_admin) {
            $can_delete = true;
        }
        // Utilisateur peut supprimer ses propres posts
        elseif ($post['user_id'] == $user_id) {
            $can_delete = true;
        }
        
        if ($can_delete) {
            // Supprimer le post (les likes seront supprimés automatiquement grâce à ON DELETE CASCADE)
            $stmt = $bdd->prepare('DELETE FROM posts WHERE id = ?');
            $stmt->execute([$post_id]);
        }
    }
}

header('Location: explorateur.php');
exit();
?>