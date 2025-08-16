document.querySelectorAll('.faqitem').forEach(item => {
    item.addEventListener('click', () => {
        const p = item.querySelector('p');
        const arrowDown = item.querySelector('.arrowdown');
        const arrowUp = item.querySelector('.arrowup');

        p.classList.toggle('max-h-0');
        p.classList.toggle('opacity-0');
        p.classList.toggle('max-h-40');
        p.classList.toggle('opacity-100');

        arrowDown.classList.toggle('hidden');
        arrowUp.classList.toggle('hidden');
    });
});
