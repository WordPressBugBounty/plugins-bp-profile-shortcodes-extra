<?php
/**
 * BuddyPress - Activity Post Form
 *
 * @package BP Profile Shortcodes Extra
 * @subpackage bp-nouveau
 * @version 2.5.6
 */

?>

<form action="<?php bp_activity_post_form_action(); ?>" method="post" id="whats-new-form" name="whats-new-form">

	<?php

	/**
	 * Fires before the activity post form.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bpps_before_activity_post_form' ); ?>

	<p class="activity-greeting"><?php if ( bp_is_group() )
		/*translators: this asks the user if they want to post an update.*/
		printf( esc_attr__( "What's new in %1\%s, %2\%s?", 'buddypress' ), 
		
		esc_attr( bp_get_group_name() ), 		
		//translators: This displays the users name
		esc_attr( bp_get_user_firstname( bp_get_loggedin_user_fullname() ) ) );
	else
		//translators: this asks the user if they want to post an update.
		printf( esc_attr( "What's new, %s?", 'buddypress' ), esc_attr( bp_get_user_firstname( bp_get_loggedin_user_fullname() ) ) );
	?></p>

	<div id="whats-new-content">
		<div id="whats-new-textarea">
			<label for="whats-new" class="bp-screen-reader-text"><?php
				//translators: this asks the user if they want to post an update.
				esc_attr_e( 'Post what\'s new', 'buddypress' );
			?></label>
			<textarea class="bp-suggestions" name="whats-new" id="whats-new" cols="50" rows="5"
				<?php if ( bp_is_group() ) : ?>data-suggestions-group-id="<?php echo esc_attr( (int) bp_get_current_group_id() ); ?>" <?php endif; ?>
			><?php if ( isset( $_GET['r'] ) ) : ?>@<?php echo esc_textarea( $_GET['r'] ); ?> <?php endif; ?></textarea>
		</div>

		<div id="whats-new-options">
			<div id="whats-new-submit">
				<input type="submit" name="aw-whats-new-submit" id="aw-whats-new-submit" value="<?php esc_attr_e( 'Post Update', 'buddypress' ); ?>" />
			</div>

			<?php if ( bp_is_active( 'groups' ) && !bp_is_my_profile() && !bp_is_group() ) : ?>

				<div id="whats-new-post-in-box">
					
					<?php //translators: this asks the user where they want to post their update.
					esc_attr_e( 'Post in', 'buddypress' ); ?>:

					<label for="whats-new-post-in" class="bp-screen-reader-text"><?php
						//translators: this asks the user where they want to post their update.
						esc_attr_e( 'Post in', 'buddypress' );
					?></label>
					<select id="whats-new-post-in" name="whats-new-post-in">
					
						<option selected="selected" value="0"><?php
						//translators: this option selects the option to post to their profile page.
						esc_attr_e( 'My Profile', 'buddypress' ); ?></option>

						<?php if ( bp_has_groups( 'user_id=' . bp_loggedin_user_id() . '&type=alphabetical&max=100&per_page=100&populate_extras=0&update_meta_cache=0' ) ) :
							while ( bp_groups() ) : bp_the_group(); ?>

								<option value="<?php bp_group_id(); ?>"><?php
								
								esc_attr( bp_group_name()); ?></option>

							<?php endwhile;
						endif; ?>

					</select>
				</div>
				<input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />

			<?php elseif ( bp_is_group_activity() ) : ?>

				<input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />
				<input type="hidden" id="whats-new-post-in" name="whats-new-post-in" value="<?php bp_group_id(); ?>" />

			<?php endif; ?>

			<?php

			/**
			 * Fires at the end of the activity post form markup.
			 *
			 * @since 1.2.0
			 */
			do_action( 'bpps_activity_post_form_options' ); ?>

		</div><!-- #whats-new-options -->
	</div><!-- #whats-new-content -->

	<?php wp_nonce_field( 'post_update', '_wpnonce_post_update' ); ?>
	<?php

	/**
	 * Fires after the activity post form.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bpps_after_activity_post_form' ); ?>

</form><!-- #whats-new-form -->
