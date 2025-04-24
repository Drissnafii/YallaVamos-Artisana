// Header Animation
document.addEventListener('DOMContentLoaded', function() {
    // Variables
    const header = document.getElementById('main-header');
    const headerNav = document.getElementById('header-nav');
    const navContainer = document.getElementById('nav-container');
    const navLinks = document.querySelectorAll('.nav-link');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const hoverIndicator = document.getElementById('hover-indicator');
    let lastScrollY = window.scrollY;
    let isMenuOpen = false;
    let isOverWhiteBackground = false;
    const whiteThreshold = 0.9; // Brightness threshold (0-1)

    // Apply initial gradient background when at the top
    function applyInitialHeaderBackground() {
        if (window.scrollY <= 50 && headerNav) {
            // Darker gradient for the initial view at top of page
            headerNav.style.background = 'linear-gradient(to bottom, rgba(0, 0, 0, 0.95), rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5))';
            headerNav.style.backdropFilter = 'blur(10px)';
            headerNav.style.borderColor = 'transparent'; // Hide border at top
        } else {
            // Regular background detection when scrolling
            updateHeaderBackground();
        }
    }

    // Function to detect white backgrounds
    function isColorWhite(rgb) {
        if (!rgb || rgb === 'rgba(0, 0, 0, 0)' || rgb === 'transparent') return false;
        const [r, g, b] = rgb.match(/\d+/g).map(Number);
        const brightness = (r * 299 + g * 587 + b * 114) / 1000;
        return brightness > 255 * whiteThreshold;
    }

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

        // Apply appropriate header background based on scroll position
        applyInitialHeaderBackground();
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

        // Update header background on resize
        applyInitialHeaderBackground();
    });

    // Function to update header background based on section below
    function updateHeaderBackground() {
        if (!header || !headerNav) return;

        // Always start with a dark header background
        let headerBg = 'rgba(0, 0, 0, 0.85)'; // Very dark with high opacity

        const headerRect = header.getBoundingClientRect();
        const headerBottom = headerRect.bottom;

        // Check elements directly below the header
        const elementsBelow = document.elementsFromPoint(
            window.innerWidth / 2,
            headerBottom + 5
        );

        // Find first non-header element with background
        const sectionBelow = elementsBelow.find(el => {
            return !el.closest('header') &&
                  window.getComputedStyle(el).backgroundColor !== 'rgba(0, 0, 0, 0)' &&
                  window.getComputedStyle(el).backgroundColor !== 'transparent';
        });

        if (sectionBelow) {
            const sectionBgColor = window.getComputedStyle(sectionBelow).backgroundColor;
            const isWhite = isColorWhite(sectionBgColor);

            if (isWhite) {
                // If section below has white background, ensure dark header
                headerNav.style.backgroundColor = headerBg;
                headerNav.style.background = headerBg; // Override any gradient
            } else {
                // If section below has a dark/colored background, make header transparent
                headerNav.style.backgroundColor = 'transparent';
                headerNav.style.background = 'transparent'; // Override any gradient
            }

            // Always maintain backdrop blur and subtle border
            headerNav.style.backdropFilter = 'blur(10px)';
            headerNav.style.borderColor = 'rgba(255, 255, 255, 0.05)';

            // Store current background state
            isOverWhiteBackground = isWhite;
        }

        // Force all navigation links to be white text
        navLinks.forEach(link => {
            // Remove any text color classes that might conflict
            link.classList.remove('text-gray-900', '!text-gray-900');
            // Add white text with !important to override any other styles
            link.classList.add('!text-white');
        });

        // Also fix mobile menu links
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.classList.remove('text-gray-900', '!text-gray-900');
            link.classList.add('!text-white');
        });
    }

    // Initial check for header background
    applyInitialHeaderBackground();

    // Recheck on page load when images and other resources are fully loaded
    window.addEventListener('load', applyInitialHeaderBackground);

    // Disable the conflicting detectBackgroundColor function
    function detectBackgroundColor() {
        // This function is now empty to prevent conflicts
        return;
    }

    window.addEventListener('scroll', detectBackgroundColor);
    window.addEventListener('resize', detectBackgroundColor);
    detectBackgroundColor(); // Initial check
});

// particles.js implementation for Morocco-themed animation - restricted to login/register pages
document.addEventListener('DOMContentLoaded', function() {
    // Check if current page is login or register
    const currentPath = window.location.pathname;
    const isLoginPage = currentPath.includes('/login');
    const isRegisterPage = currentPath.includes('/register');

    // Only initialize animation on login or register pages
    if (isLoginPage || isRegisterPage) {
        initializeParticleAnimation();
    }

    function initializeParticleAnimation() {
        // Create a canvas element and append it to the body
        const canvas = document.createElement('canvas');
        canvas.id = 'snow-animation';

        // Position the canvas as a fixed background
        canvas.style.position = 'fixed';
        canvas.style.top = '0';
        canvas.style.left = '0';
        canvas.style.width = '100%';
        canvas.style.height = '100%';
        canvas.style.pointerEvents = 'none'; // Allow clicks to pass through
        canvas.style.zIndex = '-1'; // Place behind content

        // Add canvas to the page (as the first child of the body)
        document.body.insertBefore(canvas, document.body.firstChild);

        // Set canvas dimensions
        const resizeCanvas = () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        };

        // Listen for window resize
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        // Get canvas context
        const ctx = canvas.getContext('2d');

        // Particle settings
        const particleSettings = {
            count: 60,         // Reduced number of particles for cleaner look
            color: '#E9272E',  // Morocco's primary red color
            minSize: 2,
            maxSize: 5,
            maxSpeed: 0.2,     // Very slow maximum speed for gentle movement
            opacity: {
                min: 0.1,
                max: 0.4
            }
        };

        // Create particles array
        const particles = [];

        // Particle constructor
        class Particle {
            constructor() {
                this.reset();
            }

            reset() {
                // Position randomly across the entire canvas
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = particleSettings.minSize + Math.random() *
                           (particleSettings.maxSize - particleSettings.minSize);

                // Random direction vectors (very small values for slow movement)
                this.vx = Math.random() * 0.2 - 0.1; // Between -0.1 and 0.1
                this.vy = Math.random() * 0.2 - 0.1; // Between -0.1 and 0.1

                // Scale down velocity for even slower movement
                const speed = Math.random() * particleSettings.maxSpeed;
                const magnitude = Math.sqrt(this.vx * this.vx + this.vy * this.vy);
                if (magnitude !== 0) {
                    this.vx = (this.vx / magnitude) * speed;
                    this.vy = (this.vy / magnitude) * speed;
                }

                this.opacity = particleSettings.opacity.min + Math.random() *
                              (particleSettings.opacity.max - particleSettings.opacity.min);

                // Add slight wobble effect
                this.angle = Math.random() * Math.PI * 2;
                this.wobbleSpeed = 0.01 + Math.random() * 0.01; // Very slow wobble
                this.wobbleSize = 0.1 + Math.random() * 0.1;    // Small wobble distance
            }

            update() {
                // Update position with velocity
                this.x += this.vx;
                this.y += this.vy;

                // Add slight wobble effect
                this.angle += this.wobbleSpeed;
                this.x += Math.sin(this.angle) * this.wobbleSize;
                this.y += Math.cos(this.angle) * this.wobbleSize;

                // Bounce off edges with random direction change
                if (this.x < 0 || this.x > canvas.width) {
                    this.vx = -this.vx * 0.8; // Dampen the bounce
                    if (Math.random() < 0.1) { // Small chance to change direction more significantly
                        this.vx = Math.random() * 0.2 - 0.1;
                    }
                }

                if (this.y < 0 || this.y > canvas.height) {
                    this.vy = -this.vy * 0.8; // Dampen the bounce
                    if (Math.random() < 0.1) { // Small chance to change direction more significantly
                        this.vy = Math.random() * 0.2 - 0.1;
                    }
                }

                // Small chance to change direction slightly for more natural movement
                if (Math.random() < 0.01) {
                    this.vx += (Math.random() * 0.04 - 0.02);
                    this.vy += (Math.random() * 0.04 - 0.02);

                    // Cap maximum speed
                    const currentSpeed = Math.sqrt(this.vx * this.vx + this.vy * this.vy);
                    if (currentSpeed > particleSettings.maxSpeed) {
                        this.vx = (this.vx / currentSpeed) * particleSettings.maxSpeed;
                        this.vy = (this.vy / currentSpeed) * particleSettings.maxSpeed;
                    }
                }
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(233, 39, 46, ${this.opacity})`; // Morocco red with opacity
                ctx.fill();
            }
        }

        // Initialize particles
        for (let i = 0; i < particleSettings.count; i++) {
            // Distribute particles throughout the canvas
            const p = new Particle();
            // Already positioned randomly in the reset() function
            particles.push(p);
        }

        // Animation loop
        function animate() {
            // Clear canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Update and draw particles
            particles.forEach(particle => {
                particle.update();
                particle.draw();
            });

            // Request next frame
            requestAnimationFrame(animate);
        }

        // Start animation
        animate();
    }
});
