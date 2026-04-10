<?php
session_start();
require 'header.php';

if (!isset($_SESSION['user_id'])){
    header("Location : login.php");
    exit();
}
$current_user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'recent';
// requete SQL permetant de recuperet outes les informations à afficher pour les posts 
$sql = '
    SELECT p.id, p.title, p.description, p.likes, p.created_at, p.deck_id, u.pseudo, u.id as author_id, d.name as deck_name,SUM(c.elixir) as total_cost
    FROM posts p
    JOIN users u ON p.user_id = u.id
    JOIN decks d ON p.deck_id = d.id 
    JOIN deck_cards dc ON d.id = dc.deck_id
    JOIN cards c ON dc.card_id = c.id
    WHERE u.is_delete = 0
    GROUP BY p.id
';

// Switch pour le ORDER BY selon le critere de tri
switch ($sort) {
    case 'likes':
        $sql .= ' ORDER BY p.likes DESC';
        break;
    case 'ancien':
        $sql .= ' ORDER BY p.created_at ASC';
        break;
    case 'cher':
        $sql .= ' ORDER BY total_cost DESC';
        break;
    case 'pas_cher':
        $sql .= ' ORDER BY total_cost ASC';
        break;
    default:
        $sql .= ' ORDER BY p.created_at DESC';
}

$stmt = $bdd->query($sql);
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Explorateur de Decks</title>
</head>
<body>

    <a href="index.php" class="btn-back">← Retour</a>

    <h1>Explorateur de Decks</h1>

    <div style="text-align:center;">
        <h2 style="margin-bottom:10px;">Trier par :</h2>
        <div class="sort-container">
            <a href="explorateur.php?sort=recent"><button class="btn-sort <?= $sort === 'recent' ? 'active' : '' ?>">Plus récent</button></a>
            <a href="explorateur.php?sort=likes"><button class="btn-sort <?= $sort === 'likes' ? 'active' : '' ?>">Plus liké</button></a>
            <a href="explorateur.php?sort=ancien"><button class="btn-sort <?= $sort === 'ancien' ? 'active' : '' ?>">Plus ancien</button></a>
            <a href="explorateur.php?sort=cher"><button class="btn-sort <?= $sort === 'cher' ? 'active' : '' ?>">Plus cher</button></a>
            <a href="explorateur.php?sort=pas_cher"><button class="btn-sort <?= $sort === 'pas_cher' ? 'active' : '' ?>">Moins cher</button></a>
        </div>
    </div>

    <div style="max-width: 800px; margin: 0 auto; color: white;">
        Annonces trouvées : <?= count($posts) ?>
    </div>

    <?php if (count($posts) > 0): ?>
        <?php foreach ($posts as $post): ?>
            <?php
            // Vérifier si l'utilisateur a liké ce post
            $has_liked = false;
            if ($role !== 'guest') {
                $stmt_like = $bdd->prepare('SELECT 1 FROM post_likes WHERE user_id = ? AND post_id = ?');
                $stmt_like->execute([$current_user_id, $post['id']]);
                $has_liked = $stmt_like->fetch() !== false;
            }
            ?>
            <!-- Afficher titre, nom du deck, pseudo de l'auteur et cout moyen du post -->
            <div class="post-card">
                <div class="post-header">
                    <div>
                        <h3 class="deck-title"><?= htmlspecialchars($post['title']) ?></h3>
                        <small>Deck : <?= htmlspecialchars($post['deck_name']) ?></small>
                    </div>
                    <div style="text-align:right;">
                        <span class="author-name"><?= htmlspecialchars($post['pseudo']) ?></span><br>
                        <?php if (isset($post['total_cost'])): ?>
                            <small style="color:#d63031;">Coût moyen <?= round($post['total_cost'] /8, 1 )?> 💧</small>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Description du post -->
                <p style="margin: 10px 0; font-style: italic; color:#555;">
                    "<?= htmlspecialchars($post['description']) ?>"
                </p>
                <!-- Récupérer les cartes du deck -->
                <?php
                $stmt_cards = $bdd->prepare('
                    SELECT c.id, c.name, c.rarity, c.image_url, c.elixir
                    FROM deck_cards dc
                    JOIN cards c ON dc.card_id = c.id
                    WHERE dc.deck_id = ?
                    ORDER BY dc.position
                ');
                $stmt_cards->execute([$post['deck_id']]);
                $deck_cards = $stmt_cards->fetchAll();
                ?>
                <!-- Affichage visuel du deck -->
                <div class="deck-visual">
                    <?php foreach ($deck_cards as $card): ?>
                        <div class="card-slot">
                            <img src="<?= htmlspecialchars($card['image_url']) ?>" alt="<?= htmlspecialchars($card['name']) ?>">
                            <div class="elixir-cost"><?= $card['elixir'] ?> 💧</div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="actions-bar">
                    <small style="color:#7f8c8d;">Posté le <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?></small>
                    <!-- bouton de like -->
                    <?php if ($role === 'guest'): ?>
                        <span>❤️ <?= $post['likes'] ?></span>
                    <?php else: ?>
                        <form method="POST" action="like_post.php" style="display: inline;">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <input type="hidden" name="sort" value="<?= $sort ?>">
                            <button type="submit" class="btn-action btn-like" style="<?= $has_liked ? 'background:#ffe6e6; border-color:red;' : '' ?>">
                                <?= $has_liked ? '❤️' : '🤍' ?> <?= $post['likes'] ?>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
                <!-- Options de modification/suppression pour l'auteur -->
                <?php if ($role !== 'guest' && $post['author_id'] == $current_user_id): ?>
                    <div style="margin-top: 10px; border-top: 1px dashed #ccc; padding-top:10px;">
                        <a href="modifier_annonce.php?id=<?= $post['id'] ?>"><button class="btn-action btn-edit">Modifier</button></a>
                        <form method="POST" action="supprimer_annonce.php" style="display: inline;" onsubmit="return confirm('Supprimer cette annonce ?');">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <button type="submit" class="btn-action btn-delete">Supprimer</button>
                        </form>
                    </div>
                <?php endif; ?>
                <!-- Section Admin -->
                <?php if ($role === 'admin'): ?>
                    <div class="admin-zone">
                        <strong>🛡️ Admin :</strong>
                        <form method="POST" action="supprimer_annonce.php" style="display: inline;" onsubmit="return confirm('Supprimer cette annonce ?');">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <input type="hidden" name="admin" value="1">
                            <button type="submit" class="btn-action btn-delete">Supprimer Post</button>
                        </form>
                        <form method="POST" action="signaler_user.php" style="display: inline;">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <input type="hidden" name="admin" value="1">
                            <button type="submit" class="btn-action btn-delete">Signaler User</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; color: white; font-size: 1.2rem;">Aucune annonce pour le moment. Soyez le premier à poster un deck !</p>
    <?php endif; ?>

</body>
</html>