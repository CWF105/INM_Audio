const track = document.getElementById("image-track");

const handleOnDown = e => track.dataset.mouseDownAt = e.clientX;

const handleOnUp = () => {
  track.dataset.mouseDownAt = "0";  
  track.dataset.prevPercentage = track.dataset.percentage;
}

const handleOnMove = e => {
  if(track.dataset.mouseDownAt === "0") return;
  
  const mouseDelta = parseFloat(track.dataset.mouseDownAt) - e.clientX,
        maxDelta = window.innerWidth / 2;
  
  const percentage = (mouseDelta / maxDelta) * -100,
        nextPercentageUnconstrained = parseFloat(track.dataset.prevPercentage) + percentage,
        nextPercentage = Math.max(Math.min(nextPercentageUnconstrained, 0), -100);
  
  track.dataset.percentage = nextPercentage;
  
  track.animate({
    transform: `translate(${nextPercentage}%, -50%)`
  }, { duration: 1200, fill: "forwards" });
  
  for(const image of track.getElementsByClassName("image")) {
    image.animate({
      objectPosition: `${100 + nextPercentage}% center`
    }, { duration: 1200, fill: "forwards" });
  }
}

/* --  touch events -- */

window.onmousedown = e => handleOnDown(e);

window.ontouchstart = e => handleOnDown(e.touches[0]);

window.onmouseup = e => handleOnUp(e);

window.ontouchend = e => handleOnUp(e.touches[0]);

window.onmousemove = e => handleOnMove(e);

window.ontouchmove = e => handleOnMove(e.touches[0]);


// library 

const openModalButtons = document.querySelectorAll('[data-modal-target]')
const closeModalButtons = document.querySelectorAll('[data-close-button]')
const overlay = document.getElementById('overlay')

openModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = document.querySelector(button.dataset.modalTarget)
    openModal(modal)
  })
})

overlay.addEventListener('click', () => {
  const modals = document.querySelectorAll('.modal.active')
  modals.forEach(modal => {
    closeModal(modal)
  })
})

closeModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = button.closest('.modal')
    closeModal(modal)
  })
})

function openModal(modal) {
  if (modal == null) return
  modal.classList.add('active')
  overlay.classList.add('active')
}

function closeModal(modal) {
  if (modal == null) return
  modal.classList.remove('active')
  overlay.classList.remove('active')
}




// function toggleComment(category) {
//   const cards = document.querySelectorAll('.comment');

//   cards.forEach(card => {
//     if (card.classList.contains(category)) {
//       card.style.display = 'block';
//     } else {
//       card.style.display = 'none';
//     }
//   });
// }

//checkout

function filterItems(category) {
  const cards = document.querySelectorAll('.card');
  cards.forEach(card => {
      if (card.classList.contains(category)) {
          card.style.display = 'block';
      } else {
          card.style.display = 'none';
      }
  });
}

//signup-login

function showModal(message, type) {
  const modal = document.getElementById('notificationModal');
  const modalContent = document.querySelector('.modal-content');

  document.getElementById('modalMessage').innerText = message;
  
  if (type === 'success') {
      modalContent.style.backgroundColor = '#d4edda'; // Green background for success
      modalContent.style.color = '#155724'; // Dark green text for success
  } else if (type === 'error') {
      modalContent.style.backgroundColor = '#f8d7da'; // Red background for error
      modalContent.style.color = '#721c24'; // Dark red text for error
  }

  modal.style.display = 'flex';
}

function closeModal() {
  document.getElementById('notificationModal').style.display = 'none';
}

function toggleDropdown() {
  const dropDown = document.querySelectorAll('responsive-container');

  if (dropDown.style.display === 'block') {
    dropDown.style.display = 'none';
  } else {
    dropDown.style.display= 'block';
  }
}






document.querySelectorAll('[data-modal-target]').forEach(button => {
  button.addEventListener('click', function() {
      const modal = document.querySelector(this.getAttribute('data-modal-target'));
      modal.style.display = 'flex';
      document.getElementById('overlay').style.display = 'block';
  });
});

// Close modal
document.querySelectorAll('[data-close-button]').forEach(button => {
  button.addEventListener('click', function() {
      const modal = button.closest('.modal');
      modal.style.display = 'none';
      document.getElementById('overlay').style.display = 'none';
  });
});

// Optionally, you can also close the modal when clicking on the overlay
document.getElementById('overlay').addEventListener('click', function() {
  document.querySelectorAll('.modal').forEach(modal => modal.style.display = 'none');
  this.style.display = 'none';
});





document.querySelectorAll('.modal').forEach((modal, index) => {
  const stars = modal.querySelectorAll('.star');
  const ratingValue = modal.querySelector('.rating-value');
  const ratingInput = modal.querySelector('.rating-value-input'); // The hidden input field

  let currentRating = parseInt(ratingValue.textContent) || 0;  // Default to the current rating (if any)

  // Mouse hover event to highlight stars
  stars.forEach(star => {
      star.addEventListener('mouseover', () => {
          const value = parseInt(star.getAttribute('data-value'));
          highlightStars(value);
      });

      // Mouse out event to reset star highlight
      star.addEventListener('mouseout', () => {
          highlightStars(currentRating);
      });

      // Click event to select the rating
      star.addEventListener('click', () => {
          currentRating = parseInt(star.getAttribute('data-value'));
          ratingValue.textContent = currentRating;
          ratingInput.value = currentRating;  // Set the value of the hidden input field
          updateStars();  // Update the selected stars' styling
      });
  });

  // Highlight stars based on rating
  function highlightStars(rating) {
      stars.forEach(star => {
          if (parseInt(star.getAttribute('data-value')) <= rating) {
              star.classList.add('hover');
          } else {
              star.classList.remove('hover');
          }
      });
  }

  // Update the stars' classes based on the selected rating
  function updateStars() {
      stars.forEach(star => {
          if (parseInt(star.getAttribute('data-value')) <= currentRating) {
              star.classList.add('selected');
          } else {
              star.classList.remove('selected');
          }
      });
  }

  // Initialize the star display on page load (in case there is an existing review)
  updateStars();
});