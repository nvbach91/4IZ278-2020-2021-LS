(function ($) {
  "use strict";

  // Mobile Nav toggle
  $(".menu-toggle > a").on("click", function (e) {
    e.preventDefault();
    $("#responsive-nav").toggleClass("active");
  });


  $(".profile-dropdown").on("click", function (e) {
    e.stopPropagation();
  });


 
	
})(jQuery);
