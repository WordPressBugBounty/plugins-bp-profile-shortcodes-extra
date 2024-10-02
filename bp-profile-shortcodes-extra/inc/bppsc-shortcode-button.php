<?php

/**
 * BPSC tinyMce Shortcode Button class
 *
 * @since 1.2.0
 */
class BPSC_Shortcodes_Button {

    /**
     * Constructor for shortcode class
     */
    public function __construct() {

		global $pagenow;
		
		
		if ( $pagenow == 'post-new.php' || $pagenow == 'post.php' ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'localize_shortcodes' )  );
			add_filter( 'mce_external_plugins',  array( $this, 'enqueue_plugin_scripts' ) );
			add_filter( 'mce_buttons',  array( $this, 'register_buttons_editor' ) );
		}

    }

    /**
     * Generate shortcode array
     *
     * @since 1.2.0
     *
     */
    function localize_shortcodes() {

		wp_register_script( 'bpsc-shortcode', BPPSC_PLUGIN_URL . "/js/bpsc-tmc-button.js", array( 'jquery' ) );

		$shortcodes = apply_filters( 'bpsc_profile_shortcodes', array(
            'bpps_profile_displayname'=> array(
                'title'   => esc_attr__( 'Profile Displayname', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_displayname]'
            ),
            'bpps_profile_email'  => array(
                'title'   => esc_attr__( 'Profile Email', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_email]'
            ),
            'bpps_profile_username'     => array(
                'title'   => esc_attr__( 'Profile Username', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_username]'
            ),
            'bpps_profile_avatar'    => array(
                'title'   => esc_attr__( 'Profile Avatar', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_avatar]'
            ),
            'bpps_profile_avatar_url'    => array(
                'title'   => esc_attr__( 'Profile Avatar URL', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_avatar_url]'
            ),
            'bpps_profile_avatar_link' => array(
                'title'   => esc_attr__( 'Profile Avatar Link', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_avatar_link]'
            ),
            'bpps_profile_cover_image'=> array(
                'title'   => esc_attr__( 'Profile Cover Image', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_cover_image]'
            ),
            'bpps_profile_cover_image_url'  => array(
                'title'   => esc_attr__( 'Profile Cover Image URL', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_cover_image_url]'
            ),
            'bpps_profile_cover_image_link'     => array(
                'title'   => esc_attr__( 'Profile Cover Image Link', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_cover_image_link]'
            ),
            'bpps_profile_header'    => array(
                'title'   => esc_attr__( 'Profile Header', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_header]'
            ),
            'bpps_profile_url'    => array(
                'title'   => esc_attr__( 'Profile URL', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_url]'
            ),
            'bpps_profile_edit_url' => array(
                'title'   => esc_attr__( 'Profile Edit URL', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_edit_url]'
            ),
            'bpps_profile_field'=> array(
                'title'   => esc_attr__( 'Profile Field', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_field]'
            ),
            'bpps_profile_lists'  => array(
                'title'   => esc_attr__( 'Profile Lists', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_lists]'
            ),
            'bpps_profile_private_message_link'     => array(
                'title'   => esc_attr__( 'Profile Private Message Link', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_profile_private_message_link]'
            ),
            'bpps_whats_new'    => array(
                'title'   => esc_attr__( 'Whats New', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_whats_new]'
            ),
            'bpps_group_url'    => array(
                'title'   => esc_attr__( 'Group URL', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_group_url]'
            ),
            'bpps_group_avatar' => array(
                'title'   => esc_attr__( 'Group Avatar', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_group_avatar]'
            ),
            'bpps_group_avatar_url'=> array(
                'title'   => esc_attr__( 'Group Avatar URL', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_group_avatar_url]'
            ),
            'bpps_group_avatar_link'  => array(
                'title'   => esc_attr__( 'Group Avatar Link', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_group_avatar_link]'
            ),
            'bpps_group_cover_image'     => array(
                'title'   => esc_attr__( 'Group Cover Image', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_group_cover_image]'
            ),
            'bpps_group_cover_image_url'    => array(
                'title'   => esc_attr__( 'Group Cover Image URL', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_group_cover_image_url]'
            ),
            'bpps_group_cover_image_link'    => array(
                'title'   => esc_attr__( 'Group Cover Image Link', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_group_cover_image_link]'
            ),
            'bpps_group_header'    => array(
                'title'   => esc_attr__( 'Group Header', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_group_header]'
            ),
            'bpps_group_members' => array(
                'title'   => esc_attr__( 'Group Members', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_group_members]'
            ),
            'bpps_group_field'    => array(
                'title'   => esc_attr__( 'Group Field', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_group_field]'
            ),
            'bpps_group_description' => array(
                'title'   => esc_attr__( 'Group Description', 'bp-Profile-Shortcodes-Extra' ),
                'content' => '[bpps_group_description]'
            )
			));

        $plugin_url = BPPSC_PLUGIN_URL;

        wp_localize_script( 'bpsc-shortcode', 'bpsc_shortcodes', array( apply_filters( 'bpsc_button_shortcodes', $shortcodes ) ) );
        wp_localize_script( 'bpsc-shortcode', 'bpsc_plugin_url', array( $plugin_url ) );
		wp_enqueue_script( 'bpsc-shortcode');
    }

    /**
     * * Singleton object
     *
     * @staticvar boolean $instance
     *
     * @return \self
     */
    public static function init() {
        static $instance = false;

        if ( !$instance ) {
            $instance = new BPSC_Shortcodes_Button();
        }

        return $instance;
    }

    /**
     * Add button on Post Editor
     *
     * @since 1.2.0
     *
     * @param array $plugin_array
     *
     * @return array
     */
    function enqueue_plugin_scripts( $plugin_array ) {
        //enqueue TinyMCE plugin script with its ID.
        $plugin_array["bpsc_button"] =  BPPSC_PLUGIN_URL . "/js/bpsc-tmc-button.js";

        return $plugin_array;
    }

    /**
     * Register tinyMce button
     *
     * @since 1.2.0
     *
     * @param array $buttons
     *
     * @return array
     */
    function register_buttons_editor( $buttons ) {
        //register buttons with their id.
        array_push( $buttons, "bpsc_button" );

        return $buttons;
    }

}

BPSC_Shortcodes_Button::init();
