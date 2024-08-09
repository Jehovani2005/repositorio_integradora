<?php
$controlador = new controladorProyecto();
if (isset($_POST['registrar'])) {
    $r = $controlador->crear(
        $_POST['nombre'],
        $_POST['fecha_inicio'],
        $_POST['fecha_finalizacion'],
        $_POST['descripcion'],
        $_POST['responsable'],
        $_POST['linea_aplica'],
        $_SESSION['nombre_cuerpo']
    );
    if ($r) {
?>

        <!-- Modal de PROYECTO DE INVESTIGACION REGISTRADO CON EXITO -->
        <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-circle" aria-hidden="true"></i>ÉXITO</h5>
                    </div>
                    <div class="modal-body">El Proyecto de Investigación ha sido registrado exitosamente.</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal" id="aceptarBtn">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            /*
                 Este script es para que se ejecute
                el modal, acuerdate de cambiar por
                el nombre del modal
                */
            $(document).ready(function() {
                $('#registroModal').modal('show');
                $('#aceptarBtn').on('click', function() {
                    window.location.href = '../inicio/?cargar=inicioProyecto';
                });
            });
        </script>
<?php

    }
}
?>



<!-- Encabezado o Titulo -->
<h1 class="h3 mb-4 text-gray-800">Registrar Proyecto de Investigación del Cuerpo Académico: <strong><?= $_SESSION['nombre_cuerpo']?></strong></h1>
<div class="container">
    <div class="contact__wrapper shadow-lg mt-n9">
        <div class="row no-gutters justify-content-center">
            <div class="col-lg-11 contact-form__wrapper p-4">

                <form action="" method="post" id="frmproyecto" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label class="required-field" for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre del Proyecto de Investigacion" autofocus 
                                    maxlength="254"
                                    pattern=".{5,254}" 
                                    oninvalid="this.setCustomValidity('El nombre debe tener entre 5 y 254 caracteres.')"
                                    oninput="this.setCustomValidity('')"
                                    required autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Ingresa la fecha de inicio"
                                    oninvalid="this.setCustomValidity('Por favor ingresa una fecha válida.')"
                                    oninput="this.setCustomValidity('')"
                                    required>
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="fecha_finalizacion">Fecha de Finalizacion</label>
                                <input type="date" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" placeholder="Ingresa la fecha de finalizacion"
                                    oninvalid="this.setCustomValidity('La fecha de finalización debe ser posterior a la fecha de inicio.')"
                                    oninput="this.setCustomValidity('')"
                                    required>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label class="required-field" for="descripcion">Descripción</label>
                                <textarea type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingresa la descripcion del Proyecto de Investigacion"
                                    maxlength="254"
                                    pattern=".{10,254}" 
                                    oninvalid="this.setCustomValidity('La descripción debe tener entre 10 y 254 caracteres.')"
                                    oninput="this.setCustomValidity('')" 
                                    required autocomplete="off"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="responsable">Responsable</label>
                                <select class="form-control" name="responsable" id="responsable" required>
                                    <?php
                                    include '../../clases/conexion.php';
                                    $conexion = new conexion();
                                    $nombre_cuerpo=$_SESSION['nombre_cuerpo'];
                                    $getres1 = "SELECT * FROM docentes WHERE nombre_cuerpo='$nombre_cuerpo'ORDER BY nombre";
                                    $getres2 = $conexion->consultaRetorno($getres1);

                                    while ($row = mysqli_fetch_array($getres2)) {
                                        $id = $row['id_docente'];
                                        $nombre = $row['nombre'];

                                    ?>
                                        <option value="<?php echo $nombre; ?>"><?php echo $nombre; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="linea_aplica">Linea que Aplica</label>
                                <select class="form-control" name="linea_aplica" id="linea_aplica" required>
                                    <?php
                                    include '../../clases/conexion.php';
                                    $conexion = new conexion();
                                    $nombre_cuerpo=$_SESSION['nombre_cuerpo'];
                                    $getlin1 = "SELECT * FROM linea_investigacion WHERE nombre_cuerpo='$nombre_cuerpo'ORDER BY nombre";
                                    $getlin2 = $conexion->consultaRetorno($getlin1);

                                    while ($row = mysqli_fetch_array($getlin2)) {
                                        $id = $row['id_linea'];
                                        $nombre = $row['nombre'];

                                    ?>
                                        <option value="<?php echo $nombre; ?>"><?php echo $nombre; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-3">
                            <button type="submit" name="registrar" class="btn btn-primary" value="Registrar">Registrar</button>
                        </div>

                </form>

                <!-- ESTE SCRIPT ES PARA QUE VALIDE QUE SE INSERTE UNA FECHA DE FINALIZACION
                    CORRECTA YA QUE DEBE DE SER POSTERIOR A LA FECHA DE INICIO -->
                    <script>
        document.getElementById('frmproyecto').addEventListener('submit', function(event) {
            const startDate = document.getElementById('fecha_inicio').value;
            const endDate = document.getElementById('fecha_finalizacion').value;

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);

                if (end <= start) {
                    const endDateInput = document.getElementById('fecha_finalizacion');
                    endDateInput.setCustomValidity('La fecha de finalización debe ser posterior a la fecha de inicio.');
                    endDateInput.reportValidity();
                    event.preventDefault();
                }
            }
        });

        document.getElementById('fecha_finalizacion').addEventListener('input', function() {
            this.setCustomValidity('');
        });
    </script>

            </div>
            <!-- End Contact Form Wrapper -->

        </div>
    </div>
</div>