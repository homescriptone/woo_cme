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

	private $_user_obj;

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
		$this->_user_id =  get_current_user_id();

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
		add_rewrite_endpoint( 'ajouter-produit', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'produits', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'vip', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'bienvenue', EP_ROOT | EP_PAGES );
		flush_rewrite_rules();
	}

	public function custom_endpoint_query_vars($vars){
		$vars[] = 'bienvenue';
		$vars[] = 'produits';
		$vars[] = 'ajouter-produit';
		$vars[] = 'vip';
    	return $vars;
	}

	public function add_my_account_link($items){
		$items =  array(
			'bienvenue'          => __( 'Bienvenue' ),
			'ajouter-produit'          => __( 'Ajouter un Produit' ),
			'produits'           => __('Mes Produits'),
			'edit-account'    	=> __( 'Details du compte' ),
			'vip'	=> __('Passer à Pro'),
		   	'customer-logout'    => __( 'Se déconnecter' ),
		);
    	return $items;
	}

	public function render_produits_page(){
		?>
		<table style="width:100%">
			<tr>
			<th>Nom du produit</th>
			<th>Options</th>
			
			</tr>
			<tr>
			<td>Jill</td>
			<td>Modifier &nbsp &nbsp Supprimer</td>
			
			</tr>
	  	</table>
		<?php
	}

	public function render_vip_page(){
		?>
			Passez en version pro afin de bénéficier d'un accès plus fluide à toute nos fonctionalités

		<?php
	}

	public function render_bienvenue_page(){
	
		$full_name =$this->_user_obj->display_name;
		?>
		<div class="woo_cme_dashboard wrap">
			Bienvenue Mr/Mme <strong><?php echo esc_attr($full_name); ?></strong><br/>
		</div>
		<?php
		do_action('woo_cme_add_after_bienvenue');
	}

	public function render_ajouter_produit_page(){
	
		
		?>
		<form method="post" id="woo_cme_ajouter_produit" enctype="multipart/form-data">
			<div class="woo_cme_ajouter_produit wrap">
				Veuillez fournir l'essentiel des informations afin de sauvegarder votre produit.<br/>
				<br/>
				<?php
					homescript_input_fields(
						'product_name',
						array(
							'type'        => 'text',
							'required'    => true,
							'label' =>  _e( '<strong> Nom du produit : </strong> ' ),
							'placeholder' => "Christian Louboutin" ,
							'description' => __("Veuillez renseigner le nom du produit."),
						)
					);

					homescript_input_fields(
						'product_description',
						array(
							'type'        => 'textarea',
							'required'    => true,
							'label' =>  _e( '<strong>Description du produit : </strong> ' ),
							'description' => __("Décrivez votre produit.")
						)
					);

					homescript_input_fields(
						'product_quantity_available',
						array(
							'type'        => 'number',
							'required'    => true,
							'label' =>  _e( '<strong>Quantité disponible : </strong> ' ),
							'placeholder' => "1" ,
							'description' => __("Veuillez renseignez la quantité disponible.")
						)
					);

					homescript_input_fields(
						'product_price',
						array(
							'type'        => 'number',
							'required'    => true,
							'label' =>  _e( '<strong>Prix de vente : </strong> ' ),
							'placeholder' => "1" ,
							'description' => __("Veuillez renseignez le prix de vente."),
							'custom_attributes' => array('required' => true)
						)
					);

					homescript_input_fields(
						'product_type',
						array(
							'type'        => 'text',
							'required'    => true,
							'label' =>  _e( '<strong>Type de produit : </strong> ' ),
							'placeholder' => "habits,chaussures" ,
							'description' => __("Vous pouvez séparé les types par une virgule."),
							'custom_attributes' => array('required')
						)
					);		
				?> 
				<label for="product_image"> Image du produit : </label>
				<input type="file" name="product_image" id="product_image"  multiple="false" />
				<br/>
				<button id="save_product" name="woo_cme_save_product" type="submit" class="button-primary button-large" >Sauvegarder le produit</button> 

			</div>
		</form>
		<?php
		do_action('woo_cme_ajouter_produit');
	}

	public function save_product(){
		var_dump($_POST['woo_cme_save_product']);
		if (isset($_POST["woo_cme_save_product"])){
			$_product_name = sanitize_text_field($_POST['product_name']);
			$_product_price = sanitize_text_field($_POST['product_price']);
			$_product_description = sanitize_text_field($_POST['product_description']);
			$_product_quantity_available = sanitize_text_field($_POST['product_quantity_available']);
			$_product_type = sanitize_text_field($_POST['product_type']);
			$_product_image = $_FILES['product_image'];


			var_dump($_product_image);
			// $data = $_POST['woo_cme_add_product'];
			// var_dump($_POST["woo_cme_add_product"]);
		}
	}
}
