<?php
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
session_start();
require_once '../classes/Pokemon.php';
require_once '../classes/PokeCare.php';

if (!isset($_SESSION['pokemonStats'])) {
    $_SESSION['pokemonStats'] = [
        'level' => 5,
        'currentHp' => 100
    ];
}

if (!isset($_SESSION['trainingHistory'])) {
    $_SESSION['trainingHistory'] = [];
}

$pokemon = new PokeCare(
    $_SESSION['pokemonStats']['level'],
    $_SESSION['pokemonStats']['currentHp']
);

$trainingResult = null;
$specialMove = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trainingType = $_POST['training_type'] ?? '';
    $intensity = intval($_POST['intensity'] ?? 0);
    
    if ($trainingType && $intensity > 0 && $intensity <= 1000) {
        $trainingResult = $pokemon->train($trainingType, $intensity);
        $specialMove = $pokemon->specialMove();
        
        $_SESSION['pokemonStats']['level'] = $pokemon->getLevel();
        $_SESSION['pokemonStats']['currentHp'] = $pokemon->getCurrentHp();
        $_SESSION['trainingHistory'][] = $trainingResult;
    }
}

$history = $_SESSION['trainingHistory'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéCare - Latihan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h1>HALAMAN LATIHAN POKEMON</h1>

        <?php if ($trainingResult): ?>
            <div class="result-box">
                <h2>Hasil Latihan</h2>
                
                <div class="result-item">
                    <label>Jenis Latihan:</label>
                    <span><?php echo htmlspecialchars($trainingResult['type']); ?></span>
                </div>

                <div class="result-item">
                    <label>Intensitas:</label>
                    <span><?php echo $trainingResult['intensity']; ?></span>
                </div>

                <div class="result-item">
                    <label>Level:</label>
                    <span><?php echo $trainingResult['levelBefore']; ?> → <strong><?php echo $trainingResult['levelAfter']; ?></strong></span>
                </div>

                <div class="result-item">
                    <label>HP:</label>
                    <span><?php echo $trainingResult['hpBefore']; ?> → <strong><?php echo $trainingResult['hpAfter']; ?></strong></span>
                </div>

                <div class="result-item special-move">
                    <label>Jurus Spesial Yang Digunakan:</label>
                    <div class="move-box">
                        <strong><?php echo htmlspecialchars($specialMove['name']); ?></strong>
                        <p><?php echo htmlspecialchars($specialMove['description']); ?></p>
                    </div>
                </div>

                <hr>
            </div>
        <?php endif; ?>

        <div class="training-form">
            <h2>Form Latihan</h2>
            
            <form method="POST">
                <div class="form-group">
                    <label for="training_type">Jenis Latihan:</label>
                    <select name="training_type" id="training_type" required>
                        <option value="">-- Pilih Jenis Latihan --</option>
                        <option value="Attack">Attack (Serangan)</option>
                        <option value="Defense">Defense (Pertahanan)</option>
                        <option value="Speed">Speed (Kecepatan)</option>
                        <option value="Stamina">Stamina (Daya Tahan)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="intensity">Intensitas Latihan (1-1000):</label>
                    <input type="number" name="intensity" id="intensity" min="1" max="1000" required>
                    <small>Semakin tinggi intensitas, semakin besar peningkatan</small>
                </div>

                <button type="submit" class="btn btn-primary">Mulai Latihan</button>
            </form>
        </div>

        <div class="button-group">
            <a href="../index.php" class="btn btn-secondary">Kembali ke Beranda</a>
            <a href="history.php" class="btn btn-secondary">Riwayat Latihan</a>
        </div>
    </div>
</body>
</html>
