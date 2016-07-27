<?php
/**
 * Footer Template
 *
 *
 * @file           footer.php
 * @package        StanleyWP 
 * @author         Brad Williams & Carlos Alvarez 
 * @copyright      2011 - 2014 Gents Themes
 * @license        license.txt
 * @version        Release: 3.0.3
 * @link           http://codex.wordpress.org/Theme_Development#Footer_.28footer.php.29
 * @since          available since Release 1.0
 */
?>
</div><!-- end of wrapper-->
<?php gents_wrapper_end(); // after wrapper hook ?>


<?php gents_container_end(); // after container hook ?>


  <!-- +++++ Footer Section +++++ -->
<footer id="footer">
<div class="container">
      <div class="row">
        <div class="col-lg-12" style="text-align:center">
          <p style="font-size:15px;">© 2016 All Our Kin | 414A Chapel Street, Suite 100  New Haven, CT  06511 | 203-772-2294 | info@allourkin.org | site by think creative group</p>
        </div>
        
        <div class="col-lg-4">
          <?php dynamic_sidebar('footer-left'); ?>
        </div>
        <div class="col-lg-4">
          <?php dynamic_sidebar('footer-middle'); ?>
        </div>
        <div class="col-lg-4">
          <?php dynamic_sidebar('footer-right'); ?>
        </div>
      
      </div><!-- /row -->
    </div><!-- /container -->
</footer><!-- end #footer -->




<?php wp_footer(); ?>
  </div>
</div>
</body>
</html>