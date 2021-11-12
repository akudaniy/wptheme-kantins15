    <div id="tabs-2">
    <h3 class="section-title">Single Post Template</h3>

    <p>
      Use special tags: <code>[title]</code >, <code>[permalink]</code >, 
      <code>[cat]</code >, <code>[date]</code>, <code>[author]</code >, 
      <code>[blog]</code>, <code>[url]</code>, <code>[tags]</code >, <code>[tag]</code >, 
      <code>[today_day]</code>
    </p>

    <table class="form-table">
    <tbody>

    <tr valign="top">
    <th scope="row"><?php _e('Attachments Title Separator', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('Attachments Title Separator', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      
      <input  type="text" value="<?php echo stripslashes($theme_opts['att_title_separator']) ?>" 
              class="regular-text" name="themeopts[att_title_separator]" 
              id="att_title_separator">
      
      </fieldset>
    </td>
    </tr>
    
    <tr valign="top">
    <th scope="row"><?php _e('Before Content Template', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('Before Content Template', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      
      <textarea id="before_content_template" rows="5"
                name="themeopts[before_content_template]" 
                class="large-text"><?php echo stripslashes($theme_opts['before_content_template']) ?></textarea>
      
      </fieldset>
    </td>
    </tr>

    <tr valign="top">
    <th scope="row"><?php _e('After Content Template', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('After Content Template', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      
      <textarea id="after_content_template" rows="5"
                name="themeopts[after_content_template]" 
                class="large-text"><?php echo stripslashes($theme_opts['after_content_template']) ?></textarea>
      
      <p class="description"><label for="after_content_template"><?php printf(__('Paste your content spin format here', WPTHEME_TEXT_DOMAIN)); ?></label></p>
      </fieldset>
    </td>
    </tr>

    </tbody>
    </table>

    <!-- ================================= dividerrrrr ================================= -->

    <h3 class="section-title">Attachments Template</h3>

    <p>
      Use special tags: <code>[title]</code >, <code>[permalink]</code >, 
      <code>[cat]</code >, <code>[date]</code>, <code>[author]</code >, 
      <code>[blog]</code>, <code>[url]</code>, <code>[img_w]</code>, <code>[img_h]</code>, 
      <code>[parent_title]</code>, <code>[parent_url]</code>, <code>[tag]</code>, 
      <code>[today_day]</code>
    </p>

    <table class="form-table">
    <tbody>

    <tr valign="top">
    <th scope="row"><?php _e('Before Attachments Template', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('Before Attachments Template', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      
      <textarea id="before_att_template" rows="5"
                name="themeopts[before_att_template]" 
                class="large-text"><?php echo stripslashes($theme_opts['before_att_template']) ?></textarea>
      
      </fieldset>
    </td>
    </tr>

    <tr valign="top">
    <th scope="row"><?php _e('After Attachments Template', WPTHEME_TEXT_DOMAIN) ?></th>
    <td>
      <fieldset><legend class="screen-reader-text"><span><?php _e('After Attachments Template', WPTHEME_TEXT_DOMAIN) ?></span></legend>
      
      <textarea id="after_att_template" rows="5"
                name="themeopts[after_att_template]" 
                class="large-text"><?php echo stripslashes($theme_opts['after_att_template']) ?></textarea>
      
      </fieldset>
    </td>
    </tr>
    
    </tbody>
    </table>
    
    </div><!-- #tabs-2 -->