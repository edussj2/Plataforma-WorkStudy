<div class="container-fluid publicaciones-total">
    <div class="row pb-5">
    <?php 
       $datos = explode("/", $_GET['views']);

       require_once "./controladores/publicacionControlador.php";
       $classpublicacion = new publicacionControlador();
   
       $filesP = $classpublicacion->datos_publicacion_controlador("Especial",$datos[1]);
   
       if($filesP->rowCount()==1){

        $datosP = $filesP->fetch();

    ?>

        <!-- Izquierda -->
        <div class="col-lg-8">

            <!-- PUBLICACION-->
            <div class="caja-central-publicaciones">

                <div class="caja-post">

                    <div class="post-header">
                        <img class="rounded-circle foto-pequeña" src="<?php echo SERVERURL;?>adjuntos/avatars/<?php echo $datosP['CtaFoto'];?>" alt="Foto-Usuario">
                        <div class="post-descripcion">
                            <span class="post-nombre-cerrar">
                                <a href="#"><?php echo $datosP['EstNombres'];?> <?php echo $datosP['EstApePaterno'];?> <?php echo $datosP['EstApeMaterno'];?></a>
                                <a href="#" class=""><i class="fas fa-ellipsis-v"></i></a>
                            </span>
                            <span class="post-fecha"><?php echo $datosP['PubFecha'];?></span>
                        </div>
                    </div>

                    <div class="post-body">                
                        <p class="post-texto">
                            <?php echo $datosP['PubDescripcion'];?>
                        </p>
                        <?php if($datosP['PubImagen']=="-"){?>
                            <div class="post-archivo d-none"></div>
                        <?php }else{?>
                            <div class="post-archivo">
                                <img src="<?php echo SERVERURL;?>adjuntos/Publicaciones-Estudiantes/<?php echo $datosP['PubImagen']; ?>" alt="">
                            </div>
                        <?php }?>
                    </div>

                    <?php 
                        /*id de la publicacion */
                        $idPublicacion = $datosP['idPublicacion'];

                        /** Estudiante que esta viendo **/
                        require_once "./controladores/estudianteControlador.php";
                        $classestudiante = new estudianteControlador();
                        $filesE = $classestudiante->datos_estudiante_controlador("Unico",mainModel::encryption($_SESSION['codigo_cuenta_WS']));
                        $datosE = $filesE->fetch();

                        /*idEstudiante viendo*/
                        $idEstudiante = $datosE['idEstudiante'];

                        /** Conocer si ya dio Like **/
                        require_once "./controladores/publicacionControlador.php";
                        $classpublicacion2 = new publicacionControlador();
                        $filesL1 = $classpublicacion2->likes_publicacion_controlador("Unico",$idPublicacion,$idEstudiante);
                        $rptaLike = $filesL1->rowCount();

                        /** Numero de Likes **/
                        require_once "./controladores/publicacionControlador.php";
                        $classpublicacion3 = new publicacionControlador();
                        $filesL2 = $classpublicacion3->likes_publicacion_controlador("Conteo",$idPublicacion,0);
                        $numLike = $filesL2->rowCount();

                        /** Numero de Comentarios **/
                        require_once "./controladores/publicacionControlador.php";
                        $classpublicacion4 = new publicacionControlador();
                        $filesC1 = $classpublicacion4->coment_publicacion_controlador("Conteo",$idPublicacion);
                        $numComent = $filesC1->rowCount();


                    ?>

                    <!--Opciones-->
                    <ul class="post-opciones">
                        <li>
                            <?php if($rptaLike>=1){?>
                                <a id="<?php echo $idPublicacion; ?>" class="like" data-usuario="<?php echo $idEstudiante; ?>">
                                    <i class="fas fa-heart mr-1" style="color:red;"></i>
                                    <span class="eliminar">Me gusta (<span id="numero-<?php echo $idPublicacion; ?>"><?php echo $numLike; ?></span>)</span>
                                </a>
                            <?php }else{?>
                                <a id="<?php echo $idPublicacion; ?>" class="like" data-usuario="<?php echo $idEstudiante; ?>">
                                    <i class="far fa-heart mr-1"></i>
                                    <span class="eliminar">Me gusta (<span id="numero-<?php echo $idPublicacion; ?>"><?php echo $numLike; ?></span>)</span>
                                </a>
                            <?php }?>
                        </li>
                        <li>
                            <a><i class="far fa-comment-alt mr-1"></i>
                                <span class="eliminar">Comentarios (<span id="num-<?php echo $idPublicacion; ?>"><?php echo $numComent; ?></span>)</span>
                            </a>
                        </li>
                        <li>
                            <span class="badge p-2" style="background:<?php echo $datosP['AreColor']; ?>;color:#fff"><?php echo $datosP['AreDescripcion']; ?></span>
                        </li>
                    </ul>

                    <!--COMENTAR-->
                    <form class="post-comentar" autocomplete="off">
                        <div class="input-comentar">
                            <input type="text" name="comentario" class="form-control coment-input" placeholder="Comentar" id="descripcion-<?php echo $idPublicacion; ?>" maxlength="500" minlength="1" data-user2="<?php echo $idEstudiante; ?>" data-post2="<?php echo $idPublicacion; ?>">
                        </div>
                        <div class="btn-comentar">
                                <div class="btn-comentar btn-solid-reg" data-user="<?php echo $idEstudiante; ?>" data-post="<?php echo $idPublicacion; ?>">Comentar</div>
                        </div>
                    </form>

                    <!--COMENTARIOS-->
                    <div class="post-comentarios" id="load_comentarios">
                        
                    </div>
                    <div class="mensaje-respuesta-publicaciones" id="load_comentarios_message"></div>

                </div>

            </div>

        </div>

        <!-- Derecha -->
        <div class="col-lg-4">
          <div class="ultimos-usuarios shadow">
              <div class="titulo-contenedor-usuarios">
                Últimos Usuarios
              </div>
              <div class="descripcion-contenedor-usuarios">

                <?php 
                  require_once "./controladores/usuarioControlador.php";
            	    $insusuario = new usuarioControlador();
                  echo $insusuario->listar_ultimos_usuarios_controlador($_SESSION['codigo_cuenta_WS']);
                ?>

              </div>
            </div>
        </div>

    <?php 
        }else{
    ?>
        <div id="notfound">
            <div class="notfound">
                <div class="notfound-404"></div>
                <h1>Oops!</h1>
                <h2>Ocurrió un error inesperado</h2>
                <p>Hubo un problema, se recomienda recargar la página o volver al Inicio.</p>
            </div>
        </div>
    <?php   
        }
    ?> 
    </div>
</div>

<?php $idPost = json_encode($idPublicacion); ?>;
<?php $ContadorComentarios = json_encode($numComent); ?>;

<script>
$(document).ready(function(){ 

  /*LISTAR COMENTARIOS*/
  var nComentarios = <?php echo $ContadorComentarios; ?>;
  var limite = 30;
  var inicio = 0;
  var action = 'inactive';
  var idPost = <?php echo $idPost; ?>;
  function load_comentarios_data(limit, start,post)
  {
      $.ajax({
          url:"<?php echo SERVERURL; ?>ajax/publicacionAjax.php",
          method:"POST",
          data:{limite:limite, inicio:inicio,post:idPost},
          cache:false,
          success:function(data)
          {
              $('#load_comentarios').append(data);
              
              if(data == ''){
                setTimeout(function() {
                    $('#load_comentarios_message').html('<div>No se encotrarón mas comentarios</div>').fadeOut(5500);
                },1000);
                action = 'active';
              }
              else
              {
                  if(nComentarios <= limite){
                    $('#load_comentarios_message').html('');
                  }else{
                    $('#load_comentarios_message').html('<button type="button" class="btn btn-info" id="ver-mas-comentarios">Ver mas comentarios</button>');
                    action = "inactive";
                  }
              }
          }
      });
  }

  if(action == 'inactive')
  {
    action = 'active';
    load_comentarios_data(limite, inicio);
  }
  $(document).on("click", "#ver-mas-comentarios", function(e){
    if(action == 'inactive')
    {
      action = 'active';
      inicio = inicio + limite;
      setTimeout(function(){
        load_comentarios_data(limite, inicio);
          }, 1000);
    }
  });


    /*LIKE PUBLICACIONES*/
    $(document).on("click", ".like", function(e){

        var idPublicacion = this.id;
        var idUsuario= $(this).data('usuario');

        $.ajax({
            url:"../../likes.php",
            method:"POST",
            data:{publicacion:idPublicacion,usuario:idUsuario},
            dataType: "json",
            success: function(data){
                var icono = data['icono'];
                var numero = data['numero'];
                $('#'+idPublicacion +'>i').replaceWith(icono);
                $('#numero-'+idPublicacion).text(numero);
            }
        });

    });

    /*COMENTARIO PUBLICACIONES CON BOTON*/
    $(document).on("click", ".btn-comentar", function(e){

        var idPublicacionC =  $(this).data('post');
        var idUsuarioC =   $(this).data('user');
        var comentario = $("#descripcion-"+idPublicacionC).val();

        if(comentario == ''){
            swal("Comentario vacio","","warning");
            return false;
        }

        $.ajax({
            url:"../../coment.php",
            method:"POST",
            data:{publicacionC:idPublicacionC,usuarioC:idUsuarioC,comentarioC:comentario},
            dataType: "json",
            success: function(data){

                var numeroC = data['numeroC'];
                var newComent = data['newComent'];

                $("#load_comentarios").prepend(newComent);
                $('#num-'+idPublicacionC).text(numeroC);
                $("#descripcion-"+idPublicacionC).val("");

            }
        });
        return false;
    });


    /* COMENTAR CON ENTER*/
    $(document).on("keypress", ".coment-input", function(e){

        if ( event.which == 13 ) {

            var idPublicacionC2 =  $(this).data('post2');
            var idUsuarioC2 =   $(this).data('user2');
            var comentario2 = $("#descripcion-"+idPublicacionC2).val();

            if(comentario2 == ''){
                swal("Comentario vacio","","warning");
                return false;
            }

            $.ajax({
                url:"../../coment.php",
                method:"POST",
                data:{publicacionC:idPublicacionC2,usuarioC:idUsuarioC2,comentarioC:comentario2},
                dataType: "json",
                success: function(data){

                    var numeroC = data['numeroC'];
                    var newComent = data['newComent'];

                    $("#load_comentarios").prepend(newComent);
                    $('#num-'+idPublicacionC2).text(numeroC);
                    $("#descripcion-"+idPublicacionC2).val("");

                }
            });
        return false;
        }
    });


});
</script>