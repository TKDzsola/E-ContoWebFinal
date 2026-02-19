<section class="py-5 hero-section">
    <div class="hero-blob hero-blob-1"></div>
    <div class="hero-blob hero-blob-2"></div>
    
    <div class="container px-5 my-5 position-relative" style="z-index: 2;">
        <div class="row gx-5 align-items-center justify-content-center">
            
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <div class="text-center text-xl-start">
                    
                    <div class="badge bg-gradient-primary-to-secondary text-white mb-4">
                        <div class="text-uppercase"><?= $text['hero_badge'] ?></div>
                    </div>
                    
                    <h1 class="display-5 fw-bolder mb-2">
                        <span class="text-gradient d-inline"><?= $text['about_name'] ?></span>
                    </h1>
                    
                    <div class="mb-3">
                        <a href="https://firmen.wko.at/erika-farkasne-bor/" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm">
                            <i class="bi bi-shield-check me-1"></i> Engedélyek ellenőrzése
                        </a>
                    </div>
                    
                    <h2 class="h3 fw-light mb-4"><?= $text['site_title'] ?></h2>
                    
                    <p class="lead fw-light mb-4"><?= $text['about_text_hu'] ?></p>
                    <p class="lead fw-light mb-4"><?= $text['about_text_at'] ?></p>
                    
                    <div class="mb-5">
                        <a href="https://www.facebook.com/profile.php?id=100049264226444" target="_blank" class="btn btn-facebook rounded-pill px-4 shadow-sm">
                            <i class="bi bi-facebook me-2"></i> <?= isset($text['btn_facebook']) ? $text['btn_facebook'] : 'Facebook' ?>
                        </a>
                    </div>
                    
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                        <a class="btn btn-primary btn-lg px-4 py-3 me-sm-3 fs-6 fw-bolder pulse-animation rounded-pill shadow-sm" href="index.php?page=booking">
                            <?= $text['btn_booking'] ?>
                        </a>
                        <a class="btn btn-outline-dark btn-lg px-4 py-3 fs-6 fw-bolder rounded-pill" href="index.php?page=contact">
                            <?= $text['btn_contact'] ?>
                        </a>
                    </div>

                </div>
            </div>
            
            <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                <div class="profile-img-container">
                    <img class="profile-img" src="assets/img/borerika.png" alt="<?= $text['about_name'] ?>" />
                </div>
            </div>
            
        </div>
    </div>
</section>