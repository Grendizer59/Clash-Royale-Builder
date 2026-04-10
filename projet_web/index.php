<?php
session_start();
require 'header.php'; // Inclusion de la BDD

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$pseudo = $_SESSION['pseudo'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Accueil - Clash Royale Builder</title>
</head>
<body>

<div class="home-panel">
    
    <h1>Bienvenue <?= htmlspecialchars($pseudo) ?> !</h1>

    <?php if ($role === 'admin'): ?>
        <div class="role-badge role-admin">👑 Administrateur</div>
    <?php elseif ($role === 'guest'): ?>
        <div class="role-badge role-guest">🛡️ Invité</div>
    <?php else: ?>
        <div class="role-badge role-user">⚔️ Joueur</div>
    <?php endif; ?>

    <h2>Arène de Combat</h2>

    <div class="home-menu">
        <!--Bouton mes decks (disponible uniquement pour les utilisateurs connectés)-->
        <?php if ($role !== 'guest'): ?>
            <a href="mes_decks.php" class="cr-btn btn-gold btn-home">
                <span>🎴</span> Mes Decks
            </a>
        <?php endif; ?>
        <!-- Bouton explorateur de decks (disponible pour tout le monde) -->
        <a href="explorateur.php" class="cr-btn btn-blue btn-home">
            <span>🌍</span> Explorateur de Decks
        </a>

    </div>
    <!-- Boutons admin (disponible uniquement pour les admins) -->
    <?php if ($role === 'admin'): ?>
        <div class="admin-section">
            <div class="admin-title">⚙️ Zone Administrateur</div>
            <div class="home-menu">
                <a href="gestion_cartes.php" class="cr-btn btn-gray">Gestion des cartes</a>
                <a href="gestion_users.php" class="cr-btn btn-red">Gestion Utilisateurs</a>
            </div>
        </div>
    <?php endif; ?>
    <!-- Bouton de déconnexion -->
    <a href="logout.php" class="logout-link">❌ Se déconnecter</a>

</div>

</body>
</html>