$(document).ready(function(){
	//USANDO EL METODO AJAX
	$('.FormularioAjax').submit(function(e){
			e.preventDefault();
		
			var form=$(this);
		
			var tipo=form.attr('data-form');
			var accion=form.attr('action');
			var metodo=form.attr('method');
			var respuesta=form.children('.RespuestaAjax');
		
			var msjError="<script>swal('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
			var formdata = new FormData(this);
		
		
			var textoAlerta;
			if(tipo==="save"){
				textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
			}else if(tipo==="delete"){
				textoAlerta="Los datos serán eliminados completamente del sistema";
			}else if(tipo==="update"){
				textoAlerta="Los datos del sistema serán actualizados";
			}else if (tipo=="search"){
				textoAlerta="¿Quieres realizar la búsqueda solicitada?";
			}else{
				textoAlerta="¿Quieres realizar la operación solicitada?";
			}
		
				swal({
					title: "¿Estás seguro?",   
					text: textoAlerta,   
					type: "question",   
					showCancelButton: true,     
					confirmButtonText: "Aceptar",
					cancelButtonText: "Cancelar"
				}).then(function () {
					$.ajax({
						type: metodo,
						url: accion,
						data: formdata ? formdata : form.serialize(),
						cache: false,
						contentType: false,
						processData: false,
						xhr: function(){
							var xhr = new window.XMLHttpRequest();
							xhr.upload.addEventListener("progress", function(evt) {
							  if (evt.lengthComputable) {
								var percentComplete = evt.loaded / evt.total;
								percentComplete = parseInt(percentComplete * 100);
								if(percentComplete<100){
									respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
								  }else{
									  respuesta.html('<p class="text-center"></p>');
								  }
							  }
							}, false);
							return xhr;
						},
						success: function (data) {
							respuesta.html(data);
						},
						error: function() {
							respuesta.html(msjError);
						}
					});
					return false;
				});
	});
	
});
(function($) {
    "use strict"; 
	
	/* Preloader */
	$(window).on('load', function() {
		var preloaderFadeOutTime = 500;
		function hidePreloader() {
			var preloader = $('.spinner-wrapper');
			setTimeout(function() {
				preloader.fadeOut(preloaderFadeOutTime);
			}, 500);
		}
		hidePreloader();
	});

    /* Image Slider - Swiper */
    var imageSlider = new Swiper('.image-slider', {
        autoplay: {
            delay: 2000,
            disableOnInteraction: false
		},
        loop: true,
        spaceBetween: 30,
        slidesPerView: 3,
		breakpoints: {
            // when window is <= 580px
            580: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            // when window is <= 768px
            768: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            // when window is <= 992px
            992: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            // when window is <= 1200px
            1200: {
                slidesPerView: 4,
                spaceBetween: 20
            },

        }
    });


    /* Card Slider - Swiper */
	var cardSlider = new Swiper('.card-slider', {
		autoplay: {
            delay: 4000,
            disableOnInteraction: false
		},
        loop: true,
        navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev'
		}
    });
    

    /* Lightbox - Magnific Popup */
	$('.popup-with-move-anim').magnificPopup({
		type: 'inline',
		fixedContentPos: false, /* keep it false to avoid html tag shift with margin-right: 17px */
		fixedBgPos: true,
		overflowY: 'auto',
		closeBtnInside: true,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-slide-bottom'
	});

	/* Removes Long Focus On Buttons */
	$(".button, a, button").mouseup(function() {
		$(this).blur();
	});

			/* ==== Slck JS: NOTICIAS ==== */
			$(".regular").slick({
				dots: true,
				infinite: true,
				slidesToShow: 1,
				autoplay: true,
				autoplaySpeed: 4000,
				slidesToScroll: 1,
				responsive: [
					{
					breakpoint: 1024,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						infinite: true,
						dots: true
					}
					},
					{
						breakpoint: 992,
						settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						infinite: true,
						dots: true
						}
					},
					{
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
					},
					{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
					}
					// You can unslick at a given breakpoint now by adding:
					// settings: "unslick"
					// instead of a settings object
				]
			});
			/* ==== Slck JS: NOTICIAS ==== */
	

})(jQuery);

/*===== EXPANDER MENU  =====*/ 
	const showMenu = (toggleId, navbarId, bodyId)=>{
	const toggle = document.getElementById(toggleId),
	navbar = document.getElementById(navbarId),
	bodypadding = document.getElementById(bodyId)
  
	if(toggle && navbar){
	  toggle.addEventListener('click', ()=>{
		navbar.classList.toggle('expander')
  
		bodypadding.classList.toggle('body-pd')
	  })
	}
  }
  showMenu('nav-toggle','navbar','body-pd')


  /* CLIC PERFIL HOME */

  function menuPerfilHome(){
	  const toggleMenu = document.querySelector('.menu-icon-profile');
	  toggleMenu.classList.toggle('activar');
  }


  /****VISOE IMAGENES 2 */
  function validarExt2()
  {
	var archivoInput  = document.getElementById('archivoInput');
	var archivoRuta = archivoInput.value;
	var extPermitidas = /(.pdf|.PNG|.png|.jpg|.JPG|.jpeg)$/i;

	if(!extPermitidas.exec(archivoRuta)){
		swal("Ocurrió un error","El archivo que intenta cargar no es válido","error");
		archivoInput.value='';
		return false;
	}else{
		document.getElementById('carga-imagen').className = 'd-none';
		if(archivoInput.files && archivoInput.files[0]){
			var visor = new FileReader();
			visor.onload=function(e)
			{
				document.getElementById('visorArchivo').innerHTML=
				'<embed src="'+e.target.result+'" width="100" height="100" id="embed" class="w-100" style="height:200px;"><i class="far fa-times-circle" id="eliminar"></i>';
			};
			visor.readAsDataURL(archivoInput.files[0]);
		}
	}
  }

    /****VISOE IMAGENES  */
	function validarExt()
	{
	  var archivoInput  = document.getElementById('archivoInput');
	  var archivoRuta = archivoInput.value;
	  var extPermitidas = /(.pdf|.PNG|.png|.jpg|.JPG|.jpeg|.svg|.SVG)$/i;
  
	  if(!extPermitidas.exec(archivoRuta)){
		  swal("Ocurrió un error","El archivo que intenta cargar no es válido","error");
		  archivoInput.value='';
		  return false;
	  }else{
		  if(archivoInput.files && archivoInput.files[0]){
			  var visor = new FileReader();
			  visor.onload=function(e)
			  {
				  document.getElementById('visorArchivo').innerHTML=
				  '<embed src="'+e.target.result+'" width="100" height="100" id="embed"><i class="far fa-times-circle" id="eliminar"></i>';
			  };
			  visor.readAsDataURL(archivoInput.files[0]);
		  }
	  }
	}

  /***BOTON ELIMINAR FOTO */
  $(document).on("click", "#eliminar", function(e){
	$("#embed").remove();
	$("#eliminar").remove();
	$('#archivoInput').val('');
	$('#carga-imagen').removeClass('d-none');
	$('#carga-imagen').addClass('d-flex');
	$('#carga-imagen').addClass('flex-column');
	$('#carga-imagen').addClass('align-items-center');
	$('#carga-imagen').addClass('pt-5');
  });


  /** VALIDAR QUE SE ESCRIBAN NUMEROS */
  /*VALIDAR QUE SOLO SEA NUM*/
function valideKey(evt){
    
    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;
    
    if(code==8) { // backspace.
      return true;
    } else if(code>=48 && code<=57) { // is a number.
      return true;
    } else{ // other keys.
      return false;
    }
}

$(function () {
	$('[data-toggle="tooltip"]').tooltip()
  })

