document.addEventListener('DOMContentLoaded', function () {
    const deck = document.getElementById('atm-deck');
    if (!deck) return; // agar element page par nahi hai toh silently exit

    const cards = deck.querySelectorAll('.atm-card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            deck.classList.add('atm-hovered');
            card.classList.add('atm-focused');
        });
        card.addEventListener('mouseleave', () => {
            deck.classList.remove('atm-hovered');
            card.classList.remove('atm-focused');
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const faqAccordion = document.getElementById('faqOne');
    if (!faqAccordion || typeof bootstrap === 'undefined') return; // FAQ not on this page

    const faqButtons = faqAccordion.querySelectorAll('.faq-title[data-bs-target]');

    faqButtons.forEach(function (button) {
        const targetEl = document.querySelector(button.getAttribute('data-bs-target'));
        if (!targetEl) return;

        button.addEventListener('mouseenter', function () {
            bootstrap.Collapse.getOrCreateInstance(targetEl, { toggle: false }).show();
        });
    });
});