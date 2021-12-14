<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../modelos/estudianteModelo.php";
	}else{
		require_once "./modelos/estudianteModelo.php";
	}

	class estudianteControlador extends estudianteModelo
	{
        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_estudiante_controlador($pagina,$registros,$busqueda){
            
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
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM estudiante WHERE EstNombres LIKE '%$busqueda%' OR EstApePaterno LIKE '%$busqueda%' OR EstDNI LIKE '%$busqueda%' ORDER BY EstApePaterno ASC LIMIT $inicio,$registros";

                $paginaURL = "estudianteBuscar";
            }else{
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM estudiante ORDER BY EstApePaterno ASC LIMIT $inicio,$registros";

                $paginaURL = "estudianteLista";
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
                                    <h6>'.$rows['EstApePaterno'].' '.$rows['EstApeMaterno'].' '.$rows['EstNombres'].'</h4>
                                </div>
                                </td>
                                <td>'.$rows['EstDNI'].'</td>
                                <td>
                                    <a href="'.SERVERURL.'estudianteEditar/'.mainModel::encryption($rows['CuentaCodigo']).'/" class="btn btn-success" data-toggle="tooltip" title="Actualizar Datos" data-placement="bottom">
                                            <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="'.SERVERURL.'cuentaEditar/'.mainModel::encryption($rows['CuentaCodigo']).'/" class="btn btn-success" data-toggle="tooltip" title="Actualizar Cuenta" data-placement="bottom">
                                        <i class="fas fa-cog"></i>
                                    </a>
                                </td>
                            </tr>';

                    $contador++;
                }
            }else{
                if($total>=1){
                    $tabla .= '<tr> <td colspan="5"><a href="'.SERVERURL.$paginaURL.'/" class="btn btn-info"><i class="fas fa-sync-alt"></i> Haga clic acá para actualizar el listado </a></td></tr>';
                }else{
                    $tabla .= '<tr> <td colspan="5"> <div class="alert alert-secondary" role="alert">
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
        
        /*DATOS*/
        public function datos_estudiante_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return estudianteModelo::datos_estudiante_modelo($tipo, $codigo);
        }

        /*ACTUALIZAR */
        public function actualizar_estudiante_controlador(){ 

            $id = mainModel::decryption($_POST['estudiante_id_up']);
            $descripcion = mainModel::limpiar_cadena($_POST['estudiante_nombre_up']);
            $vigencia = mainModel::limpiar_cadena($_POST['estudiante_estado_up']);

            if($id == "" || ($vigencia != "Habilitada" && $vigencia != "Deshabilitada")){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos correctamente","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();
            }

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM estudiante WHERE idTrabajador ='$id'");

            $datos = $consulta1->fetch();

            if($descripcion != $datos['descripcion']){

                $consulta2 = mainModel::ejecutar_consulta_simple("SELECT descripcion FROM estudiante WHERE descripion ='$descripcion'");

                if($consulta2->rowCount()>=1){

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La descripción ya ha sido registrada en el sistema, intenté nuevamente","Tipo"=>"error"];
                    return mainModel::sweet_alert($alerta);
                    exit();

                }
            }

            if(strlen( $descripcion ) > 40){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la descripción no es válida","Tipo"=>"warning"];   
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            $datosestudiante= ["descripcion"=>$descripcion, "vigencia"=>$vigencia, "codigo"=>$id];

            if(estudianteModelo::actualizar_estudiante_modelo($datosestudiante)->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"estudiante ACTUALIZADO","Texto"=>"Los datos fueron actualizados con éxito","Tipo"=>"success"];

            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudieron actualizar los datos del Documento, intenté nuevamente","Tipo"=>"error"];

            }
            return mainModel::sweet_alert($alerta);
        }
	}
    