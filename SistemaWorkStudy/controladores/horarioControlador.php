<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../modelos/horarioModelo.php";
	}else{
		require_once "./modelos/horarioModelo.php";
	}

	class horarioControlador extends horarioModelo
	{
		/*AGREGAR*/
		public function agregar_horario_controlador(){

			$dia = mainModel::limpiar_cadena($_POST['horario_dia_reg']);
            $inicio =  mainModel::limpiar_cadena($_POST['horario_inicio_reg']);
            $fin =  mainModel::limpiar_cadena($_POST['horario_fin_reg']);
            $tutor =  mainModel::decryption($_POST['horario_tutor_reg']);


            /*--VALIDACIONES--*/
            if($inicio== "" || $fin=="" || $dia=="Sin Registro" || $tutor==""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{

                    $consulta1 = mainModel::ejecutar_consulta_simple("SELECT idHorario FROM horario WHERE HorDia='$dia' AND (HorInicio = '$inicio' AND HorFin = '$fin')");

                    $consulta2 = mainModel::ejecutar_consulta_simple("SELECT idHorario FROM horario WHERE HorDia='$dia' AND (HorInicio < '$inicio' AND '$inicio' < HorFin)");
                    $consulta3 = mainModel::ejecutar_consulta_simple("SELECT idHorario FROM horario WHERE HorDia='$dia' AND (HorInicio > '$inicio' AND '$inicio' < HorFin)");
                    
                    if($consulta1->rowCount()>=1 || $consulta2->rowCount()>=1 || $consulta3->rowCount()>=1){
                        
                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El horario que intentas ingresar ya se encuentra registrado en el sistema, o no es válido","Tipo"=>"warning"];
                    
                    }else{

                            if($fin <= $inicio ){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El rango de horas no es válido","Tipo"=>"warning"];
                            
                            }else{  

                                $datoshorario=[
                                            "dia"=>$dia,
                                            "inicio"=>$inicio,
                                            "fin"=>$fin,
                                            "tutor"=>$tutor
                                ];

                                $guardarhorario = horarioModelo::agregar_horario_modelo($datoshorario);

                                if($guardarhorario->rowCount()>=1){
                                    $alerta = ["Alerta"=>"recargar", "Titulo"=>"HORARIO REGISTRADO","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];
                                }else{
                                    $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro del horario, intente nuevamente","Tipo"=>"error"];
                                }       
 
                            }
                        
                    }
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*PAGINAR LISTA Y BUSQUEDA*/
        public function paginador_horario_controlador($busqueda){
            
            $busqueda = mainModel::decryption($busqueda);

            $consultaGeneral = mainModel::ejecutar_consulta_simple("SELECT * FROM horario WHERE idTutor = $busqueda");

            $consultaLunes = mainModel::ejecutar_consulta_simple("SELECT * FROM horario WHERE idTutor = $busqueda AND HorDia='Lunes' ORDER BY HorInicio ASC");

            $consultaMartes = mainModel::ejecutar_consulta_simple("SELECT * FROM horario WHERE idTutor = $busqueda AND HorDia='Martes' ORDER BY HorInicio ASC");

            $consultaMiercoles = mainModel::ejecutar_consulta_simple("SELECT * FROM horario WHERE idTutor = $busqueda AND HorDia='Miércoles' ORDER BY HorInicio ASC");

            $consultaJueves = mainModel::ejecutar_consulta_simple("SELECT * FROM horario WHERE idTutor = $busqueda AND HorDia='Jueves' ORDER BY HorInicio ASC");

            $consultaViernes = mainModel::ejecutar_consulta_simple("SELECT * FROM horario WHERE idTutor = $busqueda AND HorDia='Viernes' ORDER BY HorInicio ASC");

            $consultaSabado = mainModel::ejecutar_consulta_simple("SELECT * FROM horario WHERE idTutor = $busqueda AND HorDia='Sábado' ORDER BY HorInicio ASC");

            $consultaDomingo = mainModel::ejecutar_consulta_simple("SELECT * FROM horario WHERE idTutor = $busqueda AND HorDia='Domingo' ORDER BY HorInicio ASC");

            if($consultaGeneral->rowCount()>=1){
                
                /*LUNES*/
                echo '<tr class="text-center text-uppercase" >
                        <td style="background:#FF6961; color:#fff"> Lunes </td>
                        <td>';
                if($consultaLunes->rowCount()>=1){
                    while ($rows = $consultaLunes->fetch()) {
                        echo $rows['HorInicio'].' - '.$rows['HorFin'].' / ';
                    }
                }else{
                    echo 'Aún no se registro diponibilidad';
                }
                echo '</td><tr>';

                /*MARTES*/
                echo '<tr class="text-center text-uppercase" >
                        <td style="background:#77dd77; color:#fff"> Martes </td>
                        <td>';
                if($consultaMartes->rowCount()>=1){
                    while ($rows = $consultaMartes->fetch()) {
                        echo $rows['HorInicio'].' - '.$rows['HorFin'].' / ';
                    }
                }else{
                    echo 'Aún no se registro diponibilidad';
                }
                echo '</td><tr>';

                /* MIERCOLES*/
                echo '<tr class="text-center text-uppercase" >
                        <td style="background:#ffda9e; color:#fff"> Miércoles </td>
                        <td>';
                if($consultaMiercoles->rowCount()>=1){
                    while ($rows = $consultaMiercoles->fetch()) {
                        echo $rows['HorInicio'].' - '.$rows['HorFin'].' / ';
                    }
                }else{
                    echo 'Aún no se registro diponibilidad';
                }
                echo '</td><tr>';

                /* JUEVES*/
                echo '<tr class="text-center text-uppercase" >
                        <td style="background:#84b6f4; color:#fff"> Jueves </td>
                        <td>';
                if($consultaJueves->rowCount()>=1){
                    while ($rows = $consultaJueves->fetch()) {
                        echo $rows['HorInicio'].' - '.$rows['HorFin'].' / ';
                    }
                }else{
                    echo 'Aún no se registro diponibilidad';
                }
                echo '</td><tr>';

                /*VIERNES*/
                echo '<tr class="text-center text-uppercase" >
                        <td style="background:#fdcae1; color:#fff"> Viernes </td>
                        <td>';
                if($consultaViernes->rowCount()>=1){
                    while ($rows = $consultaViernes->fetch()) {
                        echo $rows['HorInicio'].' - '.$rows['HorFin'].' / ';
                    }
                }else{
                    echo 'Aún no se registro diponibilidad';
                }
                echo '</td><tr>';

                /*SABADO*/
                echo '<tr class="text-center text-uppercase" >
                        <td style="background:#bdbfbf; color:#fff"> Sábado </td>
                        <td>';
                if($consultaSabado->rowCount()>=1){
                    while ($rows = $consultaSabado->fetch()) {
                        echo $rows['HorInicio'].' - '.$rows['HorFin'].' / ';
                    }
                }else{
                    echo 'Aún no se registro diponibilidad';
                }
                echo '</td><tr>';

                /* Domingo*/
                echo '<tr class="text-center text-uppercase" >
                        <td style="background:#8f7193; color:#fff"> Domingo </td>
                        <td>';
                if($consultaDomingo->rowCount()>=1){
                    while ($rows = $consultaDomingo->fetch()) {
                        echo $rows['HorInicio'].' - '.$rows['HorFin'].' / ';
                    }
                }else{
                    echo 'Aún no se registro diponibilidad';
                }
                echo '</td><tr>';

            }else{
                echo '  <tr> 
                            <td colspan="2" class="text-center">
                                <div class="alert alert-secondary" role="alert">
                                <i class="fas fa-bullhorn"></i> NO SE REGISTRARÓN DATOS AÚN</div>
                            </td>
                        </tr>';
            }


        }

        /*ELIMINAR*/
        public function eliminar_horario_controlador(){

            /**-----DESINCRIPTAMOS LOS DATOS ----**/
            $id = mainModel::decryption($_POST['horario_id_del']);
 
            /**-----LIMPIAMOS LOS DATOS ----**/
            $id = mainModel::limpiar_cadena($id);


            $Eliminarhorario = horarioModelo::eliminar_horario_modelo($id);

            if($Eliminarhorario->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"HORARIO REMOVIDO","Texto"=>"Los datos se eliminarón satisfactoriamente del sistema.","Tipo"=>"success"];
    
            }else{

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"No se pudo eliminar la categoría, puede que este asociado a otros registros, se recomienda cambiar el estado o intenté nuevamente","Tipo"=>"error"];

            }
     

            return mainModel::sweet_alert($alerta);
        }

        /*DATOS*/
        public function datos_horario_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return horarioModelo::datos_horario_modelo($tipo, $codigo);
        }

	}
    