 <script>
     $(document).ready(function() {
         wow = new WOW({
             boxClass: 'wow',
             animateClass: 'animated',
             offset: 100,
             mobile: false
         })
         wow.init();
     });
 </script>

 <script>
     $(window).scroll(function() {
         if ($(this).scrollTop() > 50) {
             $('.header').addClass('newClass');
         } else {
             $('.header').removeClass('newClass');
         }
     });
 </script>
 <script>
     $('#screenshotport').owlCarousel({

         autoplay: true,
         center: false,
         nav: false,
         margin: 30,
         items: 2,
         loop: true,
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 3
             },
             1000: {
                 items: 4
             }

         }
     });
 </script>
 <script>
     $('#testi').owlCarousel({

         autoplay: true,
         center: false,
         nav: false,
         dots: true,
         margin: 30,
         items: 2,
         loop: true,
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 1
             },
             1000: {
                 items: 2
             }

         }
     });
 </script>

 <script>
     $('.downarrow').click(function() {

         var the_id = $(this).attr("href");

         $('html, body').animate({
             scrollTop: $(the_id).offset().top
         }, 'slow');

         return false;
     });
     $(document).ready(function() {
         $('.btn-link').click(function(e) {
             $(this).toggleClass('active');
         })
     })
 </script>