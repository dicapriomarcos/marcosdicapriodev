document.addEventListener('DOMContentLoaded', () => {
    const themeToggleBtn = document.getElementById('theme-toggle');
    const body = document.body;

    // Check for saved user preference, if any, on load
    const savedTheme = localStorage.getItem('theme');

    // Check for OS preference
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');

    // Check time of day (apply dark mode after 19:00 local time)
    const currentHour = new Date().getHours();
    const isEvening = currentHour >= 19 || currentHour < 6; // Dark mode from 19:00 to 05:59

    // Apply theme on load
    if (savedTheme === 'dark') {
        body.classList.add('dark-mode');
    } else if (savedTheme === 'light') {
        body.classList.remove('dark-mode');
    } else if (isEvening) {
        body.classList.add('dark-mode'); // Prioritize time-based dark mode
    } else if (prefersDarkScheme.matches) {
        body.classList.add('dark-mode');
    }

    // Toggle theme on click
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            body.classList.toggle('dark-mode');

            // Save user preference
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });
    }

    // Copy Link functionality
    const copyLinkBtn = document.getElementById('copy-link-btn');
    const copyFeedback = document.getElementById('copy-feedback-msg');

    if (copyLinkBtn && copyFeedback) {
        copyLinkBtn.addEventListener('click', async () => {
            const urlToCopy = copyLinkBtn.getAttribute('data-url');

            try {
                await navigator.clipboard.writeText(urlToCopy);

                // Show feedback message
                copyFeedback.style.display = 'block';
                copyLinkBtn.style.color = 'var(--color-accent)';
                copyLinkBtn.style.borderColor = 'var(--color-accent)';

                // Hide after 3 seconds
                setTimeout(() => {
                    copyFeedback.style.display = 'none';
                    copyLinkBtn.style.color = '';
                    copyLinkBtn.style.borderColor = '';
                }, 3000);
            } catch (err) {
                console.error('Error al copiar el enlace: ', err);
            }
        });
    }
});
