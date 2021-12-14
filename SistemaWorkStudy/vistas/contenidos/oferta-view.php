<?php 
    $datos = explode("/", $_GET['views']);

    require_once "./controladores/ofertaControlador.php";
    $classoferta = new ofertaControlador();
   
    $filesOferta = $classoferta->datos_oferta_controlador("Unico",$datos[1]);
   
    if($filesOferta->rowCount()==1){
   
        $campos = $filesOferta->fetch();

        require_once "./controladores/empresaControlador.php";
        $classempresa = new empresaControlador();

        $filesE = $classempresa->datos_empresa_controlador("Unico2",mainModel::encryption($campos['idEmpresa']));

        $camposE = $filesE->fetch();
?>
<!-- Breadcrumbs -->
<div class="container">
  <div class="breadcrumbs p-2">
         <a href="<?php echo SERVERURL; ?>inicioEstudiante/">Inicio</a><i class="fa fa-angle-double-right"></i><a href="<?php echo SERVERURL; ?>ofertas/all/">Ofertas Laborales</a><i class="fa fa-angle-double-right"></i><span><?php echo $campos['OfeTitulo']; ?></span>
  </div>
</div>

<div class="container">
    <div class="row" >

        <div class="col-lg-8 mb-4">
            <div class="izquierda-oferta shadow">
                <h3 class="m-0"><?php echo $campos['OfeTitulo']; ?></h3>
                <p>Chiclayo, Lambayeque - 12/04/2021</p>

                <h5 class="m-0 mt-4"><i class="fas fa-file-medical-alt" style="color:#1c7bba"></i> Descripción</h5>
                <p class="descripcion"><?php echo $campos['OfeDescripcion'];?></p>

                <h5 class="m-0 mt-4 mb-3"><i class="fas fa-user-check" style="color:#1c7bba"></i> Requerimientos</h5>

                <ul class="list-group">
                    <li class="list-group-item"><i class="fas fa-graduation-cap"></i> Educación Mínima : <?php echo $campos['OfeEduMinima']; ?></li>
                    <li class="list-group-item"><i class="far fa-star"></i> Años de Experiencia : <?php echo $campos['OfeExpYear']; ?></li>
                    <li class="list-group-item"><i class="fas fa-car"></i> Disponibilidad para viajar : <?php echo $campos['OfeDisViajar']; ?></li>
                    <li class="list-group-item"><i class="fas fa-warehouse"></i> Disponibilidad de cambio de residencia : <?php echo $campos['OfeDisCamResidencia']; ?></li>
                    <li class="list-group-item"><i class="fas fa-blind"></i> Personas con discapacidad : <?php echo $campos['OfeDisDiscapactiado']; ?></li>
                </ul>

                <a href="" class="btn w-100 mt-4 mb-2 text-decoration-none" style="background:#1c7bba;color:#fff;"> Postularme</a>

            </div>
        </div>

        <div class="col-lg-4">
            <div class="derecha-oferta shadow">
                <div class="d-flex">
                    <img src="<?php echo SERVERURL; ?>adjuntos/avatars/<?php echo $camposE['CtaFoto'];?>" alt="" style="width:95px;">
                    <div class="mx-3">
                        <h4 class="m-0"><?php echo $camposE['EmpNomComercial'];?></h4>
                        <h5 class="m-0"><?php echo $camposE['EmpRazSocial'];?></h5>
                        <p><?php echo $camposE['EmpDireccion'];?></p>
                    </div>
                </div>

                <h5 class="m-0 mt-4 mb-3"><i class="fas fa-pencil-alt" style="color:#1c7bba"></i> Detalles</h5>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Jornada Laboral: <?php echo $campos['OfeJorLaboral'];?></li>
                    <li class="list-group-item">Tipo de Contrato: <?php echo $campos['OfeTipContrato'];?></li>
                    <li class="list-group-item">Modalidad: <?php echo $campos['OfeTipTrabajo'];?></li>
                    <li class="list-group-item">Salario: S/ <?php echo $campos['OfeSalario'];?></li>
                    <li class="list-group-item">Relevancia: <?php echo $campos['OfeRelevancia'];?></li>
                </ul>
                
                <a href="" class="btn w-100 mt-4 mb-2 text-decoration-none" style="background:#1c7bba;color:#fff;"> Postularme</a>
            </div>
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
<div class="container">
    <hr>
    <?php include "./vistas/modulos/footer.php";?>
</div>