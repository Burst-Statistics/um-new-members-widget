<?php
defined('ABSPATH') or die("you do not have acces to this page!");

class umnm_enqueue {

	function __construct() {

		add_action('wp_enqueue_scripts',  array(&$this, 'wp_enqueue_scripts'), 0);

	}

	function wp_enqueue_scripts(){

		wp_register_style('um_new_members', um_new_members_url . 'assets/css/umnm.css', array(), um_new_members_version );
		wp_enqueue_style('um_new_members');

	}

}
