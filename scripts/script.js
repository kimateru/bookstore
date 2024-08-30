const menu = document.querySelector('#menu');
const overlayMenu = document.querySelector('#overlayMenu');
menu.addEventListener('click', () => {
    const currentSrc = menu.getAttribute('src');
    if (currentSrc.includes('menu.svg')) {
        menu.setAttribute('src', '../assets/site_assets/close.svg');
        overlayMenu.classList.add('active');
        document.body.style.overflow = 'hidden';
    } else {
        menu.setAttribute('src', '../assets/site_assets/menu.svg');
        overlayMenu.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
})