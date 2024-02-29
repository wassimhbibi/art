<!-- woocommerce -->
<div id="woocommerce" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#tab1"><?php esc_html_e('WooCommerce', 'redart'); ?></a></li>
        </ul>

        <!-- tab1-woocommerce -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">

                <div class="box-title">
                    <h3><?php esc_html_e('WooCommerce', 'redart'); ?></h3>
                </div>
    
                <div class="box-content">
                	<div class="column one-half">
                    	<h6><?php esc_html_e('Products Per Page', 'redart'); ?></h6>
						<div class="column one-fifth">
                        	<input name="dttheme[woo][shop-product-per-page]" type="text" class="small" value="<?php echo trim(stripslashes(redart_option('woo','shop-product-per-page'))); ?>" />
                        </div>
                        <div class="column four-fifth last">    
	                        <p class="note"><?php esc_html_e('Number of products to show in catalog / shop page', 'redart'); ?></p>
                        </div>    
                    </div>
                    <div class="column one-half last">
                    	<h6><?php esc_html_e('Product Style', 'redart'); ?></h6>
                    	<div class="column one-fifth">
                        	<select name="dttheme[woo][product-style]" class="dt-chosen-select"><?php
								$selected = redart_option('woo','product-style');
								$product_styles =  array( 'type15' => esc_html__('Diamond','redart'));
								foreach( $product_styles as $bs => $bv ):
									echo "<option value='{$bs}'".selected($selected,$bs,false).">{$bv}</option>";
								endforeach;?></select>
                        </div>
                        <div class="column four-fifth last">
                        	<p class="note"><?php esc_html_e('Choose products style to display shop & archive pages.', 'redart'); ?></p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="hr"></div>

                    <h6><?php esc_html_e('Layout', 'redart'); ?></h6>
                    <p class="note no-margin"><?php esc_html_e("Choose the Product Layout Style in Catalog / Shop ", 'redart'); ?></p>
                    <div class="hr_invisible"> </div>
                    <div class="bpanel-option-set">
                        <ul class="bpanel-post-layout bpanel-layout-set">
                        <?php $posts_layout = array('one-half-column'=>esc_html__("Two products per row.", 'redart'),'one-third-column' => esc_html__("Three products per row.", 'redart'),
                                                    'one-fourth-column' => esc_html__("Four products per row", 'redart'));
                              $v = redart_option('woo',"shop-page-product-layout");
                              $v = !empty($v) ? $v : "one-half-column";
                              foreach($posts_layout as $key => $value):
                                 $class = ( $key ==  $v ) ? " class='selected' " :"";                                  
                                 echo "<li><a href='#' rel='{$key}' {$class} title='{$value}'><img src='" . REDART_URI . "/framework/theme-options/images/columns/{$key}.png' /></a></li>";
                              endforeach;?>                        
                        </ul>
                        <input name="dttheme[woo][shop-page-product-layout]" type="hidden" value="<?php echo esc_attr($v); ?>"/>
                    </div>
                </div><!-- .box-content -->
    
                <div class="box-title">
                    <h3><?php esc_html_e('Product Detail', 'redart'); ?></h3>
                </div>
    
                <div class="box-content">
                    <h6><?php esc_html_e('Layout', 'redart'); ?></h6>
                    <p class="note no-margin"> <?php esc_html_e("Choose the Product Page Layout", 'redart'); ?></p>
                    <div class="hr_invisible"> </div>
                    <div class="bpanel-option-set">
                        <ul class="bpanel-post-layout bpanel-layout-set"  id="woocommerce-product-layout">
                        <?php $layout = array('content-full-width'=>'without-sidebar','with-left-sidebar'=>'left-sidebar','with-right-sidebar'=>'right-sidebar','with-both-sidebar'=>'both-sidebar');
                              $v =  redart_option('woo',"product-layout");
                              $v = !empty($v) ? $v : "content-full-width";
                              foreach($layout as $key => $value):
                                  $class = ( $key ==  $v ) ? " class='selected' " : "";
                                  echo "<li><a href='#' rel='{$key}' {$class}><img src='" . REDART_URI . "/framework/theme-options/images/columns/{$value}.png' /></a></li>";
                              endforeach;?>
                        </ul>
                        <input name="dttheme[woo][product-layout]" type="hidden" value="<?php echo esc_attr($v); ?>"/>
                    </div><?php
                    //Disable option for sidebar
                    $sb_layout = redart_option('woo',"product-layout");
                    $sidebar_both = $sidebar_left = $sidebar_right = '';
                    if($sb_layout == 'content-full-width') {
                      $sidebar_both = 'style="display:none;"'; 
                    } elseif($sb_layout == 'with-left-sidebar') {
                      $sidebar_right = 'style="display:none;"'; 
                    } elseif($sb_layout == 'with-right-sidebar') {
                      $sidebar_left = 'style="display:none;"'; 
                    } ?>
                    <div id="bpanel-widget-area-options" <?php echo 'class="woocommerce-product-layout" '.$sidebar_both;?>>
                      <div id="left-sidebar-container" class="bpanel-page-left-sidebar" <?php echo redart_wp_kses($sidebar_left); ?>>
                          <!-- 2. Standard Sidebar Left Start -->
                          <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                              <h6><?php esc_html_e('Show Shop Standard Sidebar Left', 'redart'); ?></label></h6>
                              <?php redart_switch("",'woo','show-shop-standard-left-sidebar-for-product-layout'); ?>
                          </div><!-- Standard Sidebar Left End-->
                      </div>
    
                      <div id="right-sidebar-container" class="bpanel-page-right-sidebar" <?php echo redart_wp_kses($sidebar_right); ?>>
                          <!-- 3. Standard Sidebar Right Start -->
                          <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                              <h6><?php esc_html_e('Show Shop Standard Sidebar Right', 'redart'); ?></label></h6>
                              <?php redart_switch("",'woo','show-shop-standard-right-sidebar-for-product-layout'); ?>
                          </div><!-- Standard Sidebar Right End-->
                      </div>
                    </div>
                    <div class="hr"> </div>
    
                    <h6><?php esc_html_e('Show Related Products', 'redart'); ?></h6>
                    <div class="column one-fifth">
                          <?php $checked = ( "true" ==  redart_option('woo','enable-related') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  redart_option('woo','enable-related') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-woo-related" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                          <input class="hidden" id="dttheme-woo-related" name="dttheme[woo][enable-related]" type="checkbox" value="true" <?php echo redart_wp_kses($checked); ?> />
                    </div>
                    <div class="column four-fifth last">
                          <p class="note"><?php esc_html_e('YES! to display related products on single product\'s page.', 'redart'); ?></p>
                    </div>
                </div><!-- .box-content -->
    
                <div class="box-title">
                    <h3><?php esc_html_e('Product Category', 'redart'); ?></h3>
                </div>
    
                <div class="box-content">
                    <h6><?php esc_html_e('Layout', 'redart'); ?></h6>
                    <p class="note no-margin"><?php esc_html_e("Choose the Product category page layout Style", 'redart'); ?></p>
                    <div class="hr_invisible"> </div>
                    <div class="bpanel-option-set">
                        <ul class="bpanel-post-layout bpanel-layout-set" id="woocommerce-product-category">
                        <?php $layout = array('content-full-width'=>'without-sidebar','with-left-sidebar'=>'left-sidebar','with-right-sidebar'=>'right-sidebar','with-both-sidebar'=>'both-sidebar');
                              $v =  redart_option('woo',"product-category-layout");
                              $v = !empty($v) ? $v : "content-full-width";
                              foreach($layout as $key => $value):
                                  $class = ( $key ==  $v ) ? " class='selected' " : "";
                                  echo "<li><a href='#' rel='{$key}' {$class}><img src='" . REDART_URI . "/framework/theme-options/images/columns/{$value}.png' /></a></li>";
                              endforeach; ?>
                        </ul>
                        <input name="dttheme[woo][product-category-layout]" type="hidden" value="<?php echo esc_attr($v); ?>"/>
                    </div><?php
                    //Disable option for sidebar
                    $sb_layout = redart_option('woo',"product-category-layout");
                    $sidebar_both = $sidebar_left = $sidebar_right = '';
                    if($sb_layout == 'content-full-width') {
                      $sidebar_both = 'style="display:none;"'; 
                    } elseif($sb_layout == 'with-left-sidebar') {
                      $sidebar_right = 'style="display:none;"'; 
                    } elseif($sb_layout == 'with-right-sidebar') {
                      $sidebar_left = 'style="display:none;"'; 
                    } ?>
                    <div id="bpanel-widget-area-options" <?php echo 'class="woocommerce-product-category" '.$sidebar_both;?>>
                        <div id="left-sidebar-container" class="bpanel-page-left-sidebar" <?php echo redart_wp_kses($sidebar_left); ?>>
                            <!-- 2. Standard Sidebar Left Start -->
                            <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                                <h6><?php esc_html_e('Show Shop Standard Sidebar Left', 'redart'); ?></label></h6>
                                <?php redart_switch("",'woo','show-shop-standard-left-sidebar-for-product-category-layout'); ?>
                            </div><!-- Standard Sidebar Left End-->
                        </div>
    
                        <div id="right-sidebar-container" class="bpanel-page-right-sidebar" <?php echo redart_wp_kses($sidebar_right); ?>>
                            <!-- 3. Standard Sidebar Right Start -->
                            <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                                <h6><?php esc_html_e('Show Shop Standard Sidebar Right', 'redart'); ?></label></h6>
                                <?php redart_switch("",'woo','show-shop-standard-right-sidebar-for-product-category-layout'); ?>
                            </div><!-- Standard Sidebar Right End-->
                        </div>
                    </div>
                </div>
    
                <div class="box-title">
                    <h3><?php esc_html_e('Product Tag', 'redart'); ?></h3>
                </div>
    
                <div class="box-content">
                    <h6><?php esc_html_e('Layout', 'redart'); ?></h6>
                    <p class="note no-margin"> <?php esc_html_e("Choose the Product tag page layout Style", 'redart'); ?></p>
                    <div class="hr_invisible"> </div>
                    <div class="bpanel-option-set">
                        <ul class="bpanel-post-layout bpanel-layout-set" id="woocommerce-product-tag">
                        <?php $layout = array('content-full-width'=>'without-sidebar','with-left-sidebar'=>'left-sidebar','with-right-sidebar'=>'right-sidebar','with-both-sidebar'=>'both-sidebar');
                              $v =  redart_option('woo',"product-tag-layout");
                              $v = !empty($v) ? $v : "content-full-width";
                              foreach($layout as $key => $value):
                                  $class = ( $key ==   $v ) ? " class='selected' " : "";
                                  echo "<li><a href='#' rel='{$key}' {$class}><img src='" . REDART_URI . "/framework/theme-options/images/columns/{$value}.png' /></a></li>";
                              endforeach; ?>
                        </ul>
                        <input name="dttheme[woo][product-tag-layout]" type="hidden" value="<?php echo esc_attr($v); ?>"/>
                    </div><?php 
                    $sb_layout = redart_option('woo',"product-tag-layout");
                    $sidebar_both = $sidebar_left = $sidebar_right = '';
                    if($sb_layout == 'content-full-width') {
                      $sidebar_both = 'style="display:none;"'; 
                    } elseif($sb_layout == 'with-left-sidebar') {
                      $sidebar_right = 'style="display:none;"'; 
                    } elseif($sb_layout == 'with-right-sidebar') {
                      $sidebar_left = 'style="display:none;"'; 
                    } ?>
                    <div id="bpanel-widget-area-options" <?php echo 'class="woocommerce-product-tag" '.$sidebar_both;?>>
                      <div id="left-sidebar-container" class="bpanel-page-left-sidebar" <?php echo redart_wp_kses($sidebar_left); ?>>
                          <!-- 2. Standard Sidebar Left Start -->
                          <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                              <h6><?php esc_html_e('Show Shop Standard Sidebar Left', 'redart'); ?></label></h6>
                              <?php redart_switch("",'woo','show-shop-standard-left-sidebar-for-product-tag-layout'); ?>
                          </div><!-- Standard Sidebar Left End-->
                      </div>
    
                      <div id="right-sidebar-container" class="bpanel-page-right-sidebar" <?php echo redart_wp_kses($sidebar_right); ?>>
                          <!-- 3. Standard Sidebar Right Start -->
                          <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                              <h6><?php esc_html_e('Show Shop Standard Sidebar Right', 'redart'); ?></label></h6>
                              <?php redart_switch("",'woo','show-shop-standard-right-sidebar-for-product-tag-layout'); ?>
                          </div><!-- Standard Sidebar Right End-->
                      </div>
                    </div>
                </div>

            </div><!-- .bpanel-box end -->            
        </div><!-- tab1-woocommerce end-->

    </div><!-- .bpanel-main-content end-->
</div><!-- woocommerce end-->