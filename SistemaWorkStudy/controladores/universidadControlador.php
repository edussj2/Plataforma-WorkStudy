<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../modelos/universidadModelo.php";
	}else{
		require_once "./modelos/universidadModelo.php";
	}

	class universidadControlador extends universidadModelo
	{
		/*AGREGAR*/
		public function agregar_universidad_controlador(){

			$descripcion = mainModel::limpiar_cadena($_POST['universidad_nombre_reg']);
            $vigencia =  mainModel::limpiar_cadena($_POST['universidad_estado_reg']);


            /*--VALIDACIONES--*/
            if($descripcion== ""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{

                    $consulta1 = mainModel::ejecutar_consulta_simple("SELECT UniDescripcion	 FROM universidad WHERE UniDescripcion	='$descripcion'");
                    
                    if($consulta1->rowCount()>=1){
                        
                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La universidad que ingresaste ya se encuentra registrada, intente nuevamente","Tipo"=>"warning"];
                    
                    }else{

                            if(strlen( $descripcion ) > 60){

                                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La universidad ingresada no es válido en longitud","Tipo"=>"warning"];
                            
                            }else{

                                    if($vigencia != "Vigente" && $vigencia != "Sin Vigencia" ){
                            
                                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La vigencia seleccionada no es válida","Tipo"=>"warning"];
                                        
                                    }else{

                                        $datosuniversidad=[
                                            "descripcion"=>$descripcion,
                                            "vigencia"=>$vigencia
                                        ];

                                        $guardaruniversidad = universidadModelo::agregar_universidad_modelo($datosuniversidad);

                                        if($guardaruniversidad->rowCount()>=1){
                                                $alerta = ["Alerta"=>"limpiar", "Titulo"=>"UNIVERSIDAD REGISTRADA","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];
                                        }else{
                                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro de la Universidad, intente nuevamente","Tipo"=>"error"];
                                        }
                                        
                                        
                                    }
                                
                            }
                        
                    }
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_universidad_controlador($pagina,$registros,$busqueda){
            
            /**-----LIMPIAMOS PARAMETROS RECIBIDOS-----**/
            $pagina = mainModel::limpiar_cadena($pagina);
            $registros = mainModel::limpiar_cadena($registros);
            $busqueda = mainModel::limpiar_cadena($busqueda);

            $tabla = "";

            /**-----VALIDAMOS LAS PAGINAS Y EL ORDEN DE LOS REGISTROS----**/
            $pagina = (isset($pagina) && $pagina>0) ? (int)$pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros) - $registros): 0;

            /**-----VALIDAMOS SI ES UNA BUSQUEDA O SI ES LA LISTA---**/
            if(isset($busqueda) && $busqueda!=""){
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM universidad WHERE UniDescripcion LIKE '%$busqueda%'  ORDER BY UniDescripcion ASC LIMIT $inicio,$registros";

                $paginaURL = "universidadBuscar";
            }else{
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM universidad WHERE idUniversidad != 1 ORDER BY UniDescripcion ASC LIMIT $inicio,$registros";

                $paginaURL = "universidadLista";
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
                        <table class="table table-hover text-center">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Estado</th> 
                                    <th scope="col">Actualizar</th>
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
                                        <h6>'.$rows['UniDescripcion'].'</h6>
                                    </div>
                                </td>
                                <td>
                                    '.$rows['UniVigencia'].'
                                </td>
                                <td>
                                    <a href="'.SERVERURL.'universidadEditar/'.mainModel::encryption($rows['idUniversidad']).'/" class="btn btn-success" data-toggle="tooltip" title="Actualizar Cuenta" data-placement="bottom">
                                        <i class="fas fa-sync"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="'.SERVERURL.'ajax/universidadAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data">
                                        <input type="hidden" name="universidad_id_del" value="'.mainModel::encryption($rows['idUniversidad']).'">
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
        public function eliminar_universidad_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $id = mainModel::decryption($_POST['universidad_id_del']);
 
            /**-----LIMPIAMOS LOS DATOS ----**/
            $id = mainModel::limpiar_cadena($id);


            $EliminarSector = universidadModelo::eliminar_universidad_modelo($id);

            if($EliminarSector->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"UNIVERSIDAD ELIMINADA","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
    
            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar la Universidad, puede que este asociado a otros registros, se recomienda cambiar el estado o intenté nuevamente","Tipo"=>"error"];

            }
     

            return mainModel::sweet_alert($alerta);
        }

        /*DATOS*/
        public function datos_universidad_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return universidadModelo::datos_universidad_modelo($tipo, $codigo);
        }

	}
    