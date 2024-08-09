<?php
    class enrutador{
        public function cargarVista($vista){
            if(@$_SESSION['validada']== 1){
                switch($vista){
                    case "crearDocente":
                        include_once('vistas/docentes/'. $vista .'.php');
                        break;
                    
                    case "editarDocente":
                        include_once('vistas/docentes/'. $vista .'.php');
                        break;

                    case "consultaParametro":
                        include_once('vistas/docentes/'. $vista .'.php');
                        break;

                    case "eliminarDocente":
                        include_once('vistas/docentes/'. $vista .'.php');
                        break;

                    case "inicioDocente":
                        include_once('vistas/docentes/'. $vista .'.php');
                        break;

                    case "crearLinea":
                        include_once('vistas/lineas_investigacion/'. $vista .'.php');
                        break;
                    
                    case "editarLinea":
                        include_once('vistas/lineas_investigacion/'. $vista .'.php');
                        break;

                    case "consultaParametro":
                        include_once('vistas/lineas_investigacion/'. $vista .'.php');
                        break;

                    case "eliminarLinea":
                        include_once('vistas/lineas_investigacion/'. $vista .'.php');
                        break;

                    case "inicioLinea":
                        include_once('vistas/lineas_investigacion/'. $vista .'.php');
                        break;

                    case "crearProyecto":
                        include_once('vistas/proyectos_investigacion/'. $vista .'.php');
                        break;
                    
                    case "editarProyecto":
                        include_once('vistas/proyectos_investigacion/'. $vista .'.php');
                        break;

                    case "consultaParametro":
                        include_once('vistas/proyectos_investigacion/'. $vista .'.php');
                        break;

                    case "eliminarProyecto":
                        include_once('vistas/proyectos_investigacion/'. $vista .'.php');
                        break;

                    case "inicioProyecto":
                        include_once('vistas/proyectos_investigacion/'. $vista .'.php');
                        break;

                    case "paramReporteProyecto":
                        include_once('vistas/proyectos_investigacion/'. $vista .'.php');
                        break;
                        
                    case "crearApartado":
                        include_once('vistas/apartados/'. $vista .'.php');
                        break;

                    case "inicioApartado":
                        include_once('vistas/apartados/'. $vista .'.php');
                        break;

                    case "crearProduccion":
                        include_once('vistas/producciones_academicas/'. $vista .'.php');
                        break;
                    
                    case "editarProduccion":
                        include_once('vistas/producciones_academicas/'. $vista .'.php');
                        break;

                    case "consultaParametro":
                        include_once('vistas/producciones_academicas/'. $vista .'.php');
                        break;

                    case "eliminarProduccion":
                        include_once('vistas/producciones_academicas/'. $vista .'.php');
                        break;

                    case "inicioProduccion":
                        include_once('vistas/producciones_academicas/'. $vista .'.php');
                        break;

                    case "cerrar":
                        $this->cerrarSesion();
                        echo "
                        <script languaje='JavaScript'>
                        
                        window.location.href='../iniciosesion.php';
                        </script>";
                        break;
                    
                    default:
                        include_once('vistas/error.php');
                }
            }else{
                include_once('../iniciosesion.php');
            }
        }

        private function cerrarSesion() {
            $con = new Conexion();
            if (isset($_SESSION['id_docente'])) {
                $id_docente = $_SESSION['id_docente'];
                $sql = "UPDATE docentes SET activo=0 WHERE id_docente='$id_docente'";
                $con->consultaSimple($sql);
            }
            session_destroy();
        }

        public function validarGet($variable){
            if(isset($variable)){
                return true;
            }else{
                if(@$_SESSION['validada'] == 1)
                    include_once('vistas/docentes/inicioDocente.php');
                
                else
                echo "
                <script languaje='JavaScript'>
                
                window.location.href='../iniciosesion.php';
                </script>";
                
            }
        }
    }
?>