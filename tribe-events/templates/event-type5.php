	<?php $event_id = get_the_ID(); ?>

	<div class="container">
        <div class="dt-sc-two-fifth column first">
            <?php echo tribe_event_featured_image( $event_id, 'event-single-type5', false ); ?>
        </div>

    	<div class="dt-sc-two-fifth column">
    	<div class="data-wrapper">
        	<p>
            	<span><?php echo tribe_get_start_date ( $event_id, true, 'd' ); ?></span>
                <?php echo tribe_get_start_date ( $event_id, true, 'F' ); ?>
                <?php echo tribe_get_start_date ( $event_id, true, 'l' ).' @ '; echo '<i>'.tribe_get_start_time ( $event_id, 'h:i a' ). ' - '.tribe_get_end_time ( $event_id, 'h:i a' ).'</i>'; ?>
            </p>
        </div>

        <div class="dt-sc-hr-invisible-xsmall"></div>
		<h2><?php the_title(); ?></h2>
        
        <p class="nav-top-links">
            <a href="<?php echo esc_url( tribe_get_events_link() ); ?>" class="back-nav"><?php esc_html_e('All Events', 'redart'); ?></a>
            <a href="<?php echo esc_url( tribe_get_gcal_link($event_id) ); ?>"><?php esc_html_e('+ Google Calendar', 'redart'); ?></a>
            <a href="<?php echo esc_url( tribe_get_ical_link() ); ?>"><?php esc_html_e('+ iCal Export', 'redart'); ?></a>
        </p>
        <div class="dt-sc-hr-invisible-small"></div>

		<div class="dt-sc-one-half column first">
        	<div class="event-details">
                <h3><?php esc_html_e('Details', 'redart'); ?></h3>
                <ul>
                    <li><dt><?php esc_html_e('Start:', 'redart'); ?></dt><?php echo tribe_get_start_date ( $event_id, true, 'M d' ).' @ '.tribe_get_start_time ( $event_id, 'h:i a' ); ?></li>
                    <li><dt><?php esc_html_e('End:', 'redart'); ?></dt><?php echo tribe_get_end_date ( $event_id, true, 'M d' ).' @ '.tribe_get_end_time ( $event_id, 'h:i a' ); ?></li>
                    <?php if ( tribe_get_cost() ) : ?>
                        <li><dt><?php esc_html_e('Cost:', 'redart'); ?></dt><?php echo tribe_get_cost( $event_id, true ); ?></li>
                    <?php endif; ?>
                    <li><?php echo tribe_get_event_categories( $event_id, array( 'before' => '', 'sep' => ', ',  'after' => '', 'label' => '', 'label_before' => '<dt class="cat">'.esc_html__('Event Category', 'redart'), 'label_after'  => '</dt>', 'wrap_before' => '<div class="cat-wrapper">', 'wrap_after' => '</div>' )); ?></li>
                    <li><?php echo tribe_meta_event_tags( esc_html__('Event Tags:', 'redart'), ', ', false ); ?></li>
                    <?php
                    $website = tribe_get_event_website_url();
                    if(!empty($website)): ?>
                        <li><dt><?php esc_html_e('Website:', 'redart'); ?></dt><a href="<?php echo esc_url($website); ?>"><?php echo esc_url($website); ?></a></li><?php
                    endif; ?>
                </ul>
            </div>
        </div>

	    <div class="dt-sc-one-half column">
        	<div class="event-organize">
                <h3><?php esc_html_e('Organizer', 'redart'); ?></h3>
                <h4><?php
                if(class_exists( 'Tribe__Events__Pro__Main' ))
                    echo tribe_get_organizer_link ( $event_id, true, false );
                else
                    echo tribe_get_organizer(); ?></h4>
                <ul><?php
                    $phone = tribe_get_organizer_phone();
                    if(!empty($phone)): ?>
                        <li><dt><?php esc_html_e('Phone:', 'redart'); ?></dt><?php echo esc_html($phone); ?></li><?php
                    endif;
                    $email = tribe_get_organizer_email();
                    if(!empty($email)): ?>
                        <li><dt><?php esc_html_e('Email:', 'redart'); ?></dt><a href="mailto:<?php echo esc_url($email); ?>"><?php echo esc_url($email); ?></a></li><?php
                    endif;
                    $website = tribe_get_organizer_website_url();
                    if(!empty($website)): ?>
                        <li><dt><?php esc_html_e('Website:', 'redart'); ?></dt><a href="<?php echo esc_url($website); ?>"><?php echo esc_url($website); ?></a></li><?php
                    endif; ?>
                </ul>
            </div>
            
        	<div class="event-venue">
            	<h3><?php esc_html_e('Venue', 'redart'); ?></h3>            
                <h4><?php
                  if(class_exists( 'Tribe__Events__Pro__Main' ))
                      echo tribe_get_venue_link($event_id, true);
                  else
                      echo tribe_get_venue($event_id); ?></h4>
                <ul class="event-venue"><?php
                    if(tribe_address_exists()): ?>
                        <li><div class="event-addr"><?php
                            echo tribe_get_full_address();
                            # Google map link...
                            if ( tribe_show_google_map_link() ) :
                                echo '<div class="dt-sc-clear"></div>'.tribe_get_map_link_html();
                            endif; ?>
                        </div></li><?php
                    endif; ?>
                </ul>
            </div>
        </div>
    </div>
    
        <div class="dt-sc-one-fifth column"><?php
            # Google map...
            $map = tribe_get_embedded_map($event_id, '', 770);
            if(!empty($map)): ?>
                <div class="event-google-map">
                    <?php echo apply_filters( 'tribe_get_embedded_map', $map); ?>
                </div><?php
            endif; ?>
        </div>
    </div>    