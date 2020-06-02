(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

	var actionSubmenu = function() {

		$('.actionItem').mouseenter(function(){
			$('.actionSubmenu').addClass('menuOn').show();
		}).mouseleave(function(){
			$('.actionSubmenu').removeClass('menuOn');
			setTimeout(function () {
				if(!$('.actionSubmenu').hasClass('menuOn')) {
					$('.actionSubmenu').hide()
				}
			}, 500);
		});

	};
	actionSubmenu();


})(jQuery);
