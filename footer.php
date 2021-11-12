  <footer class="footer-block">
    <?php /* <div class="container cont-top clearfix">
      <div class="row">
      
        <div class="col-md-3 brand-col brand-center">
          <div class="vcenter">
            <a class="vcenter-this" href="#">
              <img src="<?php echo THEME_URL ?>images/logo-footer.png" alt="logo"/>
            </a>
          </div>
        </div>
        
        <div class="col-md-9 links-col">
        
          <div class="row-fluid">
          
            <div class="col-xs-6 col-sm-6 col-md-6">
              <h5>About us</h5>
              <p>Helena is a freelance fashion designer who specialises in print designs and combining fabrics. My designs have been sold all over the world.</p>
                <!-- hlinks -->
                <ul class="hlinks hlinks-icons color-icons-borders color-icons-bg color-icons-hovered">
                  <li><a href="#"><i class="icon fa fa-facebook"></i></a></li>
                  <li><a href="#"><i class="icon fa fa-twitter"></i></a></li>
                  <li><a href="#"><i class="icon fa fa-rss"></i></a></li>
                  <li><a href="#"><i class="icon fa fa-google-plus"></i></a></li>
                  <li><a href="#"><i class="icon fa fa-instagram"></i></a></li>
                  <li><a href="#"><i class="icon fa fa-youtube"></i></a></li>
                </ul>
                <!-- /hlinks -->              
            </div>                

            <div class="col-xs-6 col-sm-3 col-md-3">
            </div>


            <div class="col-xs-6 col-sm-3 col-md-3 newsletter">
              <h5>newsletter</h5>
              <form>
                <input type="text" class="form-control" placeholder="Email Address">
                <button class="btn btn-outline" type="button">get newsletter</button>
              </form>
            </div>
            
         </div>
         <!-- /Row -->
         
        </div>
        <!-- /Links -->
        
      </div>
      <!-- /Row -->
      
    </div>
    <!-- /Container -->
    */ ?>

    <!-- Bottom -->
    <div class="footer-bottom bcolor-bg invert-colors">
      <div class="container">
      
        <span class="copy-text">&copy; 2015 <?php bloginfo('name') ?>.</span>
        
      </div><!-- /Container -->
    </div><!-- /Bottom -->
    
  </footer><!-- /Footer -->

</div><!-- .page-wrapper -->

<script src="<?php echo THEME_URL ?>uikit/js/jquery-latest.min.js"></script>
<script type="text/javascript">

  // UTILITY FUNCTIONS
  // ========================================================================
  // Console fix
  // -------------------------------------------------------------------
  (function() {
    if (!window.console) {
      window.console = {};
    }
    // union of Chrome, FF, IE, and Safari console methods
    var m = [
      "log", "info", "warn", "error", "debug", "trace", "dir", "group",
      "groupCollapsed", "groupEnd", "time", "timeEnd", "profile", "profileEnd",
      "dirxml", "assert", "count", "markTimeline", "timeStamp", "clear"
    ];
    // define undefined methods as noops to prevent errors
    for (var i = 0; i < m.length; i++) {
      if (!window.console[m[i]]) {
        window.console[m[i]] = function() {};
      }    
    } 
  })();


  // Script Loader (previously minified)
  // ---------------------------------------------------------------------
  function getScripts(o, t) {
    for (var i = 0; i < o.length; ++i) {
      var r = path + o[i];
      $.importJS(r, {
          cache: t
      }).done(function() {
          console.log("SUCCESS: loaded script >> " + r)
      }).fail(function(o) {
          console.log("ERROR: can't load script >> " + r + " << " + o.statusText)
      })
    }
  }
  jQuery.importJS = function(o, t) {
    return t = $.extend(t || {}, {
      dataType: "script",
      url: o,
      async: !1
    }), jQuery.ajax(t)
  };

  // Scripts for loading
  // =========================================================================
  var path = "<?php echo THEME_URL ?>uikit/"; // Paths are relative to the page loading this script!
  var scripts = [
    "js/uikit-utils.js",
    "js/jquery.bxslider-rahisified.js",
    "js/jquery-ui.min.js",
    "js/highlight.pack.js",
    "bootstrap/js/bootstrap.min.js",
    "js/jquery-scrollto.js",
    "js/jquery.prettyPhoto.js",
    "js/wow.min.js",
    "js/theme.js",
    // "js/style-switcher.js",
  ];

  // IMPORTANT: To force caching change false to true
  // ==========================================================================
  getScripts(scripts, true);
</script>

<?php wp_footer(); ?>

</body>
</html>