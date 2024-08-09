<?php
    require_once('conexion.php');

    class Proyecto{
        //atributos
        private $id_proyecto_investigacion;
        private $nombre;
        private $fecha_inicio;
        private $fecha_finalizacion;
        private $descripcion;
        private $responsable;
        private $linea_aplica;
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
            $sql="SELECT * FROM proyecto_investigacion AND nombre_cuerpo='$nombre_cuerpo' ";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function filtrar($valor){
            $nombre_cuerpo=$_SESSION['nombre_cuerpo'];
            $sql="SELECT * FROM proyecto_investigacion WHERE nombre LIKE '%$valor%' AND nombre_cuerpo='$nombre_cuerpo' ";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function crear(){
            $sql="INSERT INTO proyecto_investigacion(nombre,fecha_inicio,fecha_finalizacion, descripcion, 
                responsable, linea_aplica, nombre_cuerpo)
                VALUES ('{$this->nombre}', '{$this->fecha_inicio}', '{$this->fecha_finalizacion}',
                '{$this->descripcion}', '{$this->responsable}', '{$this->linea_aplica}', '{$this->nombre_cuerpo}')";

                $this->con->consultaSimple($sql);
                return true;
        }

        public function eliminar(){
            $sql="DELETE FROM proyecto_investigacion WHERE id_proyecto_investigacion='{$this->id_proyecto_investigacion}'";
            $resultado=$this->con->consultaSimple($sql);
        }

        public function consultar(){
            $sql="SELECT * FROM proyecto_investigacion WHERE id_proyecto_investigacion='{$this->id_proyecto_investigacion}'";
            $resultado=$this->con->consultaRetorno($sql);
            $row=mysqli_fetch_assoc($resultado);

            //set
            $this->id_proyecto_investigacion=$row['id_proyecto_investigacion'];
            $this->nombre=$row['nombre'];
            $this->fecha_inicio=$row['fecha_inicio'];
            $this->fecha_finalizacion=$row['fecha_finalizacion'];
            $this->descripcion=$row['descripcion'];
            $this->responsable=$row['responsable'];
            $this->linea_aplica=$row['linea_aplica'];
            $this->nombre_cuerpo=$row['nombre_cuerpo'];
            return $row;
        }

        public function editar(){
            $sql="UPDATE proyecto_investigacion SET nombre='{$this->nombre}', fecha_inicio='{$this->fecha_inicio}',
            fecha_finalizacion='{$this->fecha_finalizacion}', descripcion='{$this->descripcion}', responsable='{$this->responsable}',
            linea_aplica='{$this->linea_aplica}', nombre_cuerpo='{$this->nombre_cuerpo}'
            WHERE id_proyecto_investigacion='{$this->id_proyecto_investigacion}'";
            $this->con->consultaSimple($sql);
            return true;
        }
    }
?>