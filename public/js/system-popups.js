(function () {
    'use strict';

    const queuedPopups = [];
    const confirmedForms = new WeakSet();
    let popupElement = null;
    let popupInstance = null;
    let activeResolve = null;

    function initializePopup() {
        if (popupElement) return;

        const template = document.createElement('template');
        template.innerHTML = `
            <div class="modal fade app-popup-modal app-popup-message" id="appPopupModal" tabindex="-1" aria-labelledby="appPopupTitle" aria-describedby="appPopupMessage" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body app-popup-message-body">
                            <span class="app-popup-icon" id="appPopupIcon" aria-hidden="true"><i></i></span>
                            <h2 class="modal-title mb-0" id="appPopupTitle"></h2>
                            <p class="app-popup-message-text mb-0" id="appPopupMessage"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-popup-choice="false"></button>
                            <button type="button" class="btn btn-primary" data-popup-choice="true"></button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        popupElement = template.content.firstElementChild;
        document.body.appendChild(popupElement);
        popupInstance = new bootstrap.Modal(popupElement);

        popupElement.querySelectorAll('[data-popup-choice]').forEach(function (button) {
            button.addEventListener('click', function () {
                popupElement.dataset.choice = button.dataset.popupChoice;
                popupInstance.hide();
            });
        });

        popupElement.addEventListener('hidden.bs.modal', function () {
            if (activeResolve) {
                const resolve = activeResolve;
                activeResolve = null;
                resolve(popupElement.dataset.choice === 'true');
            }
            showNextPopup();
        });
    }

    function showNextPopup() {
        if (activeResolve || queuedPopups.length === 0) return;
        initializePopup();

        const popup = queuedPopups.shift();
        const isConfirmation = popup.type === 'confirm';
        const cancelButton = popupElement.querySelector('[data-popup-choice="false"]');
        const acceptButton = popupElement.querySelector('[data-popup-choice="true"]');

        popupElement.querySelector('#appPopupTitle').textContent = popup.title;
        popupElement.querySelector('#appPopupMessage').textContent = popup.message;
        const icon = popupElement.querySelector('#appPopupIcon');
        icon.classList.toggle('d-none', !popup.icon);
        icon.firstElementChild.className = popup.icon ? 'bi ' + popup.icon : '';
        cancelButton.textContent = popup.cancelText;
        cancelButton.classList.toggle('d-none', !isConfirmation);
        acceptButton.textContent = popup.acceptText;
        popupElement.dataset.choice = 'false';
        activeResolve = popup.resolve;
        popupInstance.show();
    }

    function enqueuePopup(popup) {
        return new Promise(function (resolve) {
            queuedPopups.push(Object.assign(popup, { resolve: resolve }));
            showNextPopup();
        });
    }

    window.AppPopup = {
        alert: function (message, options) {
            options = options || {};
            return enqueuePopup({
                type: 'alert',
                title: options.title || 'Informasi',
                message: String(message),
                icon: options.icon || 'bi-info-circle',
                cancelText: '',
                acceptText: options.acceptText || 'Tutup'
            });
        },
        confirm: function (message, options) {
            options = options || {};
            return enqueuePopup({
                type: 'confirm',
                title: options.title || 'Konfirmasi',
                message: String(message),
                icon: options.icon || 'bi-question-circle',
                cancelText: options.cancelText || 'Batal',
                acceptText: options.acceptText || 'Lanjutkan'
            });
        }
    };

    document.querySelectorAll('form[data-confirm]').forEach(function (form) {
        form.addEventListener('submit', async function (event) {
            if (confirmedForms.has(form)) {
                confirmedForms.delete(form);
                return;
            }

            event.preventDefault();
            const accepted = await window.AppPopup.confirm(form.dataset.confirm, {
                title: form.dataset.confirmTitle,
                acceptText: form.dataset.confirmAccept
            });
            if (!accepted) return;
            if (!form.reportValidity()) return;

            confirmedForms.add(form);
            if (event.submitter) {
                form.requestSubmit(event.submitter);
            } else {
                form.requestSubmit();
            }
        });
    });

})();
