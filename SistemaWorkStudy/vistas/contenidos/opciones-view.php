<div class="container">
    <div class="mt-5 pb-3 text-center">
        <h2><i class="fas fa-edit"></i> Funcionalidades de Workstudy</h2>
        <p>Aprovecha las distintas funcionalidades que te ofrece Workstudy para generar ingresos económicos a través de la publicación de anuncios de tutoría, publicación de la venta de cursos y proyectos, todo a través de la misma plataforma.</p>
    </div>
</div>
<?php 
    require_once "./controladores/estudianteControlador.php";
    $classestudiante = new estudianteControlador();
    
    $filesC = $classestudiante->datos_estudiante_controlador("Unico",mainModel::encryption($_SESSION['codigo_cuenta_WS']));

    $datosEst = $filesC->fetch();
?>

<div class="container mt-5">

    <!-- Content Row -->
    <div class="row pb-2">

        <div class="col-lg-4 mb-4">
                <!-- Tarjtea -->
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-graduation-cap"></i> Mis datos de Tutor</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo SERVERURL; ?>vistas/images/img/tutor.svg" alt="">
                        </div>
                        <!-- Datos de tutor -->
                        <?php 
                            require_once "./controladores/tutorControlador.php";
                            $classtutor = new tutorControlador();

                            $filesT = $classtutor->datos_tutor_controlador("Unico",mainModel::encryption($datosEst['idEstudiante']));

                            if($filesT->rowCount()>=1){
                        ?>

                        <p>Maten actualizado tus datos como tutor, para que tus alumnos conozcan más sobre tu desempeño.</p>
                        <a class="enlace-funcionalidad" href="<?php echo SERVERURL; ?>datosTutor/<?php echo $lc->encryption($_SESSION['codigo_cuenta_WS'])?>/">Actualizar Datos &rarr;</a>

                        <?php }else{?>

                        <p>Registrate como tutor, para poder crear anuncios de tutoría y poder ganar dinero brindado este servicio.</p>
                        <a class="enlace-funcionalidad" href="<?php echo SERVERURL; ?>datosTutor/<?php echo $lc->encryption($_SESSION['codigo_cuenta_WS'])?>/">Registrar Datos &rarr;</a>

                        <?php }?>
                    </div>
                </div>
        </div>

        <div class="col-lg-4 mb-4">
                <!-- Tarjtea -->
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-readme"></i> Crear Anuncio de Tutoría</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 13rem;" src="<?php echo SERVERURL; ?>vistas/images/img/anuncio.svg" alt="">
                        </div>
                        <p>Crea anuncios de tutoría de una materia, para que se comuniquen contigo y puedan contratar tus servicios.</p>
                        <a class="enlace-funcionalidad" href="<?php echo SERVERURL; ?>anuncioNuevo/">Nuevo Anuncio &rarr;</a>
                    </div>
                </div>
        </div>

        <div class="col-lg-4 mb-4">
                <!-- Tarjtea -->
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-book-open"></i> Publicar Curso</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 13.5rem;" src="<?php echo SERVERURL; ?>vistas/images/img/curso.svg" alt="">
                        </div>
                        <p>Crea contenido educativo y publicalo para su venta a los estudiantes interesados en dichos temas.</p>
                        <a class="enlace-funcionalidad" href="<?php echo SERVERURL; ?>cursoNuevo/">Crear Curso &rarr;</a>
                    </div>
                </div>
        </div>

    </div>
    
    <hr> 
    
    <?php include "./vistas/modulos/footer.php" ?>

</div>