<?php
// Hibaüzenetek elrejtése a kimenetről, hogy tiszta JSON maradjon
error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

try {
    // =======================================================================
    // 1. ADATBÁZIS KAPCSOLAT (KÉNYSZERÍTETT ÉLES BEÁLLÍTÁS)
    // =======================================================================
    // Meghatározzuk a config fájl pontos helyét a szerveren
    $db_file = dirname(__DIR__) . '/config/db.php';

    if (file_exists($db_file)) {
        require_once $db_file;
    } else {
        throw new Exception("Az adatbázis konfigurációs fájl nem található a megadott útvonalon: " . $db_file);
    }

    // Ellenőrizzük, hogy a db.php valóban létrehozta-e a $pdo objektumot
    if (!isset($pdo)) {
        throw new Exception("Adatbázis hiba: a \$pdo objektum nem jött létre.");
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

    // NYELV BEOLVASÁSA (Alapértelmezett: hu)
    $lang = $input['lang'] ?? 'hu';

    // DUPLIKÁCIÓ ELLENŐRZÉSE
    $checkSql = "SELECT COUNT(*) FROM bookings WHERE booking_date = :b_date AND booking_time = :b_time";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([
        ':b_date' => $input['date'],
        ':b_time' => $input['time']
    ]);
    
    if ($checkStmt->fetchColumn() > 0) {
        if ($lang === 'de') {
            throw new Exception('Leider ist dieser Termin bereits vergeben! Bitte wählen Sie einen anderen.');
        } else {
            throw new Exception('Sajnáljuk, ezt az időpontot időközben már lefoglalták! Kérjük, válasszon másikat.');
        }
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
    // 4. AUTOMATA EMAIL KÜLDÉSE TITKOS MÁSOLATTAL
    // =======================================================================
    
    if ($result) {
        $to = $input['email'];
        
        // E-mail változók beállítása nyelv szerint
        if ($lang === 'de') {
            $subject = "Erfolgreiche Terminbuchung - E-Conto";
            $email_title = "Erfolgreiche Buchung!";
            $email_greeting = "Sehr geehrte(r) <strong>" . htmlspecialchars($input['name']) . "</strong>!";
            $email_text1 = "Vielen Dank! Ihre Terminbuchung wurde erfolgreich in unserem System erfasst.";
            $email_details_title = "Details der Buchung:";
            $lbl_date = "Termin";
            $lbl_service = "Anliegen";
            $lbl_name = "Name";
            $lbl_phone = "Telefonnummer";
            $lbl_msg = "Notiz";
            $email_text2 = "Wir freuen uns auf Sie zum vereinbarten Termin!";
            $email_sign = "Mit freundlichen Grüßen,<br><strong>Erika Farkasné Bor, B.Sc.</strong><br>E-Conto";
            $email_footer = "Dies ist eine automatische Nachricht, bitte antworten Sie nicht direkt darauf.<br>Adresse: A-7540 Güssing, Europastraße 1";
        } else {
            $subject = "Sikeres időpontfoglalás - E-Conto";
            $email_title = "Sikeres Foglalás!";
            $email_greeting = "Tisztelt <strong>" . htmlspecialchars($input['name']) . "</strong>!";
            $email_text1 = "Köszönjük! Az időpontfoglalását sikeresen rögzítettük rendszerünkben.";
            $email_details_title = "A foglalás részletei:";
            $lbl_date = "Időpont";
            $lbl_service = "Ügytípus";
            $lbl_name = "Név";
            $lbl_phone = "Telefonszám";
            $lbl_msg = "Megjegyzés";
            $email_text2 = "Várjuk sok szeretettel a megadott időpontban!";
            $email_sign = "Üdvözlettel,<br><strong>Farkasné Bor Erika</strong><br>E-Conto";
            $email_footer = "Ez egy automatikus üzenet, kérjük ne válaszoljon rá közvetlenül.<br>Cím: A-7540 Güssing, Europastraße 1";
        }
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: E-Conto <no-reply@e-conto.at>" . "\r\n";
        $headers .= "Reply-To: farkasneborerika@gmail.com" . "\r\n";
        $headers .= "Bcc: farkasneborerika@gmail.com" . "\r\n"; 

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
                    <h2>{$email_title}</h2>
                </div>
                <div class='content'>
                    <p>{$email_greeting}</p>
                    <p>{$email_text1}</p>
                    
                    <div class='details'>
                        <h3>{$email_details_title}</h3>
                        <ul style='list-style: none; padding-left: 0;'>
                            <li><strong>{$lbl_date}:</strong> " . htmlspecialchars($input['date']) . " (" . htmlspecialchars($input['time']) . ")</li>
                            <li><strong>{$lbl_service}:</strong> " . htmlspecialchars($input['service']) . "</li>
                            <li><strong>{$lbl_name}:</strong> " . htmlspecialchars($input['name']) . "</li>
                            <li><strong>{$lbl_phone}:</strong> " . htmlspecialchars($input['phone']) . "</li>
                            <li><strong>{$lbl_msg}:</strong> " . htmlspecialchars($input['message']) . "</li>
                        </ul>
                    </div>

                    <p>{$email_text2}</p>
                    <p>{$email_sign}</p>
                </div>
                <div class='footer'>
                    <p>{$email_footer}</p>
                </div>
            </div>
        </body>
        </html>";

        @mail($to, $subject, $messageBody, $headers);
    }

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Hiba: ' . $e->getMessage()]);
}
?>