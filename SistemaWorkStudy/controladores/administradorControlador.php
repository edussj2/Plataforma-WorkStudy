<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../modelos/administradorModelo.php";
	}else{
		require_once "./modelos/administradorModelo.php";
	}

	class administradorControlador extends administradorModelo
	{
		/*AGREGAR*/
		public function agregar_administrador_controlador(){

			/*--DATOS DEL ADMINISTRADOR--*/
			$dni = mainModel::limpiar_cadena($_POST['administrador_dni_reg']);
			$nombres = mainModel::limpiar_cadena($_POST['administrador_nombres_reg']);
			$apellidos = mainModel::limpiar_cadena($_POST['administrador_apellidos_reg']);
			$telefono = mainModel::limpiar_cadena($_POST['administrador_telefono_reg']);
            $direccion = mainModel::limpiar_cadena($_POST['administrador_direccion_reg']);

			/*--DATOS DE LA CUENTA--*/
			$pass1 = mainModel::limpiar_cadena($_POST['administrador_pass1_reg']);
			$pass2 = mainModel::limpiar_cadena($_POST['administrador_pass2_reg']);
			$correo = mainModel::limpiar_cadena($_POST['administrador_email_reg']);

            /*--ASIGNAMOS AVATAR--*/
			$avatar = "admin.png";


            /*--VALIDACIONES--*/
            if($dni== "" || $nombres=="" || $apellidos=="" || $correo=="" || $pass1=="" || $pass2=="" ){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{
            
                if($pass1!=$pass2){

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Las contraseñas no coinciden, intente nuevamente","Tipo"=>"warning"];
                
                }else{

                    $consulta1 = mainModel::ejecutar_consulta_simple("SELECT AdmDNI FROM administrador WHERE AdmDNI='$dni'");
                    
                    if($consulta1->rowCount()>=1){
                        
                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El DNI que ingresaste ya se encuentra registrado, intente nuevamente","Tipo"=>"warning"];
                    
                    }else{

                        $consulta2 = mainModel::ejecutar_consulta_simple("SELECT CtaEmail FROM cuenta WHERE CtaEmail ='$correo'");
                        if($consulta2->rowCount()>=1){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El correo ingresado ya se encuentra registrado, intente nuevamente","Tipo"=>"warning"];
                        
                        }else{

                            if(strlen( $dni ) != 8 || is_numeric($dni)==false){

                                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El DNI ingresado no es válido","Tipo"=>"warning"];
                            
                            }else{

                                if(filter_var($correo, FILTER_VALIDATE_EMAIL)==false){
                                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El correo electrónico ingresado no es válido","Tipo"=>"warning"];
                                }else{

                                if($telefono!="" && is_numeric($telefono)==false ){
                           
                                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El teléfono no es válido","Tipo"=>"warning"];
                                       
                                }else{

                                        $consulta3 = mainModel::ejecutar_consulta_simple("SELECT idCuenta FROM cuenta");
                                        $numero = ($consulta3->rowCount())+1;

                                        $codigo= mainModel::generar_codigo_aleatorio("WS",10,$numero);

                                        $clave = mainModel::encryption($pass1);

                                        $fechaActual = date('Y-m-d');

                                        $datosCuenta=[
                                                "codigo"=>$codigo,
                                                "clave"=>$clave,
                                                "email"=>$correo,
                                                "estado"=>"Activo",
                                                "tipo"=>"Administrador",
                                                "foto"=>$avatar,
                                                "fechaReg"=>$fechaActual
                                        ];

                                        $guardarCuenta = mainModel::agregar_cuenta($datosCuenta);

                                        if($guardarCuenta->rowCount()>=1){
                                            $datosAdministrador=[
                                                    "dni"=>$dni,
                                                    "nombres"=>$nombres,
                                                    "apellidos"=>$apellidos,
                                                    "telefono"=>$telefono,
                                                    "direccion"=>$direccion,
                                                    "codigo"=>$codigo
                                            ];

                                            $guardarAdministrador = administradorModelo::agregar_administrador_modelo($datosAdministrador);

                                            if($guardarAdministrador->rowCount()>=1){
                                                $alerta = ["Alerta"=>"limpiar", "Titulo"=>"ADMINISTRADOR REGISTRADO","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];
                                            }else{
                                                mainModel::eliminar_cuenta($codigo);
                                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro del administrador, intente nuevamente","Tipo"=>"error"];
                                            }
                                        }else{
                                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro de la cuenta, intente nuevamente","Tipo"=>"error"];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_administrador_controlador($pagina,$registros,$codigo,$busqueda){
            
            /**-----LIMPIAMOS PARAMETROS RECIBIDOS-----**/
            $pagina = mainModel::limpiar_cadena($pagina);
            $registros = mainModel::limpiar_cadena($registros);
            $codigo = mainModel::limpiar_cadena($codigo);
            $busqueda = mainModel::limpiar_cadena($busqueda);

            $tabla = "";

            /**-----VALIDAMOS LAS PAGINAS Y EL ORDEN DE LOS REGISTROS----**/
            $pagina = (isset($pagina) && $pagina>0) ? (int)$pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros) - $registros): 0;

            /**-----VALIDAMOS SI ES UNA BUSQUEDA O SI ES LA LISTA---**/
            if(isset($busqueda) && $busqueda!=""){
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM administrador WHERE ((CuentaCodigo != '$codigo')AND (idAdministrador != 1) AND (AdmNombre LIKE '%$busqueda%' OR AdmApellidos LIKE '%$busqueda%' OR 	AdmDNI LIKE '%$busqueda%')) ORDER BY AdmApellidos ASC LIMIT $inicio,$registros";

                $paginaURL = "administradorBuscar";
            }else{
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM administrador WHERE CuentaCodigo != '$codigo' AND idAdministrador != 1 ORDER BY AdmApellidos	 ASC LIMIT $inicio,$registros";

                $paginaURL = "administradorLista";
            }

            /**-----CONECTAMOS Y GUARDAMOS LOS DATOS----**/
            $conexion = mainModel::conectar();
            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();

            /**-----CALCULAMOS EL TOTAL DE REGISTROS----**/
            $total = $conexion->query("SELECT FOUND_ROWS()");
            $total = (int) $total->fetchColumn();

            /**-----CALCULAMOS EL TOTAL DE PAGINAS----**/
            $Npaginas = ceil($total/$registros);

            /**-----GENERAMOS TABLA---**/
            $tabla .= '<div class="table-responsive">
                        <table class="table table-hover text-center tabla-especialitas">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Identificación</th>
                                    <th scope="col">DNI</th>
                                    <th scope="col">Datos</th> 
                                    <th scope="col">Cuenta</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>';

            if($total>=1 && $pagina <= $Npaginas){

                $contador = $inicio+1;
                foreach ($datos as $rows) {
                    $tabla.= '<tr>
                                <th scope="row">'.$contador.'</th>
                                <td>
                                <div class="identificacion">
                                    <h6>'.$rows['AdmApellidos'].' '.$rows['AdmNombre'].'</h4>
                                </div>
                                </td>
                                <td>'.$rows['AdmDNI'].'</td>
                                <td>
                                    <a href="'.SERVERURL.'adminEditar/admin/'.mainModel::encryption($rows['CuentaCodigo']).'/" class="btn btn-success" data-toggle="tooltip" title="Actualizar Datos" data-placement="bottom">
                                            <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="'.SERVERURL.'myaccount/admin/'.mainModel::encryption($rows['CuentaCodigo']).'/" class="btn btn-success" data-toggle="tooltip" title="Actualizar Cuenta" data-placement="bottom">
                                        <i class="fas fa-cog"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="'.SERVERURL.'ajax/administradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data">
                                        <input type="hidden" name="administrador_id_del" value="'.mainModel::encryption($rows['CuentaCodigo']).'">
                                        <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Eliminar" data-placement="bottom">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <div class="RespuestaAjax"></div>
                                    </form>
                                </td>
                            </tr>';

                    $contador++;
                }
            }else{
                if($total>=1){
                    $tabla .= '<tr> <td colspan="6"><a href="'.SERVERURL.$paginaURL.'/" class="btn btn-info"><i class="fas fa-sync-alt"></i> Haga clic acá para actualizar el listado </a></td></tr>';
                }else{
                    $tabla .= '<tr> <td colspan="6"> <div class="alert alert-secondary" role="alert">
                    <i class="fas fa-bullhorn"></i> NO HAY REGISTOS EN EL SISTEMA</div></td></tr>';
                }
            }

            $tabla .= '     </tbody>
                        </table>
                        <small class="p-2 float-right" style="color: #333;">Si estas en un dispósitivo móvil, desliza sobre la tabla para ver más detalles</small>
                    </div>';

            /**-----GENERAMOS PAGINADOR---**/
            if($total>=1 && $pagina <= $Npaginas){

                $tabla.='<nav aria-label="Page navigation" class="d-flex justify-content-center mt-2 mb-2"><ul class="pagination">';

                if($pagina==1){
                    $tabla.= '<li class="page-item"><a class="page-link inactivo"><span aria-hidden="true">&laquo;</span></a></li>';
                }else{
                    $tabla.= '<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaURL.'/'.($pagina-1).'/" ><span aria-hidden="true">&laquo;</span></a></li>';
                }

                /*BOTONES QUE MOSTRARAS*/
                $ci=0;
                $botones = 5;

                for ($i=$pagina; $i <= $Npaginas ; $i++) {
                    if($ci >=$botones){
                        break;
                    } 
                    if($pagina == $i){
                        $tabla.= '<li class="page-item"><a class="page-link activo" href="'.SERVERURL.$paginaURL.'/'.$i.'">'.$i.'</a></li>';
                    }else{
                        $tabla.= '<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaURL.'/'.$i.'">'.$i.'</a></li>';
                    }
                    $ci++;
                }

                if($pagina==$Npaginas){
                    $tabla.= '<li class="page-item"><a class="page-link inactivo"><span aria-hidden="true">&raquo;</span></a></li>';
                }else{
                    $tabla.= '<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaURL.'/'.($pagina+1).'/" ><span aria-hidden="true">&raquo;</span></a></li>';
                }

                $tabla.='</ul></nav>';
            }
            return $tabla;
        }

        /*ELIMINAR*/
        public function eliminar_administrador_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $Cuenta = mainModel::decryption($_POST['administrador_id_del']);
 
            /**-----LIMPIAMOS LOS DATOS ----**/
            $Cuenta = mainModel::limpiar_cadena($Cuenta);

                $query1=mainModel::ejecutar_consulta_simple("SELECT id FROM administrador WHERE CuentaCodigo='$Cuenta'");

                $datosAD = $query1->fetch();

                if($datosAD['idAdministrador']!=1){

                    $eliminarAdministrador = administradorModelo::eliminar_administrador_modelo($Cuenta);
                    mainModel::eliminar_bitarcora($Cuenta);

                    if($eliminarAdministrador->rowCount()>=1){

                        $eliminarCuenta = mainModel::eliminar_cuenta($Cuenta);

                        if($eliminarCuenta->rowCount()>=1){
                            $alerta = ["Alerta"=>"recargar", "Titulo"=>"ADMINISTRADOR ELIMINADO","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
                        
                        }else{
                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar completamente la cuenta, avisar a soporte técnico","Tipo"=>"info"];
                        }
                    }else{
                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar el administrador, intenté nuevamente","Tipo"=>"error"];
                    }

                }else{

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El administrador que desea eliminar no es válido para la eliminación","Tipo"=>"error"];

                }

            return mainModel::sweet_alert($alerta);
        }

        /*DATOS*/
        public function datos_administrador_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return administradorModelo::datos_administrador_modelo($tipo, $codigo);
        }

	}
    