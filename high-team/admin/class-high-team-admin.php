<?php

/***
	* The admin functionality for High Team plugin
	* Defines the plugin name, version, and two examples hooks for how to
	* enqueue the admin-specific stylesheet and JavaScript.
	* @package    high_team
	* @subpackage high_team/admin
	* @author    ernie
***/

class high_team_Admin {

	
	private $high_team;
	private $version;
	
	
	public function __construct( $high_team, $version ) {

		$this->high_team = $high_team;
		$this->version = $version;

	}


	// enqueu admin styles 
	public function enqueue_styles() {

		
		wp_enqueue_style( $this->high_team, plugin_dir_url( __FILE__ ) . 'css/high-team-admin.css', array(), $this->version, 'all' );

	}

	
	// enqueue admin JS
	public function enqueue_scripts() {

		wp_enqueue_script( $this->high_team, plugin_dir_url( __FILE__ ) . 'js/high-team-admin.js', array(), $this->version, false );

	}

}
