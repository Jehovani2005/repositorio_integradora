<?php
    require_once('conexion.php');

    class Produccion{
        //atributos
        private $id_producciones_academicas;
        private $nombre;
        private $fecha_publicacion;
        private $proyec_inv_gen;
        private $tipo;
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
            $sql="SELECT * FROM producciones_academicas AND nombre_cuerpo='$nombre_cuerpo' ";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function filtrar($valor){
            $nombre_cuerpo=$_SESSION['nombre_cuerpo'];
            $sql="SELECT * FROM producciones_academicas WHERE nombre LIKE '%$valor%' AND nombre_cuerpo='$nombre_cuerpo' ";
            $resultado=$this->con->consultaRetorno($sql);
            return $resultado;
        }

        public function crear(){
            $sql="INSERT INTO producciones_academicas(nombre,fecha_publicacion,proyec_inv_gen,tipo, nombre_cuerpo)
                VALUES ('{$this->nombre}', '{$this->fecha_publicacion}', '{$this->proyec_inv_gen}',
                 '{$this->tipo}', '{$this->nombre_cuerpo}')";

                $this->con->consultaSimple($sql);
                return true;
        }

        public function eliminar(){
            $sql="DELETE FROM producciones_academicas WHERE id_producciones_academicas='{$this->id_producciones_academicas}'";
            $resultado=$this->con->consultaSimple($sql);
        }

        public function consultar(){
            $sql="SELECT * FROM producciones_academicas WHERE id_producciones_academicas='{$this->id_producciones_academicas}'";
            $resultado=$this->con->consultaRetorno($sql);
            $row=mysqli_fetch_assoc($resultado);

            //set
            $this->id_producciones_academicas=$row['id_producciones_academicas'];
            $this->nombre=$row['nombre'];
            $this->fecha_publicacion=$row['fecha_publicacion'];
            $this->proyec_inv_gen=$row['proyec_inv_gen'];
            $this->tipo=$row['tipo'];
            $this->nombre_cuerpo=$row['nombre_cuerpo'];
            return $row;
        }

        public function editar(){
            $sql="UPDATE producciones_academicas SET nombre='{$this->nombre}', fecha_publicacion='{$this->fecha_publicacion}',
            proyec_inv_gen='{$this->proyec_inv_gen}', tipo='{$this->tipo}', nombre_cuerpo='{$this->nombre_cuerpo}'
            WHERE id_producciones_academicas='{$this->id_producciones_academicas}'";
            $this->con->consultaSimple($sql);
            return true;
        }
    }
?>