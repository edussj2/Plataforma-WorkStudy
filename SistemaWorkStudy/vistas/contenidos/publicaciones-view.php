<div class="container-fluid publicaciones-total">
    <div class="row pb-5">

        <!-- Columna Izquierda -->
        <div class="col-lg-3">
            <div class="spiner-publicaciones shadow">

                <div class="box-spiner">

                  <?php 
                    require_once "./controladores/publicacionControlador.php";
                    $Npub = new publicacionControlador();
                    $NumeroPub = $Npub->datos_publicacion_controlador("Conteo","");
                    $numeroPub =  $NumeroPub->rowCount();

                    $porciento = ($numeroPub/METAPUB)*100
                  ?>

                    <h4>Meta Workstudy</h4>
                    <p class="text-lead"><?php echo METAPUB; ?> Publicaciones</p>
                    <div class="percent">
                        
                        <svg>
                          <circle cx="70" cy="70" r="70"></circle>
                          <circle cx="70" cy="70" r="70"></circle>
                        </svg>

                        <div class="number">
                          <h2><?php echo $porciento; ?><span>%</span></h2>
                        </div>

                    </div>

                    <h2 class="text-spiner"><?php echo $numeroPub; ?> publicaciones</h2>

                </div>

            </div>
        </div>

        <!-- Centro -->
        <div class="col-lg-6">

            <?php if($_SESSION['tipo_WS']=="Estudiante"){?>

            <!-- PUBLICAR --->
            <div class="publicar shadow">
              <div class="imagen-publicar">
                <img src="<?php echo SERVERURL; ?>vistas/images/img/publicar.svg" alt="Imagen Publicar">
              </div>
              <div class="descripcion-publicar">
                <h3>¿Conoces una oferta laboral?</h3>
                <p>Comparte anuncios de ofertas laborales que conozcas o hayas visto y ayuda a que la comunidad crezca y obtengan un trabajo.</p>
                <button type="button" class="btn-solid-reg" data-toggle="modal" data-target="#ModalPublicarEstudiante">
                  !Compartir Oferta!
                </button>
              </div>
            </div>

            <!-- Modal Publicar -->
            <div class="modal fade" id="ModalPublicarEstudiante" tabindex="-1" role="dialog" aria-labelledby="ModalPublicarEstudianteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalPublicarEstudianteLabel"><i class="far fa-newspaper"></i> Compartir oferta laboral</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!--PUBLICAR-->
                            <form class="FormularioAjax" data-form="save" action="<?php echo SERVERURL; ?>ajax/publicacionAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                                  <div class="caja-publicar">

                                      <input type="hidden" name="publicacion_estudiante_reg" value="<?php echo mainModel::encryption($_SESSION['codigo_cuenta_WS']);?>">
                                      <textarea name="publicacion_descripcion_reg" rows="6" placeholder="Escribe algo..." class="area-red"></textarea>

                                      <input type="file" id="archivoInput" placeholder="Cargue archivo" onchange="return validarExt()" name="publicacion_imagen_reg">
                                      <div class="elementos">
                                          <label for="archivoInput">
                                            <i class="fas fa-image"></i> Imagen(.png/pdf/.jpg/.jpeg)
                                          </label>

                                          <select name="publicacion_area_reg" class="select-publicar">
                                            <option value="Sin Registro"> Seleccione una área</option>
                                                    <?php 
                                                        require_once "./controladores/areaControlador.php";

                                                        $insArea = new areaControlador();

                                                        $doc = $insArea->datos_area_controlador("Select",0);

                                                        while ($rowD = $doc->fetch()) {
                                                            echo '<option value="'.$rowD['idArea'].'">'.$rowD['AreDescripcion'].'</option>';
                                                          
                                                        }
                                                    ?> 
                                          </select>

                                      </div>
                                      <div id="visorArchivo" class="visor">
                                      </div>   
                                  </div>
                                  <input type="submit"value="Publicar" class="btn-solid-reg w-100 m-1"> 
                                  <div class="RespuestaAjax"></div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>

            <?php }else{?>

            <!-- PUBLICAR --->
            <div class="publicar shadow">
              <div class="imagen-publicar">
                <img src="<?php echo SERVERURL; ?>vistas/images/img/publicar.svg" alt="">
              </div>
              <div class="descripcion-publicar">
                <h3>Publicaciones de la Comunidad</h3>
                <p>Descubre las publicaciones de ofertas laborales que han hecho los estudiantes para apoyar a que los miembros de la comunidad consigan un puesto de trabajo.</p>
              </div>
            </div>
            
            <?php } ?>

            <!-- PUBLICACIONES-->
            <div class="caja-central-publicaciones" id="load_data">
              
            </div>

            <div class="mensaje-respuesta-publicaciones" id="load_data_message"></div>

        </div>

        <!-- Derecha -->
        <div class="col-lg-3">
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
    </div>
</div>

<?php $cuentaCodigo = json_encode($_SESSION['codigo_cuenta_WS']); ?>;

<script>
$(document).ready(function(){ 

  /*LISTAR PUBLICACIONES*/
  var limit = 5;
  var start = 0;
  var action = 'inactive';
  var CuentaCodigo = <?php echo $cuentaCodigo; ?>;
  function load_publicaciones_data(limit, start,cuenta)
  {
      $.ajax({
          url:"<?php echo SERVERURL; ?>ajax/publicacionAjax.php",
          method:"POST",
          data:{limit:limit, start:start,cuenta:CuentaCodigo},
          cache:false,
          success:function(data)
          {
              $('#load_data').append(data);
              
              if(data == ''){
                setTimeout(function() {
                  $('#load_data_message').html('<div class="alert alert-secondary alert-dismissible fade show w-100" role="alert"><strong><i class="fas fa-bullhorn"></i></strong>  NO SE ENCONTARON MÁS RESULTADOS <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').fadeOut(6000);
                },1000);  
                  action = 'active';
              }
              else
              {
                  $('#load_data_message').html('<div class="lds-dual-ring"></div>');
                  action = "inactive";
              }
          }
      });
  }

  if(action == 'inactive')
  {
    action = 'active';
    load_publicaciones_data(limit, start);
  }
  $(window).scroll(function(){
    if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
    {
      action = 'active';
      start = start + limit;
      setTimeout(function(){
          load_publicaciones_data(limit, start);
          }, 2000);
    }
  });


  /*LIKE PUBLICACIONES*/
  $(document).on("click", ".like", function(e){

    var idPublicacion = this.id;
    var idUsuario= $(this).data('usuario');

    $.ajax({
        url:"../likes.php",
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
        url:"../coment.php",
        method:"POST",
        data:{publicacionC:idPublicacionC,usuarioC:idUsuarioC,comentarioC:comentario},
        dataType: "json",
        success: function(data){

          console.log(idPublicacionC, idUsuarioC, comentario);
          var numeroC = data['numeroC'];
          var newComent = data['newComent'];

          $("#comentario"+idPublicacionC).append(newComent);
          $('#num-'+idPublicacionC).text(numeroC);
          $("#comentario"+idPublicacionC).removeClass("collapse");
          $("#comentario"+idPublicacionC).addClass("show");
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
        url:"../coment.php",
        method:"POST",
        data:{publicacionC:idPublicacionC2,usuarioC:idUsuarioC2,comentarioC:comentario2},
        dataType: "json",
        success: function(data){

          var numeroC = data['numeroC'];
          var newComent = data['newComent'];

          $("#comentario"+idPublicacionC2).append(newComent);
          $('#num-'+idPublicacionC2).text(numeroC);
          $("#comentario"+idPublicacionC2).removeClass("collapse");
          $("#comentario"+idPublicacionC2).addClass("show");
          $("#descripcion-"+idPublicacionC2).val("");

        }
      });
      return false;
    }

  });

});
</script>