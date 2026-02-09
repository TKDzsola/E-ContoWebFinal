<header class="py-5">
    <div class="container px-5 pb-5">
        <div class="row gx-5 align-items-center">
            
            <div class="col-xxl-7">
                <div class="text-center text-xxl-start">
                    
                    <div class="badge bg-gradient-primary-to-secondary text-white mb-4 text-uppercase">
                        <?= $text['hero_badge'] ?>
                    </div>
                    
                    <div class="fs-3 fw-light text-muted"><?= $text['about_title'] ?></div>
                    <h1 class="display-3 fw-bolder mb-5">
                        <span class="text-gradient d-inline"><?= $text['about_name'] ?></span>
                    </h1>
                    
                    <div class="fs-5 fw-light text-muted mb-4">
                        <p><?= $text['about_text_hu'] ?></p>
                        <p><?= $text['about_text_at'] ?></p>
                    </div>
                    
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start">
                        
                        <a class="btn btn-primary btn-lg px-5 py-3 fs-6 fw-bolder pulse-animation" href="index.php?page=booking">
                            <?= $text['btn_booking'] ?>
                        </a>
                        
                        <a class="btn btn-outline-dark btn-lg px-5 py-3 fs-6 fw-bolder" href="index.php?page=contact">
                            <?= $text['btn_contact'] ?>
                        </a>
                    </div>

                </div>
            </div>
            
            <div class="col-xxl-5">
                <div class="d-flex justify-content-center mt-5 mt-xxl-0">
                    <div class="profile bg-gradient-primary-to-secondary p-4 rounded-circle">
                        <img class="profile-img img-fluid" src="assets/img/borerika.png" alt="Profil" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>