<?php 
    $pagina = explode("/", $_GET['views']);

    if($pagina[1]=="all"){
        $categoria = 0;
    }else{
        $categoria = $pagina[1];
    }
    $categoria = json_encode($categoria);
?>
<div class="barra-opciones-curso">

    <div class="header__categoria">
        <div class="header__categoria--titulo">
            <p> Categorías de los cursos &nbsp; <i class="fas fa-chevron-down"></i></p>
        </div>
        <ul>
        <?php 
            require_once "./controladores/categoriaCursoControlador.php";

            $inscategoriaCurso = new categoriaCursoControlador();

            $doc = $inscategoriaCurso->datos_categoriaCurso_controlador("Select",0);

            while ($rowD = $doc->fetch()) {
                echo '<li><a href="'.SERVERURL.'cursos/'.$rowD['idCategoriaCurso'].'/"><img src="'.SERVERURL.'adjuntos/categoriasCursos/'.$rowD['CatCursoImagen'].'" alt=""> '.$rowD['CatCursoDescripcion'].'</a></li>';    
                                        
            }
                                                                    
        ?>
            
        </ul>
    </div>

    <div class="opciones-buscador">
        <label for="curso_buscado"><i class="fas fa-search"></i> &nbsp; Nombre del curso: </label>
        <input class="buscador" type="text" name="curso_buscado" id="curso_buscado" placeholder="Desarrollo Web...">
    </div>
</div>

<?php if($pagina[1]!="all"){
    require_once "./controladores/categoriaCursoControlador.php";

    $inscategoriaCurso2 = new categoriaCursoControlador();

    $doc2 = $inscategoriaCurso2->datos_categoriaCurso_controlador("Unico",mainModel::encryption($pagina[1]));  
    
    $cat = $doc2->fetch();
?>

<div class="breadcrumbs mt-4">
    <a href="<?php echo SERVERURL; ?>cursos/all/">Cursos</a><i class="fa fa-angle-double-right"></i><span><?php echo $cat['CatCursoDescripcion']; ?></span>
</div>
<?php } ?>
<div class="cursos-lista" id="load_data2">

</div>

<div class="mensaje-respuesta-publicaciones" id="load_data_message2"></div>

<script>
$(document).ready(function(){

    var limit = 8;
    var start = 0; 
    var categoria = <?php echo $categoria; ?>;
    var action = 'inactive';

    function load_cursos_data(limit, start, categoria)
    {
        $.ajax({
            url:"<?php echo SERVERURL; ?>ajax/cursoAjax.php",
            method:"POST",
            data:{limit:limit, start:start, categoria:categoria},
            cache:false,
            success:function(data)
            {
                $('#load_data2').append(data);
            
                if(data == ''){
                    $('#load_data_message2').html('<div class="alert alert-secondary alert-dismissible fade show w-50" role="alert"><strong><i class="fas fa-bullhorn"></i></strong>  NO SE ENCONTARON MÁS RESULTADOS <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    action = 'active';
                }
                else
                {
                    $('#load_data_message2').html('<div class="lds-dual-ring"></div>');
                    action = "inactive";
                }
            }
        });
    }

    if(action == 'inactive')
    {
        action = 'active';
        load_cursos_data(limit, start, categoria);
    }

    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $("#load_data2").height() && action == 'inactive')
        {
            action = 'active';
            start = start + limit;
            setTimeout(function(){
                load_cursos_data(limit, start, categoria);
            }, 2000);
        }
    });

});

</script>
