<?php
class TCMCoupons {

	protected static $instance = null;

	protected function __construct() {
		add_action( 'init', 'create_post_type', 0 );
	}

	public static function getInstance() {
		if($instance == null)
		{
			$instance = new TCMCoupons();
		}
		return $instance;
	}

	public static function active() {
		if(version_compare($GLOBALS['wp_version'], TCM_COUPON_VERSION, '<')) {
			die('Minimum WP version is:' . TCM_COUPON_VERSION);
		}
	}	

	public static function deactive() {

	}

	public static function setup() {
		//register post type
		add_action('init', array('TCMCoupons', 'create_post_type'));

		//register texonamy
		add_action('init', array('TCMCoupons', 'custom_taxonomy'));
		add_action('store_add_form_fields', array('TCMCoupons', 'store_taxonomy_add_field_linkaff'));

		//register meta box for coupon
		add_action('add_meta_boxes', array('TCMCoupons', 'add_meta_box'));
		add_action('edit_form_after_title',  array('TCMCoupons', 'move_meta_box'));


		add_action('admin_enqueue_scripts', array('TCMCoupons', 'custom_admin_style'));
		add_action('save_post', array('TCMCoupons', 'save_post_meta'));

		add_action('wp_enqueue_scripts', array('TCMCoupons', 'tcm_coupons_style'), 12);

	}
	
	// Register Custom Post Type
	public static function create_post_type() {	
		$labels = array(
			'name'                  => _x( 'Coupons', 'Post Type General Name', 'tcm-coupons' ),
			'singular_name'         => _x( 'Coupon', 'Post Type Singular Name', 'tcm-coupons' ),
			'menu_name'             => __( 'Coupons', 'tcm-coupons' ),
			'name_admin_bar'        => __( 'Coupons', 'tcm-coupons' ),
			'archives'              => __( 'Item Archives', 'tcm-coupons' ),
			'attributes'            => __( 'Item Attributes', 'tcm-coupons' ),
			'parent_item_colon'     => __( 'Parent Item:', 'tcm-coupons' ),
			'all_items'             => __( 'All Items', 'tcm-coupons' ),
			'add_new_item'          => __( 'Add New Item', 'tcm-coupons' ),
			'add_new'               => __( 'Add New', 'tcm-coupons' ),
			'new_item'              => __( 'New Item', 'tcm-coupons' ),
			'edit_item'             => __( 'Edit Item', 'tcm-coupons' ),
			'update_item'           => __( 'Update Item', 'tcm-coupons' ),
			'view_item'             => __( 'View Item', 'tcm-coupons' ),
			'view_items'            => __( 'View Items', 'tcm-coupons' ),
			'search_items'          => __( 'Search Item', 'tcm-coupons' ),
			'not_found'             => __( 'Not found', 'tcm-coupons' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'tcm-coupons' ),
			'featured_image'        => __( 'Featured Image', 'tcm-coupons' ),
			'set_featured_image'    => __( 'Set featured image', 'tcm-coupons' ),
			'remove_featured_image' => __( 'Remove featured image', 'tcm-coupons' ),
			'use_featured_image'    => __( 'Use as featured image', 'tcm-coupons' ),
			'insert_into_item'      => __( 'Insert into item', 'tcm-coupons' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'tcm-coupons' ),
			'items_list'            => __( 'Items list', 'tcm-coupons' ),
			'items_list_navigation' => __( 'Items list navigation', 'tcm-coupons' ),
			'filter_items_list'     => __( 'Filter items list', 'tcm-coupons' ),
		);
		$args = array(
			'label'                 => __( 'Coupon', 'tcm-coupons' ),
			'description'           => __( 'TCM Coupons', 'tcm-coupons' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'author', /*'custom-fields',*/ ),
			'taxonomies'            => array( 'store' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'coupon', $args );
	}

	// Register Custom Taxonomy
	public static function custom_taxonomy() {

		$labels = array(
			'name'                       => _x( 'Stores', 'Taxonomy General Name', 'tcm-coupons' ),
			'singular_name'              => _x( 'Store', 'Taxonomy Singular Name', 'tcm-coupons' ),
			'menu_name'                  => __( 'Stores', 'tcm-coupons' ),
			'all_items'                  => __( 'All Items', 'tcm-coupons' ),
			'parent_item'                => __( 'Parent Item', 'tcm-coupons' ),
			'parent_item_colon'          => __( 'Parent Item:', 'tcm-coupons' ),
			'new_item_name'              => __( 'New Item Name', 'tcm-coupons' ),
			'add_new_item'               => __( 'Add New Item', 'tcm-coupons' ),
			'edit_item'                  => __( 'Edit Item', 'tcm-coupons' ),
			'update_item'                => __( 'Update Item', 'tcm-coupons' ),
			'view_item'                  => __( 'View Item', 'tcm-coupons' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'tcm-coupons' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'tcm-coupons' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'tcm-coupons' ),
			'popular_items'              => __( 'Popular Items', 'tcm-coupons' ),
			'search_items'               => __( 'Search Items', 'tcm-coupons' ),
			'not_found'                  => __( 'Not Found', 'tcm-coupons' ),
			'no_terms'                   => __( 'No items', 'tcm-coupons' ),
			'items_list'                 => __( 'Items list', 'tcm-coupons' ),
			'items_list_navigation'      => __( 'Items list navigation', 'tcm-coupons' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'rewrite'                    => false,
		);
		register_taxonomy( 'store', array( 'coupon' ), $args );
	}

	public static function store_taxonomy_add_field_linkaff() {
		
		echo '<div class="form-field">
			<label for="term_meta[class_term_meta]">' . __( 'Affiliate Link', 'tcm-coupons' ) . '</label>
			<input type="text" name="term_meta[class_term_meta]" id="term_meta[class_term_meta]" value="">
			<p class="description">' . __( 'Enter affiliate link for this store','tcm-coupons' ) . '</p>
		</div>'	;
	}

	public static function add_meta_box() {
		add_meta_box('coupon_details', __('Coupon Details', 'tcm-coupons'), array('TCMCoupons', 'coupon_details_callback'), 'coupon', 'coupon_location', 'high');
	}

	public static function save_post_meta() {
		global $post;
		if(isset($_POST['coupon_code_field']) && !wp_verify_nonce($_POST['coupon_code_field'], 'save_coupon_code')) {
			die('Error Nonce Field');
		}

		//save meta
		if(array_key_exists('coupon', $_POST)) {
			$coupon = $_POST['coupon'];
			update_post_meta($post->ID, 'coupon_details', $coupon);	

			$coupon_exp = $_POST['coupon_exp'];
			update_post_meta($post->ID, 'coupon_exp', $coupon_exp);	
		}
	}

	public static function move_meta_box() {
	    # Get the globals:
	    global $post, $wp_meta_boxes;

	    # Output the "advanced" meta boxes:
	    do_meta_boxes(get_current_screen(), 'coupon_location', $post);

	    # Remove the initial "advanced" meta boxes:
	    unset($wp_meta_boxes['post']['coupon_location']);

	}

	public static function coupon_details_callback() {
		global $post;
		$coupon = get_post_meta($post->ID, 'coupon_details', true);
		$coupon_exp = get_post_meta($post->ID, 'coupon_exp', true);
		include (TCM_COUPON_DIR . 'templates/metabox.php');
	}

	public static function custom_admin_style() {
		wp_enqueue_style('tcm-coupons-admin-style', TCM_COUPON_URL . 'css/admin.css');
		wp_enqueue_style('jquery-ui-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
		wp_enqueue_script('tcm-coupons-admin-script', TCM_COUPON_URL . 'js/admin.js', array('jquery', 'jquery-ui-datepicker'));
	}

	public static function tcm_coupons_style() {
		wp_enqueue_style('tcm-coupons-style', TCM_COUPON_URL . 'css/style.css', array('parent-style'));
	}

}