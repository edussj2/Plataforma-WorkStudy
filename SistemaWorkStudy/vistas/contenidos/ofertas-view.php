<?php 
    $pagina = explode("/", $_GET['views']);

    if(isset($pagina[2])){
        $orden = $pagina[1];
        $pag = $pagina[2];
    }else{
        $orden = "all";
        $pag = $pagina[1];
    }
?>
<div class="container-fluid publicaciones-total">
    <div class="row">

        <!-- Columna Izquierda -->
        <div class="col-lg-3">
            <div class="panel-filtro-ofertas">
                <div class="cabecera">
                    <div class="titulo">
                        <img src="<?php echo SERVERURL; ?>vistas/images/img/laboral.jpg" alt="">
                        <h1>Ofertas Laborales</h1>
                    </div>
                    <p>Encuentra una oferta laboral de tu interés y postula a estas y se parte de la nueva forma de conseguir empleo.</p>
                </div>
                
                <div class="cuerpo">
                    <div class="titulo" data-toggle="collapse" data-target="#filtros">
                        <h4>Filtros</h4>
                    </div> 
                    <div class="tabla-filtro collapse show" id="filtros">

                        <div class="filtro-seleccionado">
                            <div class="filtro-titulo">
                                <i class="fas fa-search"></i> Búsquedas Seleccionadas
                            </div>
                            <?php 
                                if(!isset($_SESSION['busqueda_categoria_filtro']) && empty($_SESSION['busqueda_categoria_filtro'])){
                            ?>
                                <div class="filtro-item">
                                    <h6><i class="fas fa-info-circle"></i> No ha filtrado Búsquedas</h6>
                                </div>
                            <?php }else{
                                require_once "./controladores/categoriaControlador.php";

                                $insCat = new categoriaControlador();

                                $data = $insCat->datos_categoria_controlador("Unico",mainModel::encryption($_SESSION['busqueda_categoria_filtro']));
                                
                                $dataCat = $data->fetch();
                            ?>
                                
                                <div class="filtro-item">
                                    <h6>Categoría: <?php echo $dataCat['CatDescripcion'];?></h6>
                                    <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="search" method="POST" autocomplete="off">
                                        <input type="hidden" name="eliminar_busqueda_categoria_filtro" value="1">
                                        <button type="submit"><i class="far fa-times-circle"></i></button>
                                        <div class="RespuestaAjax"></div>
                                    </form>
                                </div>
                            <?php }?>
                        </div>
                        <?php 
                                if(!isset($_SESSION['busqueda_categoria_filtro']) && empty($_SESSION['busqueda_categoria_filtro'])){
                        ?>
                        <div class="filtro-buscar">
                            <div class="filtro-titulo">
                                <i class="fas fa-tags"></i> &nbsp;Categorías
                            </div>
                            
                            <div class="lista-item-filtro2">
                                <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="search" method="POST" autocomplete="off">
                                    <input type="hidden" name="modulo" value="">
                                    <select class="form-control selecttwo" id="oferta_categoria" name="busqueda_categoria_filtro" required>
                                        <?php 
                                            require_once "./controladores/categoriaControlador.php";

                                            $inscategoria = new categoriaControlador();

                                            $doc = $inscategoria->datos_categoria_controlador("Select",0);

                                            while ($rowD = $doc->fetch()) {
                                                echo '<option value="'.$rowD['idCategoria'].'">'.$rowD['CatDescripcion'].'</option>';                            
                                            }
                                        ?>
                                    </select>
                                    <div class="mt-2">
                                        <p class="text-center">
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Buscar</button>
                                        </p>
                                    </div>
                                    <div class="RespuestaAjax"></div>
                                </form>
                            </div>
                        </div>
                        <?php }else{?>
                            <div class="d-none">
                            </div>
                        <?php }?>

                        <div class="filtro-buscar">
                            <div class="filtro-titulo">
                                <i class="fas fa-street-view"></i> &nbsp;Región
                            </div>
                            <div class="lista-item-filtro">
                            <?php 
                                require_once "./controladores/ubigeoControlador.php";
                                $insubigeo = new ubigeoControlador();

                                $cat = $insubigeo->datos_departamento_controlador("Select",0);

                                while($rowD = $cat->fetch()){
                            ?> 
                                <div class="filtro-item">
                                    <a href="<?php echo SERVERURL;?>ofertas/<?php echo $orden; ?>/?dep=<?php echo $rowD['idDepartamento'];?>/"><?php echo $rowD['DepDescripcion'];?></a> 
                                </div>
                            <?php } ?>
                            </div>
                        </div>

                    </div>   
                </div>
            </div>
        </div>

        <!-- Centro -->
        <div class="col-lg-9 pb-5">
            
            <!-- ORDENAR --->
            <div class="ordenar">
                <div>Ordenar por: </div>
                <a href="<?php echo SERVERURL; ?>ofertas/all/" <?php if($orden== "all"){ echo 'style="color:#ff1e00;"';}?> ><i class="far fa-star"></i> &nbspRelevancia</a>
                <a href="<?php echo SERVERURL; ?>ofertas/date/" <?php if($orden == "date"){ echo 'style="color:#ff1e00;"';}?>><i class="far fa-calendar-alt"></i> &nbspFecha</a>
                <a href="<?php echo SERVERURL; ?>ofertas/salary/" <?php if($orden == "salary"){ echo 'style="color:#ff1e00;"';}?>><i class="fas fa-dollar-sign"></i> &nbspSalario</a>
            </div>

            <?php 
                    require_once "./controladores/ofertaControlador.php";
                    $insoferta = new ofertaControlador();
                    if(!isset($_SESSION['busqueda_categoria_filtro']) && empty($_SESSION['busqueda_categoria_filtro'])){
                        echo $insoferta->paginador_oferta_controlador($pag,15,"",$orden);
                    }else{
                        echo $insoferta->paginador_oferta_controlador($pag,15,$_SESSION['busqueda_categoria_filtro'],$orden);
                    } 
                    
                         
            ?>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('.selecttwo').select2();
    });
</script>