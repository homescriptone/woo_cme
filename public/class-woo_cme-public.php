<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Woo_cme
 * @subpackage Woo_cme/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woo_cme
 * @subpackage Woo_cme/public
 * @author     HomeScript <homescript1@gmail.com>
 */
class Woo_cme_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_cme_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_cme_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo_cme-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_cme_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_cme_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo_cme-public.js', array( 'jquery' ), $this->version, false );

	}

	public function add_custom_endpoint(){
		add_rewrite_endpoint( 'produits', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'vip', EP_ROOT | EP_PAGES );
		flush_rewrite_rules();
	}

	public function custom_endpoint_query_vars($vars){
		$vars[] = 'produits';
		$vars[] = 'vip';
    	return $vars;
	}

	public function add_my_account_link($items){
		$items =  array(
			'dashboard'          => __( 'Bienvenue' ),
			'produits'           => __('Mes Produits'),
			'edit-account'    	=> __( 'Details du compte' ),
			'vip'	=> __('Passer à Pro'),
		   	'customer-logout'    => __( 'Se déconnecter' ),
		);
    	return $items;
	}

	public function render_produits_page(){
		echo "welcome";
	}

	public function render_vip_page(){
		echo "welcome";
	}

}
