<?php
session_start();
require 'header.php';

$erreur = ''; 

if (isset($_POST['guest'])) {
    $_SESSION['user_id'] = 0;
    $_SESSION['pseudo'] = 'Invité';
    $_SESSION['role'] = 'guest';
    header('Location: index.php');
    exit();
}

if (isset($_POST['login'])) {
    $pseudo = trim($_POST['pseudo']);
    $password = $_POST['password'];
    
    if (empty($pseudo) || empty($password)) {
        $erreur = 'Veuillez remplir tous les champs';
    } else {
        $stmt = $bdd->prepare('SELECT id, nom, prenom, pseudo, password, role, is_delete FROM users WHERE pseudo = ?');
        $stmt->execute([$pseudo]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            // Vérification si banni AVANT de connecter
            if ($user['is_delete'] == 1){
                 $erreur = 'Votre compte a été banni suite à des signalements.';
            } else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['etat'] = $user['is_delete'];
                
                header('Location: index.php');
                exit();
            }
        } else {
            $erreur = 'Pseudo ou mot de passe incorrect';
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
    <title>Connexion - Clash Royale</title>
</head>
<body>

<div class="login-card">
    <h2>Connexion</h2>

    <?php if ($erreur): ?>
        <div class="error-msg"> <?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>
        <!-- Formulaire de connexion -->
    <form method="POST">
        <div class="form-group">
            <label>Pseudo :</label>
            <input type="text" name="pseudo" required>
        </div>
        <div class="form-group">
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" name="login" class="btn-main">Se connecter</button>
    </form>

    <form method="POST">
        <button type="submit" name="guest" class="btn-guest">Continuer en tant qu'invité</button>
    </form>

    <p><a href="register.php" class="register-link">Créer un compte</a></p>
</div>

</body>
</html>