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

  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( "pingback_url" ); ?>">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( "stylesheet_url" ); ?>" />

  <?php wp_head(); ?>



</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">


<header class="header-block">

  <!-- Nav Top
  ............................................. -->
  <nav class="nav-top hnav hnav-sm hnav-borderless invert-colors bcolor-bg">
  
    <!-- Container -->
    <div class="container">
      
      <!-- Collapse -->
      <div class="collapse navbar-collapse navbar-absolute">
      
        <p class="navbar-text navbar-center">Welcome to our store. Login or registration is required to shop.</p>
        
      </div>
      <!-- /Collapse -->
      
      <!-- Dont Collapse -->
      <div class="navbar-dont-collapse no-toggle">

        <!-- Navbar Left -->
        <ul class="nav navbar-nav navbar-left case-c">
          <li><a href="index.html"><i class="icon-left fa fa-fax"></i>Hotline : + 254 560 890 340</a></li>
        </ul>
        <!-- /Navbar Left -->
        
        <!-- Navbar Right -->
        <ul class="nav navbar-nav case-u navbar-right">
          <li><a href="#"><i class="icon fa fa-facebook"></i></a></li>
          <li><a href="#"><i class="icon fa fa-twitter"></i></a></li>
          <li><a href="#"><i class="icon fa fa-pinterest"></i></a></li>
        </ul>
        <!-- /Navbar right -->

      </div>
      <!-- /Dont Collapse -->
    
    </div>
    <!-- /Container -->
    
  </nav>
  <!-- /Nav Top
  ............................................ -->

  <!-- Main Header
  ............................................ -->
  <div class="main-header container">
  
    <!-- Header Cols -->
    <div class="header-cols"> 
    
      <!-- Brand Col -->
      <div class="brand-col hidden-xs">
      
        <!-- vcenter -->
        <div class="vcenter">
          <!-- v-centered -->               
          <div class="vcenter-this">
            <a href="index.html">
              <img src="images/logo.png" alt="HELENA">
            </a>
          </div>
          <!-- v-centered -->
        </div>
        <!-- vcenter -->

      </div>
      <!-- /Brand Col -->
      
      <!-- Right Col -->
      <div class="right-col">
      
        <!-- vcenter -->
        <div class="vcenter">
          
          <!-- v-centered -->               
          <div class="vcenter-this">

            <!-- Cart Summary -->
            <div class="header-cart-summary pull-right clearfix">
            
              <i class="icon ti ti-bag"></i>
              
              <!-- Summary Text -->
              <div class="summary-text">
              
                <small>(4) items in your cart</small>
                
                <a class="total" data-toggle="dropdown" href="#"><span class="hidden-xs hidden-sm total-text">TOTAL</span><span class="total-price">$560.00</span><i class="toggler ti ti-plus rot-135"></i></a>
                
                <!-- Dropdown Panel -->
                <div class="dropdown-menu dropdown-panel dropdown-right arrow-top" data-keep-open="true">
                  <section>
                    <!-- Mini Cart -->
                    <ul class="mini-cart">
                      <!-- Item -->
                      <li class="clearfix">
                        <img src="images/products/product1.jpg" alt="">
                        <div class="text">
                          <a class="title" href="#">Modern black hat</a>
                          <div class="details">2 x $40.50
                            <div class="btn-group">
                              <a class="btn btn-primary" href="#"><i class="fa fa-pencil"></i></a>
                              <a class="btn btn-default" href="#"><i class="fa fa-trash"></i></a>
                            </div>
                          </div>
                        </div>
                      </li>
                      <!-- /Item -->
                      
                      <!-- Item -->
                      <li class="clearfix">
                        <img src="images/products/product2.jpg" alt="">
                        <div class="text">
                          <a class="title" href="#">Sexy lace blouse</a>
                          <div class="details">1 x $95.00
                            <div class="btn-group">
                              <a class="btn btn-primary" href="#"><i class="fa fa-pencil"></i></a>
                              <a class="btn btn-default" href="#"><i class="fa fa-trash"></i></a>
                            </div>
                          </div>
                        </div>
                      </li>
                      <!-- /Item -->
                    </ul>
                    <!-- /Mini Cart -->
                  </section>
                  
                  <section>
                    <div class="row grid-10">
                      <div class="col-md-6">
                        <a class="btn btn-base btn-block margin-y-5" href="cart.html">view cart</a>
                      </div>
                      <div class="col-md-6">
                        <a class="btn btn-primary btn-block margin-y-5" href="checkout.html">checkout</a>
                      </div>
                    </div>
                  </section>
                </div>
                <!-- /Dropdown Panel -->
                
              </div>
              <!-- /Summary Text -->
              
            </div>
            <!-- /Cart summary -->

          </div>
          <!-- v-centered -->
          
        </div>
        <!-- vcenter -->
      
      </div>
      <!-- /Right Col -->
      
      <!-- Left Col -->
      <div class="left-col">
      
        <!-- vcenter -->
        <div class="vcenter">
        
          <!-- v-centered -->
          <div class="vcenter-this">
          
            <span class="header-text case-u mgb-10 hidden-xs hidden-sm"><i class="icon-left fa fa-fax bcolor-l"></i>support : <span class="pcolor">+254 5670 800</span></span>
            
            <form class="header-search">
              <div class="form-group">
                <input class="form-control" placeholder="SEARCH" type="text">
                <button class="btn btn-empty"><i class="fa fa-search"></i></button>
              </div>
            </form>
          
          </div>
          <!-- /v-centered -->
        </div>
        <!-- /vcenter -->
        
      </div>
      <!-- /Left Col -->
      

    </div>
    <!-- Header Cols -->
  
  </div>
  <!-- /Main Header
  .............................................. -->
  
  <!-- Nav Bottom
  .............................................. -->
  <nav class="nav-bottom hnav hnav-borderless pcolor-bg invert-colors boxed-section">
  
    <!-- Container -->
    <div class="container">
    
      <!-- Header-->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle no-border" data-toggle="collapse" data-target="#nav-collapse5">
          <span class="sr-only">Toggle navigation</span>
          <i class="fa fa-navicon"></i>
        </button>
        <a class="navbar-brand visible-xs" href="#"><img src="images/logo-white-xs.png" alt="H"></a>
      </div>
      <!-- /Header-->
    
      <!-- Collapse -->
      <div id="nav-collapse5" class="collapse navbar-collapse navbar-absolute">
      
        <!-- Navbar Center -->
        <ul class="nav navbar-nav navbar-center fill-default case-u">
          <li class="active"><a href="index.html">home</a></li>
          <li class="dropdown dropdown-mega"><a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown">pages<i class="fa fa-angle-down toggler"></i></a>
            
            <!-- Mega Menu -->
            <div class="mega-menu dropdown-menu">
              <!-- Row -->
              <div class="row">
              
                <!-- col -->
                <div class="col-md-3">
                  <img class="featured-img hidden-xs hidden-sm" src="images/menu-pic.jpg" alt="">
                </div>
                <!-- /col -->
                
                <!-- col -->
                <div class="col-md-3">
                  <h5>shop pages</h5>
                  <ul class="links">
                    <li><a href="category.html">category</a></li>
                    <li><a href="category2.html">category #2</a></li>
                    <li><a href="product.html">product details</a></li>
                    <li><a href="cart.html">cart</a></li>
                    <li><a href="checkout.html">checkout</a></li>
                  </ul>
                </div>
                <!-- /col -->
                
                <!-- col -->
                <div class="col-md-3">
                  <h5>common pages</h5>
                  <ul class="links">
                    <li><a href="page.html">Typical Page</a></li>
                    <li><a href="error-404.html">404</a></li>
                    <li><a href="error-generic.html">generic error</a></li>
                    <li><a href="contact.html">contact</a></li>
                    <li><a href="faq.html">faq</a></li>
                  </ul>
                </div>
                <!-- /col -->
                
                <!-- col -->
                <div class="col-md-3">
                  <h5>other pages</h5>
                  <ul class="links">
                    <li><a href="blog.html">blog</a></li>
                    <li><a href="blog-post.html">single post</a></li>
                    <li><a href="login.html">login</a></li>
                    <li><a href="register.html">register</a></li>
                  </ul>
                </div>
                <!-- /col -->
              </div>
              <!-- /Row -->
            </div>
            <!-- /Mega Menu -->
          </li>
          <li class="dropdown">
            <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown">features<i class="fa fa-angle-down toggler"></i></a>
            <ul class="dropdown-menu">
              <li><a href="uikit/index.html">Elements + Modules</a></li>
              <li><a href="uikit/index.html#bxslider.demo?viewer=ajax">Sliders</a></li>
              <li><a href="uikit/index.html#animations.demo?viewer=ajax">Animations</a></li>
            </ul>
          </li>
          <li><a href="headers.html">headers</a></li>
          <li><a href="footers.html">footers</a></li>
        </ul>
        <!-- /Navbar Center -->
        
      </div>
      <!-- /Collapse -->
      
      <!-- Dont Collapse -->
      <div class="navbar-dont-collapse">

        <!-- Navbar btn-group -->
        <div class="navbar-btn-group btn-group navbar-right no-margin-r-xs">
        
          <!-- Btn Wrapper -->
          <div class="btn-wrapper dropdown">
          
            <a class="btn btn-outline" data-toggle="dropdown"><i class="ti ti-user"></i></a>
            
            <!-- Dropdown Panel -->
            <div class="dropdown-menu dropdown-panel" data-keep-open="true">
              <fieldset>
                <form>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-user"></i></div>
                      <input class="form-control" placeholder="Email" type="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                      <input class="form-control" placeholder="Password" type="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="checkbox-inline"><input value="" type="checkbox">Remember me </label>
                  </div>
                  <button class="btn btn-primary btn-block">sign in</button>
                </form>
              </fieldset>
            </div>
            <!-- /Dropdown Panel -->
            
          </div>
          <!-- /Btn Wrapper -->

          <!-- Btn Wrapper -->
          <div class="btn-wrapper dropdown">
          
            <a class="btn btn-outline" data-toggle="dropdown"><i class="ti ti-pencil-alt"></i></a>
            
              <!-- Dropdown Panel -->
              <div class="dropdown-menu dropdown-panel" data-keep-open="true">
                <fieldset>
                  <form>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input class="form-control" placeholder="Email" type="email">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                        <input class="form-control" placeholder="Password" type="password">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                        <input class="form-control" placeholder="Repeat Password" type="password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="checkbox-inline"><input value="" type="checkbox">I accept the terms and conditions.</label>
                    </div>
                    
                    <button class="btn btn-primary btn-block">sign up</button>
                  </form>
                </fieldset>
              </div>
              <!-- /Dropdown Panel -->
            
          </div>
          <!-- /Btn Wrapper -->

        </div>
        <!-- /Navbar btn-group -->
        
        <!-- Navbar Left -->
        <ul class="nav navbar-nav navbar-left navbar-right-xs">
          <li class="dropdown has-panel">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="img-left" alt="" src="images/flags/us.gif"><span>USD</span><i class="fa fa-angle-down toggler"></i></a>
            <!-- Dropdown Panel -->
            <div class="dropdown-menu dropdown-panel" data-keep-open="true">
              <fieldset>
                <form>
                  <div class="form-group">
                    <label>Language</label>
                    <select class="form-control">
                      <option>English</option>
                      <option>French</option>
                      <option>German</option>
                      <option>Spanish</option>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label>Currency</label>
                    <select class="form-control">
                      <option>US Dollar</option>
                      <option>Kenyan Shillings</option>
                      <option>TZ Shillings</option>
                      <option>British Pound</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="checkbox-inline"><input value="" type="checkbox">Remember settings </label>

                  </div>
                  <button class="btn btn-primary btn-block">change</button>
                </form>
              </fieldset>
            </div>
            <!-- /Dropdown Panel -->
            
          </li>
        </ul>
        <!-- /Navbar Left -->
      </div>
      <!-- /Dont Collapse -->

    </div>
    <!-- /Container -->
    
  </nav>
  <!-- /Nav Bottom
  .............................................. -->
  
</header>



