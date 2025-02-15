const openModal = document.querySelector(".open-modal1");
const closeModal = document.getElementById("closeModal1");
const modalOverlay = document.getElementById("modalOverlay1");

// Open Modal
openModal.addEventListener("click", function() {
    modalOverlay.style.display = "flex";
});

// Close Modal
closeModal.addEventListener("click", function() {
    modalOverlay.style.display = "none";
});

// Close Modal when clicking outside the modal box
modalOverlay.addEventListener("click", function(event) {
    if (event.target === modalOverlay) {
        modalOverlay.style.display = "none";
    }
});