<?php
	if($_SESSION['tipo_WS']!="Empresa"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
	$fechaActual= date('Y-m-d');;
?> 

<div class="mt-5 pb-3 text-center">
    <h2><i class="fas fa-briefcase"></i> ¿Necesitas Personal? Crea una convactoria</h2>
    <p>¡Regístra una oferta laboral con los datos nescesarios, y selecciona al personal que postule a través de esta publicación!</p>

</div>

<div class="contenedor-reg-conv">
	<form class="FormularioAjax" data-form="save" action="<?php echo SERVERURL; ?>ajax/ofertaAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="oferta_empresa_reg" value="<?php echo mainModel::encryption($_SESSION['codigo_cuenta_WS']);?>">

		<div class="form-convocatoria" id="formConv1">
			<h3><i class="fas fa-address-card"></i> &nbsp;Información General</h3>

			<fieldset>
				<div class="pt-2">
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
								<label for="oferta_categoria">
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

			<div class="btn-next-previous">
				<button type="button" id="Next1">Siguiente</button>
			</div>

		</div>

		<div class="form-convocatoria" id="formConv2">
			<h3><i class="fas fa-list"></i> &nbsp;Requisitos</h3>

			<fieldset>
                <div class="pt-2">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="oferta_eduMin">
                                      Educación Mínima <span class="asterisco">*</span>
                                </label>
                                <select class="form-control" name="oferta_eduMin_reg" id="oferta_eduMin" required>
                                    <option selected value="Sin Registro">Seleccione una opción</option>
                                    <option value="Secundaria">Secundaria</option>
                                    <option value="Técnico">Técnico</option>
                                    <option value="Universitario">Universitario</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
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

						<div class="col-lg-6">
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

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="oferta_tipTrabajo">
                                    Tipo de Trabajo <span class="asterisco">*</span>
                                </label>
                                <select class="form-control" name="oferta_tipTrabajo_reg" id="oferta_tipTrabajo" required>
                                    <option selected value="Sin Registro">Seleccione una opción</option>
                                    <option value="Presencial">Presencial</option>
                                    <option value="Semipresencial">Semipresencial</option>
                                    <option value="Remoto">Remoto</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mt-1">
                            <label>
								<i class="fas fa-plane"></i> &nbsp;Disponibilidad para viajar
							</label>
                            <div class="form-group bmd-form-group is-filled">
                                <div class="radio">
                                    <label>
                                    	<input type="radio" name="oferta_disViajar_reg" value="Si" checked=""><span class="bmd-radio"></span>&nbsp; Sí
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="oferta_disViajar_reg" value="No"><span class="bmd-radio"></span>&nbsp; No
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mt-1">
                            <label>
								<i class="fas fa-suitcase"></i> &nbsp;Disponibilidad para cambio de residencia
							</label>
                            <div class="form-group bmd-form-group is-filled">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="oferta_disCamRes_reg" value="Si" checked=""><span class="bmd-radio"></span>&nbsp; Si
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="oferta_disCamRes_reg" value="No"><span class="bmd-radio"></span> &nbsp; No
                                    </label>
                                </div>
                            </div>
                        </div>
                                
                    </div>
                </div>
            </fieldset>

			<div class="btn-next-previous">
				<button type="button" id="Back1">Atrás</button>&nbsp;&nbsp;
				<button type="button" id="Next2">Siguiente</button>
			</div>

		</div>

		<div class="form-convocatoria" id="formConv3">
			<h3><i class="far fa-building"></i> &nbsp;Datos Empresariales</h3>

			<fieldset>
                <div class="pt-2">
                    <div class="row">

						<div class="col-lg-8">
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

						<div class="col-6 col-md-4">
                            <div class="form-group bmd-form-group is-filled">
                                <label for="oferta_vacantes" class="bmd-label-floating">#<span class="asterisco">*</span></label>
                                <input type="text" pattern="[0-9]{1,5}" class="form-control" name="oferta_vacantes_reg" placeholder="# de vacantes" id="oferta_vacantes" maxlength="5" required onkeypress="return valideKey(event);">
                            </div>
                        </div>

                        <div class="col-6 ">
                            <div class="form-group bmd-form-group is-filled">
                                <label for="oferta_salario" class="bmd-label-floating">Salario <span class="asterisco">*</span></label>
                                <input type="text" pattern="[0-9.]{1,25}" class="form-control" name="oferta_salario_reg" value="0.00" id="oferta_salario" maxlength="25">
                            </div>
                        </div>

						<div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="oferta_fLimite">
                                      Fecha Límite <span class="asterisco">*</span>
                                </label>
                                <input type="date" name="oferta_fLimite_reg" id="oferta_fLimite" class="form-control" required min="<?php echo $fechaActual;?>">
                            </div>
                        </div>
                            
						<div class="col-12 col-md-6 mt-1">
							<label><i class="fas fa-exclamation-circle"></i>&nbsp; Relevancia</label>
                            <div class="form-group bmd-form-group is-filled">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="oferta_relevancia_reg" value="Urgente" checked=""><span class="bmd-radio"></span>&nbsp; Urgente
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="oferta_relevancia_reg" value="Normal"><span class="bmd-radio"></span>&nbsp; Normal
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mt-1">
                            <label><i class="fas fa-blind"></i>&nbsp; Aviso para personas con discapacidad</label>
                            <div class="form-group bmd-form-group is-filled">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="oferta_disDiscapacitado_reg" value="Si" checked=""><span class="bmd-radio"></span>&nbsp; Si
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="oferta_disDiscapacitado_reg" value="No"><span class="bmd-radio"></span>&nbsp; No
                                    </label>
                                </div>
                            </div>
                        </div> 
                                
                    </div>
                </div>
            </fieldset>

			<div class="btn-next-previous">
				<button type="button" id="Back2">Atrás</button>&nbsp;&nbsp;
				<button type="submit" >Publicar</button>
			</div>

		</div>
	
		<div class="RespuestaAjax"></div>
	</form>
	<div class="step-row">
		<div id="progress"></div>
		<div class="step-col"><small>Paso 1</small></div>
		<div class="step-col"><small>Paso 2</small></div>
		<div class="step-col"><small>Paso 3</small></div>
	</div>
</div>
<br><br><br>
<script>

	function validarPaso1(){

		var titulo = document.getElementById("oferta_titulo").value;	
		var descripcion = document.getElementById("oferta_descripcion").value;	
		var categoria = document.getElementById("oferta_categoria").value;

		if(titulo === "" || descripcion === "" || categoria == "Sin Registro"){
			swal("Ocurrió un error","Complete todos los campos requeridos","error");
			return false;
		}else if(titulo.length>50 || titulo.length<15){
			swal("Ocurrió un error","El Título/Cargo debe tener como mínimo 15 carácteres y 50 como máximo, intente nuevamente","error");
			return false;
    	}else if(descripcion.length > 800 || descripcion.length < 200){
			swal("Ocurrió un error","La descripción debe tener como mínimo 200 carácteres y 800 como máximo, intente nuevamente","error");
			return false;
    	}
		return true;
	}

	function validarPaso2(){

		var eduMin = document.getElementById("oferta_eduMin").value;	
		var expYear = document.getElementById("oferta_expYear").value;	
		var jorLaboral = document.getElementById("oferta_jorLaboral").value;
		var tipTrabajo = document.getElementById("oferta_tipTrabajo").value;

		if(eduMin == "Sin Registro" || expYear == "Sin Registro" || jorLaboral == "Sin Registro" || tipTrabajo == "Sin Registro"){
			swal("Ocurrió un error","Complete todos los campos requeridos","error");
			return false;
		}
		return true;
	}

	var Form1 = document.getElementById("formConv1");
	var Form2 = document.getElementById("formConv2");
	var Form3 = document.getElementById("formConv3");

	var Next1 = document.getElementById("Next1");	
	var Next2 = document.getElementById("Next2");	
	var Back1 = document.getElementById("Back1");	
	var progress = document.getElementById("progress");	

	var Back2 = document.getElementById("Back2");	

	
	
	Next1.onclick = function(){
		if(validarPaso1()==true){
			Form1.style.left="-650px";
			Form2.style.left="24px";
			progress.style.width="432px";
		}
	}

	Back1.onclick = function(){
		Form1.style.left="24px";
		Form2.style.left="650px";
		progress.style.width="216px";
	}

	Next2.onclick = function(){
		if(validarPaso2()==true){
			Form2.style.left="-650px";
			Form3.style.left="24px";
			progress.style.width="648px";
		}
	}

	Back2.onclick = function(){
		Form2.style.left="24px";
		Form3.style.left="650px";
		progress.style.width="432px";
	}

</script>