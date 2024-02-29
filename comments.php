<?php
if ( post_password_required() ) {
	return;
}?>

    <?php if ( have_comments() ) : ?>
    
        <h3><?php comments_number(esc_html__('No Comments','redart'), esc_html__('Comment ( 1 )','redart'), esc_html__('Comments ( % )','redart') ); ?></h3>

		<?php the_comments_navigation(); ?>

        <ul class="commentlist">
     		<?php wp_list_comments( array( 'callback' => 'redart_comment_style' ) ); ?>
        </ul>

        <?php the_comments_navigation(); ?>

    <?php endif; ?>
    
	<?php if(!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
        <p class="nocomments"><?php esc_html_e( 'Comments are closed.','redart'); ?></p>
    <?php endif;?>    
	
    <!-- Comment Form -->
        <?php

            if(is_user_logged_in()) {
                $comment = "<div class='column dt-sc-one-column first'><textarea id='comment' name='comment' cols='5' rows='3' placeholder='".esc_attr__("Comment",'redart')."' ></textarea></div>";
            } else {
                $comment = "<div class='column dt-sc-one-half first'><textarea id='comment' name='comment' cols='5' rows='3' placeholder='".esc_attr__("Comment",'redart')."' ></textarea></div>";
            }
            
            $fields = array(
                "author" => "<div class='column dt-sc-one-half'><p><input id='author' name='author' type='text' placeholder='".esc_attr__("Name",'redart')."' required /></p>",
                "email" => "<p> <input id='email' name='email' type='text' placeholder='".esc_attr__("Email",'redart')."' required /> </p></div>",
            );
            
            $privacy_cmdfrm = redart_option('privacy','enable-commentfrm-msg');
            if( isset( $privacy_cmdfrm ) ) {
            
                $content = do_shortcode( redart_option('privacy', 'commentfrm-msg') );
            
                $fields['comment-form-dt-privatepolicy'] = '<p class="comment-form-dt-privatepolicy">
                    <input id="comment-form-dt-privatepolicy" name="comment-form-dt-privatepolicy" type="checkbox" value="yes">
                    <label for="comment-form-dt-privatepolicy">'.$content.'</label> </p>';
            }
				
            $comments_args = array(
                'title_reply' 			=> 	esc_html__( 'Give a comment','redart' ),
                'fields'				=> 	$fields,
                'comment_field'			=> 	$comment,
                'comment_notes_before'	=>	'',
                'comment_notes_after'	=>	'',
                'label_submit'			=>	esc_html__('Comment','redart'));
            comment_form($comments_args); 
        ?>