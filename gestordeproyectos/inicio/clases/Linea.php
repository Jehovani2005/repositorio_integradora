<?php
    require_once('conexion.php');

    class Linea{
        //atributos
        private $id_linea;
        private $nombre;
        private $descripcion;
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
            $sql="SELECT * FROM linea_investigacion WHERE nombre_cuerpo='$nombre_cuerpo' ";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function filtrar($valor){
            $nombre_cuerpo=$_SESSION['nombre_cuerpo'];
            $sql="SELECT * FROM linea_investigacion WHERE nombre LIKE '%$valor%' AND nombre_cuerpo='$nombre_cuerpo' ";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function crear(){
            $sql="INSERT INTO linea_investigacion(nombre,descripcion,nombre_cuerpo)
                VALUES ('{$this->nombre}', '{$this->descripcion}', '{$this->nombre_cuerpo}')";

                $this->con->consultaSimple($sql);
                return true;
        }

        public function eliminar(){
            $sql="DELETE FROM linea_investigacion WHERE id_linea='{$this->id_linea}'";
            $resultado=$this->con->consultaSimple($sql);
        }

        public function consultar(){
            $sql="SELECT * FROM linea_investigacion WHERE id_linea='{$this->id_linea}'";
            $resultado=$this->con->consultaRetorno($sql);
            $row=mysqli_fetch_assoc($resultado);

            //set
            $this->id_linea=$row['id_linea'];
            $this->nombre=$row['nombre'];
            $this->descripcion=$row['descripcion'];
            $this->nombre_cuerpo=$row['nombre_cuerpo'];
            return $row;
        }

        public function editar(){
            $sql="UPDATE linea_investigacion SET nombre='{$this->nombre}', descripcion='{$this->descripcion}',
            nombre_cuerpo='{$this->nombre_cuerpo}'
            WHERE id_linea='{$this->id_linea}'";
            $this->con->consultaSimple($sql);
            return true;
        }
    }
?>