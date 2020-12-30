  </main><!-- content -->
</div><!-- /.container -->

  <div>
    <button id="topScrollButton" hidden>
      &#9650;  
    </button>
  </div>

    <footer class="blog-footer" id="footer">
      <p>
        <?php _e("WordPress template by ", 'my-secret-memory'); ?>
        <a href="https://github.com/alicjusz23">Alicja</a>.
      </p>
      <p>
      <p>
        <?php _e("Copyright ", 'my-secret-memory'); echo date("Y");?>
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

    <?php wp_footer(); ?>
  </body>
</html>