<section class="py-2 hero-section">
    <div class="hero-blob hero-blob-1" style="top: 10%; right: 20%;"></div>
    <div class="hero-blob hero-blob-2" style="bottom: 10%; left: 10%;"></div>

    <div class="container px-4 position-relative" style="z-index: 2;">
        <div class="text-center mb-2">
            <h1 class="display-6 fw-bolder mb-1">
                <span class="text-gradient d-inline"><?= $text['nav_partners'] ?></span>
            </h1>
        </div>

        <div class="row gx-3 justify-content-center align-items-stretch">
            <div class="col-lg-5 mb-3">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100" style="background: rgba(255, 255, 255, 0.95);">
                    <div class="card-body p-3 text-center d-flex flex-column">
                        <div class="partner-logo-container mb-3 d-flex align-items-center justify-content-center" style="height: 80px;">
                            <img src="./assets/img/<?= $text['partner_1_logo'] ?>?v=<?= time() ?>" alt="Nyelvhatár" style="max-height: 100%; width: auto; object-fit: contain; border-radius: 5px;">
                        </div>
                        
                        <p class="text-muted mb-3 small" style="line-height: 1.4; font-size: 0.9rem;"><?= $text['partner_1_desc'] ?></p>
                        
                        <div class="mt-auto pt-2">
                            <a href="http://www.nyelvhatar.hu/" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm fw-bold">
                                <i class="bi bi-box-arrow-up-right me-2"></i> <?= $text['partner_visit'] ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 mb-3">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100" style="background: rgba(255, 255, 255, 0.95);">
                    <div class="card-body p-3 text-center d-flex flex-column">
                        <div class="partner-logo-container mb-3 d-flex align-items-center justify-content-center" style="height: 80px;">
                            <img src="./assets/img/fidas.gif?v=<?= time() ?>" alt="FIDAS" style="max-height: 100%; width: auto; object-fit: contain; border-radius: 5px;">
                        </div>

                        <p class="text-muted mb-3 small" style="line-height: 1.4; font-size: 0.9rem;"><?= $text['partner_2_desc'] ?></p>
                        
                        <div class="mt-auto pt-2">
                            <a href="https://fidas.at/" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm fw-bold">
                                <i class="bi bi-box-arrow-up-right me-2"></i> <?= $text['partner_visit'] ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-3 bg-gradient-primary-to-secondary text-white mt-auto">
    <div class="container px-5 text-center">
        <a class="btn btn-outline-light btn-lg px-5 py-2 fs-3 fw-bolder pulse-animation" href="index.php?page=contact&lang=<?= $lang ?>">
            <?= $text['services_cta'] ?>
        </a>
    </div>
</section>