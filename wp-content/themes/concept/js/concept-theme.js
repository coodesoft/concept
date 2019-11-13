$( document ).ready(function() {
  (function($){

  	var navbar = document.getElementById("main_menu");
  	var sticky = navbar.offsetTop;

  	function myFunction() {
  	  if (document.documentElement.scrollTop >= sticky -10) {
  		 navbar.classList.add("sticky")
  	  } else {
  		 navbar.classList.remove("sticky");
  	  }
  	}

  	window.onscroll = function() {
  		myFunction()
  	};
      
      $('body').off().on('click', '#navbarCollapse li a', function(){
          $('#navbarCollapse li a').removeClass('active-item');
          $(this).addClass('active-item');
      })
      

  })(jQuery);
});