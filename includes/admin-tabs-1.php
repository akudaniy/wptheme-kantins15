    <div id="tabs-1">
    
    <table class="form-table">
    <tbody>

    <tr valign="top">
    <th scope="row"><?php _e('Custom CSS', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('Custom CSS', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      
      <textarea id="custom_css" rows="10"
                name="themeopts[custom_css]" 
                class="large-text"><?php echo stripslashes($theme_opts['custom_css']) ?></textarea>
      
      </fieldset>
    </td>
    </tr>

    <tr valign="top">
    <th scope="row"><?php _e('Custom Favicon', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('Custom Favicon', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      <input id="custom_favicon" type="text" name="themeopts[custom_favicon]" class="large-text" value="<?php echo stripslashes($theme_opts['custom_favicon']) ?>" />
      <p class="description"><label for="custom_favicon"><?php printf(__('Paste your PNG or ICO favicon URL here or <input type="button" id="upload_image_button" class="button button-primary" value="Upload" /> a new one', WPTHEME_TEXT_DOMAIN)); ?></label></p>
      </fieldset>
    </td>
    </tr>

    <tr valign="top">
    <th scope="row"><?php _e('Google Fonts URL', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('Google Fonts URL', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      <input id="googlefonts_url" 
      type="text" name="themeopts[googlefonts_url]" 
      class="large-text" 
      value="<?php echo stripslashes($theme_opts['googlefonts_url']) ?>" />
      </fieldset>
    </td>
    </tr>

    <tr valign="top">
    <th scope="row"><?php _e('Footer Script', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('Footer Script', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      
      <textarea id="wp_footer_script" rows="5"
                name="themeopts[wp_footer_script]" 
                class="large-text"><?php echo stripslashes($theme_opts['wp_footer_script']) ?></textarea>
      <p class="description"><label for="wp_footer_script"><?php printf(__('Anything to echo before closing body tag, usually histats or Google Analytics', WPTHEME_TEXT_DOMAIN)); ?></label></p>
      
      </fieldset>
    </td>
    </tr>
    
    </tbody>
    </table>
      
    </div><!-- #tabs-1 -->