<?php

	class vistasModelo 
	{
		/********* MODELO OBTENER VISTAS ***********/
		protected static function obtener_vistas_modelo($vistas){
			$listaBlanca = ["inicioAdministrador","mantenimiento", "usuarios", "pagina", "reportes", "areaNueva", "areaLista", "areaBuscar", "sectorComercialNuevo","sectorComercialLista", "sectorComercialBuscar","categoriaNueva","categoriaLista", "categoriaBuscar", "materiaLista", "materiaNueva", "materiaBuscar","idiomaLista","idiomaNuevo","idiomaBuscar","universidadLista","universidadNueva","universidadBuscar", "categoriaCursoNueva", "categoriaCursoLista", "categoriaCursoBuscar","subcategoriaNueva","subcategoriaLista","subcategoriaBuscar","administradorNuevo", "administradorLista","administradorBuscar","estudianteLista", "estudianteBuscar", "empresaLista", "empresaBuscar", "testimonioLista","notificaciones","busqueda","inicioEstudiante","publicaciones","publicacion","ofertas","oferta","opciones","datosTutor","anuncioNuevo","anuncios","anuncio","cursoNuevo","cursos","curso","inicioEmpresa","404","ofertaNew","convocatoria"];

			if (in_array($vistas, $listaBlanca)) {
				if(is_file("./vistas/contenidos/".$vistas."-view.php")){
					$contenido = "./vistas/contenidos/".$vistas."-view.php";
				}else{
                    $contenido="404";
				}
			}elseif($vistas=="login" || $vistas=="index"){
				$contenido="login";
			}else{
				$contenido="404";
			}
			return $contenido;
		}
	}