<?php
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
session_start();
require_once 'classes/Pokemon.php';
require_once 'classes/PokeCare.php';

if (isset($_GET['reset'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['pokemonStats'])) {
    $_SESSION['pokemonStats'] = [
        'level' => 5,
        'currentHp' => 95
    ];
}

$pokemon = new PokeCare(
    $_SESSION['pokemonStats']['level'],
    $_SESSION['pokemonStats']['currentHp']
);
$specialMove = $pokemon->specialMove();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéCare - Beranda</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>POKE CARE TRAINING CENTER</h1>
        
        <div class="pokemon-card">
            <div class="pokemon-image">
                <img src="assets/vulpix.png" alt="Vulpix" style="width: 200px; height: 200px;">
            </div>
            
            <h2>Informasi Pokémon</h2>
            
            <div class="info-grid">
                <div class="info-item">
                    <label>Nama Pokémon:</label>
                    <span class="value"><?php echo htmlspecialchars($pokemon->getName()); ?></span>
                </div>
                
                <div class="info-item">
                    <label>Tipe:</label>
                    <span class="type-badge type-fire">
                        <?php echo htmlspecialchars($pokemon->getType()); ?>
                    </span>
                </div>
                
                <div class="info-item">
                    <label>Level:</label>
                    <span class="value"><?php echo $pokemon->getLevel(); ?></span>
                </div>
                
                <div class="info-item">
                    <label>HP:</label>
                    <span class="value"><?php echo $pokemon->getCurrentHp(); ?> / <?php echo $pokemon->getMaxHp(); ?></span>
                </div>
            </div>

            <div class="info-item">
                <label style="margin-top: 15px;">Jurus Spesial:</label>
                <div class="move-box">
                    <strong><?php echo htmlspecialchars($specialMove['name']); ?></strong>
                    <p><?php echo htmlspecialchars($specialMove['description']); ?></p>
                </div>
            </div>
        </div>

        <div class="button-group">
            <a href="pages/training.php" class="btn btn-primary">Mulai Latihan</a>
            <a href="pages/history.php" class="btn btn-secondary">Riwayat Latihan</a>
            <a href="index.php?reset=1" class="btn btn-secondary" onclick="return confirm('Reset semua data Pokemon?')">Reset Pokemon</a>
        </div>
    </div>
</body>
</html>
