document.addEventListener('DOMContentLoaded', function () {

    var tabButtons = document.querySelectorAll('.or-tab-btn');
    var panels = document.querySelectorAll('.or-panel');

    if (!tabButtons.length || !panels.length) {
        return;
    }

    tabButtons.forEach(function (btn) {

        btn.addEventListener('click', function () {

            var target = btn.getAttribute('data-tab');

            tabButtons.forEach(function (b) {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });

            btn.classList.add('active');
            btn.setAttribute('aria-selected', 'true');

            panels.forEach(function (panel) {
                panel.classList.toggle('active', panel.getAttribute('data-panel') === target);
            });

        });

    });

});
