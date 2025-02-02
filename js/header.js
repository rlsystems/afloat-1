
jQuery(document).ready(function ($) {


  //phone-mobile
  const phoneMobile = document.getElementById('phone-mobile');
  const phoneMobileExpand = document.getElementById('phone-mobile-expand');
  //let phoneMobileOpen = false;

  phoneMobile.addEventListener('click', evt => {

    phoneMobileExpand.classList.toggle('active');


  });

  // document.addEventListener('click', evt => {
    
 
  //   let isMenuClick = phoneMobileExpand.contains(evt.target);

  //   if ((isMenuClick == false) && phoneMobileOpen == true) {
  //     phoneMobileExpand.classList.remove('active');
  //     phoneMobileOpen = false;
  //   }
  // });

  var opaqueNavAlways = false;
  if ($("body").hasClass("page-template-template-generic") || $("body").hasClass("page-template-template-about") || $("body").hasClass("page-template-template-contact") || $("body").hasClass("page-template-template-search") || $("body").hasClass("single-rfc_travel_guides") || $("body").hasClass("page-template-template-travel-guide")) {
    opaqueNavAlways = true;
    $('.header__main').addClass('header__main--opaque-nav');
  }

  //HEADER --------------
  //Header Main -- Scroll
  const nav = document.querySelector('#header');
  const topOfNav = 60; //change to 0 for absolute top of page

  function fixNav() {
    if (window.scrollY >= topOfNav) {
      $('.header__main').addClass('header__main--small-nav header__main--opaque-nav');
    } else {
      //if mega not active
      if ($('.nav-mega').hasClass('active') != true) {

        $('.header__main').removeClass('header__main--small-nav ');

        if ($('.burger-menu').hasClass('burger-menu--active') != true) {
          if (opaqueNavAlways == false) {
            $('.header__main').removeClass('header__main--opaque-nav');
          }

        }
      }
    }
  }
  window.addEventListener('scroll', fixNav);

  //Header Main -- Hover
  //Make navbar white on hover - add class: header__main--opaque-nav

  $('.header__main').hover(
    function () {

      if (opaqueNavAlways == false) {
        $('.header__main').addClass('header__main--opaque-nav');
      }
    },
    function () {
      //if not small and mega active
      if ($('.header__main').hasClass('header__main--small-nav') != true) {

        if ($('.burger-menu').hasClass('burger-menu--active') != true) {
          if ($('.nav-mega').hasClass('active') != true) {
            if (opaqueNavAlways == false) {
              $('.header__main').removeClass('header__main--opaque-nav');
            }
          }
        }
      }
    }
  )




  //remove mega when mouse out of window
  $(document).mouseleave(function () {
    $('.nav-mega').removeClass('active');
  });

  //MEGA
  //--hover behavior
  $('.nav-mega').hover(
    function () { },
    function () {

      //if no active burger
      if ($(".burger-menu").hasClass('burger-menu--active') != true) {

        //if product-nav then dont do (sticky wrapper)
        var elementExists = document.getElementById("page-nav");
        if (elementExists == null) {
          $('.nav-mega').removeClass('active');
        }

        //if not header small -- remove opaque from header__main
        if ($('.header__main').hasClass('header__main--small-nav') != true) {

          if (opaqueNavAlways == false) {
            $('.header__main').removeClass('header__main--opaque-nav');
          }
        }
      }
    }
  )

  //main link -expand mega
  $('.header__main__nav__list__item__link.mega').hover(
    function () {
      var navelement = this.getAttribute("navelement");
      $('.nav-mega').addClass('active');

      if (navelement == "Destinations") {
        $('.nav-mega__nav--experiences').hide();
        $('.nav-mega__nav--destinations').fadeIn(200);

      } else if (navelement == "Experiences") {
        $('.nav-mega__nav--destinations').hide();
        $('.nav-mega__nav--experiences').fadeIn(200);
      }
      else {
        $('.nav-mega__nav--destinations').hide();
        $('.nav-mega__nav--experiences').fadeIn(200);
      }
    },
  );
  $('.header__main__nav__list__item__link.no-mega').hover(
    function () {
      $('.nav-mega').removeClass('active');

    },
  );



  //Burger Menu

  //Burger Menu -- click
  $(".burger-menu ").on("click", function () {

    $(".burger-menu").toggleClass('burger-menu--active');
    $('.nav-mobile').toggleClass('nav-mobile--active');


    //on open
    if ($(".nav-mobile").hasClass('nav-mobile--active') == true) {

      $('.header__main').addClass('header__main--opaque-nav');
      $('.nav-mobile__content-panel').removeClass('slide-out-left');
      $('.nav-mobile__content-panel').removeClass('slide-center');
      document.body.classList.add('lock-scroll');

      //$('#page-nav').hide();

      //on close
    } else {
      //$('#page-nav').show();
      document.body.classList.remove('lock-scroll');
      if (window.scrollY <= topOfNav) {
        if (opaqueNavAlways == false) {
          $('.header__main').removeClass('header__main--opaque-nav');
        }
      }
      $(".burger-menu").removeClass('burger-menu--active');

    }
  });

  //Toggle Mega / Mobile -- resize window
  $(window).resize(function () {
    if ($(window).width() > 1000) {
      $('.nav-mobile').removeClass('nav-mobile--active');
      $(".burger-menu").removeClass('burger-menu--active');

    }
    if ($(window).width() <= 1000) {
      $('.nav-mega').removeClass('active');
    }
  });




  //New Mobile Menu
  const mobileButtons = [...document.querySelectorAll('.nav-mobile__content-panel__button')];
  mobileButtons.forEach(item => {
    item.addEventListener('click', () => {
      let menuLink = item.getAttribute('menuLinkTo');

      var topPanel = document.querySelector('.nav-mobile__content-panel--top');
      var subPanel = document.querySelector('[menuid="' + menuLink + '"]');

      var isBackButton = $(item).hasClass('nav-mobile__content-panel__button--back');
      if (isBackButton) {
        $(topPanel).removeClass('slide-out-left');
        $(item).parent().removeClass('slide-center');
      } else {

        if (!item.classList.contains("mobile-link")) {
          topPanel.classList.add('slide-out-left');
          $(subPanel).addClass('slide-center');
        } else {
          $('.nav-mobile').removeClass('nav-mobile--active');
          $(".burger-menu").removeClass('burger-menu--active');
          document.body.classList.remove('lock-scroll');
        }

      }


    });
  })


  //Page Nav-- Hover
  $('#template-nav').hover(
    function () { },
    function () {
      if ($(".burger-menu").hasClass('burger-menu--active') != true) {
        $('.nav-mega').removeClass('active');
      }
    }
  );





});

