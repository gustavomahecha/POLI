document.querySelectorAll('.view-btn').forEach(button => {
    button.addEventListener('click', () => {
        alert('Ver informacion del usuario');
    });
});

document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', () => {
        alert('Esta opcion actualizara los datos del usuario');
    });
});

document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', () => {
        alert('Esta seguro de eliminar el registro');
    });
});
