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

// Function to toggle edit mode for a specific modal
function toggleEditMode(modalIndex, isEditing) {
    const editButton = document.getElementById(`editButton-${modalIndex}`);
    const saveButton = document.getElementById(`saveButton-${modalIndex}`);
    const cancelButton = document.getElementById(`cancelButton-${modalIndex}`);
    const readOnlyFields = document.querySelectorAll(`#gearItem-${modalIndex} .read-only`);
    const editModeFields = document.querySelectorAll(`#gearItem-${modalIndex} .edit-mode`);
    const selectFields = document.querySelectorAll(`#gearItem-${modalIndex} select`);

    editButton.style.display = isEditing ? "none" : "inline-block";
    saveButton.style.display = isEditing ? "inline-block" : "none";
    cancelButton.style.display = isEditing ? "inline-block" : "none";

    readOnlyFields.forEach(field => (field.style.display = isEditing ? "none" : "block"));
    editModeFields.forEach(field => (field.style.display = isEditing ? "block" : "none"));

    // Toggle the select fields' disabled property
    selectFields.forEach(select => (select.disabled = !isEditing));
}

// Add event listeners for all modals
document.querySelectorAll(".view-button").forEach((button, index) => {
    button.addEventListener("click", event => {
        event.preventDefault();

        const targetModalId = button.getAttribute("data-target");
        const targetModal = document.getElementById(targetModalId);
        if (targetModal) {
            targetModal.style.display = "block";

            // Setup edit button logic for this modal
            document.getElementById(`editButton-${index}`).addEventListener("click", () => toggleEditMode(index, true));
            document.getElementById(`cancelButton-${index}`).addEventListener("click", () => toggleEditMode(index, false));
        }
    });
});

// Close modal logic
document.querySelectorAll(".close").forEach(button => {
    button.addEventListener("click", () => {
        const modal = button.closest(".modal");
        if (modal) {
            modal.style.display = "none";
        }
    });
});

// Close modal when clicking outside
window.addEventListener("click", event => {
    if (event.target.classList.contains("modal")) {
        event.target.style.display = "none";
    }
});

// SWITCH TABS
function switchTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(content => {
      content.classList.remove('active');
    });
    document.getElementById(tabId).classList.add('active');
}