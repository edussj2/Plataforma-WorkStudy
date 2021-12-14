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

	/* Navbar Scripts */
	// jQuery to collapse the navbar on scroll
    $(window).on('scroll load', function() {
		if ($(".navbar").offset().top > 60) {
			$(".fixed-top").addClass("top-nav-collapse");
		} else {
			$(".fixed-top").removeClass("top-nav-collapse");
		}
    });

	// jQuery for page scrolling feature - requires jQuery Easing plugin
	$(function() {
		$(document).on('click', 'a.page-scroll', function(event) {
			var $anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top
			}, 600, 'easeInOutExpo');
			event.preventDefault();
		});
	});

    // closes the responsive menu on menu item click
    $(".navbar-nav li a").on("click", function(event) {
    if (!$(this).parent().hasClass('dropdown'))
        $(".navbar-collapse").collapse('hide');
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

    /* Back To Top Button */
    // create the back to top button
    $('body').prepend('<a href="body" class="back-to-top page-scroll">Back to Top</a>');
    var amountScrolled = 700;
    $(window).scroll(function() {
        if ($(window).scrollTop() > amountScrolled) {
            $('a.back-to-top').fadeIn('500');
        } else {
            $('a.back-to-top').fadeOut('500');
        }
    });


	/* Removes Long Focus On Buttons */
	$(".button, a, button").mouseup(function() {
		$(this).blur();
	});

})(jQuery);


/* validar extesion */
function validarExt()
{
	var archivoInput  = document.getElementById('archivoInput');
	var archivoRuta = archivoInput.value;
	var extPermitidas = /(.PNG|.png|.jpg|.JPG|.jpeg|.svg|.SVG)$/i;

	if(!extPermitidas.exec(archivoRuta)){
		swal("Ocurrió un error","El archivo que intenta cargar no es válido","error");
		archivoInput.value='';
		return false;
	}
}

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


function validarRegistroUsuario(){
    var nombre, apePaterno, pass1, pass2, apeMaterno;
    nombre = document.getElementById("nombres").value;
    apePaterno = document.getElementById("apePaterno").value;
    apeMaterno = document.getElementById("apeMaterno").value;
    pass1 = document.getElementById("pass1").value;
    pass2 = document.getElementById("pass2").value;

    if(nombre === "" || apePaterno === "" || apeMaterno === "" || pass1 === "" || pass2 === ""){
        swal("Ocurrió un error","Complete todos los campos requeridos","error");
        return false;
    }
    else if(pass1 != pass2){
        swal("Ocurrió un error","Las contraseñas no son iguales, intente nuevamente","error");
        return false;
    }
    else if(pass1.length>16 || pass1.length<6){
        swal("Ocurrió un error","Las longitudes de las contraseñas nos son válidas, intente nuevamente","error");
        return false;
    }
    else if(nombre.length>60){
        swal("Ocurrió un error","El nombre es muy largo y no es válido, intente nuevamente","error");
        return false;
    }
    else if(apePaterno.length>40){
        swal("Ocurrió un error","El apellido paterno es muy largo y no es válido, intente nuevamente","error");
        return false;
    }
    else if(apeMaterno.length>40){
        swal("Ocurrió un error","El apellido materno es muy largo y no es válido, intente nuevamente","error");
        return false;
    }else if(!isNaN(nombre) || !isNaN(apeMaterno) || !isNaN(apePaterno)){
        swal("Ocurrió un error","Los nombre o apellidos ingresados no son válidos, intente nuevamente","error");
        return false;
    }
}

function validarRegistroEmpresa(){
    var nomComercial, razSocial, pass1, pass2, direccion, inputNomContacto,inputApeContacto,inputRuc,inputNum,cboSecComrecial;
    nomComercial = document.getElementById("nomComercial").value;
    razSocial = document.getElementById("razSocial").value;
    direccion = document.getElementById("direccion").value;
    pass1 = document.getElementById("pass1").value;
    pass2 = document.getElementById("pass2").value;
    inputNomContacto = document.getElementById("inputNomContacto").value;
    inputApeContacto = document.getElementById("inputApeContacto").value;
    num  = document.getElementById("inputNum").value;
    ruc = document.getElementById("inputRuc").value;
    cboSecComrecial = document.getElementById("cboSecComercial").value;
    cboDistrito = document.getElementById("cboDistrito").value;

    if(nomComercial === "" || razSocial === "" || direccion === "" || pass1 === "" || pass2 === "" || inputApeContacto === "" || inputNomContacto === "" || ruc === "" || num === "" || cboSecComrecial == "Sin Registro" || cboDistrito == "Sin Registro"){
        swal("Ocurrió un error","Complete todos los campos requeridos","error");
        return false;
    }
    else if(pass1 != pass2){
        swal("Ocurrió un error","Las contraseñas no son iguales, intente nuevamente","error");
        return false;
    }
    else if(pass1.length>16 || pass1.length<6){
        swal("Ocurrió un error","Las longitudes de las contraseñas nos son válidas, intente nuevamente","error");
        return false;
    }
    else if(nomComercial.length>70){
        swal("Ocurrió un error","El nombre comercial es muy largo y no es válido, intente nuevamente","error");
        return false;
    }
    else if(razSocial.length>70){
        swal("Ocurrió un error","La razón social es muy larga y no es válida, intente nuevamente","error");
        return false;
    }
    else if(direccion.length>80){
        swal("Ocurrió un error","La dirección es muy larga y no es válido, intente nuevamente","error");
        return false;
    } 
    else if(direccion.length>80){
        swal("Ocurrió un error","La dirección es muy larga y no es válido, intente nuevamente","error");
        return false;
    }
    else if(ruc.length>15 || ruc.length<10){
        swal("Ocurrió un error","El RUC tienes una longitud no válida, intente nuevamente","error");
        return false;
    }
    else if(num.length>9 || ruc.length<9){
        swal("Ocurrió un error","El teléfono tiene que tener 9 caracteres, intente nuevamente","error");
        return false;

    }else if(!isNaN(inputNomContacto) || !isNaN(inputApeContacto)){
        swal("Ocurrió un error","Los nombre o apellidos ingresados no son válidos, intente nuevamente","error");
        return false;
    }
}