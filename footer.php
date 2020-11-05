  </main><!-- content -->
</div><!-- /.container -->

  <div>
    <button id="topScrollButton" hidden>
      &#9650;  
    </button>
  </div>

    <footer class="blog-footer" id="footer">
      <p>Wordpress template by <a href="https://github.com/alicjusz23">Alicja</a>.</p>
      <p>
      <p>
        Copyright <?php echo date("Y");?>
      </p>
        <?php if(get_option('facebook')) { ?>
          <a href="<?php echo get_option('facebook'); ?>"><i class="fa fa-facebook-square smedia"></i></a>
        <?php } ?>
        <?php if(get_option('twitter')) { ?>
          <a href="<?php echo get_option('twitter'); ?>"><i class="fa fa-twitter smedia"></i></a>
        <?php } ?>
        <?php if(get_option('instagram')) { ?>
          <a href="<?php echo get_option('instagram'); ?>"><i class="fa fa-instagram smedia"></i></a>
        <?php } ?>
        <?php if(get_option('pinterest')) { ?>
          <a href="<?php echo get_option('pinterest'); ?>"><i class="fa fa-pinterest smedia"></i></a>
        <?php } ?>
      </p>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
    <?php wp_footer(); ?>
  </body>
</html>