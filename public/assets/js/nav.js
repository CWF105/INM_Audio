document.addEventListener("DOMContentLoaded", function() {
    const dropdownContainer = document.querySelector(".dropdown-container");
    const dropdown = document.querySelector(".dropdown");
    
    dropdownContainer.addEventListener("click", (event) => {
        // Prevent click events on SVG
        if (event.target.tagName === "svg" || event.target.closest("svg")) {
            event.preventDefault();
            return;
        }
        
        // Toggle dropdown visibility on smaller screens
        if (window.innerWidth <= 992) {
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }
    });
    
    // Hide dropdown if clicked outside
    document.addEventListener("click", (event) => {
        if (!dropdownContainer.contains(event.target)) {
            dropdown.style.display = "none";
        }
    });
});