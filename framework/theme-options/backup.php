<!-- backup -->
<div id="backup" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#tab1"><?php esc_html_e('Backup', 'redart'); ?></a></li>
        </ul>
        
        <!-- tab1-backup -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Backup & Restore Options', 'redart'); ?></h3>
                </div>

                <div class="box-content">
                	<div><?php
                    	esc_html_e('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'redart'); ?>
                    </div><?php
					$backup = get_option('dt_theme_backup');
					$log = ( is_array( $backup) && array_key_exists('backup',$backup) ) ? $backup['backup'] : esc_html__('No backups yet', 'redart'); ?>
					<p><strong><?php esc_html_e('Last Backup : ', 'redart'); ?><span class="backup-log"><?php echo esc_html($log); ?></span></strong></p>
					<div class="clar"></div>
					<div class="hr_invisible"></div>
					<a href="#" id="dttheme_backup_button" class="bpanel-button black-btn" title="<?php esc_attr_e('Backup Options', 'redart'); ?>"><?php esc_html_e('Backup Options', 'redart'); ?></a>
					<a href="#" id="dttheme_restore_button" class="bpanel-button black-btn" title="<?php esc_attr_e('Restore Options', 'redart'); ?>"><?php esc_html_e('Restore Options', 'redart'); ?></a>
                </div><!-- .box-content -->

                <!--<div class="box-title">
                    <h3><?php esc_html_e('Transfer Theme Options Data', 'redart'); ?></h3>
                </div>

                <div class="box-content">
                	<div><?php
						esc_html_e("You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click 'Import Options'", 'redart'); ?>
                    </div>
                    <div class="clar"></div>
                    <div class="hr_invisible"></div>
                	<?php /*$data = array( 'general' => redart_option('general'),
										 'layout' => redart_option('layout'),
										 'widgetarea' => redart_option('widgetarea'),
										 'pageoptions' => redart_option('pageoptions'),
										 'woo' => redart_option('woo'),
										 'colors' => redart_option("colors"),
										 'fonts' => redart_option('fonts'));

					$data = get_option( REDART_SETTINGS);*/?>

                    <textarea id="export_data" rows="13" cols="15"><?php #echo base64_encode( serialize($data) ); ?></textarea>
                    <div class="clear"></div>
                    <div class="hr_invisible"></div>
                    <a href="#" id="dttheme_import_button" class="bpanel-button black-btn" title="<?php esc_attr_e('Import Options', 'redart'); ?>"><?php esc_html_e('Import Options', 'redart'); ?></a>
                </div>-->
            </div><!-- .bpanel-box end -->
        </div><!-- tab1-backup end-->

    </div><!-- .bpanel-main-content end-->
</div><!-- backup end-->