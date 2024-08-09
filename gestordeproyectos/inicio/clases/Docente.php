<?php
    require_once('conexion.php');

    class Docente{
        //atributos
        private $id_docente;
        private $nombre;
        private $area_adscripcion;
        private $telefono;
        private $lider;
        private $correo;
        private $contrasena;
        private $nombre_cuerpo;
        private $con;

        //metodos
        public function __construct(){
            $this->con=new conexion();
        }

        public function set($atributo, $contenido){
            $this->$atributo=$contenido;
        }

        public function get($atributo){
            return $this->$atributo;
        }

        public function listar(){
            $nombre_cuerpo=$_SESSION['nombre_cuerpo'];
            $sql="SELECT id_docente,nombre,area_adscripcion,telefono,lider,correo,(SELECT MD5(contrasena)) AS codificado 
                    FROM docentes WHERE activo=0 AND nombre_cuerpo='$nombre_cuerpo' ";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function filtrar($valor){
            $nombre_cuerpo=$_SESSION['nombre_cuerpo'];
            $sql="SELECT id_docente,nombre,area_adscripcion,telefono,lider,correo,(SELECT MD5(contrasena)) AS codificado 
                    FROM docentes WHERE nombre LIKE '%$valor%' AND activo=0 AND nombre_cuerpo='$nombre_cuerpo'";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function crear(){
            $sql="INSERT INTO docentes(nombre,area_adscripcion,telefono,lider,correo,contrasena, nombre_cuerpo)
                VALUES ('{$this->nombre}','{$this->area_adscripcion}', '{$this->telefono}', '{$this->lider}',
                 '{$this->correo}', '{$this->contrasena}', '{$this->nombre_cuerpo}')";

                $this->con->consultaSimple($sql);
                return true;
        }

        public function eliminar(){
            $sql="DELETE FROM docentes WHERE id_docente='{$this->id_docente}'";
            $resultado=$this->con->consultaSimple($sql);
        }

        public function consultar(){
            $sql="SELECT * FROM docentes WHERE id_docente='{$this->id_docente}'";
            $resultado=$this->con->consultaRetorno($sql);
            $row=mysqli_fetch_assoc($resultado);

            //set
            $this->id_docente=$row['id_docente'];
            $this->nombre=$row['nombre'];
            $this->area_adscripcion=$row['area_adscripcion'];
            $this->telefono=$row['telefono'];
            $this->lider=$row['lider'];
            $this->correo=$row['correo'];
            $this->contrasena=$row['contrasena'];
            $this->nombre_cuerpo=$row['nombre_cuerpo'];
            return $row;
        }

        public function editar(){
            $sql="UPDATE docentes SET nombre='{$this->nombre}', area_adscripcion='{$this->area_adscripcion}',
            telefono='{$this->telefono}', lider='{$this->lider}', correo='{$this->correo}', 
            contrasena='{$this->contrasena}', nombre_cuerpo='{$this->nombre_cuerpo}' 
            WHERE id_docente='{$this->id_docente}'";
            $this->con->consultaSimple($sql);
            return true;
        }
    }
?>