<?php
/**
 * Header Template
 **/
?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title><?php wp_title('&#124;', true, 'right'); ?><?php bloginfo('name'); ?></title>
<?php if( bi_get_data('custom_favicon') !== '' ) : ?>
        <link rel="icon" type="image/png" href="<?php echo bi_get_data('custom_favicon'); ?>" />
    <?php endif; ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/includes/multiple-select.css" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php global $current_lang; $current_lang = pll_current_language();?>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php get_template_directory_uri();?>/js/html5shiv.js"></script>
      <script src="<?php get_template_directory_uri();?>/js/respond.min.js"></script>
    <![endif]-->

<?php wp_head(); ?> 

</head>

<body <?php body_class(); ?>>
                 
<header>
  <div class="container">
    <div class="row">
      <div class="logo col-lg-9 col-md-9 col-sm-9">
        <a href="<?php echo site_url(); ?>">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/main-logo.png" alt="">
        </a> 
        <h2>PROVIDER SHOWCASE PROGRAM</h2>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="nav-search">
          <?php
            if(is_active_sidebar('header_sidebar')){
                dynamic_sidebar('header_sidebar');
            }
          ?>
        </div>
        <a href="<?php echo site_url(); ?>"><div class="nav-logo"></div></a>
      </div>
    </div>
  </div>
</header>

