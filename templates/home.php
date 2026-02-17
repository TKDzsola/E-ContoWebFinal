<header class="py-5 hero-section">
    <div class="hero-blob hero-blob-1"></div>
    <div class="hero-blob hero-blob-2"></div>

    <div class="container px-5 pb-5 position-relative" style="z-index: 2;">
        <div class="row gx-5 align-items-center justify-content-center">
            
            <div class="col-xxl-7 col-xl-7 col-lg-6">
                <div class="text-center text-lg-start">
                    
                    <div class="badge bg-gradient-primary-to-secondary text-white mb-4 px-3 py-2 rounded-pill text-uppercase shadow-sm">
                        <?= $text['hero_badge'] ?>
                    </div>
                    
                    <div class="fs-4 fw-light text-muted mb-2"><?= $text['about_title'] ?></div>
                    <h1 class="display-3 fw-bolder mb-4 lh-tight">
                        <span class="text-gradient"><?= $text['about_name'] ?></span>
                    </h1>
                    
                    <div class="fs-5 text-muted mb-5">
                        <p class="mb-3"><?= $text['about_text_hu'] ?></p>
                        <div class="d-flex align-items-center mt-3 p-3 bg-white rounded-3 shadow-sm border-start border-4 border-primary">
                            <i class="bi bi-translate fs-3 text-primary me-3"></i>
                            <p class="mb-0 fst-italic small text-secondary"><?= $text['about_text_at'] ?></p>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-lg-start">
                        <a class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bold rounded-pill shadow-lg pulse-animation border-0 bg-gradient-primary-to-secondary" href="index.php?page=booking">
                            <?= $text['btn_booking'] ?>
                        </a>
                        <a class="btn btn-white btn-lg px-5 py-3 fs-6 fw-bold rounded-pill shadow-sm hover-lift text-dark bg-white border" href="index.php?page=contact">
                            <?= $text['btn_contact'] ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-xxl-5 col-xl-5 col-lg-6">
                <div class="d-flex justify-content-center mt-5 mt-lg-0">
                    <div class="profile-img-container hover-lift">
                        <img class="profile-img" src="assets/img/borerika.png" alt="Farkasné Bor Erika" />
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>