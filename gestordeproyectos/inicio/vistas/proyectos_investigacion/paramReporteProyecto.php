<!-- Encabezado o Titulo -->
<h1 class="h3 mb-4 text-gray-800">Reporte de Proyectos de Investigación por Año de Inicio</h1>
<div class="container">
    <div class="contact__wrapper shadow-lg mt-n9">
        <div class="row no-gutters justify-content-center">
            <div class="col-lg-11 contact-form__wrapper p-4">

                <form action="" method="post" id="frmproyecto" enctype="multipart/form-data" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="fecha">Año de Inicio</label>
                                <select class="form-control" name="fecha" id="fecha" required>
                                    <?php
                                    include '../../clases/conexion.php';
                                    $conexion = new conexion();
                                    $nombre_cuerpo=$_SESSION['nombre_cuerpo'];
                                    $getfecha1 = "SELECT YEAR(fecha_inicio) AS fecha_inicio 
                                                FROM proyecto_investigacion WHERE nombre_cuerpo='$nombre_cuerpo' 
                                                ORDER BY fecha_inicio;";
                                    $getfecha2 = $conexion->consultaRetorno($getfecha1);

                                    while ($row = mysqli_fetch_array($getfecha2)) {
                                        $id = $row['id_proyecto_investigacion'];
                                        $fecha = $row['fecha_inicio'];

                                    ?>
                                        <option value="<?php echo $fecha; ?>"><?php echo $fecha; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-3">
                            <button class="btn btn-primary" onClick="abrirReporte()">Obtener Reporte</button>
                        </div>

                </form>
            </div>
            <!-- End Contact Form Wrapper -->

        </div>
    </div>
</div>

<script>
    function abrirReporte() {
        clas = document.getElementById('clas');
        window.open("../fpdf/reporte_parametro.php?fecha="+fecha.value,"Reporte por Año","directories=no location=no");
    }
</script>