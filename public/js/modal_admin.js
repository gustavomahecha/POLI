
  document.addEventListener("DOMContentLoaded", () => {
    const openBtn = document.getElementById("openAdminModal");
    const modal = document.getElementById("adminModal");
    const closeBtn = document.querySelector(".admin-close");

    openBtn.addEventListener("click", (e) => {
      e.preventDefault();
      modal.style.display = "flex";
    });

    closeBtn.addEventListener("click", () => {
      modal.style.display = "none";
    });

    window.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.style.display = "none";
      }
    });
  });
