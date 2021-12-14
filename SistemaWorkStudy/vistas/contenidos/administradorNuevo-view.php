<?php
	if($_SESSION['tipo_WS']!="Administrador"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?> 

<!-- Breadcrumbs -->
<div class="container">
  <div class="breadcrumbs p-2">
         <a href="<?php echo SERVERURL; ?>inicioAdministrador/">Inicio</a><i class="fa fa-angle-double-right"></i><a href="<?php echo SERVERURL; ?>mantenimiento/">Mantenimiento</a><i class="fa fa-angle-double-right"></i><span>Gestión de Administradores</span>
  </div>
</div>

<section class="pb-4">
  <div class="container">
    <div class="row mb-5">
      <div class="contenedor-formularios mb-2">

          <!-- Cabecera-->
          <div class="full-box page-header">
              <hr>
              <h3 class="text-left">
                <i class="fas fa-user-cog"></i> &nbsp; Administradores 
              </h3>
              <p class="text-justify">
                En el módulo GESTIÓN DE ADMINISTRADORES usted podrá registrar los administradores que mantendrán actualizados los datos del sistema. Además de lo antes mencionado, puede actualizar los datos de los administradores, realizar búsquedas de los mismos o eliminarlos si así lo desea.
              </p>
          </div>

          <!-- Opciones-->
          <div class="container-fluid">
            <ul class="listado-panel">
                <li>
                    <a href="<?php echo SERVERURL; ?>administradorLista/" class="enlace-lista">
                        <i class="far fa-list-alt"></i> &nbsp; LISTADO
                    </a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>administradorNuevo/" class="enlace-nuevo activo2">
                        <i class="fas fa-plus"></i> &nbsp; AGREGAR
                    </a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>administradorBuscar/" class="enlace-buscar">
                        <i class="fas fa-search"></i> &nbsp; BUSCAR
                    </a>
                </li>
            </ul>
          </div>

          <!-- Formulario-->
          <div class="container">
            <div class="row">
              <div class="col-lg-12 mb-5">
                <div class="contenedor-paneles mb-5">
                  <div class="container-fluid">
                    <div class="panel panel-agregar shadow">
                      <div class="panel-heading">
                        <h3 class="panel-title">
                          <i class="fas fa-plus"></i>&nbsp; NUEVO ADMINISTRADOR
                        </h3>
                      </div>
                      <div class="panel-body">
                      <form class="FormularioAjax" data-form="save" action="<?php echo SERVERURL; ?>ajax/administradorAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                        <fieldset>
                            <legend><i class="far fa-id-badge"></i> &nbsp; Información personal</legend>
                            <div class="container-fluid pt-2">
                              <div class="row">

                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="administrador_dni">
                                      DNI <span class="asterisco">*</span>
                                    </label>
                                    <input pattern="[0-9-]{1,9}" class="form-control" type="text" name="administrador_dni_reg" required maxlength="8" minlength="8" onkeypress="return valideKey(event);" id="administrador_dni">
                                  </div>
                                </div>

                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="administrador_nombres">
                                      Nombres <span class="asterisco">*</span>
                                    </label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,80}" class="form-control" type="text" name="administrador_nombres_reg" required="" maxlength="80" id="administrador_nombres">
                                  </div>
                                </div>

                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="administrador_apellidos">
                                      Apellidos <span class="asterisco">*</span>
                                    </label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" class="form-control" type="text" name="administrador_apellidos_reg" required="" maxlength="50" id="administrador_apellidos">
                                  </div>
                                </div>

                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="administrador_telefono">
                                      Teléfono
                                    </label>
                                    <input pattern="[0-9+]{1,15}" class="form-control" type="text" name="administrador_telefono_reg" maxlength="10" minlength="6" onkeypress="return valideKey(event);" id="administrador_telefono"> 
                                  </div>
                                </div>

                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <label for="administrador_direccion">
                                      Dirección
                                    </label>
                                    <textarea name="administrador_direccion_reg" class="form-control" rows="1" maxlength="100" id="administrador_direccion"></textarea>
                                  </div>
                                </div>

                              </div>
                            </div>
                        </fieldset>

                          <br>

                          <fieldset>
                            <legend><i class="far fa-user-circle"></i> &nbsp; Datos de la cuenta</legend>
                            <div class="container-fluid pt-2">
                              <div class="row">

                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <label for="administrador_email">
                                      Correo Electrónico<span class="asterisco">*</span>
                                    </label>
                                    <input class="form-control" type="email" name="administrador_email_reg" maxlength="80" required="" id="administrador_email"> 
                                  </div>
                                </div>

                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="administrador_pass1">
                                      Contraseña <span class="asterisco">*</span>
                                    </label>
                                    <input class="form-control" type="password" name="administrador_pass1_reg" required="" maxlength="16" minlength="6" id="administrador_pass1"> 
                                  </div>
                                </div>

                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="administrador_pass2">
                                      Repita la contraseña <span class="asterisco">*</span>
                                    </label>
                                    <input class="form-control" type="password" name="administrador_pass2_reg" required="" maxlength="16" minlength="6" id="administrador_pass2"> 
                                  </div>
                                </div>

                              </div>
                            </div>
                          </fieldset>
                          <br>
                          <p class="text-center" style="margin-top: 10px;">
                            <button type="reset" class="boton-limpiar"><i class="fas fa-eraser"></i> &nbsp; Limpiar</button>
                                &nbsp; &nbsp;
                            <button type="submit" class="boton-guardar"><i class="far fa-save"></i> Guardar</button>
                          </p>
                          <p class="text-center">
                                <small style="font-size:14px">Los campos marcados con &nbsp; (<span class="asterisco">*</span>) &nbsp; son obligatorios</small>
                          </p>
                          <div class="RespuestaAjax"></div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                  
      </div>
    </div>
  </div>
</section> 