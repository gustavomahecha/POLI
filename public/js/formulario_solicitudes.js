document.addEventListener("DOMContentLoaded", function () {
    const formulario = document.querySelector("form.formulario");
  
    if (formulario) {
      formulario.addEventListener("submit", function () {
        setTimeout(() => {
          formulario.reset(); 
        }, 100); 
      });
    }
  });
  