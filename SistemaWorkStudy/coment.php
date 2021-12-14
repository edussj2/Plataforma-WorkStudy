<?php 
    $publicacion=$_POST['publicacionC'];
    $usuario = $_POST['usuarioC'];
    $comentario = $_POST['comentarioC'];
    $tiempo = date('Y-m-d H:i:s');

	require_once "./core/configApp.php";
	require_once "./core/configGeneral.php";

    $conexion = new PDO(SGBD,USER,PASS);

    $insertarcomentario = "INSERT INTO comentario_publicacion (idPublicacion,idEstudiante,ComPubFecha,ComPubDescripcion) VALUES($publicacion,$usuario,'$tiempo','$comentario')";
    $Guardarcomentario = $conexion->query($insertarcomentario);

    
    if($Guardarcomentario->rowCount()>=1){

        $consultarUsusarioComentario = "SELECT comentario_publicacion.*, estudiante.EstNombres AS nombre, estudiante.EstApePaterno AS paterno, estudiante.EstApeMaterno AS materno, cuenta.CtaFoto AS foto FROM comentario_publicacion 
        INNER JOIN estudiante ON comentario_publicacion.idEstudiante = estudiante.idEstudiante
        INNER JOIN cuenta ON estudiante.CuentaCodigo = cuenta.CtaCodigo
        WHERE comentario_publicacion.idPublicacion=$publicacion AND comentario_publicacion.idEstudiante=$usuario AND comentario_publicacion.ComPubFecha='$tiempo'";
        $dataComentario = $conexion->query($consultarUsusarioComentario);

        $dataComentarios = $dataComentario->fetch();

        $newComent = '
            <div class="item-comentario">
                <img class="rounded-circle extra-pequeña" src="'.SERVERURL.'adjuntos/avatars/'.$dataComentarios['foto'].'" alt="User Image">
                <div class="body-comentario">
                    <div class="datos-comentario">
                        <span class="username">'.$dataComentarios['nombre'].' '.$dataComentarios['paterno'].' '.$dataComentarios['materno'].'</span>
                        <span class="hora-comentario">'.$dataComentarios['ComPubFecha'].'</span>
                    </div>  
                    <p>'.$dataComentarios['ComPubDescripcion'].'</p>
                </div>
            </div>';
    }else{
        $newComent = '<div class="item-comentario"><div class="alert alert-warning">Ocurrio un error</div></div>';
    }
    

    $numeroComentarios = "SELECT idPublicacion FROM comentario_publicacion WHERE idPublicacion = $publicacion";
    $cantidadComentarios = $conexion->query($numeroComentarios);

    $numeroC = $cantidadComentarios->rowCount();

    $retorno = array("numeroC"=>$numeroC,"newComent"=>$newComent);
    
    echo json_encode($retorno);
?>