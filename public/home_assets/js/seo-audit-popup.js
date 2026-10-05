document.addEventListener('DOMContentLoaded', function () {

    var STORAGE_KEY = 'sapDismissed';

    var overlay = document.getElementById('sapOverlay');
    var closeBtn = document.getElementById('sapCloseBtn');

    if (!overlay || !closeBtn) {
        return;
    }

    /* Popup form is not shown on mobile devices */
    if (window.matchMedia('(max-width: 767px)').matches) {
        return;
    }

    var alreadyDismissed = false;

    try {
        alreadyDismissed = localStorage.getItem(STORAGE_KEY) === '1';
    } catch (e) {
        alreadyDismissed = false;
    }

    if (alreadyDismissed) {
        return;
    }

    function showPopup() {
        overlay.classList.add('is-open');
        document.body.classList.add('sap-no-scroll');
    }

    function dismissPopup() {

        overlay.classList.remove('is-open');
        document.body.classList.remove('sap-no-scroll');

        try {
            localStorage.setItem(STORAGE_KEY, '1');
        } catch (e) {
            /* localStorage unavailable — popup may reappear next visit, non-fatal */
        }
    }

    var showTimer = setTimeout(showPopup, 5000);

    closeBtn.addEventListener('click', dismissPopup);

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) {
            dismissPopup();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.classList.contains('is-open')) {
            dismissPopup();
        }
    });

});
