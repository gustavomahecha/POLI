
  
function confirmarEliminacion(btn) {
    const id = btn.getAttribute('data-id');
    if (confirm("¿Estás seguro de que deseas eliminar este administrador?")) {
        window.location.href = 'index.php?controller=admin&action=eliminar&id=' + id;
    }
}

function editarAdmin(button) {
    const id = button.getAttribute('data-id');
    const nombres = button.getAttribute('data-nombres');
    const apellidos = button.getAttribute('data-apellidos');
    const correo = button.getAttribute('data-correo');
    const numeroDocumento = button.getAttribute('data-numero_documento');
    const tipoDocumento = button.getAttribute('data-tipo_documento');
    const telefono = button.getAttribute('data-telefono');
    const direccion = button.getAttribute('data-direccion');
    const rol = button.getAttribute('data-rol');

    document.getElementById('nombres').value = nombres;
    document.getElementById('apellidos').value = apellidos;
    document.getElementById('correo').value = correo;
    document.getElementById('numero_documento').value = numeroDocumento;
    document.getElementById('tipo_documento').value = tipoDocumento;
    document.getElementById('telefono').value = telefono;
    document.getElementById('direccion').value = direccion;
    document.getElementById('rol').value = rol;
    document.getElementById('contrasena').value = '';

    document.getElementById('contrasenaContainer').style.display = 'none';
    document.getElementById('btn-cambiar-clave').style.display = 'block';

    const form = document.getElementById('adminForm');
    form.action = `index.php?controller=admin&action=editarAdmin&id=${id}`;

    document.getElementById('modal-title').innerHTML = '<i class="fas fa-user-shield"></i> Editar Administrador';
    document.getElementById('adminModal').style.display = 'block';
}

function mostrarCampoContrasena() {
    document.getElementById('contrasenaContainer').style.display = 'block';
    document.getElementById('btn-cambiar-clave').style.display = 'none';
}

document.getElementById('openModalBtn').addEventListener('click', function () {
    const form = document.getElementById('adminForm');
    form.reset();
    form.action = 'index.php?controller=admin&action=crearAdmin';

    document.getElementById('contrasenaContainer').style.display = 'block';
    document.getElementById('btn-cambiar-clave').style.display = 'none';

    document.getElementById('modal-title').innerHTML = '<i class="fas fa-user-shield"></i> Crear Administrador';
    document.getElementById('adminModal').style.display = 'block';
});

document.getElementById('closeModalBtn').addEventListener('click', function () {
    document.getElementById('adminModal').style.display = 'none';
});

window.onclick = function (event) {
    if (event.target === document.getElementById('adminModal')) {
        document.getElementById('adminModal').style.display = 'none';
    }
};

