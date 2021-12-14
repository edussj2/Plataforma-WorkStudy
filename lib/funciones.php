<?php 

    const METHOD="AES-256-CBC";
    const SECRET_KEY = '$WS@2121';
    const SECRET_IV = '2121';

    /**-----FUNCIONA PARA DESINCRYPTAR-----**/
    function decryption($string){
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV), 0, 16);
        $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }
    /**-----FUNCIONA PARA ENCRIPTAR-----**/
    function encryption($string){
        $output=FALSE;
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV), 0, 16);
        $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
    }

    /**-----FUNCIONA PARA LIMPIAR CADENA-----**/
    function limpiar_cadena($cadena){
        $cadena = str_ireplace("<script>","", $cadena); //QUITA Y REMPLAZA SEGUN QUERRÁMOS
        $cadena = str_ireplace("</script>","", $cadena);
        $cadena = str_ireplace("<script src","", $cadena);
        $cadena = str_ireplace("<script type","", $cadena);
        $cadena = str_ireplace("SELECT *  FROM","", $cadena);
        $cadena = str_ireplace("DELETE FROM","", $cadena);
        $cadena = str_ireplace("INSERT INTO","", $cadena);
        $cadena = str_ireplace("UPDATE SET","", $cadena);
        $cadena = str_ireplace("[","", $cadena);
        $cadena = str_ireplace("]","", $cadena);
        $cadena = str_ireplace("==","", $cadena);
        $cadena = str_ireplace("DROP TABLE","", $cadena);
        $cadena = str_ireplace("SHOW TABLES","", $cadena);
        $cadena = str_ireplace("SHOW DATABASES","", $cadena);
        $cadena = str_ireplace("<?php","", $cadena);
        $cadena = str_ireplace("?>","", $cadena);
        $cadena = str_ireplace("DELETE administrador","", $cadena);
        $cadena = str_ireplace("DELETE colegiado","", $cadena);
        $cadena = str_ireplace("::","", $cadena);
        $cadena = trim($cadena);//QUITA ESPACIOS EN BLANCO
        $cadena = stripcslashes($cadena);//QUITA BARRAS INVERTIDAS
        return $cadena;
    }

    /**-----FUNCION GENERAR CODIGO ALEATORIO-----**/
    function generar_codigo_aleatorio($letra,$longitud,$num){
        for($i=1 ; $i<=$longitud; $i++){
            $numero = rand(0,9);
            $letra.= $numero;
        }

        return $letra.$num;
    }
?>

