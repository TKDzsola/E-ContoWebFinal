<?php
// Hibaüzenetek elrejtése a válaszból
error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

try {
    // 1. ADATBÁZIS KAPCSOLAT (Ugyanaz a robusztus logika, mint a mentésnél)
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
        throw new Exception("Adatbázis konfigurációs fájl nem található.");
    }

    if (!isset($pdo)) {
        throw new Exception("Adatbázis kapcsolat sikertelen.");
    }

    // 2. LEKÉRDEZÉS
    if (!isset($_GET['date'])) {
        echo json_encode([]); // Ha nincs dátum, üres listát küldünk
        exit;
    }

    $date = $_GET['date'];

    // Lekérjük az összes foglalt időpontot az adott napra
    $stmt = $pdo->prepare("SELECT booking_time FROM bookings WHERE booking_date = ?");
    $stmt->execute([$date]);
    
    // Egy egyszerű tömböt készítünk: ['08:00', '14:00', ...]
    $booked_slots = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode($booked_slots);

} catch (Exception $e) {
    // Hiba esetén üres tömböt küldünk, hogy ne omoljon össze az oldal
    echo json_encode([]);
}
?>