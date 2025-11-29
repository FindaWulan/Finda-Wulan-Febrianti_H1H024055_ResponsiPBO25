<?php
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
session_start();
require_once '../classes/Pokemon.php';
require_once '../classes/PokeCare.php';

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
$history = $_SESSION['trainingHistory'] ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéCare - Riwayat Latihan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h1>RIWAYAT LATIHAN POKEMON</h1>

        <?php if (empty($history)): ?>
            <div class="no-data">
                <p>Belum ada riwayat latihan. Mulai latihan sekarang!</p>
            </div>
        <?php else: ?>
            <div class="history-table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Latihan</th>
                            <th>Intensitas</th>
                            <th>Level</th>
                            <th>HP</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($history as $index => $session): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($session['type']); ?></td>
                                <td><?php echo $session['intensity']; ?></td>
                                <td class="level-change">
                                    <?php echo $session['levelBefore']; ?> → <?php echo $session['levelAfter']; ?>
                                </td>
                                <td class="hp-change">
                                    <?php echo $session['hpBefore']; ?> → <?php echo $session['hpAfter']; ?>
                                </td>
                                <td><?php echo $session['timestamp']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="summary-box">
                <h3>Ringkasan</h3>
                <p><strong>Total Sesi Latihan:</strong> <?php echo count($history); ?> sesi</p>
                <p><strong>Level Sekarang:</strong> <?php echo $pokemon->getLevel(); ?></p>
                <p><strong>HP Sekarang:</strong> <?php echo $pokemon->getCurrentHp(); ?> / <?php echo $pokemon->getMaxHp(); ?></p>
            </div>
        <?php endif; ?>

        <div class="button-group">
            <a href="../index.php" class="btn btn-secondary">Kembali ke Beranda</a>
            <a href="training.php" class="btn btn-primary">Mulai Latihan</a>
        </div>
    </div>
</body>
</html>
