jQuery(function($) {
    jQuery('.navbar-toggle').click(function () {
        jQuery('.navbar-nav').toggleClass('slide-in');
        jQuery('.side-body').toggleClass('body-slide-in');
        /// uncomment code for absolute positioning tweek see top comment in css
        //$('.absolute-wrapper').toggleClass('slide-in');
    });
    jQuery(".headerPage i.sprite").velocity("transition.perspectiveDownIn",{duration:1500});

});
;
