jQuery(window).on('load', function(){
	jQuery('.sponsors-carousel > .panel-grid-cell').slick({
		infinite: true,
  		speed: 300,
  		autoplay: true,
  		autoplaySpeed: 3000,
		slidesToShow: 4,
  		slidesToScroll: 1,
  		responsive: [
		    {
		      breakpoint: 980,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3
		      }
		    },
		    {
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 2,
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
		  ]
	});
	
	var urlActual = window.location.href;
	
	if( urlActual.indexOf('#') != '-1') {
		urlActual = urlActual.split("#")[1];
		console.log(urlActual.indexOf('#'));
	   	if(jQuery('#'+urlActual).length) {
	    	jQuery('html,body').animate({

	        scrollTop: jQuery('#'+urlActual).offset().top-70
	    	}, 1000);	
	    }
	}

	jQuery('.menu-item a').click(function(e){
	    e.preventDefault();
	    var id = jQuery(this).attr('href');
		id = id.split("#")[1];
	    if(jQuery('#'+id).length) {
	    	jQuery('html,body').animate({

	        scrollTop: jQuery('#'+id).offset().top-70
	    	}, 1000);	
	    }
	    else {
	    	window.location.href = jQuery(this).attr('href');
	    }
	    
	});

	if (jQuery(window).width() < 1023) {
			jQuery('#text-2').insertAfter('#menu-main-menu');
		}
		else {
			jQuery('#text-2').insertAfter('#nav_menu-2');  
		}

	jQuery( window ).resize(function() {
		if (jQuery(window).width() < 1023) {
			jQuery('#text-2').insertAfter('#menu-main-menu');
		}
		else {
			jQuery('#text-2').insertAfter('#nav_menu-2');  
		}
	});
	
	
});