jQuery(document).ready(function($) {
    // $('.heros > .panel-grid-cell').slick({
    //     dots: true,
    //     infinite: true,
    //     speed: 500,
    //     fade: true,
    //     cssEase: 'linear'
    // });
    //slider
    $('.slider-ruvix').slick({
        infinite: true,
        dots: true,
        customPaging : function(slider, i) {
            return '<span class="dots-slider"></span>';
        },
        prevArrow: '<i class="fa fa-angle-left arrow-prev"></i>',
        nextArrow: '<i class="fa fa-angle-right arrow-next"></i>',
        autoplay: true,
        autoplaySpeed: 5000,
    });
    $('.slider-lastprojects').slick({
        infinite: true,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: false,
        nextArrow: '.arrow-next-proj',
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
              breakpoint: 980,
              settings: {
                slidesToShow: 2
              }
            }
          ]
    });

    $('.contact-btn a').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });
    $('a.project-link').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });
    $('.clicker-filter').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });
    $(document).on("click", ".clicker-filter", function(e){
        e.preventDefault();
        $(this).magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        }).magnificPopup('open');
    });
    
    $('#continue-nav').magnificPopup('close');

    $('.apply-filters').on('click', function(e){
        e.preventDefault();
        location.reload();
    });
    $('.sf-field-taxonomy-etiquetas .chosen-single span:contains("Todas las etiquetas")').css({"color" : "#fff"});
    $(document).on("click", ".sf-field-taxonomy-etiquetas .chosen-results li", function(){
        $('.sf-field-taxonomy-etiquetas .chosen-single span:not(:contains("Todas las etiquetas"))').css({"color" : "#444"});
    });

    $('.socials-share.face-share a').addClass('a2a_button_facebook');
    $('.socials-share.face-share a').click(function(e){
        e.preventDefault();
        $('.addtoany_share_save_container .a2a_kit .a2a_button_facebook')[0].click();
    });
    $('.socials-share.twitter-share a').addClass('a2a_button_twitter');
    $('.socials-share.twitter-share a').click(function(e){
        e.preventDefault();
        $('.addtoany_share_save_container .a2a_kit .a2a_button_twitter')[0].click();
    });
    $('.socials-share.linkedin-share a').addClass('a2a_button_linkedin');
    $('.socials-share.linkedin-share a').on('click', function(e){
        e.preventDefault();
        $('.addtoany_share_save_container .a2a_kit .a2a_button_linkedin')[0].click();
    });
    /* Mobile menu */
    $('a.mobile-icons').on('click', function(e){
        e.preventDefault();
        $('.mobile-menu').addClass('show');
    });
    $('.mobile-menu .close-mmenu').on('click', function(){
        $('.mobile-menu').removeClass('show');
    });
    $('.mobile-menu .contact-btn a').on('click', function(){
        $('.mobile-menu').removeClass('show');
    });
    $( window ).resize(function() {
        if (window.innerWidth >= 960){
            $('.mobile-menu').removeClass('show');
        }
    });
    /***************/
});