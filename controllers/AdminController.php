<?php
class AdminController
{
    private PDO $db;
    private Admin $modelo;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->modelo = new Admin($this->db);
    }

    public function inicio(): void
    {
        $this->listarAdmins();
    }

    public function listarAdmins(): void
    {
        $admins = $this->modelo->obtenerAdmins();

        $query = $this->db->query("SELECT id, descripcion FROM tipo_documento");
        $tipos_documento = $query->fetchAll(PDO::FETCH_ASSOC);

        include BASE_PATH . '/views/admin.php';
    }

    public function crearAdmin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'correo'             => $_POST['correo'],
                'numero_documento'   => $_POST['numero_documento'],
                'tipo_documento_id'  => $_POST['tipo_documento'],
                'nombres'            => $_POST['nombres'],
                'apellidos'          => $_POST['apellidos'],
                'direccion'          => $_POST['direccion'],
                'telefono'           => $_POST['telefono'],
                'contrasena'         => $_POST['contrasena'], // 🔓 Texto plano
                'rol'                => $_POST['rol'],
                'estado_id'          => 1
            ];

            $this->modelo->crearAdmin($data);

            header('Location: index.php?controller=admin&action=listarAdmins&status=creado');
            exit();
        }
    }

    public function eliminar(int $id): void
    {
        $this->modelo->eliminarAdmin($id);

        header('Location: index.php?controller=admin&action=listarAdmins&status=eliminado');
        exit();
    }

    public function editarAdmin(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'correo'            => $_POST['correo'],
                'numero_documento'  => $_POST['numero_documento'],
                'tipo_documento_id' => $_POST['tipo_documento'],
                'nombres'           => $_POST['nombres'],
                'apellidos'         => $_POST['apellidos'],
                'direccion'         => $_POST['direccion'],
                'telefono'          => $_POST['telefono'],
                'rol'               => $_POST['rol']
            ];

            if (!empty($_POST['contrasena'])) {
                $data['contrasena'] = $_POST['contrasena']; // 🔓 Texto plano
            }

            $this->modelo->actualizarAdmin($id, $data);

            header('Location: index.php?controller=admin&action=listarAdmins&status=actualizado');
            exit();
        }
    }
}
