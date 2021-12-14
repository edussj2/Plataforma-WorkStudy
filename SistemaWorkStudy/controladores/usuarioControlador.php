<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class usuarioControlador extends mainModel
	{
        /*ULTIMAS USUARIOS*/
        public function listar_ultimos_usuarios_controlador($codigo){

            $consulta ="SELECT * FROM cuenta WHERE CtaTipo != 'Administrador' AND CtaCodigo!= '$codigo' ORDER BY idCuenta DESC LIMIT 8";
            $conexion = mainModel::conectar();
            $respuesta = $conexion->query($consulta);

            if($respuesta->rowCount()>=1){
                while($data = $respuesta->fetch()) {

                    $codigo = $data['CtaCodigo'];

                    if($data['CtaTipo']=="Estudiante"){
                        
                        $consultaEst = "SELECT EstNombres, EstApePaterno, EstApeMaterno FROM estudiante WHERE CuentaCodigo='$codigo'";
                        $conexion = mainModel::conectar();
                        $respuestaEst = $conexion->query($consultaEst);
                        $dataEst = $respuestaEst->fetch();
                        $nombreCompleto = $dataEst['EstNombres']." ".$dataEst['EstApePaterno']." ".$dataEst['EstApeMaterno'];

                    }if($data['CtaTipo']=="Empresa"){

                        $consultaEmp = "SELECT EmpNomComercial FROM empresa WHERE CuentaCodigo='$codigo'";
                        $conexion = mainModel::conectar();
                        $respuestaEmp = $conexion->query($consultaEmp);
                        $dataEmp = $respuestaEmp->fetch();
                        $nombreCompleto = $dataEmp['EmpNomComercial'];
                    
                    }

                    echo '  <div class="item-contenedor-usuarios">
                                <img src="'.SERVERURL.'adjuntos/avatars/'.$data['CtaFoto'].'" alt="'.$data['CtaEmail'].'">
                                <div class="texto-item-contenerdor-usuarios">
                                    <h5><a href="perfil/'.mainModel::encryption($data['CtaCodigo']).'">'.$nombreCompleto.'</a></h5>
                                    <p>'.$data['CtaTipo'].'</p>
                                </div>
                            </div>';
                }
            }else{
                echo '<div class="alert alert-primary text-center border w-100">
                        <i class="fab fa-gratipay" style="font-size:4rem;"></i>
                        <h4>Felicitaciones</h4>
                        <p>Usted es nuestro primer Usuario</p>
                    </div>';
            }

        }


	}
    