document.addEventListener('DOMContentLoaded', () => {
    const themeToggleBtn = document.getElementById('theme-toggle');
    const menuToggleBtn = document.getElementById('menu-toggle');
    const headerActions = document.getElementById('header-actions');
    const body = document.body;

    // Use a larger brand at the top and compact it after the page starts moving.
    const updateScrolledState = () => {
        body.classList.toggle('is-scrolled', window.scrollY > 24);
    };

    updateScrolledState();
    window.addEventListener('scroll', updateScrolledState, { passive: true });

    // Check for saved user preference, if any, on load
    const savedTheme = localStorage.getItem('theme');

    // Check for OS preference
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');

    // Apply theme on load
    if (savedTheme === 'dark') {
        body.classList.add('dark-mode');
    } else if (savedTheme === 'light') {
        body.classList.remove('dark-mode');
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

    // Mobile navigation.
    if (menuToggleBtn && headerActions) {
        menuToggleBtn.addEventListener('click', () => {
            const isOpen = body.classList.toggle('menu-open');
            menuToggleBtn.setAttribute('aria-expanded', String(isOpen));
        });

        headerActions.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                body.classList.remove('menu-open');
                menuToggleBtn.setAttribute('aria-expanded', 'false');
            });
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
