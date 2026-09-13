/**
 * Simpósio de Advocacia Renovada - Instituto MAR
 * Interactive JavaScript for Dynamic Event Date Countdown, Lead Capture Modal & Multi-Event API Integration
 */

document.addEventListener('DOMContentLoaded', function () {
    // ----------------------------------------------------------------------
    // 1. Countdown Timer (Dinamico de acordo com data_evento no HTML)
    // ----------------------------------------------------------------------
    const targetDateEl = document.getElementById('targetEventDate');
    let targetDateStr = targetDateEl ? targetDateEl.value : '2026-11-11 09:00:00';
    
    // Converte 'YYYY-MM-DD HH:MM:SS' em ISO format para suporte cross-browser
    targetDateStr = targetDateStr.replace(' ', 'T');
    const targetDate = new Date(targetDateStr).getTime();

    const daysEl = document.getElementById('days');
    const hoursEl = document.getElementById('hours');
    const minutesEl = document.getElementById('minutes');
    const secondsEl = document.getElementById('seconds');

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance < 0) {
            if (daysEl) daysEl.textContent = '00';
            if (hoursEl) hoursEl.textContent = '00';
            if (minutesEl) minutesEl.textContent = '00';
            if (secondsEl) secondsEl.textContent = '00';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if (daysEl) daysEl.textContent = days < 10 ? '0' + days : days;
        if (hoursEl) hoursEl.textContent = hours < 10 ? '0' + hours : hours;
        if (minutesEl) minutesEl.textContent = minutes < 10 ? '0' + minutes : minutes;
        if (secondsEl) secondsEl.textContent = seconds < 10 ? '0' + seconds : seconds;
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);

    // ----------------------------------------------------------------------
    // 2. Modal Controller
    // ----------------------------------------------------------------------
    const modalBackdrop = document.getElementById('modalLeadCapture');
    const modalCloseBtn = document.getElementById('modalCloseBtn');
    const modalFinishBtn = document.getElementById('modalFinishBtn');
    const openModalBtns = document.querySelectorAll('.btn-open-modal');

    const leadForm = document.getElementById('leadCaptureForm');
    const formView = document.getElementById('modalFormView');
    const successView = document.getElementById('modalSuccessView');
    const subscriberNameSpan = document.getElementById('subscriberNameSpan');
    const submitBtn = document.querySelector('.btn-submit-modal');

    function openModal() {
        if (modalBackdrop) {
            modalBackdrop.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal() {
        if (modalBackdrop) {
            modalBackdrop.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    openModalBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            openModal();
        });
    });

    if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeModal);
    if (modalFinishBtn) modalFinishBtn.addEventListener('click', closeModal);

    if (modalBackdrop) {
        modalBackdrop.addEventListener('click', function (e) {
            if (e.target === modalBackdrop) closeModal();
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modalBackdrop && modalBackdrop.classList.contains('active')) {
            closeModal();
        }
    });

    // ----------------------------------------------------------------------
    // 3. WhatsApp Input Phone Mask ( (XX) XXXXX-XXXX )
    // ----------------------------------------------------------------------
    const phoneInput = document.getElementById('userPhone');

    if (phoneInput) {
        phoneInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);

            if (value.length > 10) {
                value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
            } else if (value.length > 6) {
                value = value.replace(/^(\d{2})(\d{4})(\d{0,4})$/, '($1) $2-$3');
            } else if (value.length > 2) {
                value = value.replace(/^(\d{2})(\d{0,5})$/, '($1) $2');
            } else if (value.length > 0) {
                value = value.replace(/^(\d*)$/, '($1');
            }

            e.target.value = value;
        });
    }

    // ----------------------------------------------------------------------
    // 4. Form Submission via AJAX Fetch to PHP API
    // ----------------------------------------------------------------------
    if (leadForm) {
        leadForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const nameInput = document.getElementById('userName');
            const simposioIdInput = document.getElementById('simposioId');
            const nameError = document.getElementById('nameError');
            const phoneError = document.getElementById('phoneError');

            let isValid = true;
            if (nameError) nameError.style.display = 'none';
            if (phoneError) phoneError.style.display = 'none';

            const nameVal = nameInput.value.trim();
            const phoneVal = phoneInput.value.trim();
            const rawPhone = phoneVal.replace(/\D/g, '');
            const simposioIdVal = simposioIdInput ? parseInt(simposioIdInput.value) : 1;

            if (nameVal.length < 3) {
                if (nameError) nameError.style.display = 'block';
                isValid = false;
            }

            if (rawPhone.length < 10) {
                if (phoneError) phoneError.style.display = 'block';
                isValid = false;
            }

            if (!isValid) return;

            // Animar botão durante o envio
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> ENVIANDO INSCRIÇÃO...';

            fetch('api/inscrever.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    simposio_id: simposioIdVal,
                    nome: nameVal,
                    whatsapp: phoneVal
                })
            })
            .then(res => res.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;

                if (data.success) {
                    if (subscriberNameSpan) subscriberNameSpan.textContent = data.nome || nameVal;

                    // Atualiza contador de vagas na tela se retornado
                    if (data.total_inscritos !== undefined && data.vagas_totais !== undefined) {
                        const totalSpan = document.getElementById('scarcityCount');
                        const progressFill = document.querySelector('.progress-bar-fill');
                        if (totalSpan) totalSpan.textContent = `${data.total_inscritos} / ${data.vagas_totais} Vagas`;
                        if (progressFill) {
                            const pct = Math.min(100, (data.total_inscritos / data.vagas_totais) * 100);
                            progressFill.style.width = `${pct}%`;
                        }
                    }

                    // Alterna para tela de sucesso
                    formView.style.display = 'none';
                    successView.style.display = 'block';
                } else {
                    alert(data.message || 'Erro ao processar inscrição. Tente novamente.');
                }
            })
            .catch(err => {
                console.error('Erro na requisição AJAX:', err);
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
                
                if (subscriberNameSpan) subscriberNameSpan.textContent = nameVal;
                formView.style.display = 'none';
                successView.style.display = 'block';
            });
        });
    }
});
