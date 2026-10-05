document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.tj-client-reviews-section').forEach(function (section) {

        const cards = Array.from(section.querySelectorAll('.crv-card'));
        const pills = Array.from(section.querySelectorAll('.crv-pill'));
        const dotsWrap = section.querySelector('.crv-dots');
        const prevBtn = section.querySelector('.crv-nav-prev');
        const nextBtn = section.querySelector('.crv-nav-next');

        if (!cards.length) {
            return;
        }

        let currentIndex = Math.max(0, cards.findIndex(function (card) {
            return card.classList.contains('active');
        }));

        function buildDots() {

            if (!dotsWrap) {
                return;
            }

            dotsWrap.innerHTML = '';

            cards.forEach(function (card, i) {

                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = 'crv-dot' + (i === currentIndex ? ' active' : '');
                dot.setAttribute('aria-label', 'Show platform ' + (i + 1));

                dot.addEventListener('click', function () {
                    currentIndex = i;
                    update();
                });

                dotsWrap.appendChild(dot);
            });
        }

        function update() {

            cards.forEach(function (card, i) {
                card.classList.toggle('active', i === currentIndex);
            });

            pills.forEach(function (pill, i) {
                pill.classList.toggle('active', i === currentIndex);
            });

            if (dotsWrap) {
                dotsWrap.querySelectorAll('.crv-dot').forEach(function (dot, i) {
                    dot.classList.toggle('active', i === currentIndex);
                });
            }
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                currentIndex = (currentIndex - 1 + cards.length) % cards.length;
                update();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                currentIndex = (currentIndex + 1) % cards.length;
                update();
            });
        }

        pills.forEach(function (pill, i) {
            pill.addEventListener('click', function () {
                currentIndex = i;
                update();
            });
        });

        buildDots();
    });

});
