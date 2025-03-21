// Main JavaScript entry point for the Morocco 2030 World Cup website
// This file initializes all the necessary functionality for the site

// Import CSS
import '../css/app.css';

// Initialize mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
  // Mobile menu toggle
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', function() {
      mobileMenu.classList.toggle('hidden');
    });
  }

  // Initialize tab functionality on favorites page
  initializeTabs();

  // Initialize any other interactive elements
  initializeTooltips();
  initializeDropdowns();
});

/**
 * Initialize tab functionality for pages that use tabs (like Favorites)
 */
function initializeTabs() {
  const tabButtons = document.querySelectorAll('[id^="tab-"]');

  tabButtons.forEach(button => {
    button.addEventListener('click', function() {
      const tabId = this.id;
      const contentId = tabId.replace('tab-', 'content-');

      // Hide all tab contents
      document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
      });

      // Remove active state from all tabs
      tabButtons.forEach(btn => {
        btn.classList.remove('border-primary', 'text-primary');
        btn.classList.add('border-transparent');
      });

      // Show selected tab content
      const selectedContent = document.getElementById(contentId);
      if (selectedContent) {
        selectedContent.classList.remove('hidden');
      }

      // Set active state on selected tab
      this.classList.add('border-primary', 'text-primary');
      this.classList.remove('border-transparent');
    });
  });
}

/**
 * Initialize tooltip functionality
 */
function initializeTooltips() {
  // Simple tooltip implementation
  const tooltipTriggers = document.querySelectorAll('[data-tooltip]');

  tooltipTriggers.forEach(trigger => {
    trigger.addEventListener('mouseenter', function() {
      const tooltipText = this.getAttribute('data-tooltip');

      if (!tooltipText) return;

      const tooltip = document.createElement('div');
      tooltip.className = 'absolute z-50 px-2 py-1 text-xs text-white bg-gray-900 rounded shadow-lg';
      tooltip.textContent = tooltipText;
      tooltip.style.bottom = '100%';
      tooltip.style.left = '50%';
      tooltip.style.transform = 'translateX(-50%) translateY(-5px)';

      this.style.position = 'relative';
      this.appendChild(tooltip);
    });

    trigger.addEventListener('mouseleave', function() {
      const tooltip = this.querySelector('div');
      if (tooltip) {
        tooltip.remove();
      }
    });
  });
}

/**
 * Initialize dropdown functionality
 */
function initializeDropdowns() {
  const dropdownTriggers = document.querySelectorAll('[data-dropdown]');

  dropdownTriggers.forEach(trigger => {
    trigger.addEventListener('click', function() {
      const dropdownId = this.getAttribute('data-dropdown');
      const dropdown = document.getElementById(dropdownId);

      if (!dropdown) return;

      dropdown.classList.toggle('hidden');

      // Close dropdown when clicking outside
      document.addEventListener('click', function closeDropdown(event) {
        if (!trigger.contains(event.target) && !dropdown.contains(event.target)) {
          dropdown.classList.add('hidden');
          document.removeEventListener('click', closeDropdown);
        }
      });
    });
  });
}
