<!-- fonts -->
<div id="fonts" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel">
            <li><a href="#tab1"><?php esc_html_e('Font Family', 'redart'); ?></a></li>
            <li><a href="#tab2"><?php esc_html_e('Font Size', 'redart'); ?></a></li>
            <li><a href="#tab3"><?php esc_html_e('Font Weight', 'redart'); ?></a></li>
            <li><a href="#tab4"><?php esc_html_e('Letter Spacing', 'redart'); ?></a></li>
            <li><a href="#tab5"><?php esc_html_e('Others', 'redart'); ?></a></li>
        </ul>

        <!-- tab1-font-family -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Font Family', 'redart'); ?></h3>
                </div>
				<?php $fonts = redart_fonts(); ?>
                <div class="box-content">
                    <div class="column one-third"><label><?php esc_html_e('Content Font', 'redart'); ?></label></div>
                    <div class="column two-third last">
                        <select id="dttheme-fonts-content" name="dttheme[fonts][content-font]" class="medium dt-chosen-select"><?php
							#system fonts
							echo '<optgroup label="'. esc_attr__('System', 'redart') .'">';
							foreach ( $fonts['system'] as $font ) {
								echo '<option value="'. $font .'"'.selected(redart_option('fonts','content-font'), $font, false).'>'. $font .'</option>';
							}
							echo '</optgroup>';

							#custom font | uploaded in theme options
							if( key_exists( 'custom', $fonts ) ){
								echo '<optgroup label="'. esc_attr__('Custom (Uploaded below)', 'redart') .'">';
								foreach ( $fonts['custom'] as $font ) {
									echo '<option value="'. $font .'"'.selected(redart_option('fonts','content-font'), $font, false).'>'. $font .'</option>';
								}
								echo '</optgroup>';
							}

							#google fonts | all
							echo '<optgroup label="'. esc_attr__('Google Fonts', 'redart') .'">';
							foreach ( $fonts['all'] as $font ) {
								echo '<option value="'. $font .'"'.selected(redart_option('fonts','content-font'), $font, false).'>'. $font .'</option>';
							}
							echo '</optgroup>'; ?>
                        </select>
                        <p class="note"><?php esc_html_e('All theme texts except headings and menu.', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Menu Font', 'redart'); ?></label></div>
                    <div class="column two-third last">
                        <select id="dttheme-fonts-menu" name="dttheme[fonts][menu-font]" class="medium dt-chosen-select"><?php
							#system fonts
							echo '<optgroup label="'. esc_attr__('System', 'redart') .'">';
							foreach ( $fonts['system'] as $font ) {
								echo '<option value="'. $font .'"'.selected(redart_option('fonts','menu-font'), $font, false).'>'. $font .'</option>';
							}
							echo '</optgroup>';

							#custom font | uploaded in theme options
							if( key_exists( 'custom', $fonts ) ){
								echo '<optgroup label="'. esc_attr__('Custom (Uploaded below)', 'redart') .'">';
								foreach ( $fonts['custom'] as $font ) {
									echo '<option value="'. $font .'"'.selected(redart_option('fonts','menu-font'), $font, false).'>'. str_replace('#', '', $font) .'</option>';
								}
								echo '</optgroup>';
							}

							#google fonts | all
							echo '<optgroup label="'. esc_attr__('Google Fonts', 'redart') .'">';
							foreach ( $fonts['all'] as $font ) {
								echo '<option value="'. $font .'"'.selected(redart_option('fonts','menu-font'), $font, false).'>'. $font .'</option>';
							}
							echo '</optgroup>'; ?>
                        </select>
                        <p class="note"><?php esc_html_e('The selected font can apply for header menu.', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Page Title Font', 'redart'); ?></label></div>
                    <div class="column two-third last">
                        <select id="dttheme-fonts-pagetitle" name="dttheme[fonts][pagetitle-font]" class="medium dt-chosen-select"><?php
							#system fonts
							echo '<optgroup label="'. esc_attr__('System', 'redart') .'">';
							foreach ( $fonts['system'] as $font ) {
								echo '<option value="'. $font .'"'.selected(redart_option('fonts','pagetitle-font'), $font, false).'>'. $font .'</option>';
							}
							echo '</optgroup>';

							#custom font | uploaded in theme options
							if( key_exists( 'custom', $fonts ) ){
								echo '<optgroup label="'. esc_attr__('Custom (Uploaded below)', 'redart') .'">';
								foreach ( $fonts['custom'] as $font ) {
									echo '<option value="'. $font .'"'.selected(redart_option('fonts','pagetitle-font'), $font, false).'>'. str_replace('#', '', $font) .'</option>';
								}
								echo '</optgroup>';
							}

							#google fonts | all
							echo '<optgroup label="'. esc_attr__('Google Fonts', 'redart') .'">';
							foreach ( $fonts['all'] as $font ) {
								echo '<option value="'. $font .'"'.selected(redart_option('fonts','pagetitle-font'), $font, false).'>'. $font .'</option>';
							}
							echo '</optgroup>'; ?>
                        </select>
                        <p class="note"><?php esc_html_e('The selected font can apply for page titles.', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

			  <?php	for( $i = 1; $i <= 6; $i++) :
			  			$class = (($i % 2) == 0) ? 'last' : ''; ?>
                        <div class="column one-half <?php echo esc_attr($class); ?>">
                        	<label><?php echo sprintf(esc_html__('Heading H%s Font', 'redart'), $i); ?></label>
                            <div class="clear"></div>
                            <select id="dttheme-fonts-head<?php echo esc_attr($i); ?>" name="dttheme[fonts][h<?php echo esc_attr($i); ?>-font]" class="medium dt-chosen-select"><?php
                                #system fonts
                                echo '<optgroup label="'. esc_attr__('System', 'redart') .'">';
                                foreach ( $fonts['system'] as $font ) {
                                    echo '<option value="'. $font .'"'.selected(redart_option('fonts', 'h'.$i.'-font'), $font, false).'>'. $font .'</option>';
                                }
                                echo '</optgroup>';

                                #custom font | uploaded in theme options
                                if( key_exists( 'custom', $fonts ) ){
                                    echo '<optgroup label="'. esc_attr__('Custom (Uploaded below)', 'redart') .'">';
                                    foreach ( $fonts['custom'] as $font ) {
                                        echo '<option value="'. $font .'"'.selected(redart_option('fonts', 'h'.$i.'-font'), $font, false).'>'. str_replace('#', '', $font) .'</option>';
                                    } 
                                    echo '</optgroup>';
                                }

                                #google fonts | all
                                echo '<optgroup label="'. esc_attr__('Google Fonts', 'redart') .'">';
                                foreach ( $fonts['all'] as $font ) {
                                    echo '<option value="'. $font .'"'.selected(redart_option('fonts', 'h'.$i.'-font'), $font, false).'>'. $font .'</option>';
                                }
                                echo '</optgroup>'; ?>
                            </select>
                            <p class="note"><?php echo sprintf(esc_html__('The selected font can apply for heading H%s.', 'redart'), $i); ?></p>
                            <div class="hr"></div>
                        </div><?php
					endfor; ?>

                    <div class="column one-third"><label><?php esc_html_e('Google Font Style & Weight', 'redart'); ?></label></div>
                    <div class="column two-third last">
                    	<ul class="checkbox-list"><?php
							#google font styles
							$font_styles = redart_font_style();
							$dtfonts = redart_option('fonts', 'font-style');
							$dtfonts = !empty($dtfonts) ? $dtfonts : array();
							foreach($font_styles as $key => $option):
								$checked = ( in_array(trim($key), $dtfonts) ) ? ' checked="checked"' : ''; ?>
								<li><label><input type="checkbox" name="dttheme[fonts][font-style][]" value="<?php echo esc_attr($key); ?>" <?php echo redart_wp_kses($checked); ?> /><?php echo esc_html($option); ?></label></li><?php
							endforeach;	?>
                        </ul>
                        <p class="note"><?php esc_html_e('Some of the fonts in the Google Font Directory support multiple styles.', 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Google Font Subset', 'redart'); ?></label></div>
                    <div class="column two-third last">
                    	<input type="text" class="large" name="dttheme[fonts][font-subset]" value="<?php echo esc_attr(redart_option('fonts','font-subset')); ?>" />
                        <p class="note"><?php esc_html_e('Specify which subsets should be downloaded. Multiple subsets should be separated with comma (,)', 'redart'); ?></p>
                    </div>
                </div><!-- .box-content -->

                <div class="box-title">
                    <h3><?php esc_html_e('Custom Fonts', 'redart'); ?></h3>
                </div>

                <div class="box-content">
                    <div class="column one-third"><label><?php esc_html_e('Custom Font Name', 'redart'); ?></label></div>
                    <div class="column two-third last">
                    	<input type="text" class="large" name="dttheme[fonts][customfont-name]" value="<?php echo esc_attr(redart_option('fonts','customfont-name')); ?>" />
                        <p class="note"><?php esc_html_e('Please use only letters or spaces, eg. Patua One', 'redart'); ?></p>
                    </div>
					<div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Custom Font (.woff)', 'redart'); ?></label></div>
                    <div class="column two-third last">
                        <input id="dttheme-favicon" name="dttheme[fonts][customfont-woff]" type="text" class="uploadfield medium" value="<?php echo esc_attr(redart_option('fonts','customfont-woff')); ?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'redart'); ?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'redart'); ?>" class="upload_image_reset" />
	                    <p class="note"> <?php esc_html_e('Upload .woff file for above custom font.', 'redart'); ?>  </p>
					</div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Custom Font (.ttf)', 'redart'); ?></label></div>
                    <div class="column two-third last">
                        <input id="dttheme-favicon" name="dttheme[fonts][customfont-ttf]" type="text" class="uploadfield medium" value="<?php echo esc_attr(redart_option('fonts','customfont-ttf')); ?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'redart'); ?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'redart'); ?>" class="upload_image_reset" />
	                    <p class="note"> <?php esc_html_e('Upload .ttf file for above custom font.', 'redart'); ?>  </p>
					</div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Custom Font (.svg)', 'redart'); ?></label></div>
                    <div class="column two-third last">
                        <input id="dttheme-favicon" name="dttheme[fonts][customfont-svg]" type="text" class="uploadfield medium" value="<?php echo esc_attr(redart_option('fonts','customfont-svg')); ?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'redart'); ?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'redart'); ?>" class="upload_image_reset" />
	                    <p class="note"> <?php esc_html_e('Upload .svg file for above custom font.', 'redart'); ?>  </p>
					</div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Custom Font (.eot)', 'redart'); ?></label></div>
                    <div class="column two-third last">
                        <input id="dttheme-favicon" name="dttheme[fonts][customfont-eot]" type="text" class="uploadfield medium" value="<?php echo esc_attr(redart_option('fonts','customfont-eot')); ?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'redart'); ?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'redart'); ?>" class="upload_image_reset" />
	                    <p class="note"> <?php esc_html_e('Upload .eot file for above custom font.', 'redart'); ?>  </p>
					</div>
                    <div class="hr"></div>
                    
                    <div class="column one-third"><label><?php esc_html_e('Custom Font 2 Name', 'redart'); ?></label></div>
                    <div class="column two-third last">
                    	<input type="text" class="large" name="dttheme[fonts][customfont2-name]" value="<?php echo esc_attr(redart_option('fonts','customfont2-name')); ?>" />
                        <p class="note"><?php esc_html_e('Please use only letters or spaces, eg. Patua One', 'redart'); ?></p>
                    </div>
					<div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Custom Font 2 (.woff)', 'redart'); ?></label></div>
                    <div class="column two-third last">
                        <input id="dttheme-favicon" name="dttheme[fonts][customfont2-woff]" type="text" class="uploadfield medium" value="<?php echo esc_attr(redart_option('fonts','customfont2-woff')); ?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'redart'); ?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'redart'); ?>" class="upload_image_reset" />
	                    <p class="note"> <?php esc_html_e('Upload .woff file for above custom font 2.', 'redart'); ?>  </p>
					</div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Custom Font 2 (.ttf)', 'redart'); ?></label></div>
                    <div class="column two-third last">
                        <input id="dttheme-favicon" name="dttheme[fonts][customfont2-ttf]" type="text" class="uploadfield medium" value="<?php echo esc_attr(redart_option('fonts','customfont2-ttf')); ?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'redart'); ?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'redart'); ?>" class="upload_image_reset" />
	                    <p class="note"> <?php esc_html_e('Upload .ttf file for above custom font 2.', 'redart'); ?>  </p>
					</div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Custom Font 2 (.svg)', 'redart'); ?></label></div>
                    <div class="column two-third last">
                        <input id="dttheme-favicon" name="dttheme[fonts][customfont2-svg]" type="text" class="uploadfield medium" value="<?php echo esc_attr(redart_option('fonts','customfont2-svg')); ?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'redart'); ?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'redart'); ?>" class="upload_image_reset" />
	                    <p class="note"> <?php esc_html_e('Upload .svg file for above custom font 2.', 'redart'); ?>  </p>
					</div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Custom Font 2 (.eot)', 'redart'); ?></label></div>
                    <div class="column two-third last">
                        <input id="dttheme-favicon" name="dttheme[fonts][customfont2-eot]" type="text" class="uploadfield medium" value="<?php echo esc_attr(redart_option('fonts','customfont2-eot')); ?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'redart'); ?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'redart'); ?>" class="upload_image_reset" />
	                    <p class="note"> <?php esc_html_e('Upload .eot file for above custom font 2.', 'redart'); ?>  </p>
					</div>
                    <div class="hr"></div>                    
                </div>
            </div><!-- .bpanel-box end -->
        </div><!-- tab1-font-family end-->

        <!-- tab2-font-size -->
        <div id="tab2" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Font Size', 'redart'); ?></h3>
                </div>

                <div class="box-content">
					<div class="column one-half"><?php
						redart_admin_jqueryuislider(esc_html__('Content', 'redart'), "dttheme[fonts][content-font-size]", redart_option('fonts','content-font-size')); ?>
						<p class="note"> <?php esc_html_e('This font size will be used for all theme texts.', 'redart'); ?>  </p>
                    </div>
					<div class="column one-half last"><?php
						redart_admin_jqueryuislider(esc_html__('Main Menu', 'redart'), "dttheme[fonts][menu-font-size]", redart_option('fonts','menu-font-size')); ?>
						<p class="note"> <?php esc_html_e('This font size will be used for top level only.', 'redart'); ?>  </p>
                    </div>
					<div class="hr"></div>

					<div class="column one-half"><?php
						redart_admin_jqueryuislider(esc_html__('Heading H1', 'redart'), "dttheme[fonts][h1-font-size]", redart_option('fonts','h1-font-size')); ?>
						<p class="note"> <?php esc_html_e('This is Heading I font size.', 'redart'); ?>  </p>
                    </div>
					<div class="column one-half last"><?php
						redart_admin_jqueryuislider(esc_html__('Heading H2', 'redart'), "dttheme[fonts][h2-font-size]", redart_option('fonts','h2-font-size')); ?>
						<p class="note"> <?php esc_html_e('This is Heading II font size.', 'redart'); ?>  </p>
                    </div>
					<div class="hr"></div>

					<div class="column one-half"><?php
						redart_admin_jqueryuislider(esc_html__('Heading H3', 'redart'), "dttheme[fonts][h3-font-size]", redart_option('fonts','h3-font-size')); ?>
						<p class="note"> <?php esc_html_e('This is Heading III font size.', 'redart'); ?>  </p>
                    </div>

					<div class="column one-half last"><?php
						redart_admin_jqueryuislider(esc_html__('Heading H4', 'redart'), "dttheme[fonts][h4-font-size]", redart_option('fonts','h4-font-size')); ?>
						<p class="note"> <?php esc_html_e('This is Heading IV font size.', 'redart'); ?>  </p>
                    </div>
					<div class="hr"></div>

					<div class="column one-half"><?php
						redart_admin_jqueryuislider(esc_html__('Heading H5', 'redart'), "dttheme[fonts][h5-font-size]", redart_option('fonts','h5-font-size')); ?>
						<p class="note"> <?php esc_html_e('This is Heading V font size.', 'redart'); ?>  </p>
                    </div>
					<div class="column one-half last"><?php
						redart_admin_jqueryuislider(esc_html__('Heading H6', 'redart'), "dttheme[fonts][h6-font-size]", redart_option('fonts','h6-font-size')); ?>
						<p class="note"> <?php esc_html_e('This is Heading VI font size.', 'redart'); ?>  </p>
                    </div>

					<div class="column one-half"><?php
						redart_admin_jqueryuislider(esc_html__('Footer Content', 'redart'), "dttheme[fonts][footer-font-size]", redart_option('fonts','footer-font-size')); ?>
						<p class="note"> <?php esc_html_e('This font size will be used for all footer texts.', 'redart'); ?>  </p>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
        </div><!-- tab2-font-size end-->

        <!-- tab3-font-weight -->
        <div id="tab3" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Font Weight', 'redart'); ?></h3>
                    <?php $fweight = array('100' => '100', '200' => '200', '300' => '300', '400' => '400', '500' => '500', '600' => '600', '700' => '700', '800' => '800', '900' => '900', 'bold' => 'Bold', 'bolder' => 'Bolder', 'lighter' => 'Lighter', 'inherit' => 'Inherit'); ?>
                </div>

                <div class="box-content">
					<div class="column one-third">
                        <label><?php esc_html_e("Menu", 'redart'); ?></label>
                    </div>
                    <div class="column two-third last">
                        <select id="dttheme-fonts-menu-weight" name="dttheme[fonts][menu-weight]" class="medium dt-chosen-select">
							<option value="normal"><?php esc_html_e('Normal', 'redart'); ?></option><?php
                            foreach ( $fweight as $key => $w ) {
                                echo '<option value="'. $key .'"'.selected(redart_option('fonts', 'menu-weight'), $key, false).'>'. $w .'</option>';
                            } ?>
                        </select>
                        <p class="note"><?php esc_html_e("The selected font weight can apply for menu links.", 'redart'); ?></p>
                    </div>
                    <div class="hr"></div>

                <?php for( $i = 1; $i <= 6; $i++) :
			  			$class = (($i % 2) == 0) ? 'last' : ''; ?>

                        <div class="column one-half <?php echo esc_attr($class); ?>">
                            <label><?php echo sprintf(esc_html__('Heading H%s', 'redart'), $i); ?></label>
                            <div class="clear"></div>
                            <select id="dttheme-fonts-h<?php echo esc_attr($i); ?>-weight" name="dttheme[fonts][h<?php echo esc_attr($i); ?>-weight]" class="medium dt-chosen-select">
                                <option value="normal"><?php esc_html_e('Normal', 'redart'); ?></option><?php
                                foreach ( $fweight as $key => $w ) {
                                    echo '<option value="'. $key .'"'.selected(redart_option('fonts', 'h'.$i.'-weight'), $key, false).'>'. $w .'</option>';
                                } ?>
                            </select>
                            <p class="note"><?php echo sprintf(esc_html__('The selected font weight can apply for H%s texts.', 'redart'), $i); ?></p>
                            <div class="hr"></div>
                        </div>
                <?php endfor; ?>

				</div>
            </div>
        </div>

        <!-- tab4-letter-spacing -->
        <div id="tab4" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Letter Spacing', 'redart'); ?></h3>
                    <?php $lspacing = array('-3px' => '-3px', '-2px' => '-2px', '-1px' => '-1px', '-0.75px' => '-0.75px', '-0.5px' => '-0.5px', '-0.25px' => '-0.25px', '-0.1px' => '-0.1px', '-0.05px' => '-0.05px', '0px' => '0px', '0.05px' => '0.05px', '0.1px' => '0.1px', '0.25px' => '0.25px', '0.5px' => '0.5px', '0.75px' => '0.75px', '1px' => '1px', '2px' => '2px', '3px' => '3px'); ?>
                </div>

                <div class="box-content">
					<div class="column one-third">
                        <label><?php esc_html_e("Menu", 'redart'); ?></label>
                    </div>
                    <div class="column two-third last">
                        <select id="dttheme-fonts-menu-letter-spacing" name="dttheme[fonts][menu-letter-spacing]" class="medium dt-chosen-select">
                            <option value=""><?php esc_html_e('Choose any one', 'redart'); ?></option><?php
                            foreach ( $lspacing as $key => $l ) {
                                echo '<option value="'. $key .'"'.selected(redart_option('fonts', 'menu-letter-spacing'), $key, false).'>'. $l .'</option>';
                            } ?>
                        </select>
						<p class="note"> <?php esc_html_e('This letter spacing will be used for all menu links.', 'redart'); ?>  </p>
                    </div>
					<div class="hr"></div>

                <?php for( $i = 1; $i <= 6; $i++) :
			  			$class = (($i % 2) == 0) ? 'last' : ''; ?>

                        <div class="column one-half <?php echo esc_attr($class); ?>">
                            <label><?php echo sprintf(esc_html__('Heading H%s', 'redart'), $i); ?></label>
                            <div class="clear"></div>
                            <select id="dttheme-fonts-h<?php echo esc_attr($i); ?>-letter-spacing" name="dttheme[fonts][h<?php echo esc_attr($i); ?>-letter-spacing]" class="medium dt-chosen-select">
                                <option value=""><?php esc_html_e('Choose any one', 'redart'); ?></option><?php
                                foreach ( $lspacing as $key => $l ) {
                                    echo '<option value="'. $key .'"'.selected(redart_option('fonts', 'h'.$i.'-letter-spacing'), $key, false).'>'. $l .'</option>';
                                } ?>
                            </select>
                            <p class="note"><?php echo sprintf( esc_html__('This is Heading H%s letter spacing.', 'redart'), $i); ?></p>
                            <div class="hr"></div>
                        </div>
                <?php endfor; ?>

                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
        </div><!-- tab4-letter-sspacing end-->

        <!-- tab5-others -->
        <div id="tab5" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Line Height', 'redart'); ?></h3>
                </div>

                <div class="box-content">
					<div class="column one-column"><?php
						redart_admin_jqueryuislider(esc_html__('Body Line Height', 'redart'), "dttheme[fonts][body-line-height]", redart_option('fonts','body-line-height')); ?>
						<p class="note"> <?php esc_html_e('This line height will be applied for body contents.', 'redart'); ?>  </p>
                    </div>
                </div>
            </div>        
        </div>
    </div><!-- .bpanel-main-content end-->
</div><!-- fonts end-->