<?php
session_start();
require 'header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
// Recuperer toutes les cartes recherchées, ou bien toutes les cartes si aucune recherchée
if(isset($_GET['nom_carte']) && !empty($_GET['nom_carte'])){
    $sql = 'SELECT * FROM cards WHERE name LIKE ? ';
    $search = '%' . $_GET['nom_carte'] . '%';
    $recherchecarte = $bdd->prepare($sql);
    $recherchecarte->execute([$search]);
    $all_cards = $recherchecarte->fetchAll();
}else{
    $stmt = $bdd->query('SELECT id, name, rarity, image_url, elixir FROM cards ORDER BY name');
    $all_cards = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <title>Gestion Cartes - Admin</title>
</head>
<body>

    <div class="admin-container">
        <h1>Gestion des cartes (<?= count($all_cards) ?>)</h1>
        <!-- Formulaire de recherche de carte -->
        <div class="search-container" style="text-align:center; margin-bottom: 30px;">
            <form action="" method="get">
                <label for="search" style="color:white; font-size:1.2rem; margin-bottom:10px; display:block;">Rechercher une carte</label>
                <div style="display:flex; justify-content:center; gap:10px; max-width:500px; margin:0 auto;">
                    <input type="text" id="search" placeholder="Ex: P.E.K.K.A" name="nom_carte" class="cr-input" value="<?= isset($_GET['nom_carte']) ? htmlspecialchars($_GET['nom_carte']) : '' ?>">
                    <input type="submit" value="Rechercher" class="cr-btn btn-blue">
                </div>
            </form>
        </div>
        <!-- Affichage des cartes -->
        <div class="cards-container">
            <?php foreach ($all_cards as $card): ?>
                <div class="card-item" style="width: 140px; padding: 15px;">
                    
                    <div class="elixir-badge">
                        <span><?= $card['elixir'] ?></span>
                    </div>

                    <img src="<?= htmlspecialchars($card['image_url']) ?>" alt="<?= htmlspecialchars($card['name']) ?>" style="width: 100%; display:block; margin-bottom:10px;">
                    
                    <div style="font-weight: bold; margin-bottom: 5px;"><?= htmlspecialchars($card['name']) ?></div>
                    <div style="font-size: 0.8rem; color: #7f8c8d; margin-bottom: 10px;"><?= htmlspecialchars($card['rarity']) ?></div>
                    
                    <a href="modifier_carte.php?id=<?= $card['id'] ?>" style="text-decoration:none;">
                        <button class="cr-btn btn-green" style="width:100%; font-size:0.8rem; padding:5px;">Modifier</button>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (count($all_cards) === 0): ?>
            <p style="text-align:center; color:white; font-size:1.2rem; margin-top:30px;">Aucune carte trouvée.</p>
        <?php endif; ?>

        <div style="text-align:center; margin-top:30px;">
            <a href='index.php' class="btn-back">← Retour à l'accueil</a>
        </div>
    </div>

</body>
</html>