document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.tj-video-testimonial-section').forEach(function (section) {

        initSlider(section);
        initVideos(section);
    });


    function initSlider(section) {

        const viewport = section.querySelector('.cr-viewport');
        const track = section.querySelector('.cr-track');
        const cards = Array.from(section.querySelectorAll('.cr-card'));
        const prevBtn = section.querySelector('.cr-nav-prev');
        const nextBtn = section.querySelector('.cr-nav-next');
        const dotsWrap = section.querySelector('.cr-dots');

        if (!viewport || !track || !cards.length || !prevBtn || !nextBtn) {
            return;
        }

        let currentIndex = 0;

        function getVisibleCount() {

            const width = window.innerWidth;

            if (width <= 575) {
                return 1;
            }

            if (width <= 991) {
                return 2;
            }

            return 3;
        }

        function getStep() {

            const cardRect = cards[0].getBoundingClientRect();
            const gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap || 0) || 0;

            return cardRect.width + gap;
        }

        function buildDots(maxIndex) {

            if (!dotsWrap) {
                return;
            }

            dotsWrap.innerHTML = '';

            if (maxIndex <= 0) {
                return;
            }

            for (let i = 0; i <= maxIndex; i++) {

                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = 'cr-dot' + (i === currentIndex ? ' active' : '');
                dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));

                dot.addEventListener('click', function () {
                    currentIndex = i;
                    update();
                });

                dotsWrap.appendChild(dot);
            }
        }

        function update(rebuildDots) {

            const visible = getVisibleCount();
            const maxIndex = Math.max(0, cards.length - visible);

            currentIndex = Math.min(currentIndex, maxIndex);

            const step = getStep();

            track.style.transform = 'translateX(-' + (currentIndex * step) + 'px)';

            prevBtn.disabled = currentIndex <= 0;
            nextBtn.disabled = currentIndex >= maxIndex;

            if (rebuildDots !== false) {
                buildDots(maxIndex);
            } else if (dotsWrap) {
                dotsWrap.querySelectorAll('.cr-dot').forEach(function (dot, i) {
                    dot.classList.toggle('active', i === currentIndex);
                });
            }
        }

        prevBtn.addEventListener('click', function () {
            currentIndex = Math.max(0, currentIndex - 1);
            update(false);
        });

        nextBtn.addEventListener('click', function () {
            const visible = getVisibleCount();
            const maxIndex = Math.max(0, cards.length - visible);
            currentIndex = Math.min(maxIndex, currentIndex + 1);
            update(false);
        });

        let resizeTimer;

        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                update(true);
            }, 150);
        });

        update(true);
    }


    function initVideos(section) {

        const mediaBlocks = Array.from(section.querySelectorAll('.cr-media'));

        mediaBlocks.forEach(function (media) {

            const video = media.querySelector('.cr-video');
            const playBtn = media.querySelector('.cr-play-btn');

            if (!video || !playBtn) {
                return;
            }

            playBtn.addEventListener('click', function () {

                mediaBlocks.forEach(function (other) {

                    if (other === media) {
                        return;
                    }

                    const otherVideo = other.querySelector('.cr-video');

                    if (otherVideo && !otherVideo.paused) {
                        otherVideo.pause();
                        other.classList.remove('is-playing');
                    }
                });

                media.classList.add('is-playing');
                video.setAttribute('controls', '');
                video.play();
            });

            video.addEventListener('ended', function () {
                media.classList.remove('is-playing');
                video.removeAttribute('controls');
                video.currentTime = 0;
            });

            video.addEventListener('pause', function () {

                if (video.currentTime > 0 && !video.ended) {
                    return;
                }

                media.classList.remove('is-playing');
                video.removeAttribute('controls');
            });
        });
    }

});
