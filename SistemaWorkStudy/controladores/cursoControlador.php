<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../modelos/cursoModelo.php";
	}else{
		require_once "./modelos/cursoModelo.php";
	}

	class cursoControlador extends cursoModelo
	{
		/*AGREGAR*/
		public function agregar_curso_controlador(){

			/*--DATOS DEL CURSO--*/
			$estudiante = mainModel::decryption($_POST['id_cuenta']);
			$titulo = mainModel::limpiar_cadena($_POST['curso_titulo_reg']);
			$subtitulo = mainModel::limpiar_cadena($_POST['curso_subtitulo_reg']);
			$subcategoria = mainModel::limpiar_cadena($_POST['curso_subcategoria_reg']);
			$nivel = mainModel::limpiar_cadena($_POST['curso_nivel_reg']);
			$precio = mainModel::limpiar_cadena($_POST['curso_precio_reg']);
			$duracion = mainModel::limpiar_cadena($_POST['curso_duracion_reg']);
			$video = $_POST['curso_video_reg'];
			$descripcion = $_POST['curso_descripcion_reg'];
			$requisito = $_POST['curso_requisito_reg'];
			$objetivo = $_POST['curso_objetivo_reg'];
			$dirigido = $_POST['curso_dirigido_reg'];
            $fecha = date('Y-m-d');

            
			$imagen = $_FILES['curso-imagen-reg']['name'];
            $ruta = $_FILES['curso-imagen-reg']['tmp_name'];


            /*--VALIDACIONES--*/
            if($estudiante =="" || $titulo =="" || $subtitulo=="" || $subcategoria=="Sin Registro" || $nivel=="Sin Registro" || $descripcion=="" || $requisito=="" || $objetivo=="" || $dirigido==""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{
                    
                if(is_numeric($duracion)==false || $duracion < 1){
                        
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La duración del curso no es válida","Tipo"=>"warning"];
                    
                }else{

                    if(strlen($requisito) > 200 || strlen($objetivo) > 200 || strlen($dirigido) > 200){

                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de los detalles del curso debe ser menor a 200 carácteres","Tipo"=>"warning"];
                            
                    }else{

                        if(strlen( $descripcion ) > 600 || strlen($descripcion) < 20){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la descripción del curso no es válida (20-600 carácteres)","Tipo"=>"warning"];

                        }else{
                            
                            /*--Codigo unico para imagen--*/
                            $consulta2 = mainModel::ejecutar_consulta_simple("SELECT idCurso FROM curso");
                            $numero = ($consulta2->rowCount())+1;

                            $codigo= mainModel::generar_codigo_aleatorio("CURSO",15,$numero);
                            
                            /*--ID del estudaiante--*/
                            $consulta3 = mainModel::ejecutar_consulta_simple("SELECT * FROM estudiante WHERE CuentaCodigo='$estudiante'");
                            $datosEstudiante = $consulta3->fetch();

                            /*----Imagen---*/
                            if($imagen!=""){

                                $RutaDestino="../adjuntos/cursos/".$codigo."-".$imagen;

                                copy($ruta,$RutaDestino);
                                $nombreImagen= $codigo."-".$imagen;
                                
                            }else{
                                $nombreImagen="-";
                            }
                            
                            /*Datos a guardar*/
                            $DatosCurso= ["titulo"=>$titulo,
                                          "subtitulo"=>$subtitulo,
                                          "descripcion"=>$descripcion,
                                          "nivel"=>$nivel,
                                          "imagen"=>$nombreImagen,
                                          "precio"=>$precio,
                                          "objetivos"=>$objetivo,
                                          "requisitos"=>$requisito,
                                          "dirigido"=>$dirigido,
                                          "fecha"=>$fecha,
                                          "upfecha"=>$fecha,
                                          "video"=>$video,
                                          "duracion"=>$duracion,
                                          "estudiante"=>$datosEstudiante['idEstudiante'],
                                          "idioma"=>1,
                                          "subcategoria"=>$subcategoria,
                                        ];

                            $Guardarcurso = cursoModelo::agregar_curso_modelo($DatosCurso);

                            if($Guardarcurso->rowCount()>=1){

                                $alerta = ["Alerta"=>"recargar", "Titulo"=>"CURSO REGISTRADO","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];

                            }else{

                                @unlink('../adjuntos/cursos/'.$nombreImagen);               
                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro del curso, intente nuevamente","Tipo"=>"error"];

                            }
                                
                        }
                        
                    }
                        
                }
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*LISTAR*/
        public function listar_curso_controlador(){
            $start = mainModel::limpiar_cadena($_POST['start']);
		    $limit = mainModel::limpiar_cadena($_POST['limit']);
		    $categoria = mainModel::limpiar_cadena($_POST['categoria']);

            if($categoria > 0){

                $consulta ="SELECT idCurso, SubIcono, CurImagen, CurTitulo, CurSubTitulo, CurPrecio, SubDescripcion, EstNombres, EstApePaterno, CtaFoto
                FROM curso 
                INNER JOIN estudiante ON curso.idEstudiante = estudiante.idEstudiante
                INNER JOIN subcategoria ON curso.idSubCategoria  = subcategoria.idSubcategoria
                INNER JOIN cuenta ON estudiante.CuentaCodigo = cuenta.CtaCodigo 
                WHERE idCatCurso = $categoria
                ORDER BY idcurso DESC
                LIMIT $start, $limit";

            }else{

                $consulta ="SELECT idCurso, SubIcono, CurImagen, CurTitulo, CurSubTitulo, CurPrecio, SubDescripcion, EstNombres, EstApePaterno, CtaFoto
                FROM curso 
                INNER JOIN estudiante ON curso.idEstudiante = estudiante.idEstudiante
                INNER JOIN subcategoria ON curso.idSubCategoria  = subcategoria.idSubcategoria
                INNER JOIN cuenta ON estudiante.CuentaCodigo = cuenta.CtaCodigo 
                ORDER BY idcurso DESC
                LIMIT $start, $limit";
            }
           

            $conexion = mainModel::conectar();
            $respuesta = $conexion->query($consulta);
            
            if($respuesta->rowCount()>=1){

                while($data = $respuesta->fetch()) {
                    echo'
                            <div class="curso-item">
                                <div class="curso-imagen">
                                    <a href="'.SERVERURL.'curso/'.mainModel::encryption($data['idCurso']).'/">
                                        <img  src="'.SERVERURL.'adjuntos/cursos/'.$data['CurImagen'].'" alt="'.$data['CurTitulo'].'">
                                    </a>
                                </div>
                                <div class="curso-descripcion">
                                    <a href="'.SERVERURL.'curso/'.mainModel::encryption($data['idCurso']).'/"><h3>'.$data['CurTitulo'].'</h3></a>
                                    
                                    <p>'.$data['CurSubTitulo'].'</p>
                        
                                    <div class="subcategoria">
                                        <i class="'.$data['SubIcono'].'"></i> '.$data['SubDescripcion'].'
                                    </div>
                        
                                </div>
                                <div class="curso-footer">
                                    <div class="curso-usuario">
                                        <img src="'.SERVERURL.'adjuntos/avatars/'.$data['CtaFoto'].'" alt="'.$data['CurTitulo'].'">
                                        <h4>'.$data['EstNombres'].' '.$data['EstApePaterno'].'</h4>
                                    </div>
                                    <div class="curso-precio">
                                        <i class="fas fa-money-check-alt"></i> S/ '.$data['CurPrecio'].' soles
                                    </div>
                                </div>
                            </div>
                        ';

                }

            }

        }

        /*DATOS*/
        public function datos_curso_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return cursoModelo::datos_curso_modelo($tipo, $codigo);
        }

        /*LISTA DENTRO DE CURSO UNICO*/
        public function listar_small_curso_controlador($categoria,$codigo){

            $categoria = mainModel::limpiar_cadena($categoria);
            $codigo = mainModel::decryption($codigo);

            $consulta ="SELECT * FROM curso WHERE idSubCategoria = '$categoria' AND idCurso != '$codigo' ORDER BY idcurso DESC LIMIT 2";

            $conexion = mainModel::conectar();

            $respuesta = $conexion->query($consulta);

            if($respuesta->rowCount()>=1){
                echo '<h3>Cursos Relacionados:</h3>';

                while($data = $respuesta->fetch()) {
                    echo '  <div class="item-mas-cursos">
                                <img src="'.SERVERURL.'adjuntos/cursos/'.$data['CurImagen'].'" alt="'.$data['CurTitulo'].'">
                                <div class="descripcion-item">
                                    <h2>'.$data['CurTitulo'].'</h2>
                                    <a href="'.SERVERURL.'curso/'.mainModel::encryption($data['idCurso']).'" class="enlace-funcionalidad mt-2">Ver Curso <i class="fas fa-long-arrow-alt-right"></i></a>
                                </div>
                            </div>';
                }
            }else{

                $consulta2 ="SELECT * FROM curso WHERE idCurso != '$codigo' ORDER BY idcurso DESC LIMIT 2";

                $conexion = mainModel::conectar();

                $respuesta2 = $conexion->query($consulta2);

                if($respuesta2->rowCount()>=1){

                    echo '<h3>Otros Cursos:</h3>';

                    while($data = $respuesta2->fetch()) {
                        echo '  <div class="item-mas-cursos">
                                    <img src="'.SERVERURL.'adjuntos/cursos/'.$data['CurImagen'].'" alt="'.$data['CurTitulo'].'">
                                    <div class="descripcion-item">
                                        <h2>'.$data['CurTitulo'].'</h2>
                                        <a href="'.SERVERURL.'curso/'.mainModel::encryption($data['idCurso']).'" class="enlace-funcionalidad mt-2">Ver Curso <i class="fas fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>';
                    }

                }else{
                    echo '';
                }
            }
        }

        /*ULTIMAS CURSOS*/
        public function listar_ultimos_cursos_controlador(){

            $consulta ="SELECT * FROM curso ORDER BY idCurso DESC LIMIT 3";
            $conexion = mainModel::conectar();
            $respuesta = $conexion->query($consulta);

            if($respuesta->rowCount()>=1){
                while($data = $respuesta->fetch()) {
                    echo '  <div class="item-ultimo-curso">
                                <a href="'.SERVERURL.'curso/'.mainModel::encryption($data['idCurso']).'/">
                                    <img src="'.SERVERURL.'adjuntos/cursos/'.$data['CurImagen'].'" alt="'.$data['CurTitulo'].'">
                                    <h4>'.$data['CurTitulo'].'</h4>
                                </a>
                            </div>
                            ';
                }
            }else{
                echo '<div class="alert alert-secondary text-center border w-100">
                        <i class="far fa-frown" style="font-size:4rem;"></i>
                        <h4>Oops! No hay cursos</h4>
                        <p>Sé el primero en publicar un cuso y empieza a ganar dinero</p>
                    </div>';
            }

        }


	}
    