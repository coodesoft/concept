$( document ).ready(function() {
  (function($){

  	var navbar = document.getElementById("main_menu");
    navbar.classList.remove("fixed-top");
  	var sticky = navbar.offsetTop;

    if ($('#page-section-container').length != 0) {
      navbar.classList.add("fixed-top");
    }

  	function myFunction() {
  	  if (document.documentElement.scrollTop >= sticky -10) {
  		 navbar.classList.add("fixed-top");
  	  } else {
  		 navbar.classList.remove("fixed-top");
  	  }
  	}

  	window.onscroll = function() {
      if ($('#page-section-container').length == 0) {
  		    myFunction();
      }
  	};

      $('body').off().on('click', '#navbarCollapse li a', function(){
          $('#navbarCollapse li a').removeClass('active-item');
          $(this).addClass('active-item');
      })


  })(jQuery);
});
