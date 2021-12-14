<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../modelos/materiaModelo.php";
	}else{
		require_once "./modelos/materiaModelo.php";
	}

	class materiaControlador extends materiaModelo
	{
		/*AGREGAR*/
		public function agregar_materia_controlador(){

			$descripcion = mainModel::limpiar_cadena($_POST['materia_nombre_reg']);
            $vigencia =  mainModel::limpiar_cadena($_POST['materia_estado_reg']);


            /*--VALIDACIONES--*/
            if($descripcion== ""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{

                    $consulta1 = mainModel::ejecutar_consulta_simple("SELECT MatNombre FROM materia WHERE MatNombre='$descripcion'");
                    
                    if($consulta1->rowCount()>=1){
                        
                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La descripción que ingresaste ya se encuentra registrada, intente nuevamente","Tipo"=>"warning"];
                    
                    }else{

                            if(strlen( $descripcion ) > 45){

                                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La descripción ingresada no es válido en longitud","Tipo"=>"warning"];
                            
                            }else{

                                    if($vigencia != "Vigente" && $vigencia != "Sin Vigencia" ){
                            
                                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La vigencia seleccionada no es válida","Tipo"=>"warning"];
                                        
                                    }else{

                                        $datosmateria=[
                                            "descripcion"=>$descripcion,
                                            "vigencia"=>$vigencia
                                        ];

                                        $guardarmateria = materiaModelo::agregar_materia_modelo($datosmateria);

                                        if($guardarmateria->rowCount()>=1){
                                                $alerta = ["Alerta"=>"limpiar", "Titulo"=>"MATERIA REGISTRADA","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];
                                        }else{
                                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro de la materia, intente nuevamente","Tipo"=>"error"];
                                        }
                                        
                                        
                                    }
                                
                            }
                        
                    }
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_materia_controlador($pagina,$registros,$busqueda){
            
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
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM materia WHERE MatNombre LIKE '%$busqueda%'  ORDER BY MatNombre ASC LIMIT $inicio,$registros";

                $paginaURL = "materiaBuscar";
            }else{
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM materia ORDER BY MatNombre ASC LIMIT $inicio,$registros";

                $paginaURL = "materiaLista";
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
                                    <th scope="col">Nombre</th>
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
                                        <h6>'.$rows['MatNombre'].'</h6>
                                    </div>
                                </td>
                                <td>
                                    '.$rows['MatVigencia'].'
                                </td>
                                <td>
                                    <a href="'.SERVERURL.'materiaEdit/'.mainModel::encryption($rows['idMateria']).'/" class="btn btn-success" data-toggle="tooltip" title="Actualizar Cuenta" data-placement="bottom">
                                        <i class="fas fa-sync"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="'.SERVERURL.'ajax/materiaAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data">
                                        <input type="hidden" name="materia_id_del" value="'.mainModel::encryption($rows['idMateria']).'">
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
        public function eliminar_materia_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $id = mainModel::decryption($_POST['materia_id_del']);
 
            /**-----LIMPIAMOS LOS DATOS ----**/
            $id = mainModel::limpiar_cadena($id);


            $EliminarMateria = materiaModelo::eliminar_materia_modelo($id);

            if($EliminarMateria->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"MATERIA ELIMINADA","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
    
            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar la categoría, puede que este asociado a otros registros, se recomienda cambiar el estado o intenté nuevamente","Tipo"=>"error"];

            }
     

            return mainModel::sweet_alert($alerta);
        }

        /*DATOS*/
        public function datos_materia_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return materiaModelo::datos_materia_modelo($tipo, $codigo);
        }

	}
    