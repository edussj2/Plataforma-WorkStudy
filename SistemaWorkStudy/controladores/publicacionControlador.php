<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../modelos/publicacionModelo.php";
	}else{
		require_once "./modelos/publicacionModelo.php";
	}

	class publicacionControlador extends publicacionModelo
	{
		/*AGREGAR*/
		public function agregar_publicacion_controlador(){

			/*--DATOS DEL user--*/
			$estudiante = mainModel::decryption($_POST['publicacion_estudiante_reg']);
			$descripcion = $_POST['publicacion_descripcion_reg'];
			$area = mainModel::limpiar_cadena($_POST['publicacion_area_reg']);
            $fecha = date('Y-m-d');

            
			$imagen = $_FILES['publicacion_imagen_reg']['name'];
            $ruta = $_FILES['publicacion_imagen_reg']['tmp_name'];


            /*--VALIDACIONES--*/
            if(($descripcion == "" && $imagen == "") || $estudiante =="" || $area =="Sin Registro"){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{
        
                $consulta1 = mainModel::ejecutar_consulta_simple("SELECT idArea FROM area WHERE idArea='$area'");
                    
                if($consulta1->rowCount()==0){
                        
                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El área seleccionada no es válida","Tipo"=>"warning"];
                    
                }else{

                    if(strlen( $descripcion ) > 2000){

                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la descripción no es válida, número máximo de carácteres de 2000","Tipo"=>"warning"];
                            
                    }else{

                        if(strlen( $imagen ) > 200){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud del nombre de la imagen no es válido, intente cambiando de nombre a la imagen.","Tipo"=>"warning"];

                        }else{
                            
                            /*--Codigo unico para imagen--*/
                            $consulta2 = mainModel::ejecutar_consulta_simple("SELECT idPublicacion FROM publicacion");
                            $numero = ($consulta2->rowCount())+1;

                            $codigo= mainModel::generar_codigo_aleatorio("PUBLIC",15,$numero);
                            
                            /*--ID del estudaiante--*/
                            $consulta3 = mainModel::ejecutar_consulta_simple("SELECT * FROM estudiante WHERE CuentaCodigo='$estudiante'");
                            $datosEstudiante = $consulta3->fetch();

                            /*----Imagen---*/
                            if($imagen!=""){

                                $RutaDestino="../adjuntos/Publicaciones-Estudiantes/".$codigo."-".$imagen;

                                copy($ruta,$RutaDestino);
                                $nombreImagen= $codigo."-".$imagen;
                                
                            }else{
                                $nombreImagen="-";
                            }
                            
                            /*Datos a guardar*/
                            $Datospublicacion= ["descripcion"=>$descripcion,"imagen"=>$nombreImagen,"fecha"=>$fecha,"estudiante"=>$datosEstudiante['idEstudiante'],"area"=>$area];

                            $Guardarpublicacion = publicacionModelo::agregar_publicacion_modelo($Datospublicacion);

                            if($Guardarpublicacion->rowCount()>=1){

                                $alerta = ["Alerta"=>"recargar", "Titulo"=>"PUBLICACIÓN REGISTRADA","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];

                            }else{

                                @unlink('../adjuntos/Publicaciones-Estudiantes/'.$nombreImagen);               
                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro de la publicación, intente nuevamente","Tipo"=>"error"];

                            }
                                
                        }
                        
                    }
                        
                }
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*LISTAR PUBLICACIONES*/
        public function listar_publicacion_controlador(){
            $start = mainModel::limpiar_cadena($_POST['start']);
		    $limit = mainModel::limpiar_cadena($_POST['limit']);
		    $cuenta = mainModel::limpiar_cadena($_POST['cuenta']);


            /**Consulta de las publicacions**/
            $consulta ="SELECT idPublicacion, PubDescripcion, PubImagen, PubFecha, EstNombres, EstApePaterno, EstApeMaterno, AreDescripcion, CtaFoto, AreColor, estudiante.idEstudiante AS idEst
            FROM publicacion 
            INNER JOIN estudiante ON publicacion.idEstudiante = estudiante.idEstudiante
            INNER JOIN area ON publicacion.idArea = area.idArea
            INNER JOIN cuenta ON estudiante.CuentaCodigo = cuenta.CtaCodigo 
            ORDER BY idPublicacion DESC
            LIMIT $start, $limit";
            $conexion = mainModel::conectar();
            $respuesta = $conexion->query($consulta);
            $contador=1;
        
			while($data = $respuesta->fetch()) {

                $idPublicacion = $data['idPublicacion'];
				echo '
                    <div class="caja-post">

                        <div class="post-header">
                            <img class="rounded-circle foto-pequeña" src="'.SERVERURL.'adjuntos/avatars/'.$data['CtaFoto'].'" alt="Foto-Usuario">
                            <div class="post-descripcion">
                                <span class="post-nombre-cerrar">
                                    <a href="#">'.$data['EstNombres'].' '.$data['EstApePaterno'].' '.$data['EstApeMaterno'].'</a>
                                    <a href="#" class=""><i class="fas fa-ellipsis-v"></i></a>
                                </span>
                                <span class="post-fecha">'.$data['PubFecha'].'</span>
                            </div>
                        </div>

                        <div class="post-body">                
                            <p class="post-texto">
                                '.$data['PubDescripcion'].'
                            </p>';
                if($data['PubImagen']=="-"){
                    echo
                            '<div class="post-archivo d-none"></div>';
                }else{
                    echo
                            '<div class="post-archivo"> 
                                <img src="'.SERVERURL.'adjuntos/Publicaciones-Estudiantes/'.$data['PubImagen'].'" alt="">
                            </div>';
                    }


                /*Consulta del Usuario que esta viendo*/
                $ConocerUsuario = "SELECT * FROM estudiante WHERE CuentaCodigo = '$cuenta'";
                $conexion = mainModel::conectar();
                $respuestaUsuario = $conexion->query($ConocerUsuario); 
                $DataEst = $respuestaUsuario->fetch();
                $idEstudiante = $DataEst['idEstudiante'];


                /*Consulta para mostrar Comentarios*/
                $consultaComentarios ="SELECT comentario_publicacion.*, estudiante.EstNombres AS nombre, estudiante.EstApePaterno AS paterno, estudiante.EstApeMaterno AS materno, cuenta.CtaFoto AS foto FROM comentario_publicacion 
                INNER JOIN estudiante ON comentario_publicacion.idEstudiante = estudiante.idEstudiante
                INNER JOIN cuenta ON estudiante.CuentaCodigo = cuenta.CtaCodigo
                WHERE comentario_publicacion.idPublicacion = $idPublicacion 
                ORDER BY ComPubFecha DESC
                LIMIT 3";
                $conexion = mainModel::conectar();
                $respuestaComentarios = $conexion->query($consultaComentarios); 


                /*Numero de comentarios*/
                $NComent = "SELECT idComPublicacion FROM comentario_publicacion WHERE idPublicacion = $idPublicacion";
                $conexion = mainModel::conectar();
                $ContComent = $conexion->query($NComent); 
                $ContadorComenario = $ContComent->rowCount();
                
                
                /*Conocer si ya el usuario ya le dio Like*/
                $SaberSiDioLike = "SELECT * FROM like_publicacion WHERE idEstudiante = $idEstudiante AND idPublicacion = $idPublicacion";
                $conexion = mainModel::conectar();
                $rptaLike = $conexion->query($SaberSiDioLike); 
                $NRPTALike = $rptaLike->rowCount();


                /*Conocer cuantos likes tiene la publicacion*/
                $ConocerLikes = "SELECT * FROM like_publicacion WHERE idPublicacion = $idPublicacion";
                $conexion = mainModel::conectar();
                $ContadorLike = $conexion->query($ConocerLikes); 
                $NContadorLike = $ContadorLike->rowCount();



                echo'   </div>
                        <ul class="post-opciones">
                            <li>';

                            if($NRPTALike>=1){
                                echo '<a id="'.$idPublicacion.'" class="like" data-usuario="'.$idEstudiante.'"><i class="fas fa-heart mr-1" style="color:red;"></i><span class="eliminar">Me gusta (<span id="numero-'.$idPublicacion.'">'.$NContadorLike.'</span>)</span>
                                </a>';
                            }else{
                                echo '<a id="'.$idPublicacion.'" class="like" data-usuario="'.$idEstudiante.'"><i class="far fa-heart mr-1"></i><span class="eliminar">Me gusta (<span id="numero-'.$idPublicacion.'">'.$NContadorLike.'</span>)</span>
                                </a>';
                            }
                                
                    echo '  </li>
                            <li>
                            <a  data-toggle="collapse" data-target="#comentario'.$idPublicacion.'"><i class="far fa-comment-alt mr-1"></i>
                                <span class="eliminar">Comentarios (<span id="num-'.$idPublicacion.'">'.$ContadorComenario.'</span>)</span>
                            </a>
                            </li>
                            <li>
                                <span class="badge p-2" style="background:'.$data['AreColor'].';color:#fff">'.$data['AreDescripcion'].'</span>
                            </li>
                        </ul>';  
                    
                    if($ContadorComenario>=1){

                        echo'<!--COMENTARIOS-->
                            <div class="post-comentarios collapse" id="comentario'.$idPublicacion.'">';

                        while($dataComentarios = $respuestaComentarios->fetch() ){

                        echo'
                                <div class="item-comentario">
                                    <img class="rounded-circle extra-pequeña" src="'.SERVERURL.'adjuntos/avatars/'.$dataComentarios['foto'].'" alt="User Image">
                                    <div class="body-comentario">
                                        <div class="datos-comentario">
                                        <span class="username">'.$dataComentarios['nombre'].' '.$dataComentarios['paterno'].' '.$dataComentarios['materno'].'</span>
                                        <span class="hora-comentario">'.$dataComentarios['ComPubFecha'].'</span>
                                        </div>  
                                        <p>'.$dataComentarios['ComPubDescripcion'].'</p>
                                    </div>
                                </div>
                                
                                ';
                        }
                        if($ContadorComenario>3){

                        echo'
                            <div class="item-comentario">
                                <div class="w-100 text-center p-3">
                                    <a href="'.SERVERURL.'publicacion/'.mainModel::encryption($idPublicacion).'/" class="text-info">Ver todos los comentarios</a>
                                </div>
                            </div>   
                            ';
                        }
                        
                        
                        echo'
                        </div>';
                    }
                    
                    echo'
                        <!--COMENTAR-->
                        <form class="post-comentar" autocomplete="off">
                            <div class="input-comentar">
                                <input type="text" name="comentario" class="form-control coment-input" placeholder="Comentar" id="descripcion-'.$idPublicacion.'" maxlength="500" minlength="1" data-user2="'.$idEstudiante.'" data-post2="'.$idPublicacion.'">
                            </div>
                            <div class="btn-comentar">
                                <div class="btn-comentar btn-solid-reg" data-user="'.$idEstudiante.'" data-post="'.$idPublicacion.'">Comentar</div>
                            </div>
                        </form>
                    </div>
				    ';

                $contador++;
			}

        }

        /*DATOS*/
        public function datos_publicacion_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return publicacionModelo::datos_publicacion_modelo($tipo, $codigo);
        }

        /*LIKES*/
        public function likes_publicacion_controlador($tipo,$publicacion,$usuario){

            $tipo = mainModel::limpiar_cadena($tipo);
            $publicacion = mainModel::limpiar_cadena($publicacion);
            $usuario = mainModel::limpiar_cadena($usuario);

            return publicacionModelo::likes_publicacion_modelo($tipo, $publicacion, $usuario);
        }

        /*COMENTARIOS*/
        public function coment_publicacion_controlador($tipo,$publicacion){

            $tipo = mainModel::limpiar_cadena($tipo);
            $publicacion = mainModel::limpiar_cadena($publicacion);

            return publicacionModelo::coment_publicacion_modelo($tipo, $publicacion);
        }

        /*MIS ULTIMAS PUBLICACIONES*/
        public function listar_mis_ultimas_publicaciones_controlador($cuenta){
            
            $cuenta = mainModel::decryption($cuenta);

            $consulta1 =mainModel::ejecutar_consulta_simple("SELECT * FROM estudiante WHERE CuentaCodigo='$cuenta'");

            $rptEstudiante = $consulta1->fetch();
            $id = $rptEstudiante['idEstudiante'];

            $consulta2 ="SELECT * FROM publicacion WHERE idEstudiante = $id ORDER BY idPublicacion DESC
            LIMIT 2";
            $conexion = mainModel::conectar();
            $respuesta = $conexion->query($consulta2);

            echo '<p>Número de publicaciones realizadas: '.$respuesta->rowCount().' &nbsp; <a href="" class="enlace-funcionalidad">(Ver todas)</a></p>';

            if($respuesta->rowCount()>=1){
                while($data = $respuesta->fetch()) {
                    echo '  <a href="#" style="text-decoration:none;">
                                <div class="item-tus-publicaciones">
                                    <p>'.$data['PubDescripcion'].'</p>
                                    <div class="fecha-imagen">
                                        <div class="fecha">
                                            <i class="far fa-calendar-alt"></i> '.$data['PubFecha'].'
                                        </div>
                                        <div class="imagen">';
                            if($data['PubImagen']!="-"){
                               echo '   <a href="'.SERVERURL.'adjuntos/Publicaciones-Estudiantes/'.$data['PubImagen'].'" target="_blank"><i class="fas fa-paperclip"></i> Adjunto</a>';
                            }
                               echo '   </div>
                                    </div>
                                </div>
                            </a>';
                }
            }else{
                echo   '<div class="alert alert-secondary text-center border">
                            <i class="far fa-frown" style="font-size:4rem;"></i>
                            <h4>Oops! No tienes publicaciones</h4>
                            <p>Haz publicaciones de ofertas laborales que encuentres y ayúdanos a crecer</p>
                        </div>';
            }

        }

        /*LISTAR*/
        public function listar_comentarios_controlador(){
            $start = mainModel::limpiar_cadena($_POST['inicio']);
		    $limit = mainModel::limpiar_cadena($_POST['limite']);
		    $post = mainModel::limpiar_cadena($_POST['post']);

            /*Consulta para mostrar Comentarios*/
            $consultaComentarios ="SELECT comentario_publicacion.*, estudiante.EstNombres AS nombre, estudiante.EstApePaterno AS paterno, estudiante.EstApeMaterno AS materno, cuenta.CtaFoto AS foto FROM comentario_publicacion 
            INNER JOIN estudiante ON comentario_publicacion.idEstudiante = estudiante.idEstudiante
            INNER JOIN cuenta ON estudiante.CuentaCodigo = cuenta.CtaCodigo
            WHERE comentario_publicacion.idPublicacion = $post 
            ORDER BY ComPubFecha ASC
            LIMIT $start, $limit";
            $conexion = mainModel::conectar();
            $respuestaComentarios = $conexion->query($consultaComentarios); 


            while($dataComentarios = $respuestaComentarios->fetch() ){

                echo'
                        <div class="item-comentario">
                            <img class="rounded-circle extra-pequeña" src="'.SERVERURL.'adjuntos/avatars/'.$dataComentarios['foto'].'" alt="User Image">
                            <div class="body-comentario">
                                <div class="datos-comentario">
                                    <span class="username">'.$dataComentarios['nombre'].' '.$dataComentarios['paterno'].' '.$dataComentarios['materno'].'</span>
                                    <span class="hora-comentario">'.$dataComentarios['ComPubFecha'].'</span>
                                </div>  
                                <p>'.$dataComentarios['ComPubDescripcion'].'</p>
                            </div>
                        </div> ';
                        
     
                        
            }	

        }

	}
    