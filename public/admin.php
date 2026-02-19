<?php
session_start();

// Alapvető hibakeresés (ha már minden jó, 0-ra állítható)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// JAVÍTOTT ÚTVONAL: az admin.php mellé, a config mappába nézünk
$db_file = __DIR__ . '/config/db.php';

if (file_exists($db_file)) {
    require_once $db_file;
} else {
    // Ha nem találja, megpróbáljuk a szülőmappából is (biztonsági tartalék)
    $db_file_alt = dirname(__DIR__) . '/config/db.php';
    if (file_exists($db_file_alt)) {
        require_once $db_file_alt;
    } else {
        die("Hiba: Az adatbázis konfigurációs fájl nem található. Próbált útvonalak: <br> 1. $db_file <br> 2. $db_file_alt");
    }
}

// Törlés kezelése
if (isset($_POST['delete_id'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = :id");
        $stmt->execute([':id' => $_POST['delete_id']]);
        header("Location: admin.php");
        exit;
    } catch (Exception $e) {
        $error = "Hiba a törlés során: " . $e->getMessage();
    }
}

// Foglalások lekérése
try {
    $stmt = $pdo->query("SELECT * FROM bookings ORDER BY booking_date DESC, booking_time DESC");
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Adatbázis hiba: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Időpontfoglalások</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .admin-container { padding: 40px 20px; }
        .table-container { background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); padding: 20px; }
        .msg-cell { max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container admin-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary fw-bold">Beérkezett időpontfoglalások</h1>
            <a href="index.php" class="btn btn-outline-secondary btn-sm">Vissza a főoldalra</a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Név</th>
                            <th>E-mail</th>
                            <th>Telefon</th>
                            <th>Szolgáltatás</th>
                            <th>Megjegyzés</th>
                            <th>Dátum</th>
                            <th>Időpont</th>
                            <th>Rögzítve</th>
                            <th class="text-center">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $b): ?>
                        <tr>
                            <td>#<?php echo htmlspecialchars($b['id']); ?></td>
                            <td class="fw-bold"><?php echo htmlspecialchars($b['name']); ?></td>
                            <td><a href="mailto:<?php echo htmlspecialchars($b['email']); ?>"><?php echo htmlspecialchars($b['email']); ?></a></td>
                            <td><?php echo htmlspecialchars($b['phone']); ?></td>
                            <td><span class="badge bg-primary"><?php echo htmlspecialchars($b['service']); ?></span></td>
                            <td class="msg-cell" title="<?php echo htmlspecialchars($b['message']); ?>">
                                <?php echo htmlspecialchars($b['message'] ?: '-'); ?>
                            </td>
                            <td><?php echo htmlspecialchars($b['booking_date']); ?></td>
                            <td class="fw-bold"><?php echo htmlspecialchars($b['booking_time']); ?></td>
                            <td class="small text-muted"><?php echo htmlspecialchars($b['created_at']); ?></td>
                            <td class="text-center">
                                <form method="POST" onsubmit="return confirm('Biztosan törölni szeretné ezt a foglalást?');">
                                    <input type="hidden" name="delete_id" value="<?php echo $b['id']; ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($bookings)): ?>
                        <tr>
                            <td colspan="10" class="text-center py-4 text-muted">Nincs beérkezett foglalás.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>