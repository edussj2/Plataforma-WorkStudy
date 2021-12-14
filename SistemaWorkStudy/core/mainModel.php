<?php
	if($peticionAjax){
		require_once "../core/configApp.php";
	}else{
		require_once "./core/configApp.php";
	}
	class mainModel
	{
		/**-----FUNCIONA PARA CONECTAR-----**/
		protected function conectar(){
		    $conexion = new PDO(SGBD,USER,PASS);

		    return $conexion;
		}

		/**-----FUNCIONA PARA CONSULTAS SIMPLES-----**/
		protected function ejecutar_consulta_simple($consulta){
			$sql = self::conectar()->prepare($consulta);
			$sql->execute();
			return $sql;
		}

        /**-----FUNCIONA PARA ENCRIPTAR-----**/
		public static function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}

		/**-----FUNCIONA PARA DESINCRIPTAR-----**/
		public static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}

		/**-----FUNCIONA PARA GENERAR CODIGO ALEATORIO-----**/
		protected function generar_codigo_aleatorio($letra,$longitud,$num){
			for($i=1 ; $i<=$longitud; $i++){
				$numero = rand(0,9);
				$letra.= $numero;
			}

			return $letra.$num;
		}

		/**-----FUNCIONA PARA AGREGAR CUENTA-----**/
		protected function agregar_cuenta($datos){
			$sql = self::conectar()->prepare("INSERT INTO cuenta(CtaCodigo,CtaClave,CtaEmail,CtaEstado,CtaTipo,CtaFoto,CtaFechaRegistro) 
				VALUES(:codigo,:clave,:email,:estado,:tipo,:foto,:fechaReg)");

			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->bindParam(":clave",$datos['clave']);
			$sql->bindParam(":email",$datos['email']);
			$sql->bindParam(":estado",$datos['estado']);
			$sql->bindParam(":tipo",$datos['tipo']);
			$sql->bindParam(":foto",$datos['foto']);
			$sql->bindParam(":fechaReg",$datos['fechaReg']);
			$sql->execute();

			return $sql;
		}

		/**-----FUNCIONA PARA ELIMINAR CUENTA-----**/
		protected function eliminar_cuenta($codigo){
			$sql = self::conectar()->prepare("DELETE FROM cuenta WHERE CtaCodigo=:id");

			$sql->bindParam(":id",$codigo);
			$sql->execute();

			return $sql;
		}

		/**-----FUNCIONA PARA OBTENER DATOS DE CUENTA-----**/
		protected function datos_cuenta($codigo,$tipo){
			$sql = self::conectar()->prepare("SELECT * FROM cuenta WHERE CtaCodigo=:id AND CtaTipo=:tipo");

			$sql->bindParam(":id",$codigo);
			$sql->bindParam(":tipo",$tipo);
			$sql->execute();

			return $sql;
		}

		/**-----FUNCIONA PARA ACTUALIZAR CUENTA-----**/
		protected function actualizar_cuenta($datos){
			$sql = self::conectar()->prepare("UPDATE cuenta SET CtaCorreo=:correo, CtaClave=:clave WHERE CtaCodigo=:id");

			$sql->bindParam(":id",$datos['id']);
			$sql->bindParam(":correo",$datos['correo']);
			$sql->bindParam(":clave",$datos['clave']);
			$sql->execute();

			return $sql;
		}

		/**-----FUNCIONA PARA GUARDAR BITACORA DE SESION-----**/
		protected function guardar_bitacora($datos){
			$sql = self::conectar()->prepare("INSERT INTO bitacora(BitacoraCodigo,BitacoraFecha,BitacoraHoraInicio,BitacoraHoraFinal,BitacoraTipo,BitacoraYear,CuentaCodigo) VALUES(:codigo,:fecha,:inicio,:final,:tipo,:year,:cuenta)");

			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->bindParam(":fecha",$datos['fecha']);
			$sql->bindParam(":inicio",$datos['inicio']);
			$sql->bindParam(":final",$datos['final']);
			$sql->bindParam(":tipo",$datos['tipo']);
			$sql->bindParam(":year",$datos['year']);
			$sql->bindParam(":cuenta",$datos['cuenta']);
			$sql->execute();

			return $sql;
		}

		/**-----FUNCIONA PARA ACTULIZAR BITACORA DE SESION-----**/
		protected function actualizar_bitarcora($codigo,$hora){
			$sql = self::conectar()->prepare("UPDATE bitacora SET BitacoraHoraFinal=:hora WHERE BitacoraCodigo = :codigo");

			$sql->bindParam(":hora",$hora);
			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/**-----FUNCIONA PARA ELIMINAR BITACORA DE SESION-----**/
		protected function eliminar_bitarcora($cuenta){
			$sql = self::conectar()->prepare("DELETE FROM bitacora WHERE CuentaCodigo = :cuenta");

			$sql->bindParam(":cuenta",$cuenta);
			$sql->execute();

			return $sql;
		}

		/**-----FUNCIONA PARA LIMPIAR CADENA-----**/
		protected function limpiar_cadena($cadena){
			$cadena = str_ireplace("<script>","", $cadena); //QUITA Y REMPLAZA SEGUN QUERRÁMOS
			$cadena = str_ireplace("</script>","", $cadena);
			$cadena = str_ireplace("<script src","", $cadena);
			$cadena = str_ireplace("<script type","", $cadena);
			$cadena = str_ireplace("SELECT *  FROM","", $cadena);
			$cadena = str_ireplace("DELETE FROM","", $cadena);
			$cadena = str_ireplace("INSERT INTO","", $cadena);
			$cadena = str_ireplace("UPDATE SET","", $cadena);
			$cadena = str_ireplace("[","", $cadena);
			$cadena = str_ireplace("]","", $cadena);
			$cadena = str_ireplace("==","", $cadena);
			$cadena = str_ireplace("DROP TABLE","", $cadena);
			$cadena = str_ireplace("SHOW TABLES","", $cadena);
			$cadena = str_ireplace("SHOW DATABASES","", $cadena);
			$cadena = str_ireplace("<?php","", $cadena);
			$cadena = str_ireplace("?>","", $cadena);
			$cadena = str_ireplace("DELETE administrador","", $cadena);
			$cadena = str_ireplace("DELETE empresa","", $cadena);
			$cadena = str_ireplace("::","", $cadena);
			$cadena = trim($cadena);//QUITA ESPACIOS EN BLANCO
			$cadena = stripcslashes($cadena);//QUITA BARRAS INVERTIDAS
			return $cadena;
		}

		/**-----FUNCIONA PARA VERIFICAR FORMATO DE FECHAS-----**/
		protected function verificar_fecha($fecha){
			$valores = explode('/', $fecha);
			if(count($valores)==3 && checkdate($valores[1], $valores[0], $valores[2])){
				return false;
			}else{
				return true;
			}
		}

        /**-----FUNCIONA PARA SELECCIONAR ALERTA-----**/
		protected function sweet_alert($datos){
			if($datos['Alerta']=="simple"){
				$alerta = "<script>
							  swal(
								'".$datos['Titulo']."',
								'".$datos['Texto']."',
								'".$datos['Tipo']."'
							  );
						   </script>";
			}elseif ($datos['Alerta']=="recargar") {
				$alerta = "<script>
							  swal({
								title: '".$datos['Titulo']."',
								text: '".$datos['Texto']."',
								type: '".$datos['Tipo']."',
								confirmButtonText: 'Aceptar'
								}).then(function () {
									location.reload();
								});
						   </script>";
			}elseif ($datos['Alerta']=="limpiar") {
				$alerta = "<script>
							  swal({
								title: '".$datos['Titulo']."',
								text: '".$datos['Texto']."',
								type: '".$datos['Tipo']."',
								confirmButtonText: 'Aceptar'
								}).then(function () {
									$('.FormularioAjax')[0].reset();
								});
						   </script>";
			}
			return $alerta;
		}
	}