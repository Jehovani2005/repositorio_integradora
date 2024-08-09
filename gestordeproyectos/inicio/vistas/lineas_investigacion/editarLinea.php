<?php
    $controlador=new controladorLinea();
    if(isset($_GET['id_linea'])){
        $row=$controlador->consultar($_GET['id_linea']);
    }else{
        header('Location: index.php');
    }
    if(isset($_POST['registrar'])){
        $r=$controlador->editar($_GET['id_linea'], $_POST['nombre'], $_POST['descripcion'], $_SESSION['nombre_cuerpo']);

        if($r){?>

                <!-- Modal de LINEA DE INVESTIGACION MODIFICADO CON EXITO -->
        <div class="modal fade" id="modificarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-circle" aria-hidden="true"></i>ÉXITO</h5>
                    </div>
                    <div class="modal-body">La linea de investigación ha sido modificado exitosamente.</div>
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
            el nombre del modal.
            Y tambien es para redireccionamiento
            */
            $(document).ready(function() {
                $('#modificarModal').modal('show');
                $('#aceptarBtn').on('click', function() {
                    window.location.href = '../inicio/index.php?cargar=inicioLinea';
                });
            });
        </script>
           <?php 
        }
    }
?>

<!-- Encabezado o Titulo -->
<h1 class="h3 mb-4 text-gray-800">Modificar Linea de Investigación del Cuerpo Académico: <strong><?= $_SESSION['nombre_cuerpo']?></strong></h1>
<div class="container">
    <div class="contact__wrapper shadow-lg mt-n9">
        <div class="row no-gutters justify-content-center">
            <div class="col-lg-11 contact-form__wrapper p-4">

            <!--En este form hay que modificar los nombres de cada input
            para que no se vaya a confundir, mejor si se le pone el nombre
            como esta en la base de datos, tambien hay que modificar el VALUE
            ya que deben de aparecer los datos que se hayan recogido, hay que
            modificarlo con los nombres en los que estan en la base de datos para no errarle-->
            <form action=""method="post" id="frmeditar_linea" class="contact-form">
            <div class="row">
                <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label class="required-field" for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" placeholder="Ingresa el nombre de la Linea de Investigación" 
                                maxlength="254" 
                                pattern=".{5,254}" 
                                oninvalid="this.setCustomValidity('El nombre solo debe contener entre 5 y 254 caracteres.')" 
                                oninput="this.setCustomValidity('')" autofocus required autocomplete="off">
                            </div>
                        </div>

                <div class="col-sm-12 mb-3">
                    <div class="form-group">
                        <label class="required-field" for="descripcion">Descripción</label>
                        <textarea type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingresa la descripcion de la Linea de Investigación"
                            maxlength="254"
                            pattern=".{10,254}" 
                            oninvalid="this.setCustomValidity('La descripción debe tener entre 10 y 254 caracteres.')"
                            oninput="this.setCustomValidity('')" 
                            required autocomplete="off"><?php echo $row['descripcion'];?></textarea>
                    </div>
                </div>
                
                <div class="col-sm-12 mb-3">
                    <button type="submit" name="registrar" class="btn btn-primary" value="Registrar" >Modificar</button>
                </div>

            </form>
            </div>
                                    <!-- End Contact Form Wrapper -->

                                </div>
                            </div>
                        </div>