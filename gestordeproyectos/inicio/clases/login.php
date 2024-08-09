<?php
require_once 'conexion.php';

class Login {
    private $user;
    private $contrasenia;

    public function __construct($user, $contrasenia) {
        $this->user = $user;
        $this->contrasenia = $contrasenia;
    }

    public function validar() {
        $con = new Conexion();
        $sql = "SELECT * FROM docentes WHERE BINARY contrasena='$this->contrasenia' AND BINARY correo='$this->user' AND lider='SI'";
        $res = $con->consultaRetorno($sql);

        if ($fila = mysqli_fetch_assoc($res)) {
            @session_start();
            $_SESSION['nombre'] = $fila['nombre'];
            $_SESSION['user'] = $this->user;
            $_SESSION['validada'] = 1;
            $_SESSION['id_docente'] = $fila['id_docente'];
            $_SESSION['nombre_cuerpo'] = $fila['nombre_cuerpo'];

            // Actualizar el registro del usuario para marcarlo como activo
            $id_docente = $_SESSION['id_docente'];
            $update_sql1 = "UPDATE docentes SET activo=1 WHERE id_docente=$id_docente";
            $con->consultaSimple($update_sql1);
        }
    }
}
?>
