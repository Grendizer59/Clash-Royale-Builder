<?php
session_start();
require_once 'header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] === 'guest' || (isset($_SESSION['etat']) && $_SESSION['etat'] == 1)) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$deck_id = isset($_GET['deck']) ? intval($_GET['deck']) : 0;

// Vérifier que le deck appartient bien à l'utilisateur
$stmt = $bdd->prepare('SELECT id, name FROM decks WHERE id = ? AND user_id = ?');
$stmt->execute([$deck_id, $user_id]);
$deck = $stmt->fetch();

if (!$deck) {
    header('Location: mes_decks.php');
    exit();
}

$message = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_deck'])) {
        $selected_cards = isset($_POST['cards']) ? $_POST['cards'] : [];
        $deck_name = trim($_POST['deck_name']);
        
        if (count($selected_cards) > 8) {
            $message = '<div class="alert error">Vous ne pouvez sélectionner que 8 cartes maximum !</div>';
        } else {
            // Mettre à jour le nom du deck
            $stmt = $bdd->prepare('UPDATE decks SET name = ? WHERE id = ?');
            $stmt->execute([$deck_name, $deck_id]);
            
            // Supprimer les anciennes cartes du deck
            $stmt = $bdd->prepare('DELETE FROM deck_cards WHERE deck_id = ?');
            $stmt->execute([$deck_id]);
            
            // Ajouter les nouvelles cartes
            $position = 1;
            foreach ($selected_cards as $card_id) {
                $stmt = $bdd->prepare('INSERT INTO deck_cards (deck_id, card_id, position) VALUES (?, ?, ?)');
                $stmt->execute([$deck_id, $card_id, $position]);
                $position++;
            }
            
            $message = '<div class="alert success">✅ Deck sauvegardé avec succès !</div>';
            
            // Recharger les données du deck
            $stmt = $bdd->prepare('SELECT id, name FROM decks WHERE id = ?');
            $stmt->execute([$deck_id]);
            $deck = $stmt->fetch();
        }
    }
}

// Récupérer les cartes actuelles du deck
$stmt = $bdd->prepare('SELECT card_id FROM deck_cards WHERE deck_id = ? ORDER BY position');
$stmt->execute([$deck_id]);
$current_cards = $stmt->fetchAll(PDO::FETCH_COLUMN);

$stmt = $bdd->query('SELECT id, name, rarity, image_url, elixir FROM cards ORDER BY name');
$all_cards = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Modifier le Deck</title>
</head>
<body>

<div class="builder-container">
    <h1>⚔️ Atelier de Construction</h1>
    
    <a href="mes_decks.php?deck=<?= $deck_id ?>" class="btn-back">← Annuler et retour</a>

    <?= $message ?>
    
    <form method="POST">
        <!-- Formulaire permettant de modifier le nom du deck -->
        <div class="deck-info-bar">
            <label style="font-family: 'Lilita One'; font-size:1.2rem; margin-right:10px;">Nom du deck :</label>
            <input type="text" name="deck_name" class="deck-name-input" value="<?= htmlspecialchars($deck['name']) ?>" required>
            
            <span class="counter-badge" id="counter-display">
                <?= count($current_cards) ?>/8
            </span>
        </div>

        <div style="text-align:center; color:white; margin-bottom:15px; font-style:italic;">
            Cliquez sur les cartes pour les ajouter ou les retirer.
        </div>
        <!-- Affichage des cartes -->
        <div class="selection-grid">
            <?php foreach ($all_cards as $card): ?>
                <?php $is_selected = in_array($card['id'], $current_cards); ?>
                
                <label class="card-checkbox-label">
                    <input type="checkbox" name="cards[]" value="<?= $card['id'] ?>" <?= $is_selected ? 'checked' : '' ?>>
                    
                    <div class="check-badge">✓</div>

                    <div class="card-visual">
                        <div class="elixir-badge"><span><?= $card['elixir'] ?></span></div>
                        <img src="<?= htmlspecialchars($card['image_url']) ?>" alt="<?= htmlspecialchars($card['name']) ?>">
                        <div style="font-size:0.75rem; font-weight:bold; margin-top:2px;"><?= htmlspecialchars($card['name']) ?></div>
                    </div>
                </label>

            <?php endforeach; ?>
        </div>
        
        <div style="text-align:center; margin: 30px 0;">
            <button type="submit" name="save_deck" class="save-btn">💾 Sauvegarder le Deck</button>
        </div>
    </form>
</div>

<script> //IA
// Fonction pour mettre à jour le compteur
function updateCounter() {
    const checked = document.querySelectorAll('input[name="cards[]"]:checked');
    const count = checked.length;
    const counterDisplay = document.getElementById('counter-display');
    
    counterDisplay.textContent = count + "/8";
    
    // Changement de couleur selon le nombre
    if (count === 8) {
        counterDisplay.style.background = "#2ecc71"; // Vert (OK)
        counterDisplay.style.borderColor = "#27ae60";
    } else if (count > 8) {
        counterDisplay.style.background = "#e74c3c"; // Rouge (Trop)
        counterDisplay.style.borderColor = "#c0392b";
    } else {
        counterDisplay.style.background = "#333"; // Gris (En cours)
        counterDisplay.style.borderColor = "#fff";
    }
}

// Écouteurs d'événements
document.querySelectorAll('input[name="cards[]"]').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const checked = document.querySelectorAll('input[name="cards[]"]:checked');
        
        if (checked.length > 8) {
            this.checked = false; // Annule le coche
            alert('⚠️ Limite atteinte !\nVous ne pouvez sélectionner que 8 cartes maximum.');
        }
        
        updateCounter();
    });
});

// Initialiser le compteur au chargement
updateCounter();
</script>

</body>
</html>