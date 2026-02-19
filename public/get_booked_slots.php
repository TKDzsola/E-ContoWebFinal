<?php
// Hibaüzenetek elrejtése, hogy ne rontsa el a JSON kimenetet
error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

try {
    // =======================================================================
    // 1. ADATBÁZIS KAPCSOLAT (KÉNYSZERÍTETT ÉLES BEÁLLÍTÁS)
    // =======================================================================
    // Meghatározzuk a config fájl pontos helyét a szerveren (szülőkönyvtár/config/db.php)
    $db_file = dirname(__DIR__) . '/config/db.php';

    if (file_exists($db_file)) {
        require_once $db_file;
    } else {
        throw new Exception("Az adatbázis konfigurációs fájl nem található.");
    }

    // Ellenőrizzük, hogy a db.php valóban létrehozta-e a $pdo objektumot
    if (!isset($pdo)) {
        throw new Exception("Adatbázis hiba: a \$pdo objektum nem jött létre.");
    }

    // =======================================================================
    // 2. ADATOK LEKÉRDEZÉSE
    // =======================================================================
    
    // Megnézzük, érkezett-e dátum a kérésben
    $date = $_GET['date'] ?? null;

    if (!$date) {
        // Ha nincs dátum, üres tömbbel térünk vissza
        echo json_encode([]);
        exit;
    }

    // Lekérjük az adott napra már lefoglalt időpontokat
    $stmt = $pdo->prepare("SELECT booking_time FROM bookings WHERE booking_date = :b_date");
    $stmt->execute([':b_date' => $date]);
    
    // Csak az időpontokat gyűjtjük ki egy egyszerű tömbbe (pl. ["08:00", "09:30"])
    $booked_slots = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Visszaküldjük a listát a naptárnak
    echo json_encode($booked_slots);

} catch (Exception $e) {
    // Hiba esetén hibaüzenetet küldünk (opcionális, a naptár üresnek fogja látni)
    echo json_encode(['error' => $e->getMessage()]);
}
?>