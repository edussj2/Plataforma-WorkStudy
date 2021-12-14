<?php 
    $departamento=$_POST['idDepartamento'];

	include 'lib/config.php';

    /*CONSULTA*/
    $consulta = "SELECT idProvincia ,ProvDescripcion
    FROM provincia
    WHERE idDepartamento = $departamento
    ORDER BY ProvDescripcion ASC";

    /**-----CONECTAMOS Y GUARDAMOS LOS DATOS----**/
    $resultado = $conexion->query($consulta);

    $html.='<option value="Sin Registro" selected="true">Seleccione una Provincia</option>';

    while($rowM = $resultado->fetch())
    {
        $html.= "<option value='".$rowM['idProvincia']."'>".$rowM['ProvDescripcion']."</option>";
    }
    
    echo $html;
?>