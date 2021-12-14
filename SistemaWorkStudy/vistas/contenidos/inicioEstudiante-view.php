<?php
	if($_SESSION['tipo_WS']!="Estudiante"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
	$fecha = date('Y-m-d');
?>

<div class="container">
	<div class="titulo-inicio-estudiante">
		<img src="<?php echo SERVERURL; ?>vistas/images/img/tablero.svg" alt="Imagen de Dashboard WorkStudy">
		<h1>Panel de Inicio de <span>Workstudy</span></h1>
	</div>
</div>

<div class="container mt-5">
	<div class="row">

		<div class="col-lg-7 mb-4">
			<h6 class="m-0"><i class="fas fa-edit"></i> Funcionalidades</h6>
			<hr>
			<div class="contenedor-inicio-opciones">
				<div class="tabla border-rojo">
					<img src="<?php echo SERVERURL; ?>vistas/images/img/tutor-inicio.svg" alt="Datos como Tutor">
					<h3>Registrate como Tutor</h3>
				</div>
				<div class="tabla border-azul">
					<img src="<?php echo SERVERURL; ?>vistas/images/img/anuncio-inicio.svg" alt="Anunciate como Tutor">
					<h3>Anuncia tutorías</h3>
				</div>
				<div class="tabla border-amarillo">
					<img src="<?php echo SERVERURL; ?>vistas/images/img/curso-inicio.svg" alt="Publica Cursos">
					<h3>Publica Cursos</h3>
				</div>
			</div>
			<p class="text-center mt-4">
				<a href="<?php echo SERVERURL;?>opciones/" class="btn btn-info text-decoration-none">Explorar Funcionalidades <i class="fas fa-binoculars"></i></a>
			</p>
		</div>


		<div class="col-lg-5 mb-4">
			<h6 class="m-0"><i class="far fa-newspaper"></i> Tus últimas publicaciones</h6>
			<hr>
			<div class="contenedor-tus-publicaciones">
			<?php 
                require_once "./controladores/publicacionControlador.php";
                $inspublicacion = new publicacionControlador();

            	echo $inspublicacion->listar_mis_ultimas_publicaciones_controlador(mainModel::encryption($_SESSION['codigo_cuenta_WS']));
            ?>
			</div>
			<p class="text-center mt-3">
				<a href="<?php echo SERVERURL;?>publicaciones/" class="btn btn-outline-info text-decoration-none">Ir a Publicaciones <i class="fas fa-comments"></i></a>
			</p>
		</div>


		<div class="col-lg-6 mb-4">
			<h6 class="m-0"><i class="fas fa-book-open"></i> Últimos cursos publicados</h6>
			<hr>
			<div class="contenedor-ultimos-cursos">

			<?php 
                require_once "./controladores/cursoControlador.php";
            	$inscurso = new cursoControlador();
                echo $inscurso->listar_ultimos_cursos_controlador();
            ?>

			</div>
			<p class="text-center mt-3">
				<a href="<?php echo SERVERURL;?>cursos/all/" class="btn btn-outline-info text-decoration-none">Ver todos los cursos <i class="fas fa-book"></i></a>
			</p>
		</div>


		<div class="col-lg-6 mb-4">
			<h6 class="m-0"><i class="fas fa-thumbtack"></i> Ofertas de hoy <?php echo $fecha;?></h6>
			<hr>

			<!-- Slider: ofertas-inicio-->
			<div class="regular contenedor-ofertas-inicio">

				<!-- Item oferta-inicio-->
				<?php 
					require_once "./controladores/ofertaControlador.php";
					$insoferta = new ofertaControlador();
					echo $insoferta->listar_hoy_ofertas_controlador($fecha);
				?>
							
			</div>
			<!-- Slider: ofertas-inicio-->
			
			<p class="text-center mt-3">
				<a href="<?php echo SERVERURL;?>ofertas/all/" class="btn btn-info text-decoration-none">Conocer más ofertas <i class="far fa-flag"></i></a>
			</p>

		</div>

	</div>
</div>

<div class="container">
	<hr>
	<?php include "./vistas/modulos/footer.php" ?>
</div>