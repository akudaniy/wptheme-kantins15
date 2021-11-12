<?php global $theme_opts; 

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( "charset" ); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( "pingback_url" ); ?>">

  <link href="<?php echo THEME_URL ?>uikit/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo THEME_URL ?>uikit/css/uikit.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="<?php echo THEME_URL ?>uikit/js/html5shiv.js"></script>
  <script src="<?php echo THEME_URL ?>uikit/js/respond.min.js"></script>
  <![endif]-->

  <?php wp_head(); ?>
  
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( "stylesheet_url" ); ?>" />

</head>
<body <?php body_class("tile-1-bg"); ?> itemscope itemtype="http://schema.org/WebPage">

<div class="page-wrapper">
<header class="header-block">

  <?php /* <!-- Main Header
  ............................................ -->
  <div class="main-header container">
  
    <div class="header-cols"> 
    
      <div class="brand-col hidden-xs">
        <div class="vcenter">
          
          <div class="vcenter-this">
            <a href="<?php echo site_url('/') ?>">
              <img src="<?php echo THEME_URL ?>images/logo.png" alt="<?php bloginfo('name') ?>">
            </a>
          </div><!-- v-centered -->
        </div><!-- vcenter -->
      </div><!-- .brand-col -->
      
      <div class="right-col"></div><!-- /Right Col -->
      
      <div class="left-col"></div><!-- /Left Col -->
      

    </div><!-- Header Cols -->
  
  </div><!-- .main-header --> */ ?>

  <nav class="nav-bottom hnav hnav-borderless pcolor-bg invert-colors boxed-section">
  
    <!-- Container -->
    <div class="container">
    
      <!-- Header-->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle no-border" data-toggle="collapse" data-target="#nav-collapse5">
          <span class="sr-only">Toggle navigation</span>
          <i class="fa fa-navicon"></i>
        </button>
        <?php /* <a class="navbar-brand visible-xs" href="<?php echo site_url('/') ?>"><img src="<?php echo THEME_URL ?>images/logo-white-xs.png" alt="<?php bloginfo('name') ?>"></a> */ ?>
      </div>
      <!-- /Header-->
    
      <!-- Collapse -->
      <div id="nav-collapse5" class="collapse navbar-collapse navbar-absolute">
      
        <!-- Navbar Center -->
        <ul class="nav navbar-nav navbar-left fill-default case-u">
          <li class="active"><a href="<?php echo site_url('/') ?>">beranda</a></li>
          <li><a href="<?php echo site_url('/kategori/berita/') ?>">berita</a></li>
          <li><a href="<?php echo site_url('/tentang/') ?>">tentang</a></li>
          <li><a href="<?php echo site_url('/download/') ?>">unduhan</a></li>
        </ul>
        <!-- /Navbar Center -->
        
      </div>
      <!-- /Collapse -->
      
      <!-- Dont Collapse -->
      <div class="navbar-dont-collapse">
        <div class="navbar-btn-group btn-group navbar-right no-margin-r-xs">
          <a href="<?php echo site_url('/') ?>">
            <img class="logo-r" src="<?php echo THEME_URL ?>images/logo.png" alt="<?php bloginfo('name') ?>">
          </a>
        </div>
      </div>
      <!-- /Dont Collapse -->

    </div>
    <!-- /Container -->
    
  </nav>
  <!-- /Nav Bottom
  .............................................. -->
  
</header><!-- .header-block -->

