// Light/Dark mode toggle
const themeToggle = document.getElementById("theme-toggle");
const body = document.body;

themeToggle.addEventListener("click", () => {
    body.classList.toggle("dark-mode");

    if (body.classList.contains("dark-mode")) {
        themeToggle.textContent = "Dark Mode";
    } else {
        themeToggle.textContent = "Light Mode";
    }
});

logoutBtn.addEventListener("click", () => {
    window.location.href = 'logout.php';
});

// Hamburger menu functionality
const hamburger = document.getElementById("hamburger");
const dropdown = document.getElementById("dropdown");

hamburger.addEventListener("click", () => {
    dropdown.classList.toggle("active");
});