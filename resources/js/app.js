// Header Animation
document.addEventListener('DOMContentLoaded', function() {
    // Variables
    const header = document.getElementById('main-header');
    const navContainer = document.getElementById('nav-container');
    const navLinks = document.querySelectorAll('.nav-link');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const hoverIndicator = document.getElementById('hover-indicator');
    let lastScrollY = window.scrollY;
    let isMenuOpen = false;

    // Handle hover effect for navigation items
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            const rect = this.getBoundingClientRect();
            const navRect = this.parentElement.getBoundingClientRect();

            hoverIndicator.style.width = `${rect.width}px`;
            hoverIndicator.style.height = `${rect.height}px`;
            hoverIndicator.style.left = `${rect.left - navRect.left}px`;
            hoverIndicator.style.opacity = '1';
        });
    });

    // Hide hover effect when mouse leaves nav container
    const navParent = document.querySelector('.flex.items-center.space-x-4.relative');
    if (navParent) {
        navParent.addEventListener('mouseleave', function() {
            hoverIndicator.style.opacity = '0';
        });
    }

    // Handle header shrink on scroll
    window.addEventListener('scroll', function() {
        const currentScrollY = window.scrollY;

        if (currentScrollY > 30) {
            navContainer.classList.add('h-14');
            navContainer.classList.remove('h-16');
        } else {
            navContainer.classList.add('h-16');
            navContainer.classList.remove('h-14');
        }

        // Hide header when scrolling down, show when scrolling up
        if (currentScrollY > lastScrollY && currentScrollY > 100) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }

        lastScrollY = currentScrollY;
    });

    // Mobile menu toggle
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', function() {
            isMenuOpen = !isMenuOpen;

            if (isMenuOpen) {
                mobileMenu.classList.remove('hidden');
                // Use setTimeout to ensure the browser recognizes the element is no longer hidden
                // before setting the maxHeight
                setTimeout(() => {
                    mobileMenu.style.maxHeight = `${mobileMenu.scrollHeight}px`;
                }, 10);

                this.innerHTML = `
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                `;
            } else {
                mobileMenu.style.maxHeight = '0px';
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 500); // Delay to match the transition duration

                this.innerHTML = `
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                `;
            }
        });
    }

    // Handle window resize
    window.addEventListener('resize', function() {
        // Reset mobile menu on resize to desktop
        if (window.innerWidth >= 768 && isMenuOpen && mobileMenuButton) {
            isMenuOpen = false;
            mobileMenu.style.maxHeight = '0px';
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 500);

            mobileMenuButton.innerHTML = `
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            `;
        }
    });
});
