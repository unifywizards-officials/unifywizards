document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.tj-why-choose-section').forEach(function (section) {

        const items = Array.from(section.querySelectorAll('.wcu-item'));

        items.forEach(function (item) {

            const head = item.querySelector('.wcu-item-head');

            if (!head) {
                return;
            }

            head.addEventListener('click', function () {

                const alreadyActive = item.classList.contains('active');

                items.forEach(function (other) {
                    other.classList.remove('active');
                });

                if (!alreadyActive) {
                    item.classList.add('active');
                }
            });
        });
    });

});
