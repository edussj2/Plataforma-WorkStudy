<?php 
    $categoria=$_POST['idCategoria'];


	require_once "./core/configApp.php";

    $conexion = new PDO(SGBD,USER,PASS);

    /*CONSULTA*/
    $consulta = "SELECT idSubcategoria ,SubDescripcion 
    FROM subcategoria
    WHERE idCatCurso = $categoria
    ORDER BY SubDescripcion  ASC";

    /**-----CONECTAMOS Y GUARDAMOS LOS DATOS----**/
    $resultado = $conexion->query($consulta);

    
    while($rowM = $resultado->fetch())
    {
        $html.= "<option value='".$rowM['idSubcategoria']."'>".$rowM['SubDescripcion']."</option>";
    }
    
    echo $html;
?>