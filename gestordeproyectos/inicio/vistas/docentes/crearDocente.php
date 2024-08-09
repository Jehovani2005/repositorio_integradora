<?php
$controlador = new controladorDocente();
if (isset($_POST['registrar'])) {
    $r = $controlador->crear(
        $_POST['nombre'],
        $_POST['area_adscripcion'],
        $_POST['telefono'],
        $_POST['lider'],
        $_POST['correo'],
        $_POST['contrasena'],
        $_SESSION['nombre_cuerpo']
    );
    if ($r) {
?>

        <!-- Modal de DOCENTE REGISTRADO CON EXITO -->
        <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-circle" aria-hidden="true"></i>ÉXITO</h5>
                    </div>
                    <div class="modal-body">El docente ha sido registrado exitosamente.</div>
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
                    window.location.href = '../inicio/index.php?cargar=inicioDocente';
                });
            });
        </script>
<?php

    }
}
?>



<!-- Encabezado o Titulo -->
<h1 class="h3 mb-4 text-gray-800">Registrar Docente del Cuerpo Académico: <strong><?= $_SESSION['nombre_cuerpo']?></strong></h1>
<div class="container">
    <div class="contact__wrapper shadow-lg mt-n9">
        <div class="row no-gutters justify-content-center">
            <div class="col-lg-11 contact-form__wrapper p-4">

                <form method="post" id="frmdocente" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label class="required-field" for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre completo"
                                maxlength="254"
                                pattern="[a-zA-Z\u00C0-\u017F ]{2,254}" 
                                oninvalid="this.setCustomValidity('El nombre solo debe contener letras y espacios, y tener entre 2 y 254 caracteres. Por ejemplo: Jehovani Santiago Sánchez')"  
                                oninput="this.setCustomValidity('')" autofocus required autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="area_adscripcion">Área de Adscripción</label>
                                <select class="form-control" name="area_adscripcion" id="area_adscripcion" required>
                                    <?php
                                    include '../../clases/conexion.php';
                                    $conexion = new conexion();
                                    $getarea1 = "SELECT * FROM area_adscripcion ORDER BY nombre";
                                    $getarea2 = $conexion->consultaRetorno($getarea1);

                                    while ($row = mysqli_fetch_array($getarea2)) {
                                        $id = $row['id_area'];
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
                                <label for="telefono">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ingresa los 10 dígitos" 
                                maxlength="10"
                                pattern="\d{10}" 
                                oninvalid="this.setCustomValidity('El teléfono debe contener exactamente 10 dígitos. Por ejemplo: 9197534521')"
                                oninput="this.setCustomValidity('')" 
                                required autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="lider">Líder</label>
                                <select class="form-control" name="lider" id="lider">
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label class="required-field" for="correo">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa el correo" required autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="contrasena">Contraseña</label>
                                <input type="text" class="form-control" id="contrasena" name="contrasena" placeholder="Ingresa la contraseña" 
                                maxlength="20"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!]).{8,20}"
                                oninvalid="this.setCustomValidity('La contraseña debe tener entre 8 y 20 caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial. Por ejemplo: Contra@123')"
                                oninput="this.setCustomValidity('')"
                                required autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-12 mb-3">
                            <button type="submit" name="registrar" class="btn btn-primary" value="Registrar">Registrar</button>
                        </div>

                </form>
            </div>
            <!-- End Contact Form Wrapper -->

        </div>
    </div>
</div>