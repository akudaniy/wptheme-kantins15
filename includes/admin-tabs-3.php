    <div id="tabs-3">
    
    <table class="form-table">
    <tbody>

    <tr valign="top">
    <th scope="row"><?php _e('Is Demo', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('Is Demo', WPTHEME_TEXT_DOMAIN) ?></span></legend>

      <select id="is_demo" name="themeopts[is_demo]">
        <option value="0" <?php selected( $theme_opts['is_demo'], 0 ); ?>>No</option>
        <option value="1" <?php selected( $theme_opts['is_demo'], 1 ); ?>>Yes</option>
      </select>

      </fieldset>
    </td>
    </tr>

    <tr valign="top">
    <th scope="row"><?php _e('AdSense pub-ID', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('AdSense pub ID', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      <input id="adsense_pubid" 
      type="text" name="themeopts[adsense_pubid]" 
      class="regular-text" 
      value="<?php echo stripslashes($theme_opts['adsense_pubid']) ?>" />
      </fieldset>
    </td>
    </tr>

    <tr valign="top">
    <th scope="row"><?php _e('AdSense Adslot', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('AdSense Adslot', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      <input id="adsense_adslot" 
      type="text" name="themeopts[adsense_adslot]" 
      class="regular-text" 
      value="<?php echo stripslashes($theme_opts['adsense_adslot']) ?>" />
      </fieldset>
    </td>
    </tr>

    </tbody>
    </table>
    
    </div><!-- #tabs-3 -->