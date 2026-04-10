<?php
session_start();
require 'header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$reporter_id = $_SESSION['user_id'];
$message = '';

$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : 0; 

// Récupérer l'auteur du post
$stmt = $bdd->prepare('SELECT user_id FROM posts WHERE id = ?');
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post) {
    header('Location: explorateur.php');
    exit();
}

$user_id = $post['user_id'];

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['description'])) {
    $description = trim($_POST['description']);
    
    if (empty($description)) {
        $message = '<div class="alert error">⚠️ La description est obligatoire</div>';
    } else {
        // Vérifier si l'utilisateur n'a pas déjà été signalé par cet admin
        $stmt_check = $bdd->prepare('SELECT id FROM signalements WHERE reporter_id = ? AND user_id = ?');
        $stmt_check->execute([$reporter_id, $user_id]);
        
        if ($stmt_check->fetch()) {
            $message = '<div class="alert error">⚠️ Vous avez déjà signalé cet utilisateur.</div>';
        } else {
            // Insérer le signalement
            $stmt_insert = $bdd->prepare('INSERT INTO signalements (user_id, reporter_id, description) VALUES (?, ?, ?)');
            
            if ($stmt_insert->execute([$user_id, $reporter_id, $description])) {
                $message = '<div class="alert success">✅ Utilisateur signalé avec succès.</div>';
                // Redirection après 2 secondes
                header('Refresh: 2; url=explorateur.php');
            } else {
                $message = '<div class="alert error">❌ Erreur lors du signalement.</div>';
            }
        }
    }
}

// Récupérer les infos de l'utilisateur à signaler
$stmt_user = $bdd->prepare('SELECT pseudo FROM users WHERE id = ?');
$stmt_user->execute([$user_id]);
$user = $stmt_user->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Signalement Utilisateur</title>
</head>
<body>

<div class="report-container">
    
    <a href="explorateur.php" class="back-link">← Annuler</a>

    <h1>🚨 Signalement</h1>
    <p class="subtitle">Modération administrateur</p>

    <div class="form-card">
        
        <?php if ($message): ?>
            <?= $message ?>
        <?php endif; ?>

        <div class="target-user">
            Cible du signalement :<br>
            <span class="target-name"><?= htmlspecialchars($user['pseudo']) ?></span>
        </div>
        <!-- Possibilité pour un administrateur de signaler un utilisateur -->
        <form method="POST">
            <input type="hidden" name="post_id" value="<?= $post_id ?>">
            
            <div style="margin: 20px 0;">
                <label for="description">Motif de la sanction / Raison * :</label>
                <textarea name="description" id="description" rows="5" class="cr-textarea" placeholder="Ex: Langage inapproprié, Spam, Contenu offensant..." required></textarea>
            </div>
            
            <button type="submit" class="btn-report">CONFIRMER LE SIGNALEMENT</button>
        </form>
    </div>

</div>

</body>
</html>