<?php 
    $pagina = explode("/", $_GET['views']);

    if(isset($pagina[2])){
        $modalidad = $pagina[1];
        $pag = $pagina[2];
    }else{
        $modalidad = "all";
        $pag = $pagina[1];
    }
?>
<div class="container-anuncios">
    <div class="mt-4 text-center">
        <h2><i class="fas fa-chalkboard-teacher"></i> Anuncios de Tutoría</h2>
        <p>Explora entre los disitintos anuncios de de tutoría y encuentra el tutor que estas buscando y ponte en contacto con el.</p>
    </div>

    <div class="filtros-anuncios">
        <div class="item-filtro-anuncio">
            
            <a href="<?php echo SERVERURL;?>anuncios/all/" <?php if($modalidad== "all"){ echo 'style="color:#00a7bd;"';}?>>General</a>  
            <img src="<?php echo SERVERURL; ?>vistas/images/img/teacher.png" alt="">

        </div>
        <div class="item-filtro-anuncio">
            
            <a href="<?php echo SERVERURL;?>anuncios/online/" <?php if($modalidad== "online"){ echo 'style="color:#00a7bd;"';}?>>Online</a>  
            <img src="<?php echo SERVERURL; ?>vistas/images/img/online.png" alt="">

        </div>
        <div class="item-filtro-anuncio">
            
            <a href="<?php echo SERVERURL;?>anuncios/presencial/" <?php if($modalidad== "presencial"){ echo 'style="color:#00a7bd;"';}?>>Presencial</a>  
            <img src="<?php echo SERVERURL; ?>vistas/images/img/presencial.png" alt="">

        </div>
        <div class="item-filtro-anuncio border-none">
            
            <a href="<?php echo SERVERURL;?>anuncios/semipresencial/" <?php if($modalidad== "semipresencial"){ echo 'style="color:#00a7bd;"';}?>>Semipresencial</a> 
            <img src="<?php echo SERVERURL; ?>vistas/images/img/semipresencial.png" alt="">

        </div>
    </div>

    <?php 
        require_once "./controladores/anuncioControlador.php";
        $insanuncio = new anuncioControlador();
 

        echo $insanuncio->paginador_anuncio_controlador($pagina[1],10,$modalidad);
    
    ?>
</div>