<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../modelos/ofertaModelo.php";
	}else{
		require_once "./modelos/ofertaModelo.php";
	}

	class ofertaControlador extends ofertaModelo
	{
		/*AGREGAR*/
		public function agregar_oferta_controlador(){

			/*--DATOS DE LA OFERTA--*/
			$titulo = mainModel::limpiar_cadena($_POST['oferta_titulo_reg']);
			$descripcion = $_POST['oferta_descripcion_reg'];
			$eduMin = mainModel::limpiar_cadena($_POST['oferta_eduMin_reg']);
			$expYear = mainModel::limpiar_cadena($_POST['oferta_expYear_reg']);
			$disViajar = mainModel::limpiar_cadena($_POST['oferta_disViajar_reg']);
			$disCamRes = mainModel::limpiar_cadena($_POST['oferta_disCamRes_reg']);
			$jorLaboral = mainModel::limpiar_cadena($_POST['oferta_jorLaboral_reg']);
			$tipTrabajo = mainModel::limpiar_cadena($_POST['oferta_tipTrabajo_reg']);
			$tipContrato = mainModel::limpiar_cadena($_POST['oferta_tipContrato_reg']);
			$salario = mainModel::limpiar_cadena($_POST['oferta_salario_reg']);
			$disDiscapacitado = mainModel::limpiar_cadena($_POST['oferta_disDiscapacitado_reg']);
			$fLimite = mainModel::limpiar_cadena($_POST['oferta_fLimite_reg']);
			$vacantes = mainModel::limpiar_cadena($_POST['oferta_vacantes_reg']);
			$relevancia = mainModel::limpiar_cadena($_POST['oferta_relevancia_reg']);
			$categoria = mainModel::limpiar_cadena($_POST['oferta_categoria_reg']);
			$empresa = mainModel::decryption($_POST['oferta_empresa_reg']);
            $fPublicacion = date('Y-m-d');


            /*--VALIDACIONES--*/
            if($titulo=="" || $empresa == ""  || $categoria =="Sin Registro"  || $tipTrabajo=="Sin Registro" || $tipContrato == "Sin Registro" || $vacantes == "" || $salario=="" || $eduMin =="Sin Registro" || $expYear =="Sin Registro" || $jorLaboral=="Sin Registro"){
 
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{
                    
                if(is_numeric($vacantes)==false ){
                        
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El número de vacantes ingresados no no es válida","Tipo"=>"warning"];
                    
                }else{

                    if(strlen( $descripcion ) > 800 || strlen($descripcion) < 200){

                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la descripción no es válida, número máximo de carácteres de 2000 y mínimo de 200","Tipo"=>"warning"];
                            
                    }else{

                        if(strlen( $titulo ) > 50 || strlen($titulo) < 15){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud del título no es válido, intente modificando el título.","Tipo"=>"warning"];

                        }else{
                            
                            
                            /*--ID del estudaiante--*/
                            $consulta3 = mainModel::ejecutar_consulta_simple("SELECT * FROM empresa WHERE CuentaCodigo='$empresa'");
                            $datosEmp = $consulta3->fetch();

                            /*Datos a guardar*/
                            $Datosoferta= [ "titulo"=>$titulo,
                                            "descripcion"=>$descripcion,
                                            "eduMin"=>$eduMin,
                                            "expYear"=>$expYear,
                                            "disViajar"=>$disViajar,
                                            "disCamRes"=>$disCamRes,
                                            "jorLaboral"=>$jorLaboral,
                                            "tipTrabajo"=>$tipTrabajo,
                                            "tipContrato"=>$tipContrato,
                                            "salario"=>$salario,
                                            "disDiscapacitado"=>$disDiscapacitado,
                                            "fLimite"=>$fLimite,
                                            "fPublicacion"=>$fPublicacion,
                                            "vacantes"=>$vacantes,
                                            "relevancia"=>$relevancia,
                                            "categoria"=>$categoria,
                                            "empresa"=>$datosEmp['idEmpresa']
                                        ];

                            $Guardaroferta = ofertaModelo::agregar_oferta_modelo($Datosoferta);

                            if($Guardaroferta->rowCount()>=1){

                                $alerta = ["Alerta"=>"recargar", "Titulo"=>"CONVOCATORIA REGISTRADA","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];

                            }else{
              
                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro de la convocatoria, intente nuevamente","Tipo"=>"error"];

                            }
                                
                        }
                        
                    }
                        
                }
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /* MOSTRAR TOTAL */
        public function paginador_oferta_controlador($pagina,$registros,$busqueda,$orden){
       
            /**-----LIMPIAMOS PARAMETROS RECIBIDOS-----**/
           $pagina = mainModel::limpiar_cadena($pagina);
           $registros = mainModel::limpiar_cadena($registros);
           $orden = mainModel::limpiar_cadena($orden);
           $busqueda = mainModel::limpiar_cadena($busqueda);

           $tabla = "";

           /**Validamos Orden */
           if($orden == "date"){
                $criOrden ="OfeFecPublicacion";
           }elseif($orden=="salary"){
                $criOrden ="OfeSalario";
           }else{
                $criOrden ="OfeRelevancia";
           }

           /**-----VALIDAMOS LAS PAGINAS Y EL ORDEN DE LOS REGISTROS----**/
           $pagina = (isset($pagina) && $pagina>0) ? (int)$pagina : 1;
           $inicio = ($pagina>0) ? (($pagina * $registros) - $registros): 0;

           /**-----VALIDAMOS SI ES UNA BUSQUEDA O SI ES LA LISTA---**/
           if($busqueda!="" && isset($busqueda)){

                 $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM oferta WHERE idCategoria LIKE '$busqueda'  ORDER BY $criOrden DESC LIMIT $inicio,$registros";

                $paginaURL = "ofertas/".$orden;

           }else{

                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM oferta ORDER BY $criOrden DESC LIMIT $inicio,$registros";
                 $paginaURL = "ofertas/".$orden;

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

           if($total>=1 && $pagina <= $Npaginas){

               $contador = $inicio+1;
               foreach ($datos as $rows) {

                $query1 = mainModel::ejecutar_consulta_simple("SELECT * FROM empresa WHERE idEmpresa ='".$rows['idEmpresa']."'");
                $datos= $query1->fetch();

                $query2 = mainModel::ejecutar_consulta_simple("SELECT * FROM cuenta WHERE CtaCodigo ='".$datos['CuentaCodigo']."'");
                $cuenta= $query2->fetch();

                $tabla.= '
                        <div class="oferta">
                            <div class="descripcion-oferta">
                                    <div class="cabecera">
                                        <h2>'.$rows['OfeTitulo'].'</h2>
                                        <div class="sub-cabecera">
                                            <span class="empresa"><a href="#">'.$datos['EmpRazSocial'].'</a></span>
                                            <span class="lugar">- Lambayeque, Motupe</span>
                                        </div>
                                    </div>
                                    <div class="cuerpo">
                                        <p>'.substr($rows['OfeDescripcion'],0,200).'...</p>
                                        <div class="fila-detalles">
                                            <div class="opcion-salario">
                                                <i class="fas fa-dollar-sign" style="color:green;"></i> Salario: '.$rows['OfeSalario'].'
                                            </div>
                                            <div class="opcion-fila-detalle">';
                                        if($rows['OfeRelevancia']=="Urgente"){
                                            $tabla.='<span class="badge badge-danger p-2 pl-3 pr-3"><i class="fas fa-stopwatch"></i> '.$rows['OfeRelevancia'].'</span>';
                                        }elseif($rows['OfeRelevancia']=="Normal"){
                                            $tabla.='<span class="badge badge-success p-2 pl-3 pr-3"><i class="fas fa-stopwatch"></i> '.$rows['OfeRelevancia'].'</span>';
                                        }
                                            
                                $tabla.='   </div>
                                            <div class="opcion-fecha">
                                                <i class="far fa-calendar-alt" style="color:#ff5b00;"></i> Hasta: '.$rows['OfeFecLimite'].'
                                            </div>
                                        </div>
                                    </div>
                                    <div class="botones-oferta">
                                            <a href="'.SERVERURL.'oferta/'.mainModel::encryption($rows['idOferta']).'/">Ver detalles <i class="fas fa-chevron-circle-right"></i></a>
                                            <a href="https://api.whatsapp.com/send?phone='.$datos['EmpContCelular'].'&text=Hola, encontre tu oferta laborarl de en WorkStudy. Más información porfavor.">Postularme <i class="far fa-paper-plane"></i></a>
                                    </div>
                            </div>
                            <div class="imagen-oferta">
                                    <img src="'.SERVERURL.'adjuntos/avatars/'.$cuenta['CtaFoto'].'" alt="">
                                    
                                    <div class="pie p-1">
                                        Publicado: '.$rows['OfeFecPublicacion'].'
                                    </div>
                            </div>
                        </div>
                        ';
                $contador++;
               }
           }else{
               if($total>=1){
                   $tabla .= '<div class="p-3 d-flex justify-content-center"><a href="'.SERVERURL.$paginaURL.'/" class="btn btn-info"><i class="fas fa-sync-alt"></i> Haga clic acá para actualizar el listado </a></div>';
               }else{
                   $tabla .= '
                   <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-bullhorn"></i></strong>  NO HAY OFERTAS LABORALES REGISTRADAS 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
               }
           }

           /**-----GENERAMOS PAGINADOR---**/
           if($total>=1 && $pagina <= $Npaginas){

               $tabla.='<nav class="mt-4 border p-1 pt-4" style="background:#fff">
               <ul class="pagination justify-content-center align-items-center">';

               if($pagina==1){
                   $tabla.= '<li class="page-item disabled"><a class="page-link" style="text-decoration: none;">&larr;</a></li>';
               }else{
                   $tabla.= '<li class="page-item"><a class="page-link" style="text-decoration: none;" href="'.SERVERURL.$paginaURL.'/'.($pagina-1).'/" >&larr;</a></li>';
               }

               /*BOTONES QUE MOSTRARAS*/
               $ci=0;
               $botones = 5;

               for ($i=$pagina; $i <= $Npaginas ; $i++) {
                   if($ci >=$botones){
                       break;
                   } 
                   if($pagina == $i){
                       $tabla.= '<li class="page-item active"><a class="page-link" href="'.SERVERURL.$paginaURL.'/'.$i.'/">'.$i.'</a></li>';
                   }else{
                       $tabla.= '<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaURL.'/'.$i.'/">'.$i.'</a></li>';
                   }
                   $ci++;
               }

               if($pagina==$Npaginas){
                   $tabla.= '<li class="page-item disabled"><a class="page-link">&rarr;</a></li>';
               }else{
                   $tabla.= '<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaURL.'/'.($pagina+1).'/" >&rarr;</li>';
               }

               $tabla.='</ul></nav>';
           }
           return $tabla;
        }

        /*DATOS*/
        public function datos_oferta_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return ofertaModelo::datos_oferta_modelo($tipo, $codigo);
        }

        /*OFERTAS HOY*/
        public function listar_hoy_ofertas_controlador($fecha){

            $consulta ="SELECT * FROM oferta INNER JOIN empresa ON oferta.idEmpresa = empresa.idEmpresa INNER JOIN cuenta ON empresa.CuentaCodigo= cuenta.CtaCodigo WHERE OfeFecPublicacion = '$fecha' ORDER BY idOferta DESC LIMIT 6";
            $conexion = mainModel::conectar();
            $respuesta = $conexion->query($consulta);

            if($respuesta->rowCount()>=1){
                while($data = $respuesta->fetch()) {
                    echo '  <div class="oferta-inicio">
                                <div class="img-oferta-inicio">
                                    <img id="afectado" src="'.SERVERURL.'adjuntos/avatars/'.$data['CtaFoto'].'">
                                </div>
                                <h3 class="titulo-oferta-inicio"><a href="#" id="sobremi">'.$data['OfeTitulo'].'</a></h3>
                            </div>';
                }
            }else{
                echo '<div class="alert alert-info text-center border p-4">
                        <i class="far fa-frown" style="font-size:4rem;"></i>
                        <h4>Oops! No se encontrarón ofertas hoy</h4>
                    </div>';
            }

        }
	}
    