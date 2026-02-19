<?php
/**
 * templates/contact.php
 * Kártya stílusú elérhetőségek táblázatban + Beágyazott Google Térkép
 */

// Nyelvi adatok biztosítása
if (!isset($lang) || empty($lang)) {
    $current_lang = $_GET['lang'] ?? ($_SESSION['lang'] ?? 'hu');
    $lang_file_path = dirname(__DIR__) . '/lang/' . $current_lang . '.php';
    if (file_exists($lang_file_path)) {
        $lang = include($lang_file_path);
    }
}
?>
<section class="py-5">
    <div class="container px-5">
        
        <div class="card border-0 shadow rounded-4 overflow-hidden mb-5">
            <div class="card-body p-5 bg-light">
                <div class="text-center mb-5">
                    <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 mb-3 d-inline-flex p-3">
                        <i class="bi bi-envelope fs-3"></i>
                    </div>
                    <h1 class="fw-bolder"><?php echo $lang['contact_title'] ?? 'Kapcsolat'; ?></h1>
                    <p class="lead fw-normal text-muted mb-0"><?php echo $lang['contact_subtitle'] ?? 'Keressen bizalommal az alábbi elérhetőségeken!'; ?></p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle bg-white rounded-3 shadow-sm">
                                <tbody>
                                    <tr>
                                        <td style="width: 60px;" class="text-center">
                                            <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 p-2 d-inline-flex">
                                                <i class="bi bi-geo-alt fs-5"></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold fs-5"><?php echo $lang['contact_address_label'] ?? 'Iroda címe'; ?></td>
                                        <td>
                                            <a href="https://www.google.com/maps/search/?api=1&query=A-7540+Güssing+Europastraße+1" target="_blank" class="text-primary text-decoration-underline fw-bold fs-5">
                                                <?php echo $lang['contact_address'] ?? 'A-7540 Güssing, Europastraße 1'; ?>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">
                                            <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 p-2 d-inline-flex">
                                                <i class="bi bi-telephone fs-5"></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold fs-5"><?php echo $lang['contact_phone_label'] ?? 'Telefon & Fax'; ?></td>
                                        <td>
                                            <a href="tel:+43332243847" class="text-muted text-decoration-none fs-5">
                                                <?php echo $lang['contact_phone'] ?? '+43 3322 43847'; ?>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">
                                            <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 p-2 d-inline-flex">
                                                <i class="bi bi-phone fs-5"></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold fs-5"><?php echo $lang['contact_mobile_label'] ?? 'Mobil'; ?></td>
                                        <td>
                                            <a href="tel:+436641793866" class="text-muted text-decoration-none d-block fs-5">
                                                <?php echo $lang['contact_mobile_1'] ?? '+43 664 1793866'; ?>
                                            </a>
                                            <a href="tel:+36705182811" class="text-muted text-decoration-none d-block fs-5">
                                                <?php echo $lang['contact_mobile_2'] ?? '+36 70 5182811'; ?>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">
                                            <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 p-2 d-inline-flex">
                                                <i class="bi bi-envelope-at fs-5"></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold fs-5"><?php echo $lang['contact_email_label'] ?? 'E-mail cím'; ?></td>
                                        <td>
                                            <a href="mailto:<?php echo $lang['contact_email'] ?? 'info@e-conto.at'; ?>" class="text-primary text-decoration-underline fw-bold fs-5">
                                                <?php echo $lang['contact_email'] ?? 'info@e-conto.at'; ?>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">
                                            <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 p-2 d-inline-flex">
                                                <i class="bi bi-clock fs-5"></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold fs-5"><?php echo $lang['contact_hours_label'] ?? 'Nyitvatartás'; ?></td>
                                        <td>
                                            <span class="text-muted fs-5"><?php echo $lang['contact_hours_text'] ?? 'Hétfő - Vasárnap: Kizárólag előre egyeztetett időpontban!'; ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2720.551717804987!2d16.324201876878367!3d47.05886542565612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476e93897b779a5d%3A0x6334a6671048b26c!2sEuropastra%C3%9Fe+1%2C+7540+G%C3%BCssing%2C+Ausztria!5e0!3m2!1shu!2shu!4v1708375000000!5m2!1shu!2shu" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </div>
</section>