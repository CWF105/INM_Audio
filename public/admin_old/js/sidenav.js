function toggleDropdown() {
    const dropdown = document.getElementById('dropdown-menu');
    dropdown.classList.toggle('hidden');
}

// Optional: Close dropdown when clicking outside
window.onclick = function (event) {
    const dropdown = document.getElementById('dropdown-menu');
    const dropdownTrigger = event.target.closest('a');

    if (!dropdown.contains(event.target) && !dropdownTrigger) {
        dropdown.classList.add('hidden');
    }
};