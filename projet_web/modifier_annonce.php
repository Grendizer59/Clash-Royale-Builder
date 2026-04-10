<?php
session_start();
require_once 'header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] === 'guest' || (isset($_SESSION['etat']) && $_SESSION['etat'] == 1)) {
    header('Location: explorateur.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Vérifier que le post existe et appartient à l'utilisateur
$stmt = $bdd->prepare('SELECT id, title, description, user_id FROM posts WHERE id = ? AND user_id = ?');
$stmt->execute([$post_id, $user_id]);
$post = $stmt->fetch();

if (!$post) {
    header('Location: explorateur.php');
    exit();
}

$message = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    
    if (empty($title)) {
        $message = '<div class="error-msg">⚠️ Le titre est obligatoire</div>';
    } else {
        $stmt = $bdd->prepare('UPDATE posts SET title = ?, description = ? WHERE id = ?');
        $stmt->execute([$title, $description, $post_id]);
        
        header('Location: explorateur.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Modifier l'annonce</title>
</head>
<body>

<div class="editor-container">
    
    <a href="explorateur.php" class="link-back">← Annuler et retour</a>

    <h1>Modifier l'annonce</h1>

    <div class="form-card">
        <?= $message ?>
        <!-- Formulaire de modification de l'annonce -->
        <form method="POST">
            <div>
                <label for="title">Titre de l'annonce </label>
                <input type="text" id="title" name="title" class="cr-input" value="<?= htmlspecialchars($post['title']) ?>" required placeholder="Ex: Deck Cochon Cycle...">
            </div>
            
            <div>
                <label for="desc">Description</label>
                <textarea id="desc" name="description" rows="5" class="cr-textarea" placeholder="Expliquez comment jouer ce deck..."><?= htmlspecialchars($post['description']) ?></textarea>
            </div>
            
            <div class="btn-group">
                <a href="explorateur.php" class="cr-btn btn-cancel">Annuler</a>
                <button type="submit" class="cr-btn btn-save">Sauvegarder</button>
            </div>
        </form>
    </div>

</div>

</body>
</html>