<?php
session_start();
require 'header.php';

// Vérifier que l'utilisateur est admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Récupérer les utilisateurs avec leur nombre de signalements
$sql = "
    SELECT u.id,u.pseudo,u.nom,u.prenom,u.is_delete,COUNT(s.id) as nb_signalements
    FROM users u
    LEFT JOIN signalements s ON u.id = s.user_id
    WHERE u.is_delete = 0
    GROUP BY u.id
    HAVING nb_signalements > 0
    ORDER BY nb_signalements DESC
";

$stmt = $bdd->query($sql);
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Gestion des signalements - Clash Royale</title>
</head>
<body>

<div class="admin-container">

    <h1>🛡️ Gestion des signalements</h1>

    <a href="index.php" class="btn-back">← Retour à l'accueil</a>
    <!-- Tableau des utilisateurs signalés -->
    <?php if (count($users) > 0): ?>
        <div style="overflow-x: auto;">
            <table class="clash-table">
                <thead>
                    <tr>
                        <th>Joueur</th>
                        <th>Nom Complet</th>
                        <th style="text-align: center;">Plaintes</th>
                        <th>Actions Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <span style="font-weight:bold; color:#2c3e50; font-size:1.1rem;">
                                    <?= htmlspecialchars($user['pseudo']) ?>
                                </span>
                            </td>
                            <td>
                                <?= htmlspecialchars($user['nom']) ?> <?= htmlspecialchars($user['prenom']) ?>
                            </td>
                            <td style="text-align: center;">
                                <span class="report-badge">⚠️ <?= $user['nb_signalements'] ?></span>
                            </td>
                            <td>
                                <div class="action-container">
                                    <a href="detail_signalements.php?user_id=<?= $user['id'] ?>" style="text-decoration:none;">
                                        <button class="cr-btn-small btn-view">
                                            👁️ Voir
                                        </button>
                                    </a>
                                    
                                    <form method="POST" action="supprimer_compte.php" style="display: inline;" 
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer le compte de <?= htmlspecialchars($user['pseudo']) ?> ?');">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                        <button type="submit" class="cr-btn-small btn-ban">
                                            🔨 Bannir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
              Aucun utilisateur signalé pour le moment.<br>
            <small>L'arène est calme...</small>
        </div>
    <?php endif; ?>

</div>

</body>
</html>