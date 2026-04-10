<?php
session_start();
require 'header.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$card_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $bdd->prepare('SELECT * FROM cards WHERE id = ?');
$stmt->execute([$card_id]);
$card = $stmt->fetch();
if (!$card) {
    // Si la carte n'existe pas, on redirige vers la liste
    header('Location: gestion_cartes.php');
    exit();
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $rarity = trim($_POST['rarity']);
    $elixir = intval($_POST['elixir']);
    $image_url = trim($_POST['image_url']);

    // Validation simple
    if (empty($name) || empty($rarity) || empty($elixir) || $elixir <0) {
        $message = '<div class="alert error">⚠️ Veuillez remplir correctement tous les champs.</div>';
    } else {
        // Met à jour la carte
        $stmt = $bdd->prepare('UPDATE cards SET name = ?, rarity = ?, elixir = ?, image_url = ? WHERE id = ?');
        $stmt->execute([$name, $rarity, $elixir, $image_url, $card_id]);

        $message = '<div class="alert success">✅ Carte mise à jour avec succès.</div>';

        // Recharger les nouvelles données
        $stmt = $bdd->prepare('SELECT * FROM cards WHERE id = ?');
        $stmt->execute([$card_id]);
        $card = $stmt->fetch();
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
    <title>Modifier la carte - Admin Clash Royale</title>
</head>
<body>

<div class="admin-container">
    <h1>Modifier : <?= htmlspecialchars($card['name']) ?></h1>

    <?= $message ?>
    <!-- Formulaire de modification de la carte -->
    <form method="POST">
        <div class="editor-layout">
            
            <div class="form-section">
                <div class="form-group">
                    <label>Nom de la carte</label>
                    <input type="text" name="name" class="cr-input" value="<?= htmlspecialchars($card['name']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Rareté</label>
                    <select name="rarity" class="cr-select" required>
                        <?php
                        $rareties = ['Commune', 'Rare', 'Épique', 'Légendaire', 'Champion'];
                        foreach ($rareties as $r) {
                            $selected = ($r === $card['rarity']) ? 'selected' : '';
                            echo "<option value=\"$r\" $selected>$r</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Coût en élixir (0-10)</label>
                    <input type="number" name="elixir" class="cr-input" value="<?= htmlspecialchars($card['elixir']) ?>" min="0" max="10" required>
                </div>

                <div class="form-group">
                    <label>URL de l’image</label>
                    <input type="text" name="image_url" class="cr-input" value="<?= htmlspecialchars($card['image_url']) ?>">
                </div>
            </div>
        </div>

        <div class="btn-group">
            <a href="gestion_cartes.php" class="cr-btn btn-cancel">Annuler</a>
            <button type="submit" class="cr-btn btn-save">Sauvegarder</button>
        </div>
    </form>

</div>

</body>
</html>