<?php
	if($_SESSION['tipo_WS']!="Administrador"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?> 

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 pb-5">
                <div class="contenedor-formularios mb-2">
                    
                    <div class="full-box page-header">
                        <hr>
                        <h3 class="text-left">
                            <i class="fas fa-users"></i> &nbsp; Usuarios
                        </h3>
                    </div>

                    <!-- Cudros Usuarios-->
                    <div class="full-box text-center p-especial" style="padding: 20px 10px 60px 10px;">

                        <?php
                            require "./controladores/administradorControlador.php";
                            $Iadministrador = new administradorControlador();
                            $Cadministrador = $Iadministrador->datos_administrador_controlador("Conteo",0);

                            require "./controladores/estudianteControlador.php";
                            $Iestudiante = new estudianteControlador();
                            $Cestudiante = $Iestudiante->datos_estudiante_controlador("Conteo",0);

                            require "./controladores/empresaControlador.php";
                            $Iempresa = new empresaControlador();
                            $Cempresa = $Iempresa->datos_empresa_controlador("Conteo",0);
                        ?>


                        <a href="<?php echo SERVERURL; ?>administradorLista/" class="opcion-admin-users">
                            <div class="cabecera">
                                Administradores
                            </div>
                            <div class="cuerpo">
                                <div class="icono">
                                    <i class="fas fa-user-cog"></i>
                                </div>
                                <div class="texto">
                                    <p><?php echo $Cadministrador->rowCount(); ?></p>
                                    <small>Registrados</small>
                                </div>
                            </div>
                        </a>

                        <a href="<?php echo SERVERURL; ?>estudianteLista/" class="opcion-admin-users">
                            <div class="cabecera">
                                Estudiantes
                            </div>
                            <div class="cuerpo">
                                <div class="icono">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <div class="texto">
                                    <p><?php echo $Cestudiante->rowCount(); ?></p>
                                    <small>Registrados</small>
                                </div>
                            </div>
                        </a>

                        <a href="<?php echo SERVERURL; ?>empresaLista/" class="opcion-admin-users">
                            <div class="cabecera">
                                Empresas
                            </div>
                            <div class="cuerpo">
                                <div class="icono">
                                    <i class="far fa-building"></i>
                                </div>
                                <div class="texto">
                                    <p><?php echo $Cempresa->rowCount(); ?></p>
                                    <small>Registrados</small>
                                </div>
                            </div>
                        </a>

                    </div>

                    <div class="full-box page-header">
                        <h4 class="text-left" style="font-size:18px; font-weigth:600;">
                            <i class="fas fa-sign-in-alt"></i> &nbsp; Últimos inicios de sesión
                        </h4>
                    </div>

                    <!-- Time Line Login-->
                    <div class="container-fluid">
                        <section id="cd-timeline" class="cd-container">
                        <?php
                            require "./controladores/bitacoraControlador.php";

                            $insBitacora = new bitacoraControlador();

                            echo $insBitacora->listado_bitacora_controlador(10);  
                        ?>       
                        </section>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
