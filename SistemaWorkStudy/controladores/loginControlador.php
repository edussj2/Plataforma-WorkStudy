<?php 
	if($peticionAjax){
		require_once "../modelos/loginModelo.php";
	}else{
		require_once "./modelos/loginModelo.php";
	}

	class loginControlador extends loginModelo
	{
		
		/**-----FUNCION PARA INICIAR SESIÓN-----**/
		public function iniciar_sesion_controlador(){
			$correo = mainModel::limpiar_cadena($_POST['correo']);
			$clave = mainModel::limpiar_cadena($_POST['clave']);

			$clave = mainModel::encryption($clave);

			$datosLogin = ["correo"=> $correo,"clave"=>$clave];

			$datosCuenta = loginModelo::iniciar_sesion_modelo($datosLogin);

			if($datosCuenta->rowCount()==1){
				$row = $datosCuenta->fetch();

				$fechaActual = date("Y-m-d");
				$yearActual = date("Y");
				$horaActual = date("h:i:s a");

				$consulta1= mainModel::ejecutar_consulta_simple("SELECT id FROM bitacora");

				$numero = ($consulta1->rowCount())+1;

				$codigoBitacora = mainModel::generar_codigo_aleatorio("CB",10,$numero);

				$datosBitacora=["codigo"=>$codigoBitacora,
								"fecha"=>$fechaActual,
								"inicio"=>$horaActual,
								"final"=>"Sin registro",
								"tipo"=>$row['CtaTipo'],
								"year"=>$yearActual,
								"cuenta"=>$row['CtaCodigo']];

				$guardarBitacora = mainModel::guardar_bitacora($datosBitacora);

				if($guardarBitacora->rowCount()>=1){

					if($row['CtaTipo'] == "Administrador"){
						$query = mainModel::ejecutar_consulta_simple("SELECT * FROM administrador WHERE CuentaCodigo ='".$row['CtaCodigo']."'");
					}elseif($row['CtaTipo'] == "Empresa"){
						$query = mainModel::ejecutar_consulta_simple("SELECT * FROM empresa WHERE CuentaCodigo ='".$row['CtaCodigo']."'");
					}elseif($row['CtaTipo'] == "Estudiante"){
						$query = mainModel::ejecutar_consulta_simple("SELECT * FROM estudiante WHERE CuentaCodigo ='".$row['CtaCodigo']."'");
					}

					if($query->rowCount()==1){
						$userData= $query->fetch();
						session_start(['name'=>'WS']);

						if($row['CtaTipo'] == "Administrador"){

							$_SESSION['nombre_WS']=$userData['AdmNombre'];
							$_SESSION['apellidos_WS']=$userData['AdmApellidos'];

						}elseif($row['CtaTipo'] == "Estudiante"){

							$_SESSION['nombre_WS']=$userData['EstNombres'];	
							$_SESSION['apellidos_WS']=$userData['EstApePaterno'];

						}elseif($row['CtaTipo'] == "Empresa"){

							$_SESSION['nombre_WS']=$userData['EmpRazSocial'];	
							$_SESSION['apellidos_WS']=$userData['EmpNomComercial'];

						}

						$_SESSION['avatar_WS']=$row['CtaFoto'];
						$_SESSION['correo_WS']=$row['CtaEmail'];
						$_SESSION['tipo_WS']=$row['CtaTipo'];
						$_SESSION['codigo_cuenta_WS']=$row['CtaCodigo'];
						$_SESSION['codigo_bitacora_WS']=$codigoBitacora;
						$_SESSION['token_WS']=md5(uniqid(mt_rand(),true));

						if($row['CtaTipo']=="Administrador"){
							$url = SERVERURL."inicioAdministrador/";
						}elseif($row['CtaTipo']=="Empresa"){
							$url = SERVERURL."inicioEmpresa/";
						}elseif($row['CtaTipo']=="Estudiante"){
							$url = SERVERURL."inicioEstudiante/";
						}

						return $urlLocation='<script> window.location="'.$url.'"</script>';

					}else{
						 $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No hemos podido iniciar la sesión por problemas técnicos, intente nuevamente.","Tipo"=>"error"];
                   		return mainModel::sweet_alert($alerta);
					}

				}else{
                   $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No hemos podido iniciar la sesión por problemas técnicos, intente nuevamente.","Tipo"=>"error"];
                   return mainModel::sweet_alert($alerta);
				}
			}else{
               $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El correo o la contraseña no son válidos, intente nuevamente.","Tipo"=>"error"];
               return mainModel::sweet_alert($alerta);
			}
		}

		/**-----FUNCION PARA CERRAR SESIÓN-----**/
		public function cerrar_sesion_controlador(){
			session_start(['name'=>'WS']);
			$token = mainModel::decryption($_GET['Token']);
			$hora = date("h:i:s a");
			$datos=["correo"=>$_SESSION['correo_WS'], "token_S"=>$_SESSION['token_WS'],"token"=>$token,"codigo"=>$_SESSION['codigo_bitacora_WS'],"hora"=>$hora];

			return loginModelo::cerrar_sesion_modelo($datos);
		}

		/**-----FUNCION PARA FORZAR CIERRE DE SESIÓN-----**/
		public function forzar_cierre_sesion_controlador(){
			session_unset();
			session_destroy();
			$redirect = '<script> window.location.href="'.SERVERURL.'login/"</script>';
			return $redirect;
		}
	}