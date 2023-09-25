
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
        fade: true,
        customPaging : function(slider, i) {
            return '<span class="dots-slider"></span>';
        },
        dots: false,
        prevArrow: '<i class="fa fa-angle-left arrow-prev"></i>',
        nextArrow: '<i class="fa fa-angle-right arrow-next"></i>',
        autoplay: true,
        autoplaySpeed: 5000,
    });
    $('#carousel_projects').slick({
        infinite: true,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: false,
        nextArrow: '.arrow-next-proj',
        autoplay: true,
        autoplaySpeed: 3000,
        prevArrow: '<i class="fa fa-arrow-left arrow-prev"></i>',
        nextArrow: '<i class="fa fa-arrow-right arrow-next"></i>',
        responsive: [
          {
            breakpoint: 1530,
            settings: {
              slidesToShow: 3
            }
          },
          {
            breakpoint: 980,
            settings: {
              slidesToShow: 2
            }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 1
            }
          }
        ]
    });
    $('#other_projects').slick({
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

 // 
 $('.slider-articulos').slick({
  infinite: true,
  dots: false,
  slidesToShow: 3,
  slidesToScroll: 1,
  prevArrow: false,
  nextArrow: '.arrow-next-proj',
  autoplay: true,
  autoplaySpeed: 3000000,
  prevArrow: '<i class="fa fa-arrow-left arrow-prev"></i>',
  nextArrow: '<i class="fa fa-arrow-right arrow-next"></i>',
  responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 2
        }
      },
      {
       breakpoint: 781,
        settings: {
          slidesToShow: 1
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

        jQuery('body').addClass('popup-search');
    });
    jQuery(document).on("click", ".mfp-close", function(e){
        jQuery('body').removeClass('popup-search');
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


jQuery(window).on('load', function(){

    jQuery( "body").on( "click", ".sf-field-post-meta-dormitorios .chosen-drop ul.chosen-results", function() {
        var val_attr = jQuery(this).find('li.result-selected').attr('data-option-array-index');
        if(val_attr == 1){
            jQuery('.sf-field-post-meta-dormitorios select.sf-input-select').find('option:nth-child(1)').prop('selected',true).trigger('change'); //trigger a change instead of click
        }
    });
    jQuery( "body").on( "click", ".sf-field-post-meta-banos .chosen-drop ul.chosen-results", function() {
        var val_attr = jQuery(this).find('li.result-selected').attr('data-option-array-index');
        if(val_attr == 1){
            jQuery('.sf-field-post-meta-banos select.sf-input-select').find('option:nth-child(1)').prop('selected',true).trigger('change'); //trigger a change instead of click
        }
    });
    jQuery( "body").on( "click", ".sf-field-post-meta-entrega_semestre .chosen-drop ul.chosen-results", function() {
        var val_attr = jQuery(this).find('li.result-selected').attr('data-option-array-index');
        if(val_attr == 1){
            jQuery('.sf-field-post-meta-entrega_semestre select.sf-input-select').find('option:nth-child(1)').prop('selected',true).trigger('change'); //trigger a change instead of click
        }
    });
    jQuery( "body").on( "click", ".sf-field-post-meta-comuna .chosen-drop ul.chosen-results", function() {
        var val_attr = jQuery(this).find('li.result-selected').attr('data-option-array-index');
        if(val_attr == 1){
            jQuery('.sf-field-post-meta-comuna select.sf-input-select').find('option:nth-child(1)').prop('selected',true).trigger('change'); //trigger a change instead of click
        }
    });
    setTimeout(function(){
        jQuery('.sf-field-post-meta-dormitorios .sf-input-select option:nth-child(2)').addClass('hide-option');
        jQuery('.sf-field-post-meta-banos .sf-input-select option:nth-child(2)').addClass('hide-option');
        jQuery('.sf-field-post-meta-entrega_semestre .sf-input-select option:nth-child(2)').addClass('hide-option');
        jQuery('.sf-field-post-meta-comuna .sf-input-select option:nth-child(2)').addClass('hide-option');
    },1000);
});

/* search input */    
jQuery(document).ready(function($) {
if( $( "body" ).hasClass( "page-template-page-blog" ) ) {
var langs =
    [['Afrikaans',       ['af-ZA']],
    ['Bahasa Indonesia',['id-ID']],
    ['Bahasa Melayu',   ['ms-MY']],
    ['Català',          ['ca-ES']],
    ['Čeština',         ['cs-CZ']],
    ['Deutsch',         ['de-DE']],
    ['English',         ['en-AU', 'Australia'],
                        ['en-CA', 'Canada'],
                        ['en-IN', 'India'],
                        ['en-NZ', 'New Zealand'],
                        ['en-ZA', 'South Africa'],
                        ['en-GB', 'United Kingdom'],
                        ['en-US', 'United States']],
    ['Español',         ['es-AR', 'Argentina'],
                        ['es-BO', 'Bolivia'],
                        ['es-CL', 'Chile'],
                        ['es-CO', 'Colombia'],
                        ['es-CR', 'Costa Rica'],
                        ['es-EC', 'Ecuador'],
                        ['es-SV', 'El Salvador'],
                        ['es-ES', 'España'],
                        ['es-US', 'Estados Unidos'],
                        ['es-GT', 'Guatemala'],
                        ['es-HN', 'Honduras'],
                        ['es-MX', 'México'],
                        ['es-NI', 'Nicaragua'],
                        ['es-PA', 'Panamá'],
                        ['es-PY', 'Paraguay'],
                        ['es-PE', 'Perú'],
                        ['es-PR', 'Puerto Rico'],
                        ['es-DO', 'República Dominicana'],
                        ['es-UY', 'Uruguay'],
                        ['es-VE', 'Venezuela']],
    ['Euskara',         ['eu-ES']],
    ['Français',        ['fr-FR']],
    ['Galego',          ['gl-ES']],
    ['Hrvatski',        ['hr_HR']],
    ['IsiZulu',         ['zu-ZA']],
    ['Íslenska',        ['is-IS']],
    ['Italiano',        ['it-IT', 'Italia'],
                        ['it-CH', 'Svizzera']],
    ['Magyar',          ['hu-HU']],
    ['Nederlands',      ['nl-NL']],
    ['Norsk bokmål',    ['nb-NO']],
    ['Polski',          ['pl-PL']],
    ['Português',       ['pt-BR', 'Brasil'],
                        ['pt-PT', 'Portugal']],
    ['Română',          ['ro-RO']],
    ['Slovenčina',      ['sk-SK']],
    ['Suomi',           ['fi-FI']],
    ['Svenska',         ['sv-SE']],
    ['Türkçe',          ['tr-TR']],
    ['български',       ['bg-BG']],
    ['Pусский',         ['ru-RU']],
    ['Српски',          ['sr-RS']],
    ['한국어',            ['ko-KR']],
    ['中文',             ['cmn-Hans-CN', '普通话 (中国大陆)'],
                        ['cmn-Hans-HK', '普通话 (香港)'],
                        ['cmn-Hant-TW', '中文 (台灣)'],
                        ['yue-Hant-HK', '粵語 (香港)']],
    ['日本語',           ['ja-JP']],
    ['Lingua latīna',   ['la']]];

for (var i = 0; i < langs.length; i++) {
  select_language.options[i] = new Option(langs[i][0], i);
}
select_language.selectedIndex = 6;
updateCountry();
select_dialect.selectedIndex = 6;
showInfo('info_start');

function updateCountry() {
  for (var i = select_dialect.options.length - 1; i >= 0; i--) {
    select_dialect.remove(i);
  }
  var list = langs[select_language.selectedIndex];
  for (var i = 1; i < list.length; i++) {
    select_dialect.options.add(new Option(list[i][1], list[i][0]));
  }
  select_dialect.style.visibility = list[1].length == 1 ? 'hidden' : 'visible';
}

var create_email = false;
var final_transcript = '';
var recognizing = false;
var ignore_onend;
var start_timestamp;
if (!('webkitSpeechRecognition' in window)) {
  upgrade();
} else {
  start_button.style.display = 'inline-block';
  var recognition = new webkitSpeechRecognition();
  recognition.continuous = true;
  recognition.interimResults = true;

  recognition.onstart = function() {
    recognizing = true;
    showInfo('info_speak_now');
  };

  recognition.onerror = function(event) {
    if (event.error == 'no-speech') {
      start_img.src = 'mic.gif';
      showInfo('info_no_speech');
      ignore_onend = true;
    }
    if (event.error == 'audio-capture') {
      start_img.src = 'mic.gif';
      showInfo('info_no_microphone');
      ignore_onend = true;
    }
    if (event.error == 'not-allowed') {
      if (event.timeStamp - start_timestamp < 100) {
        showInfo('info_blocked');
      } else {
        showInfo('info_denied');
      }
      ignore_onend = true;
    }
  };

  recognition.onend = function() {
    recognizing = false;
    if (ignore_onend) {
      return;
    }
    if (!final_transcript) {
      showInfo('info_start');
      return;
    }
    showInfo('');
    if (window.getSelection) {
      window.getSelection().removeAllRanges();
      var range = document.createRange();

    }
    if (create_email) {
      create_email = false;
      createEmail();
    }
  };

  recognition.onresult = function(event) {
    var interim_transcript = '';
    for (var i = event.resultIndex; i < event.results.length; ++i) {
      if (event.results[i].isFinal) {
        final_transcript = event.results[i][0].transcript;
      } else {
        interim_transcript = event.results[i][0].transcript;
      }
    }
    final_transcript = capitalize(final_transcript);
    $(".speech-input").val(linebreak(final_transcript));
    interim_span.innerHTML = linebreak(interim_transcript);
    $(".speech-input").trigger("select");
    if (final_transcript || interim_transcript) {
      showButtons('inline-block');
    }
  };
}

function upgrade() {
  start_button.style.visibility = 'hidden';
  showInfo('info_upgrade');
}

var two_line = /\n\n/g;
var one_line = /\n/g;
function linebreak(s) {
  return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
}

var first_char = /\S/;
function capitalize(s) {
  return s.replace(first_char, function(m) { return m.toUpperCase(); });
}
 $( "#start_button" ).click(function() {
    if (recognizing) {
      recognition.stop();
      return;
    }
    final_transcript = '';
    recognition.lang = select_dialect.value;
    recognition.start();
    ignore_onend = false;
    final_span.innerHTML = '';
    interim_span.innerHTML = '';
    showInfo('info_allow');
    showButtons('none');
    start_timestamp = event.timeStamp;
  });

    function showInfo(s) {
    if (s) {
        for (var child = info.firstChild; child; child = child.nextSibling) {
        if (child.style) {
            child.style.display = child.id == s ? 'inline' : 'none';
        }
        }
        info.style.visibility = 'visible';
    } else {
        info.style.visibility = 'hidden';
    }
    }

    var current_style;
    function showButtons(style) {
    if (style == current_style) {
        return;
    }
    current_style = style;
    
    }
}
});

/* hide secction */
jQuery(document).ready(function($) {
  var containerArrow = 1;
  $( ".new-asesoration-arrow p" ).click(function() {
    $(".new-asesoration").slideToggle();
    $(".new-asesoration").css({display: "flex"});
    if(containerArrow == 1){
      containerArrow = 0;
      $(".new-asesoration-arrow img").css({transform: 'rotate(180deg)'});
      
    }else{
      containerArrow = 1;
      $(".new-asesoration-arrow img").css({transform: 'rotate(0deg)'});
    }
  });
  $('.so-widget-image').attr('data-aos','zoom-in-up');
  $('.so-widget-image').attr('data-aos-delay','300');
  $('.sidebar-primary').attr('data-aos','zoom-in-up');
  $('.sidebar-primary').attr('data-aos-delay','300');
  $('.pasos-box').attr('data-aos','fade-down');
  $('.pasos-box').attr('data-aos-delay','400');
  AOS.init({
    once: true
  });
  $('.card').attr('data-aos','');
});



