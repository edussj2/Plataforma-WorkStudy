<!-- Breadcrumbs -->
<div class="container">
    <div class="breadcrumbs p-2">
            <a href="<?php echo SERVERURL; ?>inicioEstudiante/">Inicio</a><i class="fa fa-angle-double-right"></i><a href="<?php echo SERVERURL; ?>opciones/">Funcionalidades</a><i class="fa fa-angle-double-right"></i><span>Anuncio de Tutoría</span>
    </div>
</div>

<div class="crear-anuncio">
    <div class="mt-3 text-center">
        <h2><i class="fas fa-chalkboard"></i> Anuncio de tutoría</h2>
        <p>Publica un anuncio para que los usuarios se contactanten contigo y puedas generar ingresos económicos.</p>
    </div>

    <?php 
        require_once "./controladores/estudianteControlador.php";
        $classestudiante = new estudianteControlador();
    
        $filesC = $classestudiante->datos_estudiante_controlador("Unico",mainModel::encryption($_SESSION['codigo_cuenta_WS']));

        $dataEstudiante = $filesC->fetch();

        require_once "./controladores/tutorControlador.php";
        $classtutor = new tutorControlador();

        $filesT = $classtutor->datos_tutor_controlador("Unico",mainModel::encryption($dataEstudiante['idEstudiante']));

        if($filesT->rowCount()>=1){
    ?>
    <form class="FormularioAjax" data-form="save" action="<?php echo SERVERURL; ?>ajax/anuncioAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">

        <input type="hidden" name="id_cuenta" value="<?php echo mainModel::encryption($_SESSION['codigo_cuenta_WS']);?>">

        <div class="crear-anuncio-bloque">
            <p>Seleccione la modalidad:</p>
            <hr>

            <div class="radio-buttons">

                <label class="custom-radio">
                    <input type="radio" name="anuncio_tipo_clase_reg" checked  value="Online"/>
                    <span class="radio-btn">
                        <i class="far fa-check-circle"></i>
                        <div class="hobbies-icon">
                            <img src="<?php echo SERVERURL; ?>vistas/images/img/online.png" alt="">
                            <h3>Online</h3>
                        </div>
                    </span>
                </label>

                <label class="custom-radio">
                    <input type="radio" name="anuncio_tipo_clase_reg" value="Presencial"/>
                    <span class="radio-btn">
                        <i class="far fa-check-circle"></i>
                        <div class="hobbies-icon">
                            <img src="<?php echo SERVERURL; ?>vistas/images/img/presencial.png" alt="">
                            <h3>Presencial</h3>
                        </div>
                    </span>
                </label>

                <label class="custom-radio">
                    <input type="radio" name="anuncio_tipo_clase_reg" value="Semipresencial"/>
                    <span class="radio-btn">
                        <i class="far fa-check-circle"></i>
                        <div class="hobbies-icon">
                            <img src="<?php echo SERVERURL; ?>vistas/images/img/semipresencial.png" alt="">
                            <h3>SemiPresencial</h3>
                        </div>
                    </span>
                </label>

            </div>        
        </div>

        <div class="crear-anuncio-bloque">
            <p>Explique brevemente de qué y cómo da las clases:</p>
            <hr>

            <div class="form-group row pt-2">
                <label for="materia" class="col-sm-2 col-form-label">Materia <span class="asterisco">*</span> :</label>
                <div class="col-sm-6">
                    <select class="form-control selectMaterias" id="materia" name="anuncio_materia_reg" required>
                        <option value="Sin Registro" selected>Seleccione un curso</option>
                    <?php 
                        require_once "./controladores/materiaControlador.php";

                        $insmateria = new materiaControlador();

                        $doc = $insmateria->datos_materia_controlador("Select",0);

                        while ($rowD = $doc->fetch()) {
                                echo '<option value="'.$rowD['idMateria'].'">'.$rowD['MatNombre'].'</option>';                            
                        }
                    ?>
                    </select>
                </div>
            </div> 

            <div class="form-group row pt-2">
                <label for="titulo" class="col-sm-2 col-form-label">Título del anuncio <span class="asterisco">*</span> :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="titulo" placeholder="Ej: Aprende inglés de una forma divertida" name="anuncio_titulo_reg" required  maxlength="60">
                </div>
            </div>

            <div class="form-group row">
                <label for="descripcion" class="col-sm-2 col-form-label">Descripción <span class="asterisco">*</span> :</label>
                <div class="col-sm-10">
                    <textarea name="anuncio_descripcion_reg" id="" rows="5" class="form-control" required pattern="{10,400}" maxlength="400"></textarea>
                    <small id="descripcionHelp" class="form-text text-muted">Caracteres (Mínimo 80 - Máximo 400).</small>
                </div>
            </div> 

        </div>

        <div class="crear-anuncio-bloque">
            <p>Más detalles del anuncio:</p>
            <hr>

            <div class="form-group row pt-2">
                <label for="precio" class="col-sm-3 col-form-label">Precio por hora <span class="asterisco">*</span> :</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="precio" placeholder="0.00" name="anuncio_precio_reg" required pattern="[0-9.]{1,15}" maxlength="15">
                </div>
            </div>

            <div class="form-group row pt-2">
                <label for="pago" class="col-sm-3 col-form-label">Forma de pago <span class="asterisco">*</span> :</label>
                <div class="col-sm-4">
                    <select name="anuncio_pago_reg" id="pago" class="form-control" required>
                    <option value="Sin Registro" selected>Seleccione una opción</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Pago a través de dispositivo móvil">Pago a través de dispositivo móvil</option>
                        <option value="Moneda Virtual">Moneda Virtual</option>
                    </select>
                </div>
            </div> 

            <div class="form-group row">
                <label for="para" class="col-sm-3 col-form-label">Dirigido <span class="asterisco">*</span> :</label>
                <div class="col-sm-4">
                    <select name="anuncio_para_reg" id="para" class="form-control" required>
                    <option value="Sin Registro" selected>Seleccione una opción</option>
                        <option value="Público en general">Público en general</option>
                        <option value="Niños">Niños</option>
                        <option value="Jóvenes">Jóvenes</option>
                        <option value="Profesionales">Profesionales</option>
                    </select>
                </div>
            </div> 

            <div class="form-group row">
                <label for="nivel" class="col-sm-3 col-form-label">Nivel de la Tutoría <span class="asterisco">*</span> :</label>
                <div class="col-sm-4">
                    <select name="anuncio_nivel_reg" id="nivel" class="form-control" required>
                        <option value="Sin Registro" selected>Seleccione una opción</option>
                        <option value="Básico">Básico</option>
                        <option value="Intermedio">Intermedio</option>
                        <option value="Avanzado">Avanzado</option>
                    </select>
                </div>
            </div> 

        </div>

        <br>
        <p class="text-center" style="margin-top: 10px;">
            <button type="submit" class="boton-guardar"><i class="far fa-save"></i> Guardar</button>
        </p>
        <p class="text-center">
            <small style="font-size:14px">Los campos marcados con &nbsp; (<span class="asterisco">*</span>) &nbsp; son obligatorios</small>
        </p>
        <div class="RespuestaAjax"></div>
    </form>
    <?php 
        }else{
    ?>
    <div class="alert alert-info text-center border mt-5">
        <i class="fas fa-info-circle" style="font-size:4rem;"></i>
        <h4>Información Importante</h4>
        <p>Para poder hacer anuncios de tutoría, debe completar sus datos haciendo <strong><a href="<?php echo SERVERURL;?>datosTutor/<?php echo mainModel::encryption($_SESSION['codigo_cuenta_WS'])?>/">clic aquí</a></strong></p>
    </div>
    <?php
        }
    ?>
</div>

<script>
    $(document).ready(function() {
        $('.selectMaterias').select2();
    });
</script>