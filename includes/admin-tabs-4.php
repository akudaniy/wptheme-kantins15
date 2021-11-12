    <div id="tabs-4">
    
    <table class="form-table">
    <tbody>

    <tr valign="top">
    <th scope="row"><?php _e('Attachments Title', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('Attachments Title', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      <input  id="atts_title" 
              type="text" name="themeopts[atts_title]" 
              class="regular-text" 
              value="<?php echo stripslashes($theme_opts['atts_title']) ?>" />
      </fieldset>
      <p class="description">Title located on single post after content and above gallery thumbnails</p>
    </td>
    </tr>

    <tr valign="top">
    <th scope="row"><?php _e('Attachments Other Title', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('Attachments Other Title', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      <input  id="atts_other_title" 
              type="text" name="themeopts[atts_other_title]" 
              class="regular-text" 
              value="<?php echo stripslashes($theme_opts['atts_other_title']) ?>" />
      </fieldset>
      <p class="description">Title located on attachment page above thumbnails of the same gallery</p>
    </td>
    </tr>

    <tr valign="top">
    <th scope="row"><?php _e('Related Single Title', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('Related Single Title', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      <input  id="related_single_title" 
              type="text" name="themeopts[related_single_title]" 
              class="regular-text" 
              value="<?php echo stripslashes($theme_opts['related_single_title']) ?>" />
      </fieldset>
      <p class="description">Title located on single post after gallery thumbnails</p>
    </td>
    </tr>

    <tr valign="top">
    <th scope="row"><?php _e('Related Tag Title', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('Related Tag Title', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      <input  id="related_tag_title" 
              type="text" name="themeopts[related_tag_title]" 
              class="regular-text" 
              value="<?php echo stripslashes($theme_opts['related_tag_title']) ?>" />
      </fieldset>
      <p class="description">Title located on tag page after current tag posts</p>
    </td>
    </tr>

    <tr valign="top">
    <th scope="row"><?php _e('Random Posts Title', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('Random Posts Title', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      <input  id="random_posts_title" 
              type="text" name="themeopts[random_posts_title]" 
              class="regular-text" 
              value="<?php echo stripslashes($theme_opts['random_posts_title']) ?>" />
      </fieldset>
      <p class="description">Title located on attachment page after gallery thumbnails</p>
    </td>
    </tr>

    </tbody>
    </table>
    
    </div><!-- #tabs-3 -->