<?php
session_start();

// 1. Nyelv kezelése
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    if (in_array($lang, ['hu', 'de'])) {
        $_SESSION['lang'] = $lang;
    }
}
$current_lang = $_SESSION['lang'] ?? 'hu';

// 2. Szótár betöltése
$lang_file = "lang/{$current_lang}.php";
if (file_exists($lang_file)) {
    $text = require $lang_file;
} else {
    // Ha nincs meg a fájl, fallback a magyarra, vagy hiba
    if (file_exists("lang/hu.php")) {
        $text = require "lang/hu.php";
    } else {
        die("Hiba: Hiányoznak a nyelvi fájlok!");
    }
}

// 3. Oldal router
$page = $_GET['page'] ?? 'home';
$allowed_pages = ['home', 'services', 'booking', 'partners', 'contact'];

if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

// 4. Oldal összeállítása
if (file_exists('templates/header.php')) {
    require_once 'templates/header.php';
} else {
    echo "Hiba: templates/header.php hiányzik.";
}

$content_file = "templates/{$page}.php";
if (file_exists($content_file)) {
    require_once $content_file;
} else {
    echo "<div class='container py-5 text-center'><h2>Az oldal nem található: $page</h2></div>";
}

if (file_exists('templates/footer.php')) {
    require_once 'templates/footer.php';
}
?>