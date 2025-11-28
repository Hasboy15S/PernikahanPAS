// Animasi Navbar Scroll dengan Height Mengecil
window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    const scrollPosition = window.scrollY;
    
    if (scrollPosition > 50) { // Threshold lebih rendah untuk respons lebih cepat
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header');
    const scrollPosition = window.scrollY;
    
    if (scrollPosition > 50) {
        header.classList.add('scrolled');
    }
    
    // Smooth scroll untuk anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Loaded - Debug Info');
    
    const navToggle = document.querySelector('.nav-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mobileClose = document.querySelector('.mobile-close');
    const mobileLinks = document.querySelectorAll('.mobile-nav-links a');
    
    // Debugging
    console.log('Nav Toggle:', navToggle);
    console.log('Mobile Menu:', mobileMenu);
    console.log('Mobile Close:', mobileClose);
    
    if (!navToggle || !mobileMenu) {
        console.error('Elements not found!');
        return;
    }

    // Toggle mobile menu
    function toggleMobileMenu() {
        console.log('Toggle menu clicked');
        navToggle.classList.toggle('active');
        mobileMenu.classList.toggle('active');
        document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : 'auto';
    }
    
    // Event listeners
    navToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleMobileMenu();
    });
    
    mobileClose.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleMobileMenu();
    });
    
    // Close menu ketika link diklik
    mobileLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleMobileMenu();
        });
    });
    
    // Close menu ketika klik di luar menu
    document.addEventListener('click', function(e) {
        if (mobileMenu.classList.contains('active') && 
            !mobileMenu.contains(e.target) && 
            !navToggle.contains(e.target)) {
            toggleMobileMenu();
        }
    });
    
    // Close menu ketika ESC ditekan
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            toggleMobileMenu();
        }
    });
});