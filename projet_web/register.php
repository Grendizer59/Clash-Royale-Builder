<?php
session_start();
require 'header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $pseudo = trim($_POST['pseudo']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    
    if (empty($nom) || empty($prenom) || empty($pseudo) || empty($password) || empty($confirm)) {
        $error = 'Veuillez remplir tous les champs';
    } elseif ($password !== $confirm) {
        $error = 'Les mots de passe ne correspondent pas';
    } elseif (strlen($password) < 3) {
        $error = 'Le mot de passe doit contenir au moins 3 caractères';
    } else {
        $stmt = $bdd->prepare('SELECT id FROM users WHERE pseudo = ?');
        $stmt->execute([$pseudo]);
        
        if ($stmt->fetch()) {
            $error = 'Ce pseudo existe déjà';
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $bdd->prepare('INSERT INTO users (nom, prenom, pseudo, password, role) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$nom, $prenom, $pseudo, $hashed, 'membre']);
            $success = 'Compte créé avec succès ! <a href="login.php" style="color:white; text-decoration:underline;">Se connecter</a>';
        }
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
    <title>Inscription - Clash Royale</title>
</head>
<body>

<div class="register-card">
    <h2>Rejoindre l'Arène</h2>

    <?php if ($error): ?>
        <div class="alert alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success">✅ <?= $success ?></div>
    <?php endif; ?>
    <!-- Formulaire d'inscription -->
    <form method="POST">
        <div class="form-row">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" required placeholder="Paananen">
            </div>
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenom" required placeholder="Ilkka">
            </div>
        </div>

        <div class="form-group">
            <label>Pseudo (Nom de joueur)</label>
            <input type="text" name="pseudo" required placeholder="ClashKing123">
        </div>

        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <label>Confirmer mot de passe</label>
            <input type="password" name="confirm" required>
        </div>

        <button type="submit" class="btn-register">Créer le compte</button>
    </form>

    <p><a href="login.php" class="login-link">Déjà combattant ? Se connecter</a></p>
</div>

</body>
</html>