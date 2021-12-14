<!-- Breadcrumbs -->
<div class="container">
    <div class="breadcrumbs p-2">
            <a href="<?php echo SERVERURL; ?>inicioEstudiante/">Inicio</a><i class="fa fa-angle-double-right"></i><a href="<?php echo SERVERURL; ?>opciones/">Funcionalidades</a><i class="fa fa-angle-double-right"></i><span>Publicar Curso</span>
    </div>
</div>

<div class="crear-anuncio">
    <div class="mt-3 text-center">
        <h2><i class="fas fa-book"></i> Publicar Curso</h2>
    </div>

    <form class="FormularioAjax" data-form="save" action="<?php echo SERVERURL; ?>ajax/cursoAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">

        <input type="hidden" name="id_cuenta" value="<?php echo mainModel::encryption($_SESSION['codigo_cuenta_WS']);?>">

        <div class="crear-anuncio-bloque">
            <p>Presentación :</p>
            <hr>

            <div class="form-group">
                <label for="curso_titulo">Título <span class="asterisco">*</span> :</label>
                <input type="text" class="form-control" id="curso_titulo"  placeholder="Ingrese el título del curso" name="curso_titulo_reg" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ-0-9- ]{1,50}" maxlength="50" required>
                <small id="TituloHelp" class="form-text text-muted">Longitud máxima de 50 carácteres.</small>
            </div>

            <div class="form-group">
                <label for="curso_subtitulo">Subtítulo <span class="asterisco">*</span> :</label>
                <input type="text" class="form-control" id="curso_subtitulo"  placeholder="Ingrese el título del curso" name="curso_subtitulo_reg" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ-0-9- ]{1,80}" maxlength="80" required>
                <small id="subtituloHelp" class="form-text text-muted">Longitud máxima de 80 carácteres.</small>
            </div>   

            <div class="form-group">
                <label for="curso_descripcion">Acerca del curso <span class="asterisco">*</span> :</label>
                <textarea name="curso_descripcion_reg" id="curso_descripcion" rows="5" class="form-control w-100" required></textarea>
                <small id="descripcionHelp" class="form-text text-muted">Longitud máxima de 600 carácteres.</small>
            </div> 

            <label for="curso_imagen"><i class="fas fa-image"></i> Imagen de presentación</label>
            <div class="row">
                <div class="col-lg-6">
                    <div class="border p-1" style="height:240px;">
                        <div id="carga-imagen" class="d-flex w-100 flex-column align-items-center pt-5">
                            <div class="carga"></div>
                            <div>Cargué una imagen</div>
                        </div>
                        <div id="visorArchivo" class="w-100">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <label for="curso_imagen">Imagen <span class="asterisco">*</span> :</label>
                    <input type="file" id="archivoInput" name="curso-imagen-reg"  onchange="return validarExt2()" required="" class="border p-1" accept=".jpg, .png, .jpeg">
                    <small id="TituloHelp" class="form-text text-muted">Extensiones permitidas .jpg , jpeg , .png , resolución de 500x240pixeles.</small>
                </div>
            </div>

        </div>

        <div class="crear-anuncio-bloque">
            <p>Información básica :</p>
            <hr>

            <div class="row">

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="curso_categoria">Categoría <span class="asterisco">*</span> :</label>
                        <select class="form-control" id="curso_categoria" name="curso_categoria_reg" required>
                        <?php 
                            require_once "./controladores/categoriaCursoControlador.php";

                            $inscategoriacurso = new categoriacursoControlador();

                            $doc = $inscategoriacurso->datos_categoriaCurso_controlador("Select",0);

                            while ($rowD = $doc->fetch()) {
                                    echo '<option value="'.$rowD['idCategoriaCurso'].'">'.$rowD['CatCursoDescripcion'].'</option>';                            
                            }
                        ?>
                        </select>
                    </div> 
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="curso_subcategoria">Subcategoría <span class="asterisco">*</span> :</label>
                        <select class="form-control" id="curso_subcategoria" name="curso_subcategoria_reg" required>
                            <option value="Sin Registro" selected>Seleccione una Subcategoría</option>
                        </select>
                    </div> 
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="curso_nivel">Nivel <span class="asterisco">*</span> :</label>
                        <select name="curso_nivel_reg" id="curso_nivel" class="form-control" required>
                            <option value="Sin Registro" selected>Seleccione una opción</option>
                            <option value="Básico">Básico</option>
                            <option value="Intermedio">Intermedio</option>
                            <option value="Avanzado">Avanzado</option>
                        </select>
                    </div> 
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="curso_precio">Precio <span class="asterisco">*</span> :</label>
                        <input type="text" class="form-control" id="curso_precio" placeholder="0.00" name="curso_precio_reg" required pattern="[0-9.]{1,15}" maxlength="15">
                    </div> 
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="curso_duracion">Duración en horas :</label>
                        <input type="text" class="form-control" id="curso_duracion" placeholder="1" name="curso_duracion_reg" required pattern="[0-9]{1,5}" maxlength="5">
                    </div> 
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="curso_video">Link de video de presentación :</label>
                        <input type="text" class="form-control" id="curso_video" name="curso_video_reg" maxlength="250">
                        <small id="VideoHelp" class="form-text text-muted">Solo se aceptan links de la plataforma de youtube o vimeo.</small>
                    </div> 
                </div>
                
            </div>

        </div>

        <div class="crear-anuncio-bloque">
            <p>Detalles :</p>
            <hr>

            <div class="form-group">
                <label for="curso_objetivo">¿Qué aprenderán en el curso? <span class="asterisco">*</span> :</label>
                <textarea name="curso_objetivo_reg" id="curso_objetivo" rows="5" class="form-control w-100" maxlength="200"></textarea>
                <small id="objetivoHelp" class="form-text text-muted">Longitud máxima de 200 carácteres.</small>
            </div>

            <div class="form-group">
                <label for="curso_requisito">¿Qué conocimientos previos necesitan? <span class="asterisco">*</span> :</label>
                <textarea name="curso_requisito_reg" id="curso_requisito" rows="5" class="form-control w-100" maxlength="200"></textarea>
                <small id="requisitoHelp" class="form-text text-muted">Longitud máxima de 200 carácteres.</small>
            </div> 

            <div class="form-group">
                <label for="curso_dirigido">¿A quiénes va dirigido el curso? <span class="asterisco">*</span> :</label>
                <textarea name="curso_dirigido_reg" id="curso_dirigido" rows="5" class="form-control w-100" maxlength="200"></textarea>
                <small id="dirigidoHelp" class="form-text text-muted">Longitud máxima de 200 carácteres.</small>
            </div> 

        </div>

        <br>
        <p class="text-center" style="margin-top: 10px;">
            <button type="submit" class="boton-guardar"><i class="far fa-save"></i> Guardar</button>
        </p>
        <p class="text-center">
            <small style="font-size:14px">Los campos marcados con &nbsp; (<span class="asterisco">*</span>) &nbsp; son obligatorios</small>
        </p>
        <div class="RespuestaAjax"></div>
    </form>
 
</div>

    <!-- Subcategorias -->
    <script>
        $(document).ready(function(){
            $("#curso_categoria").change(function(){

                $("#curso_categoria option:selected").each(function(){
                    idCategoria = $(this).val();
                    $.post("../subcategoria.php",{idCategoria: idCategoria},function(data){
                        $("#curso_subcategoria").html(data);
                    })
                })
            })
            
        })
    </script>