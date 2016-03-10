jQuery(".dropdown-menu li").click(function(){
   var caret = jQuery(this).text()+'<b class="caret"></b>';
  jQuery(".dropdown-toggle").html(caret);
});
/** Mixitup **/
jQuery(function($){

var layout = 'grid';
var	$portfolio = jQuery('#portfolio');
var	$changeLayout = jQuery('.changeLayout');
var $class = $portfolio.find('figure').attr('class');

 $portfolio.mixItUp({
					layout:{
					  containerClass: layout
					},
					animation:{
					animateChangeLayout:true,
          duration: 440,
		      effects: 'fade translateZ(-360px)',
		        easing: 'cubic-bezier(0.47, 0, 0.745, 0.715)'
					}

				});

 $changeLayout.on('click', function(){
    // If the current layout is a list, change to grid:
    if(layout == 'list'){
      layout = 'grid';

      if(jQuery(this).closest('.dropdown-menu').length > 0){

      	$changeLayout.text('Affichage Liste');
	  	jQuery(".dropdown-toggle").html('Affichage Grille'+'<b class="caret"></b>');
      }
      else{

      $changeLayout.html('<i class="icon-justify icon-2x"></i>'); // Update the button text

      }
      $portfolio.mixItUp('changeLayout', {
        containerClass: layout // change the container class to "grid"
      });

       $portfolio.find('figure').addClass($class);

    // Else if the current layout is a grid, change to list:

    } else {

       layout = 'list';

      if(jQuery(this).closest('.dropdown-menu').length > 0){

      		$changeLayout.text('Affichage Grille');
      		jQuery(".dropdown-toggle").html('Affichage Liste'+'<b class="caret"></b>');
      }
      else {

      $changeLayout.html('<i class="icon-justify icon-2x"></i>'); // Update the button text

      }

      $portfolio.mixItUp('changeLayout', {
        containerClass: layout // Change the container class to 'list'
      });
      $portfolio.find('figure').removeClass($class);
    }
  });

});
