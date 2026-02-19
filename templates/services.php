<?php
/**
 * templates/services.php
 * Kétnyelvű tartalom, éles szerverre optimalizált betöltéssel.
 */

// Nyelvi adatok biztosítása az éles szerveren
if (!isset($lang) || empty($lang)) {
    $current_lang = $_GET['lang'] ?? ($_SESSION['lang'] ?? 'hu');
    $lang_file_path = dirname(__DIR__) . '/lang/' . $current_lang . '.php';
    
    if (file_exists($lang_file_path)) {
        $lang = include($lang_file_path);
    }
}
?>

<style>
@keyframes bootstrap-like-pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}
.bootstrap-pulse {
    animation: bootstrap-like-pulse 2s infinite;
    display: inline-block;
}
</style>

<section class="py-5">
    <div class="container px-5 mb-5">
        <div class="text-center mb-5">
            <br><br>
            <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline"><?php echo $lang['activities_title'] ?? 'Tevékenység'; ?></span></h1>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-11 col-xl-9 col-xxl-8">
                <div class="card overflow-hidden shadow rounded-4 border-0 mb-5">
                    <div class="card-body p-0">
                        <div class="d-flex">
                            <div class="p-5">
                                <div id="ServicesDivId">
                                    <p class="fs-3 d-flex justify-content-center"><?php echo $lang['services_intro'] ?? 'Tevékenységeink:'; ?></p>
                                    <ul>
                                        <li><?php echo $lang['service_1'] ?? 'Könyvelés'; ?></li>
                                        <li><?php echo $lang['service_2'] ?? 'Bérszámfejtés és TB ügyintézés'; ?></li>
                                        <li><?php echo $lang['service_3'] ?? 'Családtámogatási ellátások (Családi pótlék, GYES)'; ?></li>
                                        <li><?php echo $lang['service_4'] ?? 'Adó visszatérítés'; ?></li>
                                        <li><?php echo $lang['service_5'] ?? 'Áfa jelentés'; ?></li>
                                        <li><?php echo $lang['service_6'] ?? 'Vállalkozási tanácsadás'; ?></li>
                                        <li><?php echo $lang['service_7'] ?? 'Mérlegkészítés'; ?></li>
                                        <li><?php echo $lang['service_8'] ?? 'Év végi zárások összeállítása és adóbevallások <br> (ÁFA, Társasági adó, Jövedelemadó...stb)'; ?></li>
                                        <li>
                                            <a href="https://www.google.com/search?q=fidas+s%C3%BCd+steuerberatungskanzlei+jennersdorf" title="Jennersdorf" target="_blank">
                                                <?php echo $lang['service_9'] ?? 'Könyvvizsgálat'; ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.google.com/search?q=fidas+s%C3%BCd+steuerberatungskanzlei+jennersdorf" title="Jennersdorf" target="_blank">
                                                <?php echo $lang['service_10'] ?? 'Adótanácsadás'; ?>
                                            </a>
                                        </li>
                                        <li><?php echo $lang['service_11'] ?? 'Képviselet nyújtása az ausztriai adóhatóságok előtt'; ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-gradient-primary-to-secondary text-white">
    <div class="container px-5 my-5">
        <div class="text-center">
            <a class="btn btn-outline-light btn-lg px-5 py-3 fs-1 fw-bolder shadow-lg bootstrap-pulse" href="index.php?page=contact">
                <?php echo $lang['contact_button'] ?? 'Lépjen velem kapcsolatba!'; ?>
            </a>
        </div>
    </div>
</section>