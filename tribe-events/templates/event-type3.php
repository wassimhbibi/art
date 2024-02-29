	<?php $event_id = get_the_ID(); ?>

	<div class="dt-sc-three-fifth column first">
    	<h2><?php the_title(); ?></h2>
    </div>
    <div class="dt-sc-two-fifth column">
    	<p class="event-date">
        	<span><?php echo tribe_get_start_date ( $event_id, true, 'd' ); ?></span>
            <?php echo tribe_get_start_date ( $event_id, true, 'F Y' ); ?>
        </p>
    </div>
    
	<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>   
    
	<div class="dt-sc-three-fifth column first">
    	<div class="dt-sc-hr-invisible-small"></div>
        <div class="dt-sc-clear"></div>
    	<?php the_content(); ?>
    </div>
    <div class="dt-sc-two-fifth column">
        <div class="dt-sc-tabs-horizontal-frame-container event-meta-tab">
          <ul class="dt-sc-tabs-horizontal-frame">
            <li><a href="#" class="current"><?php esc_html_e('Details', 'redart'); ?></span></a></li>
            <li><a href="#"><?php esc_html_e('Organizer', 'redart'); ?></a></li>
            <li><a href="#"><?php esc_html_e('Venue', 'redart'); ?></a></li>
          </ul>
          <div class="dt-sc-tabs-horizontal-frame-content">
              <ul class="event-details">
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
          <div class="dt-sc-tabs-horizontal-frame-content">
              <h4><?php
              if(class_exists( 'Tribe__Events__Pro__Main' ))
                  echo tribe_get_organizer_link ( $event_id, true, false );
              else
                  echo tribe_get_organizer(); ?></h4>
              <ul class="event-organize"><?php
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
          <div class="dt-sc-tabs-horizontal-frame-content">
          	  <h4><?php
			  	if(class_exists( 'Tribe__Events__Pro__Main' ))
					echo tribe_get_venue_link($event_id, true);
				else
					echo tribe_get_venue($event_id); ?></h4>
              <ul class="event-venue"><?php
                  if(tribe_address_exists()): ?>
                      <li><dt><?php esc_html_e('Address:', 'redart'); ?></dt>
                      <div class="event-addr"><?php
                          echo tribe_get_full_address();
                          # Google map link...
                          if ( tribe_show_google_map_link() ) :
                              echo '<div class="dt-sc-clear"></div>'.tribe_get_map_link_html();
                          endif; ?>
                      </div></li><?php
                  endif;
                  $phone = tribe_get_phone();
                  if(!empty($phone)): ?>
                      <li><dt><?php esc_html_e('Phone:', 'redart'); ?></dt><?php echo esc_html($phone); ?></li><?php
                  endif;
                  $website = tribe_get_venue_website_url();
                  if(!empty($website)): ?>
                      <li><dt><?php esc_html_e('Website:', 'redart'); ?></dt><a href="<?php echo esc_url($website); ?>"><?php echo esc_url($website); ?></a></li><?php
                  endif; ?>
              </ul>
          </div>
        </div>
    </div>

    <div class="dt-sc-hr-invisible-small"></div>
	<div class="dt-sc-clear"></div><?php
	# Google map...
	$map = tribe_get_embedded_map($event_id);
	if(!empty($map)): ?>
		<div class="event-google-map">
			<?php echo apply_filters( 'tribe_get_embedded_map', $map); ?>
		</div><?php
	endif; ?>

    <div class="dt-sc-hr-invisible-xsmall"></div>
    <div class="right-calc">
        <a href="<?php echo esc_url( tribe_get_gcal_link($event_id) ); ?>"><?php esc_html_e('+ Google Calendar', 'redart'); ?></a>
        <span class="sep">/</span>
        <a href="<?php echo esc_url( tribe_get_ical_link() ); ?>"><?php esc_html_e('+ iCal Export', 'redart'); ?></a>
    </div>
    <div class="dt-sc-hr-invisible-xsmall"></div>    

    <ul class="tribe-events-sub-nav">
        <li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span class="fa fa-long-arrow-left"></span> %title%' ); ?></li>
        <li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span class="fa fa-long-arrow-right"></span>' ); ?></li>
    </ul>