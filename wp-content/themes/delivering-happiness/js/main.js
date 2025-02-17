/**
 * Custom functions
 *
 */

(function($){
	$( document ).ready(function() {

    // Modal box 
    $('.faded').height($(document).height());
    $('.modal-box-handler').click(function(){
      $('.faded').show();
    });
    $('.modal-box').find('.close').click(function(){
      $('.faded').hide();
      $(this).parent().hide();
    });

    //for closing keep in touch popup
    $('.popups').find('.close').click(function(){
      $('.popups').hide('slow');
    });

    // Flip animation 
		$('.flip .coin').click(function() {
      $(this).parents('.all-coins').find('.coin').removeClass('active');
     	$(this).addClass('active');
      $(this).parents('.wrapper').find('.right-col .content').removeClass('active');
      $(this).parents('.wrapper').find('.right-col .content:eq('+$(this).parents('.all-coins').find('.coin').index(this)+')').toggleClass('active');
      return false;
    });
    $( ".products-animation" ).hover(
        function() {
        }, function() {
          $( this ).find('.card').eq(0).addClass('active');
        }
    );
		$( ".products-animation .card" ).hover(
  			function() {
          $('.products-animation .card').removeClass('active');
    			$( this ).addClass('active');
  			}, function() {
    			$( this ).removeClass('active');
  			}
		);
    $('.video-container .button').click(function() {
        $(this).parents('.video-container').find('.video').show();
    });
    //Mobile nav toggle
    $("#page").css("width", "100%");
    $('.mobile-toggle').click(function() {
        $("#page").toggleClass("animate-me");
        $(".mobile-nav-menu").toggleClass("animate-me");
        $("#page").addClass("trans");
        return false;
    });
    $('.course-bottom-bar .top-btn').click(function() {
        $(".course-bottom-bar").toggleClass("animate-me");
        $(this).toggleClass("active");
        return false;
    });
    //Circle 
    $( document ).ready(function() {
        $('#myStat2').circliful();
        $('#myStat3').circliful();
        $('#myStat4').circliful();
        $('#myStat5').circliful();
        $('#myStat6').circliful();
        $('#myStat7').circliful();

    });
	});
})(jQuery);

