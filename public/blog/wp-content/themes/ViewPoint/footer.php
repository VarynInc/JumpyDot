<!-- JS
    ================================================== -->
  
  <!-- fancybox -->
  <script type="text/javascript">
    jQuery(document).ready(function() {

    jQuery(".nav2").sticky({topSpacing:34});

    /* This is basic - uses default settings */
  
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
            social_tools: false,
            theme: 'light_square'
          });

    jQuery(".rslides").responsiveSlides({
                maxwidth: 423,
                speed: 400
            });

    });

    jQuery('.proj-img').hover(function() {
        jQuery(this).find('i').stop().animate({
          opacity: 0.8
        }, 'fast');
        jQuery(this).find('a').stop().animate({
          "top": "0"
        });
      }, function() {
        jQuery(this).find('i').stop().animate({
          opacity: 0
        }, 'fast');
        jQuery(this).find('a').stop().animate({
          "top": "-600px"
        });
    });
    
  </script>
    
    
<!-- End Document
================================================== -->

<?php global $viewpoint;
if(isset($viewpoint['integration_footer'])) echo $viewpoint['integration_footer'] . PHP_EOL; ?>

 <?php wp_footer(); ?>
 
</body>
</html>