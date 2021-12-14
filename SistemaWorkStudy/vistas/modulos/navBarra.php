<?php 
    $hora = date('H:i',time());
?>
<div class="barra-superior">

    <!-- Saludos de Buenas Horas y Logo en responsive-->
    <div class="nav-bar-izquierda">
        <?php if($hora >= "12:30" && $hora <= "18:30"){?>

            <h3>
                <span style="color: #b4cbd9"><i class="fas fa-cloud"></i></span> Buenas Tardes <?php echo ucwords($_SESSION['nombre_WS']);?>
            </h3>

        <?php }elseif($hora >"18:30" && $hora <= "24:00"){?>

            <h3>
                <span style="color: #e3e3d0"><i class="fas fa-moon"></i></span> Buenas Noches <?php echo ucwords($_SESSION['nombre_WS']);?>
            </h3>

        <?php }else{?>

            <h3>
                <span style="color: rgb(240, 221, 56);"><i class="far fa-sun"></i></span> Buenas Días <?php echo ucwords($_SESSION['nombre_WS']);?>
            </h3>

        <?php }?>
        <img src="<?php echo SERVERURL; ?>vistas/images/img/logoRectangulo.png" class="d-none logo-superior">
    </div>
                
    <!-- Opciones derecha -->
    <div class="nav-bar-derecha">
        
        <?php if($_SESSION['tipo_WS']== "Estudiante"){?>

        <div class="opcion">
            <a href="<?php echo SERVERURL; ?>opciones/" data-toggle="tooltip" data-placement="bottom" title="Funcionalidades"><i class="fas fa-edit"></i></a>
        </div>
        <?php }else{?>

        <div class="opcion">
            <a href="<?php echo SERVERURL;?>notificaciones/" data-toggle="tooltip" data-placement="bottom" title="Notificaciones"><i class="far fa-bell"></i></a>
        </div>

        <?php } ?>

        <!-- Buscar -->
        <div class="opcion">
            <a href="<?php echo SERVERURL;?>busqueda/" data-toggle="tooltip" data-placement="bottom" title="¿Quieres buscar algo?"><i class="fas fa-search"></i></a>
        </div>

        <!--Perfil-->
        <div class="opcion">
            <div class="action-icon-profile">

                <div class="icon-profile" onclick="menuPerfilHome();">
                    <img src="<?php echo SERVERURL; ?>adjuntos/avatars/<?php echo $_SESSION['avatar_WS']; ?>" alt="">
                </div>

                <div class="menu-icon-profile">

                    <div class="d-flex align-items-center mt-1">
                        <div class="imagen-icon-profile">
                            <img src="<?php echo SERVERURL; ?>adjuntos/avatars/<?php echo $_SESSION['avatar_WS']; ?>" alt="">
                        </div>
                        <div class="d-flex flex-column descripcion-icon-profile">
                            <?php if($_SESSION['tipo_WS']=="Empresa"){ ?>
                                <h5 class="font-weight-bold"><?php echo ucwords($_SESSION['apellidos_WS']);?> </h5>
                            <?php }else{ ?>
                                <h5 class="font-weight-bold"><?php echo ucwords($_SESSION['nombre_WS'])." ".ucwords($_SESSION['apellidos_WS']);?> </h5>
                            <?php }?>
                                <div class="text-muted"><?php echo $_SESSION['tipo_WS'];?></div>
                                <p><i class="fas fa-envelope"></i> <?php echo substr($_SESSION['correo_WS'],0,23);?></p>
                                <a href="<?php echo $lc->encryption($_SESSION['token_WS']);?>" class="btn-cerrar-sesion"><i class="fas fa-sign-out-alt" style="color:#fff"></i> Salir</a> 
                        </div>
                    </div>

                    <hr class="mb-1">

                    <div class="lista-opciones">

                            <a href="#" class="opcion-sub-perfil">
                                <div class="link-opcion">
                                    <div class="simbolo-opcion">
                                        <i class="fas fa-user-circle" style="color:#1bc5bd;"></i>
                                    </div>
                                    <div class="texto-opcion">
                                        <div class="texto-opcion-principal">
                                            Mi Perfil
                                        </div>
                                        <div class="texto-opcion-descripcion">
                                            Mi información General.
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="" class="opcion-sub-perfil">
                                <div class="link-opcion">
                                    <div class="simbolo-opcion">
                                        <i class="fas fa-sliders-h"  style="color:#3699ff;"></i>
                                    </div>
                                    <div class="texto-opcion">
                                        <div class="texto-opcion-principal">
                                            Configuración 
                                        </div>
                                        <div class="texto-opcion-descripcion">
                                            Actualizar contraseña, correo, foto.
                                        </div>
                                    </div>
                                </div>
                            </a>

                        <?php if($_SESSION['tipo_WS']== "Estudiante"){?>

                            <a href="#" class="opcion-sub-perfil">
                                <div class="link-opcion">
                                    <div class="simbolo-opcion">
                                        <i class="fas fa-book-open" style="color:#ffa800;"></i>
                                    </div>
                                    <div class="texto-opcion">
                                        <div class="texto-opcion-principal">
                                            Mi Contenido
                                        </div>
                                        <div class="texto-opcion-descripcion">
                                            Proyectos, anuncios y cursos.
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>