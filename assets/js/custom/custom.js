/**
 *	Custom jQuery Scripts
 *	Developed by: Lisa DeBona
 *  Date Modified: 02.21.2025
 */
jQuery(document).ready(function ($) {

  //AOS.init();
  
  var mobileBreakPoint = 1024;

  // if( $('.main-navigation ul.sub-menu').length ) {
  //   $('.main-navigation ul.sub-menu').each(function(){
  //     var submenu = $(this);
  //     $('<button class="submenu-toggle" aria-label="Sub-Menu"><i class="fa-solid fa-chevron-down"></i></button>').insertBefore(submenu);
  //     submenu.wrap('<div class="submenu-wrapper" />');
  //   });
  // }

  // $(document).on('click','.mobileNavContent .submenu-toggle', function(e){
  //   e.preventDefault();
  //   var current = $(this);
  //   $(this).toggleClass('active');
  //   $(this).next().slideToggle();
  //   $('.mobileNavContent .submenu-toggle').not(current).each(function(){
  //     if( $(this).hasClass('active') ) {
  //       $(this).removeClass('active');
  //       $(this).next().slideUp();
  //     }
  //   });
  // });

  $(window).on('load resize', function(){
    mobileNavigation();
  });
  function mobileNavigation() {
    if( $(window).width() <= mobileBreakPoint ) {
      if( $('.MobileNavigation .main-navigation').length==0 ) {
        $('.site-header .main-navigation').appendTo('.mobileNavContent');
        $('.site-header .secondaryNav').appendTo('.mobileNavContent');
      }

      if( $('.foot-contact-map .social-media-links').length==0 ) {
        $('.foot-contact-info .social-media-links').appendTo('.foot-contact-map');
      }
    } else {
      if( $('.site-header .primary-navigation .main-navigation').length==0 ) {
        $('.mobileNavContent .main-navigation').appendTo('.site-header .primary-navigation');
        $('.mobileNavContent .secondaryNav').appendTo('.site-header .header-top .header-right');
      }
      if( $('.foot-contact-info .social-media-links').length==0 ) {
        $('.foot-contact-map .social-media-links').appendTo('.foot-contact-info');
      }
    }
  }

  if( $('.site-header .secondaryNav .searchBtn').length ) {
    $('.site-header .secondaryNav .searchBtn').clone().insertBefore('.mobile-toggle');
  }

  $('.collapsible-title').on('click', function(){
    var mainParent = $(this).parents('.collapsible');
    var current = $(this);
    $(this).parent().toggleClass('open');
    $(this).parent().find('.collapsible-content').slideToggle();
    $(this).attr('aria-expanded', function(i, attr) {
      return attr === 'true' ? 'false' : 'true';
    });

    //Close previously open
    mainParent.find('.collapsible-title').not(current).each(function(){
      $(this).attr('aria-expanded','false');
      $(this).parent().find('.collapsible-content').slideUp();
    });
  });


  if( $('.slideshow').length ) {
    $('.slideshow').each(function(){
      if( typeof $(this).attr('id')!='undefined' && $(this).attr('id')!=null ) {
        var slideId = '#' + $(this).attr('id');
        do_slideshow(slideId);
      }
    });
  }

  $('#mobile-primary-menu li.menu-item-has-children > a').each(function(){
    var target = $(this);
    //$(this).wrap('<span class="parent"></span><button class="mobile-menu-dropdown" aria-label="Dropdown" aria-expanded="false"><i class="fa-sharp fa-regular fa-chevron-down"></i></button>');
    $(this).wrap('<span class="parent" />');
    $('<button class="mobile-menu-dropdown" aria-label="Dropdown" aria-expanded="false"><i class="fa-solid fa-chevron-down"></i></button>').insertAfter(target);
  });

  // $(document).on('click', '.searchBtn', function(e){
  //   e.preventDefault();
  //   var expanded = $(this).attr('aria-expanded') === 'true';
  //   $(this).attr('aria-expanded', !expanded);
  //   $('.header-search-form').slideToggle();
  //   $('.header-search-form input[name="s"]').val("");
  //   setTimeout(function(){
  //     $('.header-search-form input[name="s"]').focus();
  //   },50);
  // });

  // $(document).on('click', '.mobile-toggle', function(e){
  //   e.preventDefault();
  //   var expanded = $(this).attr('aria-expanded') === 'true';
  //   $(this).attr('aria-expanded', !expanded);
  //   $('.MobileNavigation').toggleClass('open');
  //   $('body').toggleClass('mobile-navigation-active');
  // });

  // $(document).on('click', '.mobileNavClose, .MobileNavigationOverlay', function(e){
  //   e.preventDefault();
  //   $('.mobile-toggle').attr('aria-expanded','false');
  //   $('.MobileNavigation').addClass('closed');
  //   $('body').removeClass('mobile-navigation-active');
  //   setTimeout(function(){
  //     $('.MobileNavigation').removeClass('open closed');
  //   },500);
  // });

  $(document).on('click', '.mobile-menu-bar', function(e){
    e.preventDefault();
    var expanded = $(this).attr('aria-expanded') === 'true';
    $(this).attr('aria-expanded', !expanded);
    $('#mobile-navigation').toggleClass('open');
    $('body').toggleClass('mobile-navigation-active');
  });

  $(document).on('click', '.mobile-menu-close', function(e){
    e.preventDefault();
    $('.mobile-menu-bar').attr('aria-expanded','false');
    $('#mobile-navigation').addClass('closed');
    $('body').removeClass('mobile-navigation-active');
    setTimeout(function(){
      $('#mobile-navigation').removeClass('open closed');
    },600);
  });


  $(document).on('click', '.mobile-menu-dropdown', function(e){
    e.preventDefault();
    var expanded = $(this).attr('aria-expanded') === 'true';
    $(this).attr('aria-expanded', !expanded);
    $(this).parent().next().slideToggle();
  });

  if( $('.repeatable--two_column_text .details').length ) {
    $('.repeatable--two_column_text').each(function(){
      if( $(this).find('.details').length ) {
        $(this).find('.details').each(function(){
          $(this).find('*').eq(0).addClass('first-element');
        });
      }
    });
  }

  /*** Our Team ***/
  $('.popup-activity').on("click",function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    $.ajax({
      url : frontajax.ajaxurl,
      type : 'post',
      dataType : "json",
      data : {
        action : 'get_team_content',
        postid : id
      },
      beforeSend:function(){
        $('#loader').show();
      },
      success : function( response ) {
        if(response.content) {
          $('#popup-content').html(response.content);
          $('#popup-content').addClass('show');
          $('#overlay').addClass('show');
          $('body').addClass('popup-open');
        } 
      },
      complete: function() {
        $('#loader').hide();
      }
    });
  });

  /* Close custom pop-up */
  $(document).click(function() {
    var container = $(".popup-content");
    if (!container.is(event.target) && !container.has(event.target).length) {
      closeCustomPopUp();
    }
  });

  $(document).on('click','#closeModalBtn',function(e){
    e.preventDefault();
    closeCustomPopUp();
  });

  function closeCustomPopUp() {
    $('#popup-content').removeClass('show');
    $('body').removeClass('popup-open');
    $('#overlay').removeClass('show');
    $('#popup-content .popup-content').remove();
  }
  /*** Our Team END ***/

  /* Slideshow */
  function do_slideshow(selector) {
    var swiper = new Swiper(selector, {
      effect: 'fade', /* "slide", "fade", "cube", "coverflow" or "flip" */
      loop: true,
      noSwiping: true,
      simulateTouch : true,
      speed: 800,
      autoplay: {
        delay: 6000,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      on: {
        init: function () {
          //console.log("swiper initialized");
        },
      }
    });
  }

  // $('[data-fancybox]').fancybox({
  //   touch : true,
  //   hash : false,
  //   youtube : {
  //       controls : 0,
  //       showinfo : 0,
  //       rel: 0
  //   },
  //   vimeo : {
  //       color : 'ffffff'
  //   }
  // });

  if( $('.entry-content .gallery[class*="gallery-columns-"]').length ) {
    $('.gallery[class*="gallery-columns-"] .gallery-item a').fancybox({
      touch : true,
      hash : false,
      buttons : ['fullScreen','close'],
    });
  }

  $('.popup-gallery').fancybox({
    buttons : ['fullScreen','close'],
    touch : true,
    hash : false,
    transitionEffect: 'none', // Applies to open/close/next/prev transitions
    transitionDuration: 0, // Set duration to 0 for immediate changes
    animationEffect: 'none', // Applies to animation effects like zoom/fade
    animationDuration: 0 // Set
  });

  $('.zoom-image').fancybox({
    buttons : ['fullScreen','close'],
    hash : false
  });
  
  if( $('.repeatable--cards_pattern_background .infoCard').length ) {
    $('.repeatable--cards_pattern_background .infoCard').each(function(){
      if( $(this).find('a.button-element').length ) {
        $(this).find('a.button-element').each(function(){
          var link = $(this).attr('href');
          if( link.includes('youtu') || link.includes('youtube') || link.includes('vimeo') ) {
            $(this).attr('data-fancybox',true);
          }
        });
      }
    });
  }


  if( $('.repeatable').length ) {
    $('.repeatable').each(function(){
      if( $(this).prev().hasClass('repeatable') ) {
        if( $(this).prev().attr('data-group')!=undefined ) {
          var groupName = $(this).prev().attr('data-group');
          $(this).addClass('prev-' + groupName);
        }
      } else {
        $(this).addClass('first-section');
      }
      if( $(this).next().hasClass('repeatable') ) {
        if( $(this).next().attr('data-group')!=undefined ) {
          var groupName = $(this).next().attr('data-group');
          $(this).addClass('next-' + groupName);
        }
      }
    }); 
  }

  $(document).on('click', '.select-category-btn', function(e){
    e.preventDefault();
    var isExpanded = $(this).attr('aria-expanded') === 'true';
    $(this).attr('aria-expanded', !isExpanded);
    $(this).next().slideToggle();
  });

}); 
