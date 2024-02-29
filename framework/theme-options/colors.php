<!-- colors -->
<div id="colors" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#tab1"><?php esc_html_e('General', 'redart'); ?></a></li>
            <li><a href="#tab2"><?php esc_html_e('Header', 'redart'); ?></a></li>
			<li><a href="#tab3"><?php esc_html_e('Menu', 'redart'); ?></a></li>
            <li><a href="#tab4"><?php esc_html_e('Content', 'redart'); ?></a></li>
            <li><a href="#tab5"><?php esc_html_e('Footer', 'redart'); ?></a></li>
            <li><a href="#tab6"><?php esc_html_e('Heading', 'redart'); ?></a></li>
        </ul>
        
        <!-- tab1-general -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Skin', 'redart'); ?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column one-third"><label><?php esc_html_e('Theme Skin', 'redart'); ?></label></div>
                    <div class="column two-third last">
                        <select id="dttheme-skin-color" name="dttheme[colors][theme-skin]" class="medium dt-chosen-select skin-types">
                        	<optgroup label="Custom">
								<option value="custom"><?php esc_html_e('Custom Skin', 'redart'); ?></option>
							</optgroup>
							<optgroup label="Skins"><?php
								foreach(redart_getfolders(REDART_DIR."/css/skins") as $skin):
									$s = selected(redart_option('colors','theme-skin'),$skin,false);
									echo "<option $s >$skin</option>";
								endforeach;?>
                            </optgroup>    
                        </select>
                        <p class="note"><?php esc_html_e('Choose one of the predefined styles or set your own colors.', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Light Skin', 'redart'); ?></label></div>
                    <div class="column two-third last">
						<?php $checked = ( "true" ==  redart_option('colors','enable-lightskin') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  redart_option('colors','enable-lightskin') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-enable-lightskin" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                        <input class="hidden" id="dttheme-enable-lightskin" name="dttheme[colors][enable-lightskin]" type="checkbox" value="true" <?php echo redart_wp_kses($checked); ?> />
                        <p class="note"><?php esc_html_e('YES! to use light skin for this site. By default dark skin enabled.', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Body Background Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][body-bgcolor]";
						$value =  (redart_option('colors','body-bgcolor') != NULL) ? redart_option('colors','body-bgcolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom background color of the body.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <?php $panelvisible = ( redart_option('colors','theme-skin') == 'custom' ) ? 'style="display:block"' : 'style="display:none"'; ?>

					<div class="custom-skin-panel" <?php echo redart_wp_kses($panelvisible); ?>>
                        <div class="column one-third"><label><?php esc_html_e('Default Color', 'redart'); ?></label></div>
                        <div class="column two-third last"><?php
                            $name  =  "dttheme[colors][custom-default]";
                            $value =  (redart_option('colors','custom-default') != NULL) ? redart_option('colors','custom-default') :"";
                            redart_admin_color_picker_two($name,$value); ?>
                            <p class="note"><?php esc_html_e('Important: This option can be used only with the <b>"Custom Skin"</b>.', 'redart'); ?></p>
                        </div>
                        <div class="hr"></div>
    
                        <div class="column one-third"><label><?php esc_html_e('Light Color', 'redart'); ?></label></div>
                        <div class="column two-third last"><?php
                            $name  =  "dttheme[colors][custom-light]";
                            $value =  (redart_option('colors','custom-light') != NULL) ? redart_option('colors','custom-light') :"";
                            redart_admin_color_picker_two($name,$value); ?>
                            <p class="note"><?php esc_html_e('Important: This option can be used only with the <b>"Custom Skin"</b>.', 'redart'); ?></p>
                        </div>
                        <div class="hr"></div>
    
                        <div class="column one-third"><label><?php esc_html_e('Dark Color', 'redart'); ?></label></div>
                        <div class="column two-third last"><?php
                            $name  =  "dttheme[colors][custom-dark]";
                            $value =  (redart_option('colors','custom-dark') != NULL) ? redart_option('colors','custom-dark') :"";
                            redart_admin_color_picker_two($name,$value); ?>
                            <p class="note"><?php esc_html_e('Important: This option can be used only with the <b>"Custom Skin"</b>.', 'redart'); ?></p>
                        </div>
                    </div>    

                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
        </div><!-- tab1-general end-->

        <!-- tab2-header -->
        <div id="tab2" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Header', 'redart'); ?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column one-half">
                    	<label><?php esc_html_e('Header BG Color', 'redart'); ?></label>
                        <div class="clear"></div><?php
						$name  =  "dttheme[colors][header-bgcolor]";
						$value =  (redart_option('colors','header-bgcolor') != NULL) ? redart_option('colors','header-bgcolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom background color of the header.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>

					<div class="column one-half last">
						<div class="bpanel-option-set">
	                        <?php echo redart_admin_jqueryuislider( esc_html__("Background opacity", 'redart'), "dttheme[colors][header-bgcolor-opacity]",
                                                                          redart_option("colors","header-bgcolor-opacity"),""); ?>
                        </div>
                        <p class="note"><?php esc_html_e('You can adjust opacity of the header BG color here.', 'redart'); ?></p>
                    </div>
					<div class="hr"></div>
                </div><!-- .box-content -->
                
                <div class="box-title">
                    <h3><?php esc_html_e('Top Bar', 'redart'); ?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column one-third"><label><?php esc_html_e('Top Bar BG Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][topbar-bgcolor]";
						$value =  (redart_option('colors','topbar-bgcolor') != NULL) ? redart_option('colors','topbar-bgcolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom background color of the top bar.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>
                    
                    <div class="column one-third"><label><?php esc_html_e('Top Bar Text Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][topbar-textcolor]";
						$value =  (redart_option('colors','topbar-textcolor') != NULL) ? redart_option('colors','topbar-textcolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom text color of the top bar.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>
                    
                    <div class="column one-third"><label><?php esc_html_e('Top Bar Link Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][topbar-linkcolor]";
						$value =  (redart_option('colors','topbar-linkcolor') != NULL) ? redart_option('colors','topbar-linkcolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom link color of the top bar.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>
                    
                    <div class="column one-third"><label><?php esc_html_e('Top Bar Link Hover Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][topbar-linkhovercolor]";
						$value =  (redart_option('colors','topbar-linkhovercolor') != NULL) ? redart_option('colors','topbar-linkhovercolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom link hover color of the top bar.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Site Title Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][site-title-color]";
						$value =  (redart_option('colors','site-title-color') != NULL) ? redart_option('colors','site-title-color') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the site title.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                </div><!-- .box-content -->

            </div><!-- .bpanel-box end -->            
        </div><!-- tab2-header end-->

        <!-- tab3-menu -->
        <div id="tab3" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Menu', 'redart'); ?></h3>
                </div>

                <div class="box-content">
                    <div class="column one-half">
                    	<label><?php esc_html_e('Menu BG Color', 'redart'); ?></label>
                        <div class="clear"></div><?php
						$name  =  "dttheme[colors][menu-bgcolor]";
						$value =  (redart_option('colors','menu-bgcolor') != NULL) ? redart_option('colors','menu-bgcolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom background color of the menu.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>

					<div class="column one-half last">
						<div class="bpanel-option-set">
	                        <?php echo redart_admin_jqueryuislider( esc_html__("Background opacity", 'redart'), "dttheme[colors][menu-bgcolor-opacity]",
                                                                          redart_option("colors","menu-bgcolor-opacity"),""); ?>
                        </div>
                        <p class="note"><?php esc_html_e('You can adjust opacity of the menu BG color here.', 'redart'); ?></p>
                    </div>
					<div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Menu Link Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][menu-linkcolor]";
						$value =  (redart_option('colors','menu-linkcolor') != NULL) ? redart_option('colors','menu-linkcolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the menu links.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Menu Hover Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][menu-hovercolor]";
						$value =  (redart_option('colors','menu-hovercolor') != NULL) ? redart_option('colors','menu-hovercolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the hover menu links.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Menu Link Active Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][menu-activecolor]";
						$value =  (redart_option('colors','menu-activecolor') != NULL) ? redart_option('colors','menu-activecolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the active menu links.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Menu Link Active BG', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][menu-activebgcolor]";
						$value =  (redart_option('colors','menu-activebgcolor') != NULL) ? redart_option('colors','menu-activebgcolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the active menu links background.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->            
        </div><!-- tab3-menu end-->

        <!-- tab4-content -->
        <div id="tab4" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Content', 'redart'); ?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column one-third"><label><?php esc_html_e('Text Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][content-text-color]";
						$value =  (redart_option('colors','content-text-color') != NULL) ? redart_option('colors','content-text-color') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the body content text.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Link Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][content-link-color]";
						$value =  (redart_option('colors','content-link-color') != NULL) ? redart_option('colors','content-link-color') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the body content link.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Link Hover Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][content-link-hcolor]";
						$value =  (redart_option('colors','content-link-hcolor') != NULL) ? redart_option('colors','content-link-hcolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom hover color of the body content link.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->            
        </div><!-- tab4-content end-->

        <!-- tab5-footer -->
        <div id="tab5" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Footer', 'redart'); ?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column one-half">
                    	<label><?php esc_html_e('Footer Background Color', 'redart'); ?></label>
                        <div class="clear"></div><?php
						$name  =  "dttheme[colors][footer-bgcolor]";
						$value =  (redart_option('colors','footer-bgcolor') != NULL) ? redart_option('colors','footer-bgcolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the footer background.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>

					<div class="column one-half last">
						<div class="bpanel-option-set">
	                        <?php echo redart_admin_jqueryuislider( esc_html__("Background opacity", 'redart'), "dttheme[colors][footer-bgcolor-opacity]",
                                                                          redart_option("colors","footer-bgcolor-opacity"),""); ?>
                        </div>
                        <p class="note"><?php esc_html_e('You can adjust opacity of the footer BG color here.', 'redart'); ?></p>
                    </div>
					<div class="hr"></div>

                    <div class="column one-half">
                    	<label><?php esc_html_e('Copyright Section BG Color', 'redart'); ?></label>
                        <div class="clear"></div><?php
						$name  =  "dttheme[colors][copyright-bgcolor]";
						$value =  (redart_option('colors','copyright-bgcolor') != NULL) ? redart_option('colors','copyright-bgcolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the copyright section background.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>

					<div class="column one-half last">
						<div class="bpanel-option-set">
	                        <?php echo redart_admin_jqueryuislider( esc_html__("Background opacity", 'redart'), "dttheme[colors][copyright-bgcolor-opacity]",
                                                                          redart_option("colors","copyright-bgcolor-opacity"),""); ?>
                        </div>
                        <p class="note"><?php esc_html_e('You can adjust opacity of the copyright section BG color here.', 'redart'); ?></p>
                    </div>
					<div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Footer Text Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][footer-text-color]";
						$value =  (redart_option('colors','footer-text-color') != NULL) ? redart_option('colors','footer-text-color') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the footer text elements.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Footer Link Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][footer-link-color]";
						$value =  (redart_option('colors','footer-link-color') != NULL) ? redart_option('colors','footer-link-color') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the footer links.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Footer Hover Link Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][footer-link-hcolor]";
						$value =  (redart_option('colors','footer-link-hcolor') != NULL) ? redart_option('colors','footer-link-hcolor') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom hover color of the footer links.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Footer Heading Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][footer-heading-color]";
						$value =  (redart_option('colors','footer-heading-color') != NULL) ? redart_option('colors','footer-heading-color') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the footer headings.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->            
        </div><!-- tab5-footer end-->

        <!-- tab6-heading -->
        <div id="tab6" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Heading', 'redart'); ?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column one-third"><label><?php esc_html_e('Heading H1 Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][heading-h1-color]";
						$value =  (redart_option('colors','heading-h1-color') != NULL) ? redart_option('colors','heading-h1-color') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the heading tag h1.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>
                    
                    <div class="column one-third"><label><?php esc_html_e('Heading H2 Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][heading-h2-color]";
						$value =  (redart_option('colors','heading-h2-color') != NULL) ? redart_option('colors','heading-h2-color') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the heading tag h2.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Heading H3 Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][heading-h3-color]";
						$value =  (redart_option('colors','heading-h3-color') != NULL) ? redart_option('colors','heading-h3-color') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the heading tag h3.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Heading H4 Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][heading-h4-color]";
						$value =  (redart_option('colors','heading-h4-color') != NULL) ? redart_option('colors','heading-h4-color') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the heading tag h4.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Heading H5 Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][heading-h5-color]";
						$value =  (redart_option('colors','heading-h5-color') != NULL) ? redart_option('colors','heading-h5-color') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the heading tag h5.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Heading H6 Color', 'redart'); ?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][heading-h6-color]";
						$value =  (redart_option('colors','heading-h6-color') != NULL) ? redart_option('colors','heading-h6-color') :"";
                        redart_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the heading tag h6.(e.g. #a314a3)', 'redart'); ?></p>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->            
        </div><!-- tab6-heading end-->

    </div><!-- .bpanel-main-content end-->
</div><!-- colors end-->