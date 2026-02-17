<section class="py-5 hero-section">
    <div class="hero-blob hero-blob-1" style="top: 10%; right: 20%;"></div>
    <div class="hero-blob hero-blob-2" style="bottom: 10%; left: 10%;"></div>

    <div class="container px-5 my-5 position-relative" style="z-index: 2;">
        
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-3">
                <span class="text-gradient d-inline"><?= $text['booking_title'] ?></span>
            </h1>
            <p class="lead fw-light text-muted mb-0"><?= $text['booking_subtitle'] ?></p>
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
                                    <input type="date" class="form-control rounded-3 fs-5" id="dateInput" required min="<?= date('Y-m-d') ?>">
                                    <label for="dateInput"><?= $text['date_label'] ?></label>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-primary rounded-pill px-4 pulse-animation" onclick="validateAndNext(1)">
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
                                    <p class="mt-2 text-muted">Szabad időpontok betöltése...</p>
                                </div>

                                <div class="list-group mb-4 gap-2" id="timeSlotContainer">
                                    <?php 
                                    $times = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'];
                                    foreach($times as $time): 
                                    ?>
                                    <label class="list-group-item d-flex align-items-center rounded-3 border shadow-sm p-3 cursor-pointer hover-lift time-slot-label" data-time="<?= $time ?>">
                                        <input class="form-check-input me-3" type="radio" name="timeSlot" value="<?= $time ?>" style="transform: scale(1.3);">
                                        <span class="fw-bold fs-5 text-dark time-text"><?= $time ?></span>
                                        <span class="badge bg-light text-muted ms-auto rounded-pill border status-badge">Szabad / Frei</span>
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

                                <div class="alert alert-primary d-flex align-items-center mb-4 border-0 shadow-sm" role="alert">
                                    <i class="bi bi-calendar-check-fill fs-3 me-3"></i>
                                    <div>
                                        <div class="small text-uppercase fw-bold"><?= $text['book_summary'] ?></div>
                                        <div class="fs-5">
                                            <span id="finalDate"></span> &bull; <span id="finalTime" class="fw-bold"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-floating mb-3">
                                    <select class="form-select rounded-3" id="serviceSelect" required>
                                        <option value="" selected disabled>Válasszon...</option>
                                        <option value="<?= $text['service_opt_1'] ?>"><?= $text['service_opt_1'] ?></option>
                                        <option value="<?= $text['service_opt_2'] ?>"><?= $text['service_opt_2'] ?></option>
                                        <option value="<?= $text['service_opt_3'] ?>"><?= $text['service_opt_3'] ?></option>
                                        <option value="<?= $text['service_opt_4'] ?>"><?= $text['service_opt_4'] ?></option>
                                        <option value="<?= $text['service_opt_5'] ?>"><?= $text['service_opt_5'] ?></option>
                                        <option value="<?= $text['service_opt_6'] ?>"><?= $text['service_opt_6'] ?></option>
                                        <option value="<?= $text['service_opt_7'] ?>"><?= $text['service_opt_7'] ?></option>
                                    </select>
                                    <label for="serviceSelect"><?= $text['book_service_label'] ?></label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control rounded-3" id="name" placeholder="<?= $text['book_name'] ?>" required>
                                    <label for="name"><?= $text['book_name'] ?></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control rounded-3" id="email" placeholder="<?= $text['book_email'] ?>" required>
                                    <label for="email"><?= $text['book_email'] ?></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control rounded-3" id="phone" placeholder="<?= $text['book_phone'] ?>" required>
                                    <label for="phone"><?= $text['book_phone'] ?></label>
                                </div>
                                <div class="form-floating mb-4">
                                    <textarea class="form-control rounded-3" placeholder="<?= $text['book_msg'] ?>" id="msg" style="height: 100px"></textarea>
                                    <label for="msg"><?= $text['book_msg'] ?></label>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-light rounded-pill px-4 text-muted border" onclick="changeStep(2)">
                                        <?= $text['btn_back'] ?>
                                    </button>
                                    <button type="submit" id="submitBtn" class="btn btn-success rounded-pill px-4 fw-bold shadow pulse-animation bg-gradient-primary-to-secondary border-0">
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
    let currentStep = 1;

    function changeStep(step) {
        document.getElementById('step1').classList.add('d-none');
        document.getElementById('step2').classList.add('d-none');
        document.getElementById('step3').classList.add('d-none');
        document.getElementById('step' + step).classList.remove('d-none');
        
        const progress = document.getElementById('progressBar');
        if(step === 1) progress.style.width = '33%';
        if(step === 2) progress.style.width = '66%';
        if(step === 3) progress.style.width = '100%';
        currentStep = step;
    }

    async function validateAndNext(step) {
        if (step === 1) {
            const dateInput = document.getElementById('dateInput').value;
            if (!dateInput) { alert('Kérjük, válasszon dátumot!'); return; }
            
            document.getElementById('selectedDateDisplay').innerText = dateInput;
            document.getElementById('finalDate').innerText = dateInput;
            
            changeStep(2);
            await loadBookedSlots(dateInput);
        }
        else if (step === 2) {
            const selectedTime = document.querySelector('input[name="timeSlot"]:checked');
            if (!selectedTime) { alert('Kérjük, válasszon időpontot!'); return; }
            document.getElementById('finalTime').innerText = selectedTime.value;
            changeStep(3);
        }
    }

    async function loadBookedSlots(date) {
        const loadingDiv = document.getElementById('timeSlotLoading');
        const container = document.getElementById('timeSlotContainer');
        const slots = document.querySelectorAll('.time-slot-label');
        
        loadingDiv.classList.remove('d-none');
        container.classList.add('opacity-50');
        
        slots.forEach(slot => {
            const input = slot.querySelector('input');
            const badge = slot.querySelector('.status-badge');
            const timeText = slot.querySelector('.time-text');

            input.disabled = false;
            input.checked = false;
            slot.classList.remove('bg-light', 'text-muted', 'border-danger');
            slot.classList.add('cursor-pointer', 'hover-lift');
            timeText.classList.remove('text-decoration-line-through');
            badge.className = 'badge bg-light text-muted ms-auto rounded-pill border status-badge';
            badge.innerText = 'Szabad / Frei';
            slot.style.pointerEvents = 'auto';
        });

        try {
            const response = await fetch(`get_booked_slots.php?date=${date}`);
            const bookedTimes = await response.json();

            slots.forEach(slot => {
                const time = slot.getAttribute('data-time');
                if (bookedTimes.includes(time)) {
                    const input = slot.querySelector('input');
                    const badge = slot.querySelector('.status-badge');
                    const timeText = slot.querySelector('.time-text');

                    input.disabled = true;
                    slot.classList.add('bg-light', 'text-muted');
                    slot.classList.remove('cursor-pointer', 'hover-lift');
                    slot.style.pointerEvents = 'none';
                    timeText.classList.add('text-decoration-line-through');
                    badge.className = 'badge bg-secondary text-white ms-auto rounded-pill status-badge';
                    badge.innerText = 'Foglalt / Gebucht';
                }
            });

        } catch (error) {
            console.error('Hiba a szabad helyek betöltésekor:', error);
        } finally {
            loadingDiv.classList.add('d-none');
            container.classList.remove('opacity-50');
        }
    }

    async function submitBooking(event) {
        event.preventDefault();
        const btn = document.getElementById('submitBtn');
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Mentés...';

        const bookingData = {
            date: document.getElementById('dateInput').value,
            time: document.getElementById('finalTime').innerText,
            service: document.getElementById('serviceSelect').value,
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            message: document.getElementById('msg').value
        };

        try {
            const response = await fetch('save_booking.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(bookingData)
            });
            const result = await response.json();

            if (result.success) {
                alert('<?= $text['success_msg'] ?>');
                // VISSZANAVIGÁLÁS A FŐOLDALRA (index.php)
                window.location.href = 'index.php'; 
            } else {
                alert('Hiba történt: ' + result.message);
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Kommunikációs hiba történt.');
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    }
</script>

<style>
    .cursor-pointer { cursor: pointer; }
    .list-group-item.bg-light.text-muted { opacity: 0.7; }
</style>