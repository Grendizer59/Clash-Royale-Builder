<?php
session_start();
require_once 'header.php';

// Vérifier que l'utilisateur est connecté et n'est pas invité
if (!isset($_SESSION['user_id']) || $_SESSION['role'] === 'guest' || (isset($_SESSION['etat']) && $_SESSION['etat'] == 1)) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$pseudo = $_SESSION['pseudo'];

// Récupérer tous les decks de l'utilisateur
$stmt = $bdd->prepare('SELECT id, name, is_favorite FROM decks WHERE user_id = ? ORDER BY id');
$stmt->execute([$user_id]);
$decks = $stmt->fetchAll();

// Créer les 10 decks s'ils n'existent pas encore
if (count($decks) < 10) {
    for ($i = count($decks) + 1; $i <= 10; $i++) {
        $stmt = $bdd->prepare('INSERT INTO decks (user_id, name) VALUES (?, ?)');
        $stmt->execute([$user_id, 'Deck ' . $i]);
    }
    // Recharger les decks
    $stmt = $bdd->prepare('SELECT id, name, is_favorite FROM decks WHERE user_id = ? ORDER BY id');
    $stmt->execute([$user_id]);
    $decks = $stmt->fetchAll();
}

// Sélectionner le deck à afficher (par défaut le premier)
$selected_deck_id = isset($_GET['deck']) ? intval($_GET['deck']) : $decks[0]['id'];

// Récupérer les cartes du deck sélectionné
$stmt = $bdd->prepare('
    SELECT c.id, c.name, c.rarity, c.image_url, c.elixir, dc.position 
    FROM deck_cards dc 
    JOIN cards c ON dc.card_id = c.id 
    WHERE dc.deck_id = ? 
    ORDER BY dc.position
');
$stmt->execute([$selected_deck_id]);
$deck_cards = $stmt->fetchAll();

// Récupérer le deck sélectionné
$selected_deck = null;
foreach ($decks as $deck) {
    if ($deck['id'] == $selected_deck_id) {
        $selected_deck = $deck;
        break;
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
    <title>Mes Decks - <?= htmlspecialchars($pseudo) ?></title>
</head>
<body>

<div class="cr-container">

    <h1>Mes Decks - <?= htmlspecialchars($pseudo) ?></h1>

    <a href="index.php" class="back-link">← Retour</a>
    <!-- Bouton avec nom du deck et une étoile si favori -->
    <div class="deck-tabs">
        <?php foreach ($decks as $index => $deck): ?>
            <a href="mes_decks.php?deck=<?= $deck['id'] ?>" class="deck-tab-btn <?= $deck['id'] == $selected_deck_id ? 'active' : '' ?>">
                <?= htmlspecialchars($deck['name']) ?>
                <?php if ($deck['is_favorite']): ?> 
                    <span style="color:#f1c40f; text-shadow:1px 1px 0 #000;">⭐</span>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
    </div>
    <!-- Boutons d'actions sur le deck (Modifier, mettre en favori, poster) -->
    <div class="deck-panel">
        <h2><?= htmlspecialchars($selected_deck['name']) ?></h2>

        <div style="margin: 20px 0;">
            <a href="modifier_deck.php?deck=<?= $selected_deck_id ?>">
                <button class="action-btn btn-green">🛠️ Modifier ce deck</button>
            </a>
            
            <form method="POST" action="actions_deck.php" style="display: inline;">
                <input type="hidden" name="deck_id" value="<?= $selected_deck_id ?>">
                <button type="submit" name="favorite" class="action-btn <?= $selected_deck['is_favorite'] ? 'btn-gold' : 'btn-white' ?>">
                    <?= $selected_deck['is_favorite'] ? '⭐ Deck favori' : '☆ Mettre en favori' ?>
                </button>
            </form>
            
            <?php if (count($deck_cards) === 8): ?>
                <a href="poster_deck.php?deck=<?= $selected_deck_id ?>">
                    <button class="action-btn btn-blue">📢 Poster ce deck</button>
                </a>
            <?php else: ?>
                <button class="action-btn btn-gray" disabled title="Le deck doit contenir exactement 8 cartes">
                    📢 Poster (<?= count($deck_cards) ?>/8)
                </button>
            <?php endif; ?>
        </div>

        <hr style="border:0; border-top:1px dashed #ccc; margin:20px 0;">

        <h3>Cartes du deck (<?= count($deck_cards) ?>/8)</h3>
        <!-- Affichage des cartes du deck -->
        <?php if (count($deck_cards) > 0): ?>
            <div class="cards-container">
                <?php foreach ($deck_cards as $card): ?>
                    <div class="card-item">
                        <div class="elixir-badge">
                            <span><?= $card['elixir'] ?></span>
                        </div>
                        
                        <img src="<?= htmlspecialchars($card['image_url']) ?>" alt="<?= htmlspecialchars($card['name']) ?>" style="width: 100%; display:block;">
                        
                        <p style="margin:5px 0 0 0; font-size:0.8rem; font-weight:bold; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            <?= htmlspecialchars($card['name']) ?>
                        </p>
                        </div>
                <?php endforeach; ?>
                
                <?php 
                if (count($deck_cards) < 8) {
                    for($j = 0; $j < (8 - count($deck_cards)); $j++) {
                        echo '<div class="card-item" style="background:transparent; border:2px dashed #999; display:flex; align-items:center; justify-content:center; color:#999;">+</div>';
                    }
                }
                ?>
            </div>
        <?php else: ?>
            <p style="font-style: italic; color: #7f8c8d;">Ce deck est vide. Cliquez sur "Modifier ce deck" pour ajouter des cartes.</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>