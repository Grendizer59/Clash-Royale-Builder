<?php
session_start();
require 'header.php';

// Vérifier que l'utilisateur est admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Vérifier que l'ID utilisateur est fourni
if (!isset($_GET['user_id'])) {
    header('Location: gestion_users.php');
    exit();
}

$user_id = $_GET['user_id'];

// Récupérer les infos de l'utilisateur
$stmt_user = $bdd->prepare('SELECT pseudo, nom, prenom FROM users WHERE id = ?');
$stmt_user->execute([$user_id]);
$user = $stmt_user->fetch();

if (!$user) {
    header('Location: gestion_users.php');
    exit();
}

// Récupérer tous les signalements de cet utilisateur
$stmt_signalements = $bdd->prepare('
    SELECT s.description,s.created_at,u.pseudo as reporter_pseudo
    FROM signalements s
    JOIN users u ON s.reporter_id = u.id
    WHERE s.user_id = ?
    ORDER BY s.created_at DESC
');
$stmt_signalements->execute([$user_id]);
$signalements = $stmt_signalements->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Détail des signalements - Clash Royale</title>
</head>
<body>

<div class="admin-container">

    <h1>📜 Détail des signalements</h1>

    <a href="gestion_users.php" class="btn-back">← Retour à la gestion</a>

    <!-- Affichage des infos utilisateur -->
    <div class="suspect-card">
        <h2>Utilisateur : <?= htmlspecialchars($user['pseudo']) ?></h2>
        <p><strong>Nom complet :</strong> <?= htmlspecialchars($user['nom']) ?> <?= htmlspecialchars($user['prenom']) ?></p>
        <p><strong>Total plaintes :</strong> <span style="color:#e74c3c; font-weight:bold;"><?= count($signalements) ?> ⚠️</span></p>
    </div>

    <h2>Historique des plaintes</h2>

    <!-- Tableau des signalements -->
    <?php if (count($signalements) > 0): ?>
        <table class="clash-table">
            <thead>
                <tr>
                    <th>Signalé par</th>
                    <th>Description du problème</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($signalements as $signalement): ?>
                    <tr>
                        <td style="font-weight:bold; color:#2980b9;">
                            <?= htmlspecialchars($signalement['reporter_pseudo']) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($signalement['description']) ?>
                        </td>
                        <td style="font-size: 0.9rem; color:#7f8c8d;">
                             <?= date('d/m/Y à H:i', strtotime($signalement['created_at'])) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align:center; font-style:italic;">Aucun signalement trouvé pour ce joueur.</p>
    <?php endif; ?>

    <!-- Section de suppression de compte -->
    <div class="danger-zone">
        <h3>⚡ Action Admin </h3>
        <p>Attention, cette action est irréversible.</p>
        <form method="POST" action="supprimer_compte.php" 
              onsubmit="return confirm('Êtes-vous sûr de vouloir BANNIR définitivement <?= htmlspecialchars($user['pseudo']) ?> ?');">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            <button type="submit" class="btn-delete">
                🔨 Supprimer ce compte
            </button>
        </form>
    </div>

</div>

</body>
</html>