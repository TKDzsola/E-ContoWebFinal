<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

try {
    // 1. ADATBÁZIS KAPCSOLAT
    $current_dir = __DIR__;
    $root_dir = dirname($current_dir);
    $config_dir = $root_dir . '/config';

    if (file_exists($config_dir . '/dbdev.php')) {
        require $config_dir . '/dbdev.php';
    } elseif (file_exists($config_dir . '/db.php')) {
        require $config_dir . '/db.php';
    } elseif (file_exists($current_dir . '/dbdev.php')) {
        require $current_dir . '/dbdev.php';
    } elseif (file_exists($current_dir . '/db.php')) {
        require $current_dir . '/db.php';
    } elseif (file_exists($root_dir . '/dbdev.php')) {
        require $root_dir . '/dbdev.php';
    } elseif (file_exists($root_dir . '/db.php')) {
        require $root_dir . '/db.php';
    } else {
        throw new Exception("Nem található a db.php vagy dbdev.php!");
    }

    if (!isset($pdo)) {
        throw new Exception("Hiányzó adatbázis kapcsolat (\$pdo)!");
    }

    // 2. ELLENŐRZÉS ÉS MENTÉS
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Csak POST kérés engedélyezett.');
    }

    $input = json_decode(file_get_contents('php://input'), true);

    if (empty($input['name']) || empty($input['email']) || empty($input['service']) || empty($input['date']) || empty($input['time'])) {
        throw new Exception('Minden mező kitöltése kötelező!');
    }

    // --- ÚJ RÉSZ: DUPLIKÁCIÓ ELLENŐRZÉSE ---
    // Megnézzük, van-e már foglalás erre a napra és időre
    $checkSql = "SELECT COUNT(*) FROM bookings WHERE booking_date = :b_date AND booking_time = :b_time";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([
        ':b_date' => $input['date'],
        ':b_time' => $input['time']
    ]);
    
    if ($checkStmt->fetchColumn() > 0) {
        throw new Exception('Sajnáljuk, ezt az időpontot időközben már lefoglalták! Kérjük, válasszon másikat.');
    }
    // -----------------------------------------

    $sql = "INSERT INTO bookings (name, email, phone, service, booking_date, booking_time, message) 
            VALUES (:name, :email, :phone, :service, :b_date, :b_time, :message)";
    
    $stmt = $pdo->prepare($sql);
    
    $result = $stmt->execute([
        ':name' => $input['name'],
        ':email' => $input['email'],
        ':phone' => $input['phone'] ?? '',
        ':service' => $input['service'],
        ':b_date' => $input['date'],
        ':b_time' => $input['time'],
        ':message' => $input['message'] ?? ''
    ]);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        throw new Exception('Az adatbázis beszúrás sikertelen.');
    }

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Hiba: ' . $e->getMessage()]);
}
?>