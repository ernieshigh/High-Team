<?php

/**
 * The core plugin class.
 * 
 * 
 */
class high_team {
 
	protected $loader;
	protected $high_team;
	protected $version;

	 
	public function __construct() {
		if ( defined( 'high_team_version' ) ) {
			$this->version = high_team_version;
		} else {
			$this->version = '0.0.1';
		}
		$this->high_team = 'high-team';

		$this->load_dependencies();
		//$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}
 
	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'inc/class-high-team-loader.php';
		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'inc/class-high-team-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-high-team-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-high-team-public.php';

		$this->loader = new high_team_Loader();

	}


	private function set_locale() {

		$plugin_i18n = new high_team_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}
	
	
	private function define_admin_hooks() {

		$plugin_admin = new high_team_Admin( $this->get_high_team(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}
	
	
	private function define_public_hooks() {

		$plugin_public = new high_team_Public( $this->get_high_team(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}


	public function load() {
		$this->loader->load();
	}


	public function get_high_team() {
		return $this->high_team;
	}
	
	public function get_loader() {
		return $this->loader;
	}
	
	public function get_version() {
		return $this->version;
	}

}
