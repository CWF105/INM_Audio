function switchTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(content => {
      content.classList.remove('active');
    });
    document.getElementById(tabId).classList.add('active');
}



const viewButtons = document.querySelectorAll(".view-button");
viewButtons.forEach(button => {
    button.addEventListener("click", event => {
        event.preventDefault();

        const targetModalId = button.getAttribute("data-target");

        const targetModal = document.getElementById(targetModalId);
        if (targetModal) {
            targetModal.style.display = "block";
        }
    });
});
const closeButtons = document.querySelectorAll(".close");
closeButtons.forEach(button => {
    button.addEventListener("click", () => {
        const modal = button.closest(".modal");
        if (modal) {
            modal.style.display = "none";
        }
    });
});
window.addEventListener("click", event => {
    if (event.target.classList.contains("modal")) {
        event.target.style.display = "none";
    }
});
