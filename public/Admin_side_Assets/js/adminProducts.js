document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.tab-btn');
    const contents = document.querySelectorAll('.tab-content');

    // Function to activate the tab
    function activateTab(tabId) {
        buttons.forEach(btn => btn.classList.remove('active'));
        contents.forEach(content => content.classList.remove('active'));

        document.querySelector(`.tab-btn[data-switch-tab="${tabId}"]`).classList.add('active');
        document.getElementById(tabId).classList.add('active');
    }

    // Load the active tab from localStorage or default to the first tab
    const activeTab = localStorage.getItem('activeTab') || 'tab-1';
    activateTab(activeTab);

    // Add click event listeners to buttons
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-switch-tab');
            activateTab(tabId);
            localStorage.setItem('activeTab', tabId);
        });
    });
});
