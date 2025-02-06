function openModal(modalId) {
  const modal = document.getElementById(modalId);

  if (modal) {
      modal.classList.add("open-modal");
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);

  if (modal) {
      modal.classList.remove("open-modal"); 
  }
}
