<?php
// Hibaüzenetek elrejtése a kimenetről, hogy tiszta JSON maradjon
error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

try {
    // =======================================================================
    // 1. ADATBÁZIS KAPCSOLAT KERESÉSE
    // =======================================================================
    
    $current_dir = __DIR__;                 
    $root_dir = dirname($current_dir);      
    $config_dir = $root_dir . '/config';    

    // Keresés a CONFIG mappában
    if (file_exists($config_dir . '/dbdev.php')) {
        require $config_dir . '/dbdev.php';
    } elseif (file_exists($config_dir . '/db.php')) {
        require $config_dir . '/db.php';
    } 
    // Tartalék: Keresés a PUBLIC mappában
    elseif (file_exists($current_dir . '/dbdev.php')) {
        require $current_dir . '/dbdev.php';
    } elseif (file_exists($current_dir . '/db.php')) {
        require $current_dir . '/db.php';
    }
    // Tartalék: Keresés a FŐKÖNYVTÁRBAN
    elseif (file_exists($root_dir . '/dbdev.php')) {
        require $root_dir . '/dbdev.php';
    } elseif (file_exists($root_dir . '/db.php')) {
        require $root_dir . '/db.php';
    } 
    else {
        // VÉSZTARTALÉK: Ha sehol sincs, megpróbáljuk a XAMPP alapbeállítást
        if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') {
            $dsn = "mysql:host=localhost;dbname=econtoatweb;charset=utf8mb4";
            $pdo = new PDO($dsn, 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } else {
            throw new Exception("Nem található az adatbázis konfiguráció!");
        }
    }

    if (!isset($pdo) && !isset($dsn)) { // Ha a vésztartalék sem futott le
        throw new Exception("Adatbázis hiba: \$pdo változó hiányzik.");
    }

    // =======================================================================
    // 2. ADATOK ELLENŐRZÉSE
    // =======================================================================

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Csak POST kérés engedélyezett.');
    }

    $input = json_decode(file_get_contents('php://input'), true);

    if (empty($input['name']) || empty($input['email']) || empty($input['service']) || empty($input['date']) || empty($input['time'])) {
        throw new Exception('Minden mező kitöltése kötelező!');
    }

    // DUPLIKÁCIÓ ELLENŐRZÉSE
    $checkSql = "SELECT COUNT(*) FROM bookings WHERE booking_date = :b_date AND booking_time = :b_time";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([
        ':b_date' => $input['date'],
        ':b_time' => $input['time']
    ]);
    
    if ($checkStmt->fetchColumn() > 0) {
        throw new Exception('Sajnáljuk, ezt az időpontot időközben már lefoglalták! Kérjük, válasszon másikat.');
    }

    // =======================================================================
    // 3. ADATOK MENTÉSE AZ ADATBÁZISBA
    // =======================================================================

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

    if (!$result) {
        throw new Exception('Az adatbázis beszúrás sikertelen.');
    }

    // =======================================================================
    // 4. AUTOMATA EMAIL KÜLDÉSE AZ ÜGYFÉLNEK
    // =======================================================================
    
    // Csak akkor próbálunk emailt küldeni, ha a mentés sikeres volt
    if ($result) {
        $to = $input['email'];
        $subject = "Sikeres időpontfoglalás - E-Conto";
        
        // Email fejléc (HTML formátum)
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: E-Conto <no-reply@e-conto.at>" . "\r\n";
        $headers .= "Reply-To: farkasneborerika@gmail.com" . "\r\n"; // Ide válaszolhatnak

        // Email tartalom
        $messageBody = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #f9f9f9; }
                .header { background-color: #0d6efd; color: #fff; padding: 15px; text-align: center; border-radius: 10px 10px 0 0; }
                .content { padding: 20px; background-color: #fff; }
                .details { background-color: #eef2f7; padding: 15px; border-radius: 5px; margin: 20px 0; }
                .footer { text-align: center; font-size: 12px; color: #777; margin-top: 20px; }
                li { margin-bottom: 5px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>Sikeres Foglalás!</h2>
                </div>
                <div class='content'>
                    <p>Tisztelt <strong>" . htmlspecialchars($input['name']) . "</strong>!</p>
                    <p>Köszönjük! Az időpontfoglalását sikeresen rögzítettük rendszerünkben.</p>
                    
                    <div class='details'>
                        <h3>A foglalás részletei:</h3>
                        <ul style='list-style: none; padding-left: 0;'>
                            <li><strong>Időpont:</strong> " . $input['date'] . " (" . $input['time'] . ")</li>
                            <li><strong>Ügytípus:</strong> " . htmlspecialchars($input['service']) . "</li>
                            <li><strong>Név:</strong> " . htmlspecialchars($input['name']) . "</li>
                            <li><strong>Telefonszám:</strong> " . htmlspecialchars($input['phone']) . "</li>
                            <li><strong>Megjegyzés:</strong> " . htmlspecialchars($input['message']) . "</li>
                        </ul>
                    </div>

                    <p>Várjuk sok szeretettel a megadott időpontban!</p>
                    <p>Üdvözlettel,<br><strong>Farkasné Bor Erika</strong><br>E-Conto</p>
                </div>
                <div class='footer'>
                    <p>Ez egy automatikus üzenet, kérjük ne válaszoljon rá közvetlenül.<br>
                    Cím: A-7540 Güssing, Europastraße 1</p>
                </div>
            </div>
        </body>
        </html>";

        // Próbáljuk elküldeni (a @ jel elnyomja a hibát localhoston, hogy ne omoljon össze)
        @mail($to, $subject, $messageBody, $headers);
        
        // OPCIONÁLIS: Értesítés magadnak is (hogy te is lásd, ha valaki foglalt)
        // @mail("farkasneborerika@gmail.com", "Új foglalás érkezett!", $messageBody, $headers);
    }

    // Válasz a böngészőnek (Minden rendben)
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Hiba: ' . $e->getMessage()]);
}
?>