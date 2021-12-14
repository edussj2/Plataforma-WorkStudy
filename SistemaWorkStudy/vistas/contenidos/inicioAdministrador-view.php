<?php
  /* HECHO */
	if($_SESSION['tipo_WS']!="Administrador"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?> 

<section class="pb-5">
    <div class="container mb-5">
        <div class="row">

            <div class="col-lg-8 mb-3">
                <div class="card rounded-0">
                    <div class="card-header bg-light">
                        <h6 class="font-weight-bold mb-0"><i class="fas fa-chart-pie"></i> N° de Usuarios por Tipo</h6>
                    </div>
                    <?php 
                            require_once "./controladores/graficosControlador.php";

                            $insgrafico1 = new graficoControlador();

                            $data1 = $insgrafico1->datos_graficos_usuarios_controlador();

                            $datos1 = json_encode($data1);
                    ?>
                    <div class="card-body">
                        <canvas id="myChart1" style="height:50vh; width:100%"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card rounded-0">
                    <div class="card-header bg-light">
                        <h6 class="font-weight-bold mb-0"> <i class="fas fa-database"></i> Datos Generales</h6>
                    </div>
                    <?php 
                        require "./controladores/publicacionControlador.php";
                        $Ipublicacion = new publicacionControlador();
                        $Cpublicacion = $Ipublicacion->datos_publicacion_controlador("Conteo",0);

                        require "./controladores/ofertaControlador.php";
                        $Ioferta = new ofertaControlador();
                        $Coferta = $Ioferta->datos_oferta_controlador("Conteo",0);

                        require "./controladores/anuncioControlador.php";
                        $Ianuncio = new anuncioControlador();
                        $Canuncio = $Ianuncio->datos_anuncio_controlador("Conteo",0);

                        require "./controladores/cursoControlador.php";
                        $Icurso = new cursoControlador();
                        $Ccurso = $Icurso->datos_curso_controlador("Conteo",0);
                    ?>
                    <div class="card-body pt-2" style="color:#000;">
                        <div class="d-flex border-bottom py-2">
                            <div class="d-flex mr-3">
                                <h2 class="align-self-center mb-0" style="color:#AFEEEE;"><i class="far fa-newspaper"></i></h2>
                            </div>
                            <div class="align-self-center">
                                <h5 class="d-inline-block mb-0"><?php echo $Cpublicacion->rowCount();?></h5><span> PUBLICACIONES</span>
                                <small class="d-block text-muted"><a href="<?php echo SERVERURL;?>publicaciones/">Ver Publicaciones</a></small>
                            </div>
                        </div>
                        <div class="d-flex border-bottom py-2">
                            <div class="d-flex mr-3">
                                <h2 class="align-self-center mb-0" style="color: #778899;"><i class="fas fa-briefcase"></i></h2>
                            </div>
                            <div class="align-self-center">
                                <h5 class="d-inline-block mb-0"><?php echo $Coferta->rowCount();?></h5><span> OFERTAS</span>
                                <small class="d-block text-muted"><a href="<?php echo SERVERURL;?>ofertas/">Ver Ofertas</a></small>
                            </div>
                        </div>
                        <div class="d-flex border-bottom py-2">
                            <div class="d-flex mr-3">
                                <h2 class="align-self-center mb-0" style="color:#008000;"><i class="fas fa-chalkboard-teacher"></i></h2>
                            </div>
                            <div class="align-self-center">
                                <h5 class="d-inline-block mb-0"><?php echo $Canuncio->rowCount();?></h5><span> ANUNCIOS</span>
                                <small class="d-block text-muted"><a href="<?php echo SERVERURL;?>anuncios/">Ver Anuncios</a></small>
                            </div>
                        </div>
                        <div class="d-flex border-bottom py-2 mb-3">
                            <div class="d-flex mr-3">
                                <h2 class="align-self-center mb-0" style="color:#A0522D;"><i class="fas fa-book"></i></h2>
                            </div>
                            <div class="align-self-center">
                                <h5 class="d-inline-block mb-0"><?php echo $Ccurso->rowCount();?></h5><span> CURSOS</span>
                                <small class="d-block text-muted"><a href="<?php echo SERVERURL;?>cursos/">Ver Anuncios</a></small>
                            </div>
                        </div>
                        
                        <div class="d-flex border-bottom py-2 mb-3">
                            <div class="d-flex mr-3">
                                <h2 class="align-self-center mb-0" style="color:rgb(255, 215, 0);"><i class="far fa-folder-open"></i></h2>
                            </div>
                            <div class="align-self-center">
                                <h5 class="d-inline-block mb-0">0</h5><span> PROYECTOS</span>
                                <small class="d-block text-muted">3.33.3</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mb-2 mt-4">
                <div class="card rounded-0">
                    <div class="card-header bg-light">
                        <h6 class="font-weight-bold mb-0"><i class="fas fa-chart-line"></i> N° de Interacciones</h6>
                    </div>
                    <?php 
                            require_once "./controladores/graficosControlador.php";

                            $insgrafico2 = new graficoControlador();

                            $data2 = $insgrafico2->datos_graficos_interacciones_controlador();

                            $datos2 = json_encode($data2);
                    ?>
                    <div class="card-body">
                        <canvas id="myChart2"  style="height:50vh; width:100%"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var titulo1 = ["Administrador","Estudiantes","Empresas"];
    var cantidad1 = <?php echo $datos1; ?>;
   
    var ctx = document.getElementById('myChart1').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: titulo1,
            datasets: [{
                label: '# de Usuarios',
                data: cantidad1,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            aspectRatio:2,
            responsive:true,
            maintainAspectRatio:false
        }
    });

    var titulo2 = ["Publicaciones","Ofertas","Anuncios","Cursos","Proyectos"];
    var cantidad2 = <?php echo $datos2; ?>;
   
    var ctx2 = document.getElementById('myChart2').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: titulo2,
            datasets: [{
                label: '# de Interacciones',
                data: cantidad2,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1,
                pointBorderColor: 'rgb(0,0,0)'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            aspectRatio:3,
            responsive:true,
            maintainAspectRatio:false
        }
    });
</script>