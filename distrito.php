<?php 
    $provincia=$_POST['idProvincia'];

	include 'lib/config.php';

    /*CONSULTA*/
    $consulta = "SELECT idDistrito ,DisDescripcion
    FROM distrito
    WHERE idProvincia = $provincia
    ORDER BY DisDescripcion ASC";

    /**-----CONECTAMOS Y GUARDAMOS LOS DATOS----**/
    $resultado = $conexion->query($consulta);

    $html.= '<option value="Sin Registro" selected="true">Seleccione un Distrito</option>';

    while($rowM = $resultado->fetch())
    {
        $html.= "<option value='".$rowM['idDistrito']."'>".$rowM['DisDescripcion']."</option>";
    }
    
    echo $html;
?>