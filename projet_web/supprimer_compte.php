<?php
session_start();
require 'header.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Suppression de Compte</title>
</head>
<body>

<div class="message-card">

<?php

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // IA Note : header location ne marchera plus ici car du HTML a été envoyé avant.
    // IA On utilise une redirection JS pour contourner le problème visuel dans ce contexte spécifique
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

if (!isset($_POST['user_id'])) {
    echo "<script>window.location.href='gestion_users.php';</script>";
    exit();
}

$user_id = $_POST['user_id'];
//verifier que l'utilisateur existe

$stmt = $bdd->prepare("SELECT nom, prenom FROM users WHERE id = ? AND is_delete = 0");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "<h1 style='color:#c0392b'>Erreur</h1>";
    echo "<p>Utilisateur introuvable ou déjà supprimé.</p>";
    echo '<a href="gestion_users.php" class="btn-return">Retour à la gestion</a>';
    echo '</div></body></html>';
    exit();
}
//Supression du compte (marquer comme supprimé)
$sql = "UPDATE users SET is_delete = 1 WHERE id = ?";
$stmt = $bdd->prepare($sql);
$stmt->execute([$user_id]);
?>

    <span class="success-icon">🗑️</span>
    <h1>Compte Supprimé</h1>
    
    <p>
        L'utilisateur <span class="deleted-name"><?php echo htmlspecialchars($user['nom'])?> <?php echo htmlspecialchars($user['prenom'])?></span> a bien été banni de l'arène.
    </p>
    
    <br>
    
    <a href="gestion_users.php" class="btn-return">Retour à la gestion</a>

</div>

</body>
</html>