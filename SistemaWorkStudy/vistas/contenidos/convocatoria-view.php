<?php
	if($_SESSION['tipo_WS']!="Empresa"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?> 

<section class="pb-4">
  <div class="container">
    <div class="row mb-5">
      <div class="contenedor-formularios mb-2">

          <!-- Cabecera-->
          <div class="full-box page-header">
              <hr>
              <h3 class="text-left">
                <i class="fas fa-user-cog"></i> &nbsp; Convocatoria &nbsp;<small>Nueva</small>
              </h3>
              <p class="text-justify">
                En el módulo CONVOCATORIA NUEVA usted podrá registrar los datos para registrar una nueva convocatoria para que puedan postular los estudiantes de la plataforma.
              </p>
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
                          <i class="fas fa-plus"></i>&nbsp; NUEVA CONVOCATORIA
                        </h3>
                      </div>
                      <div class="panel-body">
                      <form class="FormularioAjax" data-form="save" action="<?php echo SERVERURL; ?>ajax/ofertaAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="oferta_empresa_reg" value="<?php echo mainModel::encryption($_SESSION['codigo_cuenta_WS']);?>">

                        <fieldset>
                          <legend> &nbsp; Información General</legend>
                            <div class="container-fluid pt-2">
                              <div class="row">

                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <label for="oferta_titulo">
                                      Título/Cargo <span class="asterisco">*</span>
                                    </label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" class="form-control" type="text" name="oferta_titulo_reg" required maxlength="50" minlength="15"  id="oferta_titulo">
                                  </div>
                                </div>

                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <label for="oferta_descripcion">
                                      Descripción <span class="asterisco">*</span>
                                    </label>
                                    <textarea name="oferta_descripcion_reg" class="form-control" rows="3" maxlength="800" minlength="200" id="oferta_descripcion" required></textarea>
                                  </div>
                                </div>

                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <label for="oferta_descripcion">
                                      Categoría <span class="asterisco">*</span>
                                    </label>
                                    <select class="form-control" id="oferta_categoria" name="oferta_categoria_reg" required>
                                        <option value="Sin Registro"> Seleccione una categoría</option>
                                        <?php 
                                            require_once "./controladores/categoriaControlador.php";

                                            $inscategoria = new categoriaControlador();

                                            $doc = $inscategoria->datos_categoria_controlador("Select",0);

                                            while ($rowD = $doc->fetch()) {
                                                echo '<option value="'.$rowD['idCategoria'].'">'.$rowD['CatDescripcion'].'</option>';                            
                                            }
                                        ?>
                                    </select>
                                  </div>
                                </div>

                              </div>
                            </div>
                        </fieldset>

                        <br>

                        <fieldset>
                            <legend> &nbsp; Requerimientos</legend>
                            <div class="container-fluid pt-2">
                              <div class="row">

                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="oferta_eduMin">
                                      Educación Mínima <span class="asterisco">*</span>
                                    </label>
                                    <select class="form-control" name="oferta_eduMin_reg" id="oferta_eduMin" required>
                                        <option selected value="Sin Registro">Seleccione una opción</option>
                                        <option value="Técnico">Técnico</option>
                                        <option value="Universitario">Universitario</option>
                                        <option value="Universitario">Secundaria</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="oferta_expYear">
                                      Años de Experiencia <span class="asterisco">*</span>
                                    </label>
                                    <select class="form-control" name="oferta_expYear_reg" id="oferta_expYear" required>
                                        <option selected value="Sin Registro">Seleccione una opción</option>
                                        <option value="1 año">1 año</option>
                                        <option value="2 años">2 años</option>
                                        <option value="3-4 años">3-4 años</option>
                                        <option value="5-10 años">5-10 años</option>
                                        <option value="Más de 10 años">Más de 10 años</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="oferta_tipTrabajo">
                                      Tipo de Trabajo <span class="asterisco">*</span>
                                    </label>
                                    <select class="form-control" name="oferta_tipTrabajo_reg" id="oferta_tipTrabajo" required>
                                        <option selected value="Sin Registro">Seleccione una opción</option>
                                        <option value="Técnico">Presencial</option>
                                        <option value="Universitario">Semipresencial</option>
                                        <option value="Universitario">Remoto</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label><i class="fas fa-user-friends"></i> &nbsp; Disponibilidad para viajar</label>
                                    <div class="form-group bmd-form-group is-filled">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="oferta_disViajar_reg" value="Si" checked=""><span class="bmd-radio"></span>
                                                &nbsp; Si
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="oferta_disViajar_reg" value="No"><span class="bmd-radio"></span>
                                                &nbsp; No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label><i class="fas fa-user-friends"></i> &nbsp; Disponibilidad para cambio de residencia</label>
                                    <div class="form-group bmd-form-group is-filled">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="oferta_disCamRes_reg" value="Si" checked=""><span class="bmd-radio"></span>
                                                &nbsp; Si
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="oferta_disCamRes_reg" value="No"><span class="bmd-radio"></span>
                                                &nbsp; No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                              </div>
                            </div>
                        </fieldset>

                        <br>
                        
                        <fieldset>
                            <legend> &nbsp; Otros Datos</legend>
                            <div class="container-fluid pt-2">
                              <div class="row">

                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="oferta_jorLaboral">
                                      Jornada Laboral <span class="asterisco">*</span>
                                    </label>
                                    <select class="form-control" name="oferta_jorLaboral_reg" id="oferta_jorLaboral" required="">
                                        <option selected value="Sin Registro">Seleccione una opción</option>
                                        <option value="8 horas">8 horas</option>
                                        <option value="6 horas">6 horas</option>
                                        <option value="4 horas">4 horas</option>
                                        <option value="10-12 horas">10-12 horas</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="oferta_tipContrato">
                                      Tipo de Contrato <span class="asterisco">*</span>
                                    </label>
                                    <select class="form-control" name="oferta_tipContrato_reg" id="oferta_tipContrato">
                                        <option selected value="Sin Registro">Seleccione una opción</option>
                                        <option value="Contrato Ocasional">Contrato Ocasional</option>
                                        <option value="Contrato de Prácticas">Contrato de Prácticas</option>
                                        <option value="Contrato de Suplencia">Contrato de Suplencia</option>
                                        <option value="Contrato de Emergencia">Contrato de Emergencia</option>
                                        <option value="Contrato de Reconversión">Contrato de Reconversión</option>
                                        <option value="Contrato Empresarial">Contrato Empresarial</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label for="oferta_salario" class="bmd-label-floating">Salario <span class="asterisco">*</span></label>
                                        <input type="text" pattern="[0-9.]{1,25}" class="form-control" name="oferta_salario_reg" value="0.00" id="oferta_salario" maxlength="25">
                                    </div>
                                </div>
                            
                                <div class="col-12 col-md-6">
                                    <label><i class="fas fa-user-friends"></i> &nbsp; Aviso para personas con discapacidad</label>
                                    <div class="form-group bmd-form-group is-filled">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="oferta_disDiscapacitado_reg" value="Si" checked=""><span class="bmd-radio"></span>
                                                &nbsp; Si
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="oferta_disDiscapacitado_reg" value="No"><span class="bmd-radio"></span>
                                                &nbsp; No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                              </div>
                            </div>
                        </fieldset>

                        <br>

                        <fieldset>
                            <legend> &nbsp; Límites</legend>
                            <div class="container-fluid pt-2">
                              <div class="row">

                                <div class="col-lg-4">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label for="oferta_vacantes" class="bmd-label-floating"># de vacantes <span class="asterisco">*</span></label>
                                        <input type="text" pattern="[0-9]{1,5}" class="form-control" name="oferta_vacantes_reg" value="1" id="oferta_vacantes" maxlength="5" required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="oferta_fLimite">
                                      Fecha Límite <span class="asterisco">*</span>
                                    </label>
                                    <input type="date" name="oferta_fLimite_reg" id="oferta_fLimite" class="form-control" required>
                                  </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label for="oferta_relevancia" class="bmd-label-floating">Relevancia <span class="asterisco">*</span></label>
                                        <select class="form-control" name="oferta_relevancia_reg" id="oferta_relevancia_reg" required>
                                            <option selected value="Sin Registro">Seleccione una opción</option>
                                            <option value="Urgente">Urgente</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Rápida">Rápida</option>
                                        </select>
                                    </div>
                                </div>
                                
                              </div>
                            </div>
                        </fieldset>

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