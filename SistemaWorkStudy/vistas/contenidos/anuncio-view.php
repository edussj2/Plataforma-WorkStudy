<div class="container">
    <?php 
       $datos = explode("/", $_GET['views']);

       require_once "./controladores/anuncioControlador.php";
       $classanuncio = new anuncioControlador();
   
       $filesC = $classanuncio->datos_anuncio_controlador("Unico",$datos[1]);
   
       if($filesC->rowCount()==1){
   
            $campos = $filesC->fetch();

            require_once "./controladores/materiaControlador.php";
            $classmateria = new materiaControlador();

            $filesM = $classmateria->datos_materia_controlador("Unico",mainModel::encryption($campos['idMateria']));

            $camposM = $filesM->fetch();


            require_once "./controladores/tutorControlador.php";
            $classtutor = new tutorControlador();

            $filesT = $classtutor->datos_tutor_controlador("Unico2",mainModel::encryption($campos['idTutor']));

            $camposT = $filesT->fetch();

            require_once "./controladores/estudianteControlador.php";
            $classestudiante = new estudianteControlador();

            $filesE = $classestudiante->datos_estudiante_controlador("Unico2",mainModel::encryption($camposT['idEstudiante']));

            $camposE = $filesE->fetch();

    ?>
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
         <a href="<?php echo SERVERURL; ?>anuncios/">Anuncios</a><i class="fa fa-angle-double-right"></i><span>Anuncio N° <?php echo $campos['idAnuncio'];?></span>
    </div>

    <div class="row">
        <div class="col-lg-8">
                
            <div class="detalles-anuncio-completo">
                <h2> <?php echo $campos['AnuTitulo'];?></h2>
                <div class="descripcion-anuncio">
                    <div class="descripcion-anuncio-izquierda">
                        <p><i class="fas fa-book-open"></i> &nbsp; Materia</p>
                        <p><i class="fas fa-chalkboard-teacher"></i> &nbsp; Modalidad</p>
                        <p><i class="far fa-star"></i> &nbsp; Nivel</p>
                        <p><i class="fas fa-hand-holding-usd"></i> &nbsp; Precio</p>
                        <p><i class="fas fa-credit-card"></i> &nbsp; Forma de pago</p>
                    </div>
                    <div class="descripcion-anuncio-derecha">
                        <p>:  &nbsp; <?php echo $camposM['MatNombre'];?></p>
                        <p>:  &nbsp; <?php echo $campos['AnuTipClase'];?></p>
                        <p>:  &nbsp; <?php echo $campos['AnuNivel'];?></p>
                        <p>:  &nbsp; S/  <?php echo $campos['AnuPrecio'];?> /h</p>
                        <p>:  &nbsp; <?php echo $campos['AnuPago'];?></p>
                    </div>
                </div>

                <p><?php echo $campos['AnuDescripcion'];?>.</p>

                <div class="horario-anuncio">
                    <h5><i class="fas fa-user-clock"></i> Horario Disponible</h5>
                    <div class="container-fluid mt-4">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                            
                                    <?php 
                                        require_once "./controladores/horarioControlador.php";
                                        $inshorario = new horarioControlador();
                                        echo $inshorario->paginador_horario_controlador($lc->encryption($camposT['idTutor']));
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="detalles-tutor">
                <img class="rounded-circle" src="<?php echo SERVERURL; ?>adjuntos/avatars/<?php echo $camposE['CtaFoto'];?>" alt="Foto-Perfil">
                <a href=""><h3 class="text-center"><?php echo $camposE['EstNombres'];?> <?php echo $camposE['EstApePaterno'];?> <?php echo $camposE['EstApeMaterno'];?></h3></a>
                <hr>
                <div class="caja-informacion-body">
                    <h4><i class="fas fa-school"></i> Modalidades</h4>
                    <p> &nbsp; <?php echo $camposT['TutDesplazo'];?> / <?php echo $camposT['TutOnline'];?> /<?php echo $camposT['TutDomicilio'];?></p>

                    <h4><i class="fas fa-phone"></i> Teléfono</h4>
                    <p> &nbsp; <?php echo $camposT['TutTelefono'];?></p>

                    <h4><i class="fas fa-chalkboard"></i> Experiencia</h4>
                    <p> &nbsp; <?php echo $camposT['TutExperiencia'];?></p>

                    <h4><i class="far fa-address-card"></i> Descripción</h4>
                    <p> &nbsp; <?php echo $camposT['TutDescripcion'];?>.</p>

                </div>   
            </div>


            <a class="btn btn-primary w-100 text-light text-decoration-none" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $camposT['TutTelefono'];?>&text=Hola, encontre tu anuncio de tutoría de '<?php echo $campos['AnuTitulo'];?>' en WorkStudy. Más información porfavor.">
                Contactar <i class="far fa-envelope"></i>
            </a>

            
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