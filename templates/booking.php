<section class="py-5 hero-section">
    <div class="hero-blob hero-blob-1" style="top: 10%; right: 20%;"></div>
    <div class="hero-blob hero-blob-2" style="bottom: 10%; left: 10%;"></div>

    <div class="container px-5 my-5 position-relative" style="z-index: 2;">
        
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-3">
                <span class="text-gradient d-inline"><?= $text['booking_title'] ?? 'Időpontfoglalás' ?></span>
            </h1>
            <p class="lead fw-light text-muted mb-0"><?= $text['booking_subtitle'] ?? '' ?></p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background: rgba(255, 255, 255, 0.95);">
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-gradient-primary-to-secondary transition-all" role="progressbar" style="width: 33%;" id="progressBar"></div>
                    </div>

                    <div class="card-body p-5">
                        <form id="bookingForm" onsubmit="submitBooking(event)">
                            
                            <div id="step1" class="step-container">
                                <h3 class="h4 fw-bold mb-2"><?= $text['step_1_title'] ?></h3>
                                <p class="text-muted mb-4"><?= $text['step_1_desc'] ?></p>
                                <div class="form-floating mb-4">
                                    <input type="date" class="form-control rounded-3 fs-5" id="dateInput" required 
                                           min="<?= date('Y-m-d') ?>"
                                           oninvalid="this.setCustomValidity('<?= $text['alert_date'] ?? 'Válasszon dátumot!' ?>')"
                                           oninput="this.setCustomValidity('')">
                                    <label for="dateInput"><?= $text['date_label'] ?></label>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-primary rounded-pill px-4" onclick="validateAndNext(1)">
                                        <?= $text['btn_next'] ?> <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <div id="step2" class="step-container d-none">
                                <h3 class="h4 fw-bold mb-2"><?= $text['step_2_title'] ?></h3>
                                <p class="text-muted mb-4">
                                    <?= $text['step_2_desc'] ?> 
                                    <span id="selectedDateDisplay" class="fw-bold text-primary bg-light px-2 py-1 rounded border"></span>
                                </p>
                                <div id="timeSlotLoading" class="text-center py-4 d-none">
                                    <div class="spinner-border text-primary" role="status"></div>
                                    <p class="mt-2 text-muted"><?= $text['loading'] ?? '...' ?></p>
                                </div>
                                <div class="list-group mb-4 gap-2" id="timeSlotContainer">
                                    <?php 
                                    $times = ["8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00"];
                                    foreach($times as $time): ?>
                                    <label class="list-group-item d-flex align-items-center rounded-3 border shadow-sm p-3 cursor-pointer hover-lift time-slot-label" data-time="<?= $time ?>">
                                        <input class="form-check-input me-3" type="radio" name="timeSlot" value="<?= $time ?>" style="transform: scale(1.3);">
                                        <span class="fw-bold fs-5 text-dark time-text"><?= $time ?></span>
                                        <span class="badge bg-light text-muted ms-auto rounded-pill border status-badge">
                                            <?= $text['status_free'] ?? 'Szabad' ?>
                                        </span>
                                    </label>
                                    <?php endforeach; ?>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-light rounded-pill px-4 text-muted border" onclick="changeStep(1)">
                                        <?= $text['btn_back'] ?>
                                    </button>
                                    <button type="button" class="btn btn-primary rounded-pill px-4" onclick="validateAndNext(2)">
                                        <?= $text['btn_next'] ?> <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <div id="step3" class="step-container d-none">
                                <h3 class="h4 fw-bold mb-2"><?= $text['step_3_title'] ?></h3>
                                <p class="text-muted mb-4"><?= $text['step_3_desc'] ?></p>
                                <div class="alert alert-primary d-flex align-items-center mb-4 border-0 shadow-sm">
                                    <i class="bi bi-calendar-check-fill fs-3 me-3"></i>
                                    <div>
                                        <div class="small text-uppercase fw-bold"><?= $text['book_summary'] ?></div>
                                        <div class="fs-5"><span id="finalDate"></span> &bull; <span id="finalTime" class="fw-bold"></span></div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select rounded-3" id="serviceSelect" required>
                                        <option value="" selected disabled><?= $text['book_service_placeholder'] ?></option>
                                        <?php for($i=1; $i<=7; $i++): ?>
                                            <?php if(!empty($text['service_opt_'.$i])): ?>
                                                <option value="<?= $text['service_opt_'.$i] ?>"><?= $text['service_opt_'.$i] ?></option>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </select>
                                    <label for="serviceSelect"><?= $text['book_service_label'] ?></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control rounded-3" id="name" required placeholder="<?= $text['book_name'] ?>">
                                    <label for="name"><?= $text['book_name'] ?></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control rounded-3" id="email" required placeholder="<?= $text['book_email'] ?>">
                                    <label for="email"><?= $text['book_email'] ?></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control rounded-3" id="phone" required placeholder="<?= $text['book_phone'] ?>">
                                    <label for="phone"><?= $text['book_phone'] ?></label>
                                </div>
                                <div class="form-floating mb-4">
                                    <textarea class="form-control rounded-3" id="msg" style="height: 100px" placeholder="<?= $text['book_msg'] ?>"></textarea>
                                    <label for="msg"><?= $text['book_msg'] ?></label>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-light rounded-pill px-4 text-muted border" onclick="changeStep(2)">
                                        <?= $text['btn_back'] ?>
                                    </button>
                                    <button type="submit" id="submitBtn" class="btn btn-success rounded-pill px-4 fw-bold shadow bg-gradient-primary-to-secondary border-0">
                                        <?= $text['btn_finish'] ?> <i class="bi bi-check-lg ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const uiText = <?= json_encode($text); ?>;
    
    // NYELV MEGHATÁROZÁSA KÉNYSZERÍTVE
    const getLang = () => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('lang') === 'de') return 'de';
        // Ha a dokumentum nyelve de, vagy az URL-ben benne van a de szó
        if (document.documentElement.lang === 'de' || window.location.href.includes('lang=de')) return 'de';
        return 'hu';
    };

    const currentLang = getLang();

    function changeStep(step) {
        document.querySelectorAll('.step-container').forEach(el => el.classList.add('d-none'));
        const target = document.getElementById('step' + step);
        if (target) target.classList.remove('d-none');
        
        const progress = document.getElementById('progressBar');
        if (progress) {
            const widths = {1: '33%', 2: '66%', 3: '100%'};
            progress.style.width = widths[step];
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    async function validateAndNext(step) {
        if (step === 1) {
            const dateInput = document.getElementById('dateInput');
            if (!dateInput.checkValidity()) { 
                dateInput.reportValidity(); 
                return; 
            }
            document.getElementById('selectedDateDisplay').innerText = dateInput.value;
            document.getElementById('finalDate').innerText = dateInput.value;
            changeStep(2);
            await loadBookedSlots(dateInput.value);
        } else if (step === 2) {
            const selected = document.querySelector('input[name="timeSlot"]:checked');
            if (!selected) { 
                alert(uiText['alert_time'] || "Bitte wählen Sie eine Uhrzeit!"); 
                return; 
            }
            document.getElementById('finalTime').innerText = selected.value;
            changeStep(3);
        }
    }

    async function loadBookedSlots(date) {
        const loading = document.getElementById('timeSlotLoading');
        const labels = document.querySelectorAll('.time-slot-label');
        if (loading) loading.classList.remove('d-none');
        
        labels.forEach(slot => {
            const input = slot.querySelector('input');
            const badge = slot.querySelector('.status-badge');
            if (input) { input.disabled = false; input.checked = false; }
            slot.classList.remove('bg-light', 'text-muted');
            slot.style.pointerEvents = 'auto';
            if (badge) {
                badge.className = 'badge bg-light text-muted ms-auto rounded-pill border status-badge';
                badge.innerText = uiText['status_free'];
            }
        });

        try {
            const resp = await fetch(`get_booked_slots.php?date=${date}`);
            const booked = await resp.json();
            labels.forEach(slot => {
                const time = slot.getAttribute('data-time');
                if (booked.includes(time)) {
                    const input = slot.querySelector('input');
                    const badge = slot.querySelector('.status-badge');
                    if (input) input.disabled = true;
                    slot.classList.add('bg-light', 'text-muted');
                    slot.style.pointerEvents = 'none';
                    if (badge) {
                        badge.className = 'badge bg-secondary text-white ms-auto rounded-pill status-badge';
                        badge.innerText = uiText['status_booked'];
                    }
                }
            });
        } catch (e) { console.error(e); } finally {
            if (loading) loading.classList.add('d-none');
        }
    }

    async function submitBooking(event) {
        event.preventDefault();
        const btn = document.getElementById('submitBtn');
        const origHtml = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> ${uiText['btn_saving'] || '...'}`;

        const data = {
            lang: currentLang, // EZ KÜLDI EL A SZERVERNEK A NYELVET
            date: document.getElementById('dateInput').value,
            time: document.getElementById('finalTime').innerText,
            service: document.getElementById('serviceSelect').value,
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            message: document.getElementById('msg').value
        };

        try {
            const resp = await fetch('save_booking.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const res = await resp.json();
            if (res.success) {
                alert(uiText['success_msg'] || "Erfolg!");
                window.location.href = 'index.php?lang=' + currentLang; 
            } else {
                alert('Error: ' + res.message);
                btn.disabled = false;
                btn.innerHTML = origHtml;
            }
        } catch (e) {
            alert(uiText['error_network'] || "Fehler.");
            btn.disabled = false;
            btn.innerHTML = origHtml;
        }
    }
</script>