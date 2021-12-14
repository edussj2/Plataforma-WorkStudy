<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class bitacoraControlador extends mainModel
	{
		/**-----FUNCION PARA BITACORA-----**/
		public function listado_bitacora_controlador($registros){

			$registros= mainModel::limpiar_cadena($registros);

			$datos = mainModel::ejecutar_consulta_simple("SELECT * FROM bitacora ORDER BY id DESC LIMIT $registros");

			$conteo =1;

			while ($rows = $datos->fetch()) {

				$datosC = mainModel::ejecutar_consulta_simple("SELECT * FROM cuenta WHERE CtaCodigo ='".$rows['CuentaCodigo']."'");

				$datosC = $datosC->fetch();

				if($rows['BitacoraTipo']=="Administrador"){

					$datosU = mainModel::ejecutar_consulta_simple("SELECT AdmNombre, AdmApellidos FROM administrador WHERE CuentaCodigo='".$rows['CuentaCodigo']."'");
					$datosU= $datosU->fetch();
					$NombreCompleto = $datosU['AdmNombre']." ".$datosU['AdmApellidos'];
                    
				}elseif($rows['BitacoraTipo']=="Estudiante"){
					$datosU = mainModel::ejecutar_consulta_simple("SELECT EstNombres, EstApePaterno, EstApeMaterno FROM estudiante WHERE CuentaCodigo='".$rows['CuentaCodigo']."'");
					$datosU= $datosU->fetch();
					$NombreCompleto = $datosU['EstNombres']." ".$datosU['EstApePaterno']." ".$datosU['EstApeMaterno'];
				}else{
                    $datosU = mainModel::ejecutar_consulta_simple("SELECT EmpNomComercial FROM empresa WHERE CuentaCodigo='".$rows['CuentaCodigo']."'");
					$datosU= $datosU->fetch();
					$NombreCompleto = $datosU['EmpNomComercial'];
                }

				echo '
					<div class="cd-timeline-block">
			            <div class="cd-timeline-img">
			                <img src="'.SERVERURL.'adjuntos/avatars/'.$datosC['CtaFoto'].'" alt="Foto-Avatar">
			            </div>
			            <div class="cd-timeline-content">
			                <h4 class="text-center text-titles">'.$NombreCompleto.' <small>('.$datosC['CtaTipo'].')</small></h4>
			                <p class="text-center">
			                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Inicio: <em>'.$rows['BitacoraHoraInicio'].'</em> &nbsp;&nbsp;&nbsp; 
			                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> Fin: <em>'.$rows['BitacoraHoraFinal'].'</em>
			                </p>
			                <span class="cd-date"><i class="fas fa-calendar"></i> '.date("d/m/Y",strtotime($rows['BitacoraFecha'])).'</span>
			            </div>
			        </div> 
				';
				$conteo++;
			}
		}
	}