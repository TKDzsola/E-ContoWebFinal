<?php
session_start();

// =======================================================================
// 1. BEÁLLÍTÁSOK (JELSZÓ)
// =======================================================================
$admin_pass = 'fbeadmin'; 

// Kijelentkezés
if (isset($_GET['logout'])) {
    session_destroy();
    // VISSZANAVIGÁLÁS A FŐOLDALRA
    header("Location: index.php");
    exit;
}

// Bejelentkezés ellenőrzése
if (isset($_POST['password'])) {
    if ($_POST['password'] === $admin_pass) {
        $_SESSION['is_admin'] = true;
    } else {
        $error = "Hibás jelszó!";
    }
}

// Ha nincs bejelentkezve, mutassuk a login űrlapot
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Belépés - E-Conto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .login-card { max-width: 400px; width: 100%; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); background: white; }
    </style>
</head>
<body>
    <div class="login-card text-center">
        <h3 class="mb-4">Admin Felület</h3>
        <?php if(isset($error)) echo '<div class="alert alert-danger">'.$error.'</div>'; ?>
        <form method="post">
            <div class="mb-3">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Jelszó" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100">Belépés</button>
        </form>
    </div>
</body>
</html>
<?php
    exit; // Itt megáll a kód, ha nincs belépve
}

// =======================================================================
// 2. ADATBÁZIS KAPCSOLAT (A már bevált módszerrel)
// =======================================================================
try {
    $current_dir = __DIR__;                 
    $root_dir = dirname($current_dir);      
    $config_dir = $root_dir . '/config';    

    if (file_exists($config_dir . '/dbdev.php')) { require $config_dir . '/dbdev.php'; } 
    elseif (file_exists($config_dir . '/db.php')) { require $config_dir . '/db.php'; } 
    elseif (file_exists($current_dir . '/dbdev.php')) { require $current_dir . '/dbdev.php'; } 
    elseif (file_exists($current_dir . '/db.php')) { require $current_dir . '/db.php'; }
    elseif (file_exists($root_dir . '/dbdev.php')) { require $root_dir . '/dbdev.php'; } 
    elseif (file_exists($root_dir . '/db.php')) { require $root_dir . '/db.php'; } 
    else { throw new Exception("Nem található az adatbázis konfiguráció!"); }

    if (!isset($pdo)) { throw new Exception("Adatbázis hiba: \$pdo változó hiányzik."); }

    // =======================================================================
    // 3. MŰVELETEK (TÖRLÉS)
    // =======================================================================
    if (isset($_GET['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
        $stmt->execute([$_GET['delete']]);
        header("Location: admin.php?msg=deleted");
        exit;
    }

    // =======================================================================
    // 4. LEKÉRDEZÉS (LISTÁZÁS)
    // =======================================================================
    // Rendezés: Dátum szerint csökkenő (legújabb elől), azon belül időpont szerint
    $stmt = $pdo->query("SELECT * FROM bookings ORDER BY booking_date DESC, booking_time ASC");
    $bookings = $stmt->fetchAll();

} catch (Exception $e) {
    die("Hiba történt: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foglalások Kezelése</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .table-responsive { border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0,0,0,0.05); }
        .bg-gradient-primary { background: linear-gradient(45deg, #0d6efd, #0dcaf0); }
        tr { vertical-align: middle; }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand mb-0 h1"><i class="bi bi-calendar-check me-2"></i>E-Conto Admin</span>
        <a href="admin.php?logout=1" class="btn btn-outline-light btn-sm">Kijelentkezés</a>
    </div>
</nav>

<div class="container">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Beérkezett Foglalások</h2>
        <span class="badge bg-primary fs-6 rounded-pill"><?= count($bookings) ?> db foglalás</span>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            A foglalást sikeresen töröltük!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-gradient-primary text-white">
                        <tr>
                            <th class="py-3 px-4">Dátum & Idő</th>
                            <th class="py-3">Ügytípus</th>
                            <th class="py-3">Ügyfél neve</th>
                            <th class="py-3">Elérhetőség</th>
                            <th class="py-3">Megjegyzés</th>
                            <th class="py-3 text-end px-4">Művelet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($bookings) > 0): ?>
                            <?php foreach ($bookings as $row): 
                                // Dátum formázása szépre
                                $date = new DateTime($row['booking_date']);
                                $today = new DateTime();
                                $is_past = $date < $today; // Múltbeli-e?
                                $row_class = $is_past ? 'opacity-50' : ''; // Ha elmúlt, legyen halvány
                            ?>
                            <tr class="<?= $row_class ?>">
                                <td class="px-4">
                                    <div class="fw-bold text-primary"><?= $row['booking_date'] ?></div>
                                    <div class="small text-muted"><?= $row['booking_time'] ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark"><?= htmlspecialchars($row['service']) ?></span>
                                </td>
                                <td class="fw-bold"><?= htmlspecialchars($row['name']) ?></td>
                                <td>
                                    <div><a href="mailto:<?= htmlspecialchars($row['email']) ?>" class="text-decoration-none"><?= htmlspecialchars($row['email']) ?></a></div>
                                    <div class="small text-muted"><?= htmlspecialchars($row['phone']) ?></div>
                                </td>
                                <td>
                                    <small class="text-muted fst-italic"><?= htmlspecialchars($row['message']) ?></small>
                                </td>
                                <td class="text-end px-4">
                                    <a href="admin.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Biztosan törölni szeretnéd ezt a foglalást?');">
                                        <i class="bi bi-trash"></i> Törlés
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                    Még nem érkezett foglalás.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>