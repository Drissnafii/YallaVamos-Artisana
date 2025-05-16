/**
 * World Cup 2030 Countdown Timer
 * 
 * This script creates a real-time countdown to the FIFA World Cup 2030 opening ceremony
 * on June 13, 2030. The countdown continues even when the user closes the browser
 * by saving the state in localStorage.
 */

document.addEventListener('DOMContentLoaded', function() {
    // Get countdown elements
    const daysElement = document.getElementById('countdown-days');
    const hoursElement = document.getElementById('countdown-hours');
    const minutesElement = document.getElementById('countdown-minutes');
    const secondsElement = document.getElementById('countdown-seconds');
    
    // Only proceed if the countdown elements exist on this page
    if (!daysElement || !hoursElement || !minutesElement || !secondsElement) {
        return;
    }
    
    // Target date: June 13, 2030 (Opening ceremony)
    const worldCupDate = new Date('June 13, 2030 00:00:00').getTime();
    
    // Function to calculate and display time remaining
    function updateCountdown() {
        const now = new Date().getTime();
        const timeRemaining = worldCupDate - now;
        
        if (timeRemaining <= 0) {
            // World Cup has started
            daysElement.textContent = "0";
            hoursElement.textContent = "0";
            minutesElement.textContent = "0";
            secondsElement.textContent = "0";
            
            // Clear any existing interval
            if (window.countdownInterval) {
                clearInterval(window.countdownInterval);
            }
            
            return;
        }
        
        // Calculate time components
        const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
        
        // Update the DOM
        daysElement.textContent = days;
        hoursElement.textContent = hours;
        minutesElement.textContent = minutes;
        secondsElement.textContent = seconds;
        
        // Save the countdown data to localStorage for persistence
        localStorage.setItem('worldcup2030CountdownData', JSON.stringify({
            days, hours, minutes, seconds,
            lastUpdated: now
        }));
    }
    
    // Check if there's saved countdown data
    const savedData = localStorage.getItem('worldcup2030CountdownData');
    if (savedData) {
        try {
            const data = JSON.parse(savedData);
            daysElement.textContent = data.days;
            hoursElement.textContent = data.hours;
            minutesElement.textContent = data.minutes;
            secondsElement.textContent = data.seconds;
        } catch (e) {
            console.error('Error parsing saved countdown data:', e);
        }
    }
    
    // Update the countdown immediately
    updateCountdown();
    
    // Update the countdown every second
    window.countdownInterval = setInterval(updateCountdown, 1000);
});
