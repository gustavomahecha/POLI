document.addEventListener("DOMContentLoaded", function() {
    const closeBtn = document.querySelector(".close");
    const aceptarBtn = document.getElementById("aceptarBtn");
    const modal = document.getElementById("ticketModal");
  
    function closeModal() {
      modal.style.display = "none";
      history.replaceState({}, document.title, window.location.pathname);
    }
  
    closeBtn.addEventListener("click", closeModal);
    aceptarBtn.addEventListener("click", closeModal);
  
    window.onclick = function(event) {
      if (event.target === modal) {
        closeModal();
      }
    };
  });
  

 
