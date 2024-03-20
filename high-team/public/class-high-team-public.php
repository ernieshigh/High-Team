<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    high_team
 * @subpackage high_team/public
 */ 
 
 
class high_team_Public {
	
	private $high_team;
	private $version;


	public function __construct( $high_team, $version ) {

		$this->high_team = $high_team;
		$this->version = $version;
		
		// create the custom high team post type
		add_action( 'init', array( $this, 'create_high_team' ) );
		
		// add custom taxonomy to high team 
		add_action( 'init', array( $this, 'high_team_roles' ));    

		// add templates for high team		                                               
		add_filter( 'theme_page_templates',  array($this, 'high_add_template_selection'));
		add_filter( 'template_include', array($this, 'add_high_team_template'));
		//add_filter ('page_template', array($this, 'add_high_page_template'));
		
		//add custom fields to high team
		add_action( 'admin_init', array($this, 'add_high_team_meta') );
		
		// save custom fields
		add_action( 'save_post',  array($this, 'save_high_team_meta'));
		 
		add_action( 'after_setup_theme', array( $this, 'high_team_excerpt' ));  
		
	}
	
	// enqueue public styles
	public function enqueue_styles() {

		wp_enqueue_style( 'icons', 'https://fonts.googleapis.com/icon?family=Material+Icons' , false, null);
		wp_enqueue_style( $this->high_team, plugin_dir_url( __FILE__ ) . 'css/high-team-public.css', array(), $this->version, 'all' );

	}
	
	

	// enqueue public js
	public function enqueue_scripts() {


		wp_enqueue_script( $this->high_team, plugin_dir_url( __FILE__ ) . 'js/high-team-public.js', array( 'jquery' ), $this->version, false );

	}
	
	public function create_high_team(){
		register_post_type( 'high_team',
			array(
				'labels' => array(
					'name' => 'High Team',
					'singular_name' => 'High Team Member',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New High Team Member',
					'edit' => 'Edit',
					'edit_item' => 'Edit High Team Member',
					'new_item' => 'New High Team Member',
					'view' => 'View',
					'view_item' => 'View High Team Member',
					'search_items' => 'Search High Team Members',
					'not_found' => 'No High Team Member found',
					'not_found_in_trash' => 'No High Team Members found in Trash', 
				),
				'public' => true,
				'menu_position' => 15,
				'show_in_rest' => true,
				'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ) , 
				'rewrite' => array('slug' => 'high-team-member','with_front' => false),
				'menu_icon' => 'dashicons-admin-users',
				'has_archive' => true
			)
		);
	}
	
	public function high_team_roles() {    
      
		$labels = array(
			'name' => __( 'Roles' , 'high-team' ),
			'singular_name' => __( 'Role', 'high-team' ),
			'search_items' => __( 'Search Roles' , 'high-team' ),
			'all_items' => __( 'All Roles' , 'high-team' ),
			'edit_item' => __( 'Edit Role' , 'high-team' ),
			'update_item' => __( 'Update Roles' , 'high-team' ),
			'add_new_item' => __( 'Add New Role' , 'high-team' ),
			'new_item_name' => __( 'New Role Name' , 'high-team' ),
			'menu_name' => __( 'Roles' , 'high-team' ),
		);
		 
		$args = array(
			'labels' => $labels,
			'hierarchical' => true,
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => array( 'slug' => 'Roles' ),
			'show_admin_column' => true,
			'show_in_rest' => true
	 
		);
		 
		register_taxonomy( 'high_role', array( 'high_team' ), $args);
		 
	}
	
	
	// create custom fields 
	public function add_high_team_meta() {
		add_meta_box( 'high_team_details',
			'High Team Details',
			array($this, 'display_high_team_details'),
			'high_team', 'normal', 'high'
		);
	}
	
	
	public function display_high_team_details($high_team) { 
		$high_team_email = esc_html( get_post_meta( $high_team->ID, 'high_team_email', true ) );
		$high_team_face = esc_html( get_post_meta( $high_team->ID, 'high_team_face', true ) );     
		$high_team_twit = esc_html( get_post_meta( $high_team->ID, 'high_team_twit', true ) );
		$high_team_link = esc_html( get_post_meta( $high_team->ID, 'high_team_link', true ) );    
		$high_team_insta = esc_html( get_post_meta( $high_team->ID, 'high_team_insta', true ) );
	?>
	<table>
		<tr>
			<td style="width: 100%">Email</td>
			<td><input type="email" size="80" name="high_team_email" value="<?php echo $high_team_email; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2">Social</td>
		</tr>
		<tr>
			<td>Team Member Facebook      </td>
				
			<td><input type="text" size="80" name="high_team_face" value="<?php echo $high_team_face; ?>" /></td>
			
		</tr> 
		<tr>
			<td>Team Member Twitter      </td>
				
			<td><input type="text" size="80" name="high_team_twit" value="<?php echo $high_team_twit; ?>" /></td>
			
		</tr>
		<tr>
			<td>Team Member LinkedIn</td>
				
			<td><input type="text" size="80" name="high_team_link" value="<?php echo $high_team_link; ?>" /></td>
			
		</tr>
		<tr>
			<td>Team Member Instagram</td>
				
			<td><input type="text" size="80" name="high_team_insta" value="<?php echo $high_team_insta; ?>" /></td>
			
		</tr>
	</table>
	<?php
}


	public function save_high_team_meta( $high_team_id) {
		// Check post type for movie reviews  
			// Store data in post meta table if present in post data 
			if ( isset( $_POST['high_team_email'] ) && $_POST['high_team_email'] != '' ) {
				update_post_meta( $high_team_id, 'high_team_email', $_POST['high_team_email'] );
			}
			if ( isset( $_POST['high_team_face'] ) && $_POST['high_team_face'] != '' ) {
				update_post_meta( $high_team_id, 'high_team_face', $_POST['high_team_face'] );
			}
			
			if ( isset( $_POST['high_team_twit'] ) && $_POST['high_team_twit'] != '' ) {
				update_post_meta( $high_team_id, 'high_team_twit', $_POST['high_team_twit'] );
			}
			if ( isset( $_POST['high_team_link'] ) && $_POST['high_team_link'] != '' ) {
				update_post_meta( $high_team_id, 'high_team_link', $_POST['high_team_link'] );
			}
			if ( isset( $_POST['high_team_insta'] ) && $_POST['high_team_insta'] != '' ) {
				update_post_meta( $high_team_id, 'high_team_insta', $_POST['high_team_insta'] );
			}
		 
	}
			  
	public function high_add_template_selection( $post_templates) {

		// Add custom template named template-custom.php to select dropdown 
		$post_templates['high-team.php'] = __('High Team');

		return $post_templates;
	}

	
	public function add_high_team_template($template_path){   
		if (get_post_type() == 'high_team' ) {    
			
			if( is_page()){
				
        $meta = get_post_meta(get_the_ID());
				if (!empty($meta['_wp_page_template'][0]) && $meta['_wp_page_template'][0] != $template_path) {
            $template_path = $meta['_wp_page_template'][0];
        }
			}
			if ( is_single() ) { 
				if ( $theme_file = locate_template( array ( 'single-high_team.php' ) ) ) {
				$template_path = $theme_file;
				} else {
					$template_path = plugin_dir_path( __FILE__ ) . 'templates/single-high_team.php';
				}
			}
			
			if( is_archive()) {
				if ( $theme_file = locate_template( array ( 'archive-high_team.php' ) ) ) {
					$template_path = $theme_file;
				} else { 
					$template_path = plugin_dir_path( __FILE__ ) . 'templates/archive-high_team.php';
				}
			}
		}
		return $template_path;   
	}
	
	public function add_high_page_template($template){   
		$post = get_post();
		$page_template = get_post_meta( $post->ID, '_wp_page_template', true );
		if ('high-team.php' == basename ($page_template)) {
			$template =plugin_dir_path( __FILE__ ) . 'templates/high-team.php';
			return $template;
		} 
	}
	
	public function high_team_excerpt($excerpt) {
		remove_all_filters('excerpt_more');
	}			  
}
