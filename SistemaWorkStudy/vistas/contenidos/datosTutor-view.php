<!-- Breadcrumbs -->
<div class="container">
        <div class="breadcrumbs">
            <a href="<?php echo SERVERURL; ?>inicioEstudiante/">Inicio</a><i class="fa fa-angle-double-right"></i><a href="<?php echo SERVERURL; ?>opciones/">Funcionalidades</a><i class="fa fa-angle-double-right"></i><span>Datos de Tutor</span>
        </div>
</div>

<div class="editar-datos">
<?php

    $datos = explode("/", $_GET['views']);

    require_once "./controladores/estudianteControlador.php";
    $classestudiante = new estudianteControlador();

    $filesC = $classestudiante->datos_estudiante_controlador("Unico",$datos[1]);

    if($filesC->rowCount()==1){

        if($_SESSION['codigo_cuenta_WS']!=mainModel::decryption($datos[1])){
            echo $lc->forzar_cierre_sesion_controlador();
        }
        
        $campos = $filesC->fetch();
?>

    <ul class="nav nav-tabs opciones-data" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tutor-tab" data-toggle="tab" href="#tutor" role="tab" aria-controls="tutor" aria-selected="false">
                <i class="fas fa-user-graduate"></i> Datos de Tutor
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="horario-tab" data-toggle="tab" href="#horario" role="tab" aria-controls="horario" aria-selected="false">
                <i class="fas fa-user-clock"></i> Horarios
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="materia-tab" data-toggle="tab" href="#materia" role="tab" aria-controls="materia" aria-selected="false">
                <i class="fas fa-graduation-cap"></i> Materias
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="certificaciones-tab" data-toggle="tab" href="#certificaciones" role="tab" aria-controls="certificaciones" aria-selected="false">
                <i class="fas fa-certificate"></i> Certificaciones
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="lenguaje-tab" data-toggle="tab" href="#lenguaje" role="tab" aria-controls="lenguaje" aria-selected="false">
                <i class="fas fa-language"></i> Idiomas
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <!-- Datos de tutor -->
        <?php 
            require_once "./controladores/tutorControlador.php";
            $classtutor = new tutorControlador();

            $filesT = $classtutor->datos_tutor_controlador("Unico",mainModel::encryption($campos['idEstudiante']));
        ?>
        <div class="tab-pane fade show active" id="tutor" role="tabpanel" aria-labelledby="tutor-tab">
            <div class="container pl-5 pr-5">
        <?php 
            if($filesT->rowCount()==0){
        ?>

                <form class="FormularioAjax" data-form="save" action="<?php echo SERVERURL; ?>ajax/tutorAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">

                    <input type="hidden" name="tutor_estudiante_reg" value="<?php echo mainModel::encryption($campos['idEstudiante']);?>">

                    <fieldset class="mt-3">
                        <legend><i class="fas fa-chalkboard-teacher"></i> ¿Donde das las clases?</legend>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="tutor_domicilio" name="tutor_domicilio_reg">
                            <label class="form-check-label" for="tutor_domicilio"><i class="fas fa-home"></i> &nbsp; En mi domicilio.</label>
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="tutor_desplazo" name="tutor_desplazo_reg">
                            <label class="form-check-label" for="tutor_desplazo"><i class="fas fa-car"></i> &nbsp; Me desplazo a domicilio.</label>
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="tutor_internet" name="tutor_internet_reg">
                            <label class="form-check-label" for="tutor_internet"><i class="fas fa-laptop"></i> &nbsp; Por internet.</label>
                        </div>

                    </fieldset>

                    <fieldset class="mt-5">
                        <legend><i class="fas fa-address-card"></i> Presentate con tus posibles alumnos</legend>
                        <p class="form-text text-muted">
                            Comparte con tus posibles alumnos cómo son tus clases: metodología que sigues, contenido o dinámica de las clases, tu experiencia....
                        </p>
                        <textarea name="tutor_descripcion_reg"  rows="5" placeholder="Escribe aquí sobre tu experiencia, cualidades, métodos de enseñanza..." class="form-control mt-3"  pattern="{60,250}" required></textarea>
                        <small id="descripcionHelp" class="form-text text-muted">Caracteres (Mínimo 20 - Máximo 350).</small>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mt-3">
                                    <label for="tutor_experiencia">Experiencia dando clases <span class="asterisco">*</span></label>
                                    <select name="tutor_experiencia_reg" id="tutor_experiencia" class="form-control" required>
                                        <option value="Sin Registro" selected>Seleccione una opción</option>
                                        <option value="Sin experiencia">Sin experiencia</option>
                                        <option value="1 año">1 año</option>
                                        <option value="2 años">2 años</option>
                                        <option value="Más de 2 años">Más de 2 años</option>
                                        <option value="5 años">5 años</option>
                                        <option value="Más de 5 años">Más de 5 años</option>
                                        <option value="Más de 10 años">Más de 10 años</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mt-3">
                                    <label for="tutor_telefono">Teléfono: <span class="asterisco">*</span></label>
                                    <input type="text" name="tutor_telefono_reg" id="tutor_telefono" class="form-control" onkeypress="return valideKey(event);"  pattern="[0-9-]{1,9}" maxlength="9" minlength="6" value="<?php echo $campos['EstCelular'] ?>">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <br>
                    <p class="text-center" style="margin-top: 10px;">
                        <button type="submit" class="boton-guardar"><i class="far fa-save"></i> Registrar</button>
                    </p>
                    <div class="RespuestaAjax"></div>
                </form>

        <?php }else{
                $camposT = $filesT->fetch();
        ?>

                <form class="FormularioAjax" data-form="update" action="<?php echo SERVERURL; ?>ajax/tutorAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">

                    <input type="hidden" name="tutor_id_up" value="<?php echo mainModel::encryption($camposT['idTutor']);?>">

                    <fieldset class="mt-3">
                        <legend><i class="fas fa-chalkboard-teacher"></i> ¿Donde das las clases?</legend>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="tutor_domicilio" name="tutor_domicilio_up" <?php if($camposT['TutDomicilio']=="Clases en mi domicilio"){ echo "checked";}?>>
                            <label class="form-check-label" for="tutor_domicilio"><i class="fas fa-home"></i> &nbsp; En mi domicilio.</label>
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="tutor_desplazo" name="tutor_desplazo_up" <?php if($camposT['TutDesplazo']=="Clases a domicilio"){ echo "checked";}?>>
                            <label class="form-check-label" for="tutor_desplazo"><i class="fas fa-car"></i> &nbsp; Me desplazo a domicilio.</label>
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="tutor_internet" name="tutor_internet_up" <?php if($camposT['TutOnline']=="Clases por Internet"){ echo "checked";}?>>
                            <label class="form-check-label" for="tutor_internet"><i class="fas fa-laptop"></i> &nbsp; Por internet.</label>
                        </div>

                    </fieldset>

                    <fieldset class="mt-5">
                        <legend><i class="fas fa-address-card"></i> Presentate con tus posibles alumnos</legend>
                        <p class="form-text text-muted">
                            Comparte con tus posibles alumnos cómo son tus clases: metodología que sigues, contenido o dinámica de las clases, tu experiencia....
                        </p>
                        <textarea name="tutor_descripcion_up"  rows="5" placeholder="Escribe aquí sobre tu experiencia, cualidades, métodos de enseñanza..." class="form-control mt-3"  pattern="{60,250}" required><?php echo $camposT['TutDescripcion'];?></textarea>
                        <small id="descripcionHelp" class="form-text text-muted">Caracteres (Mínimo 20 - Máximo 350).</small> 

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mt-3">
                                    <label for="tutor_experiencia">Experiencia dando clases <span class="asterisco">*</span></label>
                                    <select name="tutor_experiencia_up" id="tutor_experiencia" class="form-control" required>
                                        <option value="Sin Registro" >Seleccione una opción</option>
                                        <option <?php if($camposT['TutExperiencia']=="Sin experiencia"){ echo "selected";}?> value="Sin experiencia">Sin experiencia</option>
                                        <option <?php if($camposT['TutExperiencia']=="1 año"){ echo "selected";}?> value="1 año">1 año</option>
                                        <option <?php if($camposT['TutExperiencia']=="2 años"){ echo "selected";}?> value="2 años">2 años</option>
                                        <option <?php if($camposT['TutExperiencia']=="Más de 2 años"){ echo "selected";}?> value="Más de 2 años">Más de 2 años</option>
                                        <option <?php if($camposT['TutExperiencia']=="5 años"){ echo "selected";}?> value="5 años">5 años</option>
                                        <option <?php if($camposT['TutExperiencia']=="Más de 5 años"){ echo "selected";}?> value="Más de 5 años">Más de 5 años</option>
                                        <option <?php if($camposT['TutExperiencia']=="Más de 10 años"){ echo "selected";}?> value="Más de 10 años">Más de 10 años</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mt-3">
                                    <label for="tutor_telefono">Teléfono: <span class="asterisco">*</span></label>
                                    <input type="text" name="tutor_telefono_up" id="tutor_telefono" class="form-control" onkeypress="return valideKey(event);"  pattern="[0-9-]{1,9}" maxlength="9" minlength="6" value="<?php echo $camposT['TutTelefono'] ?>" required>
                                </div>
                            </div>
                        </div>
                            
                    </fieldset>

                    <br>
                    <p class="text-center" style="margin-top: 10px;">
                        <button type="submit" class="boton-actualizar"><i class="fas fa-sync"></i> Actualizar</button>
                    </p>
                    <div class="RespuestaAjax"></div>
                </form>

        <?php }?>
            </div>
        </div>



        <?php 
            require_once "./controladores/tutorControlador.php";
            $classtutor2 = new tutorControlador();

            $filesT2 = $classtutor2->datos_tutor_controlador("Unico",mainModel::encryption($campos['idEstudiante']));
        ?>
        <!-- Datos Horario -->
        <div class="tab-pane fade " id="horario" role="tabpanel" aria-labelledby="horario-tab">
            <div class="container pl-5 pr-5">
        <?php 
            if($filesT2->rowCount()==0){
        ?>
                <div class="alert alert-info text-center border mt-5">
                    <i class="fas fa-info-circle" style="font-size:4rem;"></i>
                    <h4>Información Importante</h4>
                    <p>Para poder registrar sus horarios de disponibilidad como tutor, primero debe registrar sus "Datos de tutor"</p>
                </div>
        <?php }else{
                $camposTutor = $filesT2->fetch();
        ?>
                <form class="FormularioAjax mb-5" data-form="update" action="<?php echo SERVERURL; ?>ajax/horarioAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">

                    <input type="hidden" name="horario_tutor_reg" value="<?php echo mainModel::encryption($camposTutor['idTutor']);?>">

                    <fieldset class="mt-3">
                        <legend><i class="fas fa-clock"></i> ¿Cúal es tu disponibilidad horaria?</legend>
                        <p class="form-text text-muted">
                            Agrega el día y las horas que tienes disponibilidad para brindar tus servicios de tutoría, para que tus posibles alumnos tengan mayor información de tu tutoría.
                        </p>
                        
                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                                <div class="form-group mt-3">
                                    <label for="horario_dia">Día <span class="asterisco">*</span></label>
                                    <select name="horario_dia_reg" id="horario_dia" class="form-control" required>
                                        <option value="Sin Registro" >Seleccione una día</option>
                                        <option value="Lunes">Lunes</option>
                                        <option value="Martes">Martes</option>
                                        <option value="Miércoles">Miércoles</option>
                                        <option value="Jueves">Jueves</option>
                                        <option value="Viernes">Viernes</option>
                                        <option value="Sábado">Sábado</option>
                                        <option value="Domingo">Domingo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mt-3">
                                    <label for="horario_inicio">Hora Inicio: <span class="asterisco">*</span></label>
                                    <input type="time" name="horario_inicio_reg" id="horario_inicio" class="form-control"  required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mt-3">
                                    <label for="horario_fin">Hora Fin: <span class="asterisco">*</span></label>
                                    <input type="time" name="horario_fin_reg" id="horario_fin" class="form-control"  required>
                                </div>
                            </div>
                        </div>
                            
                    </fieldset>

                    <br>
                    <p class="text-center" style="margin-top: 5px;">
                        <button type="submit" class="boton-guardar"><i class="far fa-save"></i> Guardar</button>
                    </p>
                    <div class="RespuestaAjax"></div>
                </form>
                
                <hr>

                <fieldset class="mt-5">
                    <legend><i class="fas fa-calendar-alt"></i> Mi Horario</legend>
                    
                    <div class="container-fluid mt-4">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                            
                                    <?php 
                                        require_once "./controladores/horarioControlador.php";
                                        $inshorario = new horarioControlador();
                                        $inshorario->paginador_horario_controlador(mainModel::encryption($camposTutor['idTutor']));
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                        
                    
                            
                </fieldset>
        <?php }?>
            </div>
        </div>




        <!-- Datos de Materia -->
        <div class="tab-pane fade" id="materia" role="tabpanel" aria-labelledby="materia-tab">
            Materia
        </div>

        <!-- Datos Cetificaciones -->
        <div class="tab-pane fade" id="certificaciones" role="tabpanel" aria-labelledby="certificaciones-tab">
            Certificaciones
        </div>

        <!-- Datos Lenguaje -->
        <div class="tab-pane fade" id="lenguaje" role="tabpanel" aria-labelledby="lenguaje-tab">
            Lenguajes
        </div>
    </div>
<?php 
    }else{
?>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404"></div>
            <h1>Oops!</h1>
            <h2>Ocurrió un error inesperado</h2>
            <p>Hubo un problema, se recomiena recargar la página o volver al Inicio.</p>
        </div>
    </div>
<?php   
    }
?> 
</div>