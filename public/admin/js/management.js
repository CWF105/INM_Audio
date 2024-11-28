// Reusable function to handle modal logic
function setupModal(modalId, openButtonId, closeButtonClass) {
    const modal = document.getElementById(modalId);
    const openButton = document.getElementById(openButtonId);
    const closeButton = modal.querySelector(closeButtonClass);

    // Open modal
    openButton.addEventListener("click", () => {
        modal.style.display = "block";
    });

    // Close modal
    closeButton.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Close modal when clicking outside the modal content
    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
}

// Initialize modals
setupModal("gearModal", "openGearModal", ".close-gear");
setupModal("categoriesModal", "openCategoriesModal", ".close-categories");

// view modal
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

// toggle edit mode
const editButton = document.getElementById("editButton");
const saveButton = document.getElementById("saveButton");
const cancelButton = document.getElementById("cancelButton");
const readOnlyFields = document.querySelectorAll(".read-only");
const editModeFields = document.querySelectorAll(".edit-mode");

function toggleEditMode(isEditing) {
    editButton.style.display = isEditing ? "none" : "inline-block";
    saveButton.style.display = isEditing ? "inline-block" : "none";
    cancelButton.style.display = isEditing ? "inline-block" : "none";

    readOnlyFields.forEach(field => (field.style.display = isEditing ? "none" : "block"));
    editModeFields.forEach(field => (field.style.display = isEditing ? "block" : "none"));
}
editButton.addEventListener("click", () => toggleEditMode(true));
cancelButton.addEventListener("click", () => toggleEditMode(false));



// SWITCH TABS
function switchTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(content => {
      content.classList.remove('active');
    });
    document.getElementById(tabId).classList.add('active');
}