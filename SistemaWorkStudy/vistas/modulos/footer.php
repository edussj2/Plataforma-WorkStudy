    <div class="footer-sistema">

        <div class="opcion">
            <a data-toggle="modal" data-target="#modalTestimonio"><i class="far fa-comment-alt"></i> Agregar Testimonio</a>

            <!-- Modal -->
            <div class="modal fade" id="modalTestimonio" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="flex-colum">
                                <h5 class="modal-title"><i class="far fa-comment-alt"></i> Agregar Testimonio</h5>
                                <small class="text-muted line-h-sm">Dejanos un testimonio de que te parece la página y como te ayuda.</small>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="FormularioAjax" data-form="save" action="<?php echo SERVERURL; ?>ajax/testimonioPlataformaAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="testimonioPlataforma_usuario_reg" value="<?php echo mainModel::encryption($_SESSION['codigo_cuenta_WS']);?>">
                        <div class="modal-body d-flex">
                            <p class="text-center p-3">
                                <img src="<?php echo SERVERURL;?>adjuntos/avatars/<?php echo $_SESSION['avatar_WS'];?>" alt="Foto de Perfil" class="border border-primary" style="border-radius:50%;width:62px">
                            </p>
                            <textarea name="testimonioPlataforma_descripcion_reg" class="form-control w-100" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                            <button type="submit" class="btn btn-primary"><i class="far fa-paper-plane"></i> Enviar</button>
                        </div>
                        <div class="RespuestaAjax"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="opcion">
            <a href=""><i class="far fa-question-circle"></i> Preguntas Frecuentes</a>
        </div>

        <div class="opcion">
            <a href=""><i class="far fa-envelope"></i> Contáctanos</a>
        </div>
    </div>