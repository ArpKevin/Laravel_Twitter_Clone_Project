let isDarkMode = false;

function toggleTheme() {
    isDarkMode = !isDarkMode;
    updateIcons();
    /*updateTooltip();*/
    cssToggle();
}

/*function updateTooltip() {
    const themeToggle = document.querySelector('span[data-tooltip][onclick*="toggleTheme"]');
    
    if (themeToggle) {
        themeToggle.setAttribute('data-tooltip', isDarkMode ? 'Light Mode' : 'Dark Mode');

        // Refresh tooltips if the function exists
        if (typeof refreshTooltips === 'function') {
            refreshTooltips();
        }
    }
}*/

function updateIcons() {
    document.querySelectorAll(".theme-icon").forEach(icon => {
        const currentSrc = icon.src.split("/").pop();
        const newIcon = isDarkMode ? `${window.location.origin}/imgs/white/${currentSrc}` : `${window.location.origin}/imgs/black/${currentSrc}`;
        icon.src = newIcon;
    });
}


function cssToggle() {
    const theme = document.getElementById('theme');
    if (!theme) return;

    const path = window.location.pathname;
    let lightCSS = "";
    let darkCSS = "";

    switch (true) {
        case path.includes("dashboard.html"):
            lightCSS = "css/light/dashboard.css";
            darkCSS = "css/dark/dashboard.css";
            break;
        case path.includes("comment.html"):
            lightCSS = "css/light/comments.css";
            darkCSS = "css/dark/comments.css";
            break;
        case path.includes("profile.html"):
            lightCSS = "css/light/profile.css";
            darkCSS = "css/dark/profile.css";
            break;
        default:
            return;
    }

    const newHref = theme.getAttribute('href').includes("light") ? darkCSS : lightCSS;

    const newTheme = document.createElement("link");
    newTheme.id = "theme";
    newTheme.rel = "stylesheet";
    newTheme.href = newHref;

    theme.replaceWith(newTheme);
}


