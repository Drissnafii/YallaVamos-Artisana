document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss functionality
    const flashMessages = document.querySelectorAll('.flash-message');

    flashMessages.forEach(function(message) {
        // Auto-dismiss after 5 seconds
        setTimeout(function() {
            fadeOut(message);
        }, 5000);

        // Manual close button functionality
        const closeButton = message.querySelector('.flash-close');
        if (closeButton) {
            closeButton.addEventListener('click', function() {
                fadeOut(message);
            });
        }
    });

    function fadeOut(element) {
        element.style.transition = 'opacity 1s ease';
        element.style.opacity = '0';
        setTimeout(function() {
            element.remove();
        }, 1000);
    }
});
