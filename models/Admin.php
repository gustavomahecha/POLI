<?php
class Admin
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function obtenerAdmins(): array
    {
        $stmt = $this->db->query("SELECT * FROM usuarios_admin");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearAdmin(array $data): void
    {
        $sql = "INSERT INTO usuarios_admin 
            (correo, numero_documento, tipo_documento_id, nombres, apellidos, direccion, telefono, contrasena, rol, estado_id)
            VALUES 
            (:correo, :numero_documento, :tipo_documento_id, :nombres, :apellidos, :direccion, :telefono, :contrasena, :rol, :estado_id)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    }

    public function actualizarAdmin(int $id, array $data): void
    {
        try {
            $fields = [
                'correo = :correo',
                'numero_documento = :numero_documento',
                'tipo_documento_id = :tipo_documento_id',
                'nombres = :nombres',
                'apellidos = :apellidos',
                'direccion = :direccion',
                'telefono = :telefono',
                'rol = :rol'
            ];

            if (isset($data['contrasena']) && !empty($data['contrasena'])) {
                $fields[] = 'contrasena = :contrasena';
            } else {
                unset($data['contrasena']);
            }

            $sql = "UPDATE usuarios_admin SET " . implode(', ', $fields) . " WHERE id_admin = :id";
            $data['id'] = $id;

            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
        } catch (PDOException $e) {
            die("🚨 Error al actualizar admin: " . $e->getMessage());
        }
    }

    public function eliminarAdmin(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM usuarios_admin WHERE id_admin = :id");
        $stmt->execute(['id' => $id]);
    }
}
