        <!-- Barra lateral en pantalla grande-->
        <div class="l-navbar" id="navbar">
            <nav class="nav">
                <div>
                    <div class="nav__brand">
                        <i class="fas fa-bars nav__toggle" id="nav-toggle"></i>
                        <a href="#" class="nav__logo">Workstudy</a>
                    </div>
                    <div class="nav__list">
                    <?php if($_SESSION['tipo_WS']== "Estudiante"){?>

                        <a href="<?php echo SERVERURL; ?>inicioEstudiante/" class="nav__link">
                            <i class="fas fa-home nav__icon"></i>
                            <span class="nav__name">Inicio</span>
                        </a>

                        <a href="<?php echo SERVERURL; ?>publicaciones/" class="nav__link">
                            <i class="fas fa-newspaper nav__icon"></i>
                            <span class="nav__name">Publicaciones</span>
                        </a>

                        <a href="<?php echo SERVERURL; ?>cursos/all/" class="nav__link">
                            <i class="fas fa-book nav__icon"></i>
                            <span class="nav__name">Cursos</span>
                        </a>
    
                        <a href="<?php echo SERVERURL; ?>ofertas/all/" class="nav__link">
                            <i class="fas fa-briefcase nav__icon"></i>
                            <span class="nav__name">Ofertas</span>
                        </a>

                        <a href="<?php echo SERVERURL; ?>anuncios/" class="nav__link">
                            <i class="fas fa-chalkboard-teacher nav__icon"></i>
                            <span class="nav__name">Tutorias</span>
                        </a>

                    <?php }elseif($_SESSION['tipo_WS']== "Empresa"){?>

                        <a href="<?php echo SERVERURL; ?>inicioEmpresa/" class="nav__link">
                            <i class="fas fa-tachometer-alt nav__icon"></i>
                            <span class="nav__name">Inicio</span>
                        </a>

                        <a href="<?php echo SERVERURL; ?>/" class="nav__link">
                            <i class="fas fa-clipboard-list nav__icon"></i>
                            <span class="nav__name">Mis Ofertas</span>
                        </a>

                        <a href="<?php echo SERVERURL; ?>ofertaNew/" class="nav__link">
                            <i class="fas fa-briefcase nav__icon"></i>
                            <span class="nav__name">Nueva Oferta</span>
                        </a>

                        <a href="<?php echo SERVERURL; ?>/" class="nav__link">
                            <i class="fas fa-id-card-alt nav__icon"></i>
                            <span class="nav__name">Selección</span>
                        </a>

                        <a href="<?php echo SERVERURL; ?>/" class="nav__link">
                            <i class="fas fa-file-alt nav__icon"></i>
                            <span class="nav__name">Contratos</span>
                        </a>

                    <?php }elseif($_SESSION['tipo_WS']== "Administrador"){?>

                        <a href="<?php echo SERVERURL; ?>inicioAdministrador/" class="nav__link">
                            <i class="fas fa-tachometer-alt nav__icon"></i>
                            <span class="nav__name">Inicio</span>
                        </a>

                        <a href="<?php echo SERVERURL; ?>mantenimiento/" class="nav__link">
                            <i class="fas fa-tasks nav__icon"></i>
                            <span class="nav__name">Mantenimiento</span>
                        </a>

                        <a href="<?php echo SERVERURL; ?>usuarios/" class="nav__link">
                            <i class="fas fa-users nav__icon"></i>
                            <span class="nav__name">Usuarios</span>
                        </a>

                        <a href="<?php echo SERVERURL; ?>pagina/" class="nav__link">
                            <i class="fas fa-desktop nav__icon"></i>
                            <span class="nav__name">Página</span>
                        </a>

                        <a href="<?php echo SERVERURL; ?>reportes/" class="nav__link">
                            <i class="fas fa-file-medical-alt nav__icon"></i>
                            <span class="nav__name">Reportes</span>
                        </a>

                    <?php } ?>
                    </div>
                </div>
    
                <a href="<?php echo $lc->encryption($_SESSION['token_WS']);?>" class="btn-cerrar-sesion nav__link">
                    <i class="fas fa-sign-out-alt nav__icon"></i>
                    <span class="nav__name">Salir</span>
                </a> 
            </nav>
        </div>

        <!-- Barra inferior en celular -->
        <nav class="navbar fixed-bottom barra-inferior d-none">

                <div class="opciones-barra-inferior">
                <?php if($_SESSION['tipo_WS']== "Estudiante"){?>

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>inicioEstudiante/">
                            <i class="fas fa-home"></i>
                            <p>Inicio</p>
                        </a>
                    </div>

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>publicaciones/">
                            <i class="fas fa-newspaper"></i>
                            <p>Publicaciones</p>
                        </a>
                    </div>

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>cursos/all/">
                            <i class="fas fa-book"></i>
                            <p>Cursos</p>
                        </a>
                    </div>

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>ofertas/all/">
                            <i class="fas fa-briefcase"></i>
                            <p>Ofertas</p>
                        </a>
                    </div>

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>anuncios/">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Tutores</p>
                        </a>
                    </div>

                <?php }elseif($_SESSION['tipo_WS']== "Empresa"){?>

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>inicioEmpresa/">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>Inicio</p>
                        </a>
                    </div> 

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>/">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Mis Ofertas</p>
                        </a>
                    </div>

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>ofertaNew/">
                            <i class="fas fa-briefcase"></i>
                            <p>Nueva Oferta</p>
                        </a>
                    </div>

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>/">
                            <i class="fas fa-id-card-alt"></i>
                            <p>Selección</p>
                        </a>
                    </div>

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>/">
                            <i class="fas fa-file-alt"></i>
                            <p>Contratos</p>
                        </a>
                    </div>

                <?php }elseif($_SESSION['tipo_WS']== "Administrador"){?> 

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>inicioAdministrador/">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>Inicio</p>
                        </a>
                    </div>

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>mantenimiento/">
                            <i class="fas fa-tasks"></i>
                            <p>Mantenimiento</p>
                        </a>
                    </div>
                    
                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>usuarios/">
                            <i class="fas fa-users"></i>
                            <p>Usuarios</p>
                        </a>
                    </div>

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>pagina/">
                            <i class="fas fa-desktop"></i>
                            <p>Página</p>
                        </a>
                    </div>

                    <div class="opcion-barra-inferior">
                        <a href="<?php echo SERVERURL; ?>reportes/">
                            <i class="fas fa-file-medical-alt"></i>
                            <p>Reportes</p>
                        </a>
                    </div>

                <?php } ?>
                </div>
            
        </nav>
        