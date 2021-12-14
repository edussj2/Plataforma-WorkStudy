<?php 
    $publicacion=$_POST['publicacion'];
    $usuario = $_POST['usuario'];

	require_once "./core/configApp.php";

    $conexion = new PDO(SGBD,USER,PASS);
    $consulta = "SELECT * FROM like_publicacion
    WHERE idEstudiante = $usuario AND idPublicacion=$publicacion";
    $resultado = $conexion->query($consulta);

    $cLikes = $resultado->rowCount();

    if($cLikes==0){
        $insertarLike = "INSERT INTO like_publicacion (idEstudiante,idPublicacion,LikPubFecha) VALUES($usuario,$publicacion,now())";
        $GuardarLike = $conexion->query($insertarLike);
    }else{
        $eliminarLike = "DELETE FROM like_publicacion WHERE idEstudiante=$usuario AND idPublicacion=$publicacion";
        $DeleteLike =  $conexion->query($eliminarLike);
    }

    if($cLikes==0){
        $megusta = '<i class="fas fa-heart mr-1" style="color:red;">';
    }else{
        $megusta = '<i class="far fa-heart mr-1"></i>';
    }

    $numeroLikes = "SELECT idPublicacion FROM like_publicacion WHERE idPublicacion = $publicacion";
    $cantidadLikes = $conexion->query($numeroLikes);

    $numero = $cantidadLikes->rowCount();

    $retorno = array("icono"=>$megusta,"numero"=>$numero);
    
    echo json_encode($retorno);
?>