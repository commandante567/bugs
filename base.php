<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <?php if (is_front_page()) { ?>
    <div class="wrap front-page"  role="document">
          <?php include Wrapper\template_path(); ?>
    </div>
    <?php } else { ?>


<?php 
$image = get_field('img');

if( !empty($image) ): 
?>
<div class="bucket">
	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
    
<?php 
$title = get_field('desc');

if( !empty($title) ): 
?><div class="page-land">
    <div class="container">
    <div class="col-md-8">
        <?php echo $title ?>
    </div>
    </div>
    </div>
<?php endif; ?>
</div>
<?php endif; ?>


    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main" role="main">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Config\display_sidebar()) : ?>
          <aside class="sidebar" role="complementary">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->

    <?php } ?>
    <?php if (!is_front_page()) { ?>
    <?php get_template_part('templates/land'); ?>
    <?php } else { ?>
    <?php } ?>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
