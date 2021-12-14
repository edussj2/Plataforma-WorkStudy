<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../modelos/anuncioModelo.php";
	}else{
		require_once "./modelos/anuncioModelo.php";
	}

	class anuncioControlador extends anuncioModelo
	{
		/*AGREGAR*/
		public function agregar_anuncio_controlador(){

			/*--DATOS DEL anuncio--*/
			$tipoClases = mainModel::limpiar_cadena($_POST['anuncio_tipo_clase_reg']);
			$materia = mainModel::limpiar_cadena($_POST['anuncio_materia_reg']);
			$titulo = mainModel::limpiar_cadena($_POST['anuncio_titulo_reg']);
			$descripcion = mainModel::limpiar_cadena($_POST['anuncio_descripcion_reg']);
            $pago = mainModel::limpiar_cadena($_POST['anuncio_pago_reg']);
			$precio = mainModel::limpiar_cadena($_POST['anuncio_precio_reg']);
			$para = mainModel::limpiar_cadena($_POST['anuncio_para_reg']);
			$nivel = mainModel::limpiar_cadena($_POST['anuncio_nivel_reg']);
			$cuenta = mainModel::decryption($_POST['id_cuenta']);

            /*--VALIDACIONES--*/
            if($tipoClases== "" || $materia=="Sin Registro" || $titulo=="" || $descripcion=="" || $precio=="" || $nivel=="Sin Registro" || $para =="Sin Registro" || $pago =="Sin Registro"){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{
            
                if(strlen($titulo) >60 || strlen($titulo) < 5){

                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud del título no es válido","Tipo"=>"warning"];
                
                }else{

                    $query1 = mainModel::ejecutar_consulta_simple("SELECT idTutor FROM estudiante INNER JOIN tutor ON tutor.idEstudiante = estudiante.idEstudiante WHERE estudiante.CuentaCodigo='$cuenta'");

                    $datos = $query1->fetch();
                    $tutor = $datos['idTutor'];

                    $consulta1 = mainModel::ejecutar_consulta_simple("SELECT idTutor, idMateria FROM anuncio WHERE idMateria='$materia' AND idTutor= '$tutor'");
                    
                    if($consulta1->rowCount()>=1){
                        
                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Usted ya tiene un anuncio de esa materia, se recomienda eliminarla o modificarla.","Tipo"=>"warning"];
                    
                    }else{

                        
                        if(strlen($descripcion) > 400 || strlen($descripcion)<80){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la descripción es muy larga.","Tipo"=>"warning"];
                        
                        }else{

                            if($precio == 0.0 || $precio == 0){

                                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Por favor ingrese un precio por sus servicios","Tipo"=>"warning"];
                            
                            }else{

                                    if(strlen($pago)>50 ){
                           
                                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La modalidad de pago seleccionada no es válida, intente nuevamante.","Tipo"=>"warning"];
                                       
                                    }else{
                                        
                                        $fechaActual = date('Y-m-d');

                                        $datosanuncio=[
                                                "tipo"=>$tipoClases,
                                                "materia"=>$materia,
                                                "titulo"=>$titulo,
                                                "descripcion"=>$descripcion,
                                                "pago"=>$pago,
                                                "precio"=>$precio,
                                                "para"=>$para,
                                                "fecha"=>$fechaActual,
                                                "estado"=>"Disponible",
                                                "nivel"=>$nivel,
                                                "tutor"=>$tutor
                                        ];

                                        $guardaranuncio = anuncioModelo::agregar_anuncio_modelo($datosanuncio);

                                        if($guardaranuncio->rowCount()>=1){
                                            
                                            $alerta = ["Alerta"=>"limpiar", "Titulo"=>"ANUNCIO REGISTRADO","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];
                                            
                                        }else{
                                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro del anuncio, intente nuevamente","Tipo"=>"error"];
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
        public function paginador_anuncio_controlador($pagina,$registros,$busqueda){
            
            /**-----LIMPIAMOS PARAMETROS RECIBIDOS-----**/
            $pagina = mainModel::limpiar_cadena($pagina);
            $registros = mainModel::limpiar_cadena($registros);
            $busqueda = mainModel::limpiar_cadena($busqueda);

            $tabla = "";

            /**-----VALIDAMOS LAS PAGINAS Y EL ORDEN DE LOS REGISTROS----**/
            $pagina = (isset($pagina) && $pagina>0) ? (int)$pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros) - $registros): 0;

            /**-----VALIDAMOS SI ES UNA BUSQUEDA O SI ES LA LISTA---**/
            if($busqueda!="all"){
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM anuncio WHERE AnuTipClase LIKE '%$busqueda%' ORDER BY AnuFecha DESC LIMIT $inicio,$registros";

                $paginaURL = "anuncios/".$busqueda;
            }else{
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM anuncio ORDER BY AnuFecha DESC LIMIT $inicio,$registros";

                $paginaURL = "anuncios/all";
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
            $tabla .= '<div class="lista-anuncios">';

            if($total>=1 && $pagina <= $Npaginas){

                $contador = $inicio+1;
                foreach ($datos as $rows) {

                    $query1 = mainModel::ejecutar_consulta_simple("SELECT * FROM materia WHERE idMateria ='".$rows['idMateria']."'");
                    $datos= $query1->fetch();

                    $tabla.= '
                            <div class="item-anuncio">
                                <div class="cabecera-anuncio">
                                    '.$rows['AnuTitulo'].'
                                </div>
                                <div class="cuerpo-anuncio">
                                    <div class="imagen-anuncio">
                                        <img src="'.SERVERURL.'adjuntos/avatars/avatar.png" alt="">
                                    </div>
                                    <div class="descripcion-anuncio">
                                        <div class="detalles-anuncio">
                                            <i class="fas fa-map-marker-alt"></i> '.$rows['AnuTipClase'].' | '.$datos['MatNombre'].' | '.$rows['AnuNivel'].'
                                        </div>
                                        <p>'.substr($rows['AnuDescripcion'],0,212).' .....</p>
                                        <div class="opciones-anuncio">
                                            <a href="'.SERVERURL.'anuncio/'.mainModel::encryption($rows['idAnuncio']).'/" class=""><i class="fas fa-info-circle"></i> Ver detalles</a>  
                                            <a href="" class=""><i class="far fa-comment"></i> Contactar </a>
                                        </div>
                                    </div>
                                </div>
                            </div>';

                    $contador++;
                }
            }else{
                if($total>=1){
                    $tabla .= '<div><a href="'.SERVERURL.$paginaURL.'/" class="btn btn-info"><i class="fas fa-sync-alt"></i> Haga clic acá para actualizar el listado </a></div>';
                }else{
                    $tabla .= '<div class="pt-5 pb-5"><div class="alert alert-secondary" role="alert">
                    <i class="fas fa-bullhorn"></i> NO HAY REGISTOS EN EL SISTEMA</div></div>';
                }
            }

            $tabla .= '</div>';

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
        public function datos_anuncio_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return anuncioModelo::datos_anuncio_modelo($tipo, $codigo);
        }

	}
    