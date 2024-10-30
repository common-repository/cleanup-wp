<?php
/**
 * Plugin Name: CleanUp WP 
 * Plugin URI: http://wptricks.dk/cleanup-wp-plugin?lang=en
 * Description: Let this plugin clean up everything on your fresh WordPress install! It will remove example content, set permalinks, remove widgets, delete unused plugins and themes and sets robots.txt! One click, and you're done!
 * Author: Aris Kuckovic
 * Author URI: http://wptricks.dk/
 * Version: 1.3
 * License: GPLv2 or later
 */

// No direct access, please!
if( !defined('ABSPATH')) {
	// Feel free to show yourself out
	exit;
}

// Delete all premade content

	function cleanupwp_remove_premade_content() {

		if(!get_post_status(1)) {
			// The post is already deleted, let´s not do anything here then...
		} else {
			wp_delete_post(1);
		}

		if(!get_post_status(2)) {
			// The premade page is aldready deleted, let´s not do anything here then...
		} else {
			wp_delete_post(2);
		}

	}

// Make some prettier permalinks

	function cleanupwp_prettier_permalinks() {

		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure('/%postname%/');
		$wp_rewrite->flush_rules();

	}

// Delete Hello Dolly plugin & Akismet

	function cleanupwp_delete_dolly() {
		// Let´s avoid the header already sent error
		$plugins = array('hello.php', 'akismet/akismet.php');
		// Now, let´s delete Dolly
		delete_plugins($plugins);

	}

// Delete all unused themes

	function cleanupwp_delete_unused_themes() {

		// First of all, let´s get all the installed themes
		$all_themes = wp_get_themes();

		// Now, let´s get the current theme
		$current_theme = wp_get_theme();
		$current_theme_name = $current_theme->get('TextDomain'); 

		// Let´s avoid an array-error in the backend
		$dont_delete = array($current_theme_name); 

		// Let´s check if its a child-theme we´re using
		if( is_child_theme() ) {

			$class = 'notice notice-error';
			$message = __( '<strong>You´re using a child-theme! No themes we´re deleted</strong>.');

			printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 

		} else {

			// Okay, let´s split them up
			foreach ($all_themes as $theme) {

				// Get the name of the themes here
				$single_theme = $theme->get_template();

				// If the name does NOT match the name of the theme thats not supposed to be deleted - we delete it!
				if(!in_array($single_theme, $dont_delete)) {

					// Prepare the theme for delete!
					$prepare_delete = $theme->get_stylesheet();

					// Aaaand we delete it!
					delete_theme($prepare_delete, false);

				}

			}

		}

	}

// Let´s remove all widgets

	function cleanupwp_remove_widgets() {

	    if (!get_option('cleared_widgets')) {	

	    	// First, let´s empty the sidebar(s)
	    	update_option('sidebars_widgets', array());		

	    	// Now, let´s set the cleared to "true"		
	    	update_option('cleared_widgets', true);	

	    }
	    
	}

// Let´s create a simple menu, with a "home" link

	function cleanupwp_create_navigation() {

	    $menu_name = 'Main Menu';
	    $menu_exists = wp_get_nav_menu_object($menu_name);

	    // If the menu does not exist, let´s create it!
	    if(!$menu_exists) {

	    	$menu_id = wp_create_nav_menu($menu_name);

	    	// Okay, so far so good, now, let´s create a "home" item
	    	wp_update_nav_menu_item($menu_id, 0, array(
	    		'menu-item-title' => __('Home'),
	    		'menu-item-classes' => 'home',
	    		'menu-item-url' => home_url('/'),
	    		'menu-item-status' => 'publish'));
	    }

	}

// Let´s activate robots.txt for the website

	function cleanupwp_activate_robots() {

		update_option('blog_public', '0');

	}

// Let´s disable the comments on the site

	function cleanupwp_disable_comments() {

		update_option('default_comment_status ', 'closed');
		update_option('default_ping_status', 'closed');

	}

// Let´s rename "Uncategorized" to something more useful

	function cleanupwp_rename_category() {

		wp_update_term(1, 'category', array(
		  'name' => 'News',
		  'slug' => 'news'
		));

	}

// Let´s disable user-registration by default

	function cleanupwp_disable_registration() {

		update_option('users_can_register', '0');

	}

// Let the user know, the plugin has finished cleaning

	function cleanupwp_finished() {

		$class = 'notice notice-warning';
		$message = __( '<strong>CleanUp WP</strong> has finished! Please delete the plugin before you proceed.');

		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 

	}

// Call all the actions below
	
	// Let´s call this hook once - we don´t wanna mess too much with the .htaccess file
	register_activation_hook(__FILE__, 'cleanupwp_prettier_permalinks');
	
	// Let the magic happen!
	add_action('admin_init', 'cleanupwp_remove_premade_content');
	add_action('admin_init', 'cleanupwp_delete_dolly');
	add_action('admin_init', 'cleanupwp_delete_unused_themes');
	add_action('admin_init', 'cleanupwp_remove_widgets');
	add_action('admin_init', 'cleanupwp_create_navigation');
	add_action('admin_init', 'cleanupwp_activate_robots');
	add_action('admin_init', 'cleanupwp_disable_comments');
	add_action('admin_init', 'cleanupwp_rename_category');
	add_action('admin_init', 'cleanupwp_disable_registration');

	// Aaaand let the user know, that we finished cleaning!
	add_action('admin_notices', 'cleanupwp_finished');


?>