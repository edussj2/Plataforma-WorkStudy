<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../modelos/testimonioPlataformaModelo.php";
	}else{
		require_once "./modelos/testimonioPlataformaModelo.php";
	}

	class testimonioPlataformaControlador extends testimonioPlataformaModelo
	{
		/*AGREGAR*/
		public function agregar_testimonioPlataforma_controlador(){

			$descripcion = mainModel::limpiar_cadena($_POST['testimonioPlataforma_descripcion_reg']);
			$cuenta = mainModel::decryption($_POST['testimonioPlataforma_usuario_reg']);
            $estado =  "No Visible";
            $fecha = date('Y-m-d');


            /*--VALIDACIONES--*/
            if($descripcion== "" || $cuenta ==""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{

                    $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM cuenta WHERE CtaCodigo='$cuenta'");
                    $usuarioDatos = $consulta1->fetch();

                if($usuarioDatos['CtaTipo']=="Administrador"){

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Usted tiene una cuenta que no es válida para registrar un testimonio.","Tipo"=>"warning"];
                    
                }else{

                    $usuario = $usuarioDatos['idCuenta'];

                    $consulta2 = mainModel::ejecutar_consulta_simple("SELECT idTestimonio FROM testimonioplataforma WHERE idUsuario='$usuario'");
                    
                    if($consulta2->rowCount()>=3){
                        
                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Usted ya ha registrado muchas testimonios, gracias por su participación.","Tipo"=>"warning"];
                    
                    }else{

                            if(strlen( $descripcion ) > 150){

                                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La descripción ingresada no es válido en longitud","Tipo"=>"warning"];
                            
                            }else{

                                    if($estado != "No Visible"){
                            
                                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El estado debe ser modificado, recargué la página.","Tipo"=>"warning"];
                                        
                                    }else{

                                        $datostestimonioPlataforma=[
                                            "usuario"=>$usuario,
                                            "descripcion"=>$descripcion,
                                            "fecha"=>$fecha,
                                            "estado"=>$estado,
                                        ];

                                        $guardartestimonioPlataforma = testimonioPlataformaModelo::agregar_testimonioPlataforma_modelo($datostestimonioPlataforma);

                                        if($guardartestimonioPlataforma->rowCount()>=1){
                                                $alerta = ["Alerta"=>"recargar", "Titulo"=>"TESTIMONIO REGISTRADO","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];
                                        }else{
                                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro del testimonio, intente nuevamente","Tipo"=>"error"];
                                        }
                                        
                                        
                                    }
                                
                            }
                    }   
                
                }    
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_testimonioPlataforma_controlador($pagina,$registros){
            
            /**-----LIMPIAMOS PARAMETROS RECIBIDOS-----**/
            $pagina = mainModel::limpiar_cadena($pagina);
            $registros = mainModel::limpiar_cadena($registros);

            $tabla = "";

            /**-----VALIDAMOS LAS PAGINAS Y EL ORDEN DE LOS REGISTROS----**/
            $pagina = (isset($pagina) && $pagina>0) ? (int)$pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros) - $registros): 0;

            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM testimonioplataforma INNER JOIN cuenta ON testimonioplataforma.idUsuario = cuenta.idCuenta ORDER BY idTestimonio DESC LIMIT $inicio,$registros";

            $paginaURL = "testimonioLista";
            

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
                        <table class="table table-hover text-center">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Testimonio</th> 
                                    <th scope="col">Estado</th>
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
                                        <h6>'.$rows['CtaEmail'].'</h6>
                                    </div>
                                </td>
                                <td>
                                    '.$rows['TesDescripcion'].'
                                </td>';
                                if($rows['TesEstado']=="Visible"){
                                $tabla.='<td>
                                            <form action="'.SERVERURL.'ajax/testimonioPlataformaAjax.php" method="POST" class="FormularioAjax" data-form="update" entype="multipart/form-data">
                                                <input type="hidden" name="testimonio-id-up" value="'.mainModel::encryption($rows['idTestimonio']).'">
                                                <input type="hidden" name="testimonio-estado-up" value="'.mainModel::encryption($rows['TesEstado']).'">
                                                <button type="submit" class="btn btn-info" data-toggle="tooltip" title="Visible" data-placement="bottom">
                                                        <i class="far fa-eye"></i>
                                                </button>
                                                <div class="RespuestaAjax"></div>
                                            </form>
                                        </td>';
                                }else{
                                $tabla.='<td>
                                            <form action="'.SERVERURL.'ajax/testimonioPlataformaAjax.php" method="POST" class="FormularioAjax" data-form="update" entype="multipart/form-data">
                                                <input type="hidden" name="testimonio-id-up" value="'.mainModel::encryption($rows['idTestimonio']).'">
                                                <input type="hidden" name="testimonio-estado-up" value="'.mainModel::encryption($rows['TesEstado']).'">
                                                <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="No Visible" data-placement="bottom">
                                                    <i class="fas fa-eye-slash"></i>
                                                </button>
                                                <div class="RespuestaAjax"></div>
                                            </form>
                                        </td>';
                                }
                                
                        $tabla.='<td>
                                    <form action="'.SERVERURL.'ajax/testimonioPlataformaAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data">
                                        <input type="hidden" name="testimonio_id_del" value="'.mainModel::encryption($rows['idTestimonio']).'">
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
                    $tabla .= '<tr> <td colspan="5"><a href="'.SERVERURL.$paginaURL.'/" class="btn btn-info"><i class="fas fa-sync-alt"></i> Haga clic acá para actualizar el listado </a></td></tr>';
                }else{
                    $tabla .= '<tr> <td colspan="5"><div class="alert alert-secondary" role="alert">
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
                        $tabla.= '<li class="page-item"><a class="page-link activo-pag" href="'.SERVERURL.$paginaURL.'/'.$i.'/">'.$i.'</a></li>';
                    }else{
                        $tabla.= '<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaURL.'/'.$i.'/">'.$i.'</a></li>';
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
        public function eliminar_testimonioPlataforma_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $id = mainModel::decryption($_POST['testimonio_id_del']);
 
            /**-----LIMPIAMOS LOS DATOS ----**/
            $id = mainModel::limpiar_cadena($id);


            $EliminartestimonioPlataforma = testimonioPlataformaModelo::eliminar_testimonioPlataforma_modelo($id);

            if($EliminartestimonioPlataforma->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"TESTIMONIO ELIMINADO","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
    
            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar el testimonio, puede que este asociado a otros registros, se recomienda cambiar el estado o intenté nuevamente","Tipo"=>"error"];

            }

            return mainModel::sweet_alert($alerta);
        }

        /*DATOS*/
        public function datos_testimonioPlataforma_controlador($tipo,$codigo,$busqueda){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return testimonioPlataformaModelo::datos_testimonioPlataforma_modelo($tipo, $codigo,$busqueda);
        }

        /* ACTUALIZAR ESTADO */
        public function actualizar_estado_testimonio_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $codigo = mainModel::decryption($_POST['testimonio-id-up']);
            $visibilidad = mainModel::decryption($_POST['testimonio-estado-up']);
                    
            if($visibilidad =="Visible"){
                $visibilidad ="No Visible" ;
            }else{
                $visibilidad ="Visible";
            }

            $datos=["estado"=>$visibilidad,"id"=>$codigo];
            $actualizar = testimonioPlataformaModelo::actualizar_estado_testimonioPlataforma_modelo($datos);
        
            if($actualizar->rowCount()>=1){
                                
                $alerta = ["Alerta"=>"recargar", "Titulo"=>"TESTIMONIO ACTUALIZADO","Texto"=>"Los datos  se actualizarón satisfactoriamente del sistema","Tipo"=>"success"];
            
                                
            }else{
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo actualizar el estado del testimonio, intenté nuevamente","Tipo"=>"error"];
            }
         
            return mainModel::sweet_alert($alerta);
        }

	}
    