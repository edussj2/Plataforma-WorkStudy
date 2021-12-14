<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../modelos/categoriaModelo.php";
	}else{
		require_once "./modelos/categoriaModelo.php";
	}

	class categoriaControlador extends categoriaModelo
	{
		/*AGREGAR*/
		public function agregar_categoria_controlador(){

			$descripcion = mainModel::limpiar_cadena($_POST['categoria_nombre_reg']);
            $vigencia =  mainModel::limpiar_cadena($_POST['categoria_estado_reg']);


            /*--VALIDACIONES--*/
            if($descripcion== ""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{

                    $consulta1 = mainModel::ejecutar_consulta_simple("SELECT CatDescripcion	 FROM categoria WHERE CatDescripcion	='$descripcion'");
                    
                    if($consulta1->rowCount()>=1){
                        
                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La descripción que ingresaste ya se encuentra registrada, intente nuevamente","Tipo"=>"warning"];
                    
                    }else{

                            if(strlen( $descripcion ) > 45){

                                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La descripción ingresada no es válido en longitud","Tipo"=>"warning"];
                            
                            }else{

                                    if($vigencia != "Vigente" && $vigencia != "Sin Vigencia" ){
                            
                                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La vigencia seleccionada no es válida","Tipo"=>"warning"];
                                        
                                    }else{

                                        $datoscategoria=[
                                            "descripcion"=>$descripcion,
                                            "vigencia"=>$vigencia
                                        ];

                                        $guardarCategoria = categoriaModelo::agregar_categoria_modelo($datoscategoria);

                                        if($guardarCategoria->rowCount()>=1){
                                                $alerta = ["Alerta"=>"limpiar", "Titulo"=>"CATEGORÍA REGISTRADA","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];
                                        }else{
                                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro de la categoría, intente nuevamente","Tipo"=>"error"];
                                        }
                                        
                                        
                                    }
                                
                            }
                        
                    }
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_categoria_controlador($pagina,$registros,$busqueda){
            
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
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM categoria WHERE CatDescripcion LIKE '%$busqueda%'  ORDER BY CatDescripcion ASC LIMIT $inicio,$registros";

                $paginaURL = "categoriaBuscar";
            }else{
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM categoria ORDER BY CatDescripcion ASC LIMIT $inicio,$registros";

                $paginaURL = "categoriaLista";
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
                                        <h6>'.$rows['CatDescripcion'].'</h6>
                                    </div>
                                </td>
                                <td>
                                    '.$rows['CatVigencia'].'
                                </td>
                                <td>
                                    <a href="'.SERVERURL.'categoriaEditar/'.mainModel::encryption($rows['idCategoria']).'/" class="btn btn-success" data-toggle="tooltip" title="Actualizar Cuenta" data-placement="bottom">
                                        <i class="fas fa-sync"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="'.SERVERURL.'ajax/categoriaAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data">
                                        <input type="hidden" name="categoria_id_del" value="'.mainModel::encryption($rows['idCategoria']).'">
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
        public function eliminar_categoria_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $id = mainModel::decryption($_POST['categoria_id_del']);
 
            /**-----LIMPIAMOS LOS DATOS ----**/
            $id = mainModel::limpiar_cadena($id);


            $EliminarSector = categoriaModelo::eliminar_categoria_modelo($id);

            if($EliminarSector->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"CATEGORÍA ELIMINADA","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
    
            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar la categoría, puede que este asociado a otros registros, se recomienda cambiar el estado o intenté nuevamente","Tipo"=>"error"];

            }
     

            return mainModel::sweet_alert($alerta);
        }

        /*DATOS*/
        public function datos_categoria_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return categoriaModelo::datos_categoria_modelo($tipo, $codigo);
        }

	}
    