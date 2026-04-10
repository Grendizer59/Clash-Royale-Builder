<?php
session_start();
require 'header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] === 'guest' || $_SESSION['etat'] == 1) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$deck_id = isset($_GET['deck']) ? intval($_GET['deck']) : 0;

// Vérifier que le deck appartient à l'utilisateur
$stmt = $bdd->prepare('SELECT d.id, d.name FROM decks d WHERE d.id = ? AND d.user_id = ?');
$stmt->execute([$deck_id, $user_id]);
$deck = $stmt->fetch();

if (!$deck) {
    header('Location: mes_decks.php');
    exit();
}

// Vérifier que le deck contient 8 cartes
$stmt = $bdd->prepare('SELECT COUNT(*) FROM deck_cards WHERE deck_id = ?');
$stmt->execute([$deck_id]);
$card_count = $stmt->fetchColumn();

if ($card_count != 8) {
    header('Location: mes_decks.php?deck=' . $deck_id);
    exit();
}

$message = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    
    if (empty($title)) {
        $message = '<div class="alert error">⚠️ Le titre est obligatoire</div>';
    } else {
        // Insérer le post directement
        $stmt = $bdd->prepare('INSERT INTO posts (user_id, deck_id, title, description) VALUES (?, ?, ?, ?)');
        $stmt->execute([$user_id, $deck_id, $title, $description]);
        
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
    <title>Publier une annonce</title>
</head>
<body>

<div class="poster-container">
    
    <a href="mes_decks.php?deck=<?= $deck_id ?>" class="back-link">← Annuler et retour</a>

    <h1>📢 Publier une annonce</h1>
    <p class="subtitle">Deck : <?= htmlspecialchars($deck['name']) ?></p>

    <div class="form-card">
        <?= $message ?>
        <!-- Formulaire de publication de l'annonce -->
        <form method="POST">
            <div class="form-group">
                <label>Titre de l'annonce * :</label>
                <input type="text" name="title" class="cr-input" required placeholder="Ex: Deck Cycle Cochon 2.6 Imbattable !" maxlength="200">
            </div>
            
            <div class="form-group">
                <label>Description / Stratégie :</label>
                <textarea name="description" rows="6" class="cr-textarea" placeholder="Expliquez comment jouer ce deck, les combos principaux, comment défendre..."></textarea>
            </div>
            
            <button type="submit" class="btn-publish">Poster</button>
        </form>
    </div>

</div>

</body>
</html>