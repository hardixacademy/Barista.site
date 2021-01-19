$(document).ready(function () {
    $('#toggle').on("click", function () {
      $(this).toggleClass('active');
      $('#overlay').toggleClass('open');
      $('.header_logo_mob').toggleClass('al');
    });
  
    $('.header_nav_a_mob').click(function () {
      $('#toggle').removeClass('active');
      $('#overlay').removeClass('open');
    });
  
  
    $("a[href*=#]").on("click", function (e) {
      var anchor = $(this);
      $('html, body').stop().animate({
        scrollTop: $(anchor.attr('href')).offset().top
      }, 777);
      e.preventDefault();
      return false;
    });

    var owl = $(".owl-carousel"),
            owlSlideSpeed = 300;
        $(document).ready(function(){
          owl.owlCarousel({

            margin:10,
            loop:true,
            margin:10,
            nav:false,
            responsive:{
              300:{
                items:1
              },
              550:{
                items:2
              },
              1024:{
                items:3
              },
              1350:{
                items:4
              }
            }
          });
        });
  });