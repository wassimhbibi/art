		<?php do_action( 'redart_hook_content_after' ); ?>
        </div><!-- **Container - End** -->

        </div><!-- **Main - End** --><?php

        // footer sections
        $footer 			= redart_option('layout','enable-footer');
        $copyright_section  = redart_option('layout','enable-copyright');

        if( isset($footer) || isset( $copyright_section) ) {?>
            <!-- **Footer** -->
            <footer id="footer"><?php
                if( isset( $footer ) ): ?>
                    <div class="footer-widgets">
                        <div class="container"><?php
                            $columns = redart_option ('layout','footer-columns');
                            redart_show_footer_widgetarea($columns); ?>
                        </div>
                    </div><?php
                endif;

                if( isset( $copyright_section) ): ?>
                    <div class="footer-copyright">
                        <div class="container">
							<div class="copyright"><?php
								$content = redart_option('layout','copyright-content');
								$content = stripslashes ( $content );
								$content = do_shortcode( $content );						
								echo redart_wp_kses( $content ); ?>
                            </div>    
                        </div>
                    </div><?php
                endif;?>
            </footer><!-- **Footer - End** --><?php
        } ?>

	</div><!-- **Inner Wrapper - End** -->
</div><!-- **Wrapper - End** -->
<?php do_action( 'redart_hook_bottom' ); ?>
<?php wp_footer(); ?>
</body>
</html>