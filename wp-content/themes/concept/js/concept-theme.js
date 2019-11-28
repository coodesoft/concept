$( document ).ready(function() {
  (function($){

  	let navbar        = document.getElementById("main_menu");
  	let sticky        = $(window).height();
    let ultima_dat_id = '';

    if ($('.page-section-container').length == 0) {
      myFunction();
    }
    setActiveClass();
    resize_images();

    function setActiveClass(){
      let sections = $('section');
      let pos_sec  = -1;
      for (let c=0; c<sections.length; c++){
        let sec = $(sections[c]);
        if (window.scrollY < (sec.offset().top + sticky - $("#main_menu").outerHeight()) && (typeof sec.attr('data-id') !== 'undefined') ){
          pos_sec = c; break;
        }
      }

      if (pos_sec != -1){ ultima_dat_id = $(sections[pos_sec]).attr('data-id'); }

      if ($('#nav-link-'+ultima_dat_id).length != 0){
        $('#navbarCollapse li a').removeClass('active-item');
        $('#nav-link-'+ultima_dat_id).addClass('active-item');
      }
    }

    function myFunction() {
  	  if (document.documentElement.scrollTop >= sticky -10) {
  		 navbar.classList.add("fixed-top");
  	  } else {
  		 navbar.classList.remove("fixed-top");
  	  }
  	}

  	window.onscroll = function() {
      if ($('.page-section-container').length == 0) {
  		    myFunction();
      }

      setActiveClass();
  	};

    $('body').off().on('click', '#navbarCollapse li a', function(){
        $('#navbarCollapse li a').removeClass('active-item');
        $(this).addClass('active-item');
    });


  })(jQuery);

  function resize_images(){
    let obj = $('.img-cont-square');
    
    for (let c=0; c<obj.length; c++){
      let o = $(obj[c]);
      o.css('height',o.css('width'));
    }
  }

  $( window ).resize(function() {
   resize_images();
  });
});
