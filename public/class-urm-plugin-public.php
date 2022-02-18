<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Urm_Plugin
 * @subpackage Urm_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Urm_Plugin
 * @subpackage Urm_Plugin/public
 * @author     junaidzx90 <admin@easeare.com>
 */
class Urm_Plugin_Public {

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

		add_shortcode( 'urm_profile', [$this, 'urm_profile_view'] );
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
		 * defined in Urm_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Urm_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/urm-plugin-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'urm-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css', array(), $this->version, 'all' );

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
		 * defined in Urm_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Urm_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'urm-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/urm-plugin-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'publicajax', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		) );
	}

	function urm_profile_view(){
		ob_start();
		require_once plugin_dir_path( __FILE__ ).'partials/author-profile.php';
		$output = ob_get_contents();
		ob_get_clean();
		return $output;
	}

	function save_profile_information(){
		global $wpdb,$urmerror;
		if(isset($_POST['save_profile_information'])){
			if(isset($_POST['recipient_id'])){
				$recipient_id = intval($_POST['recipient_id']);

				if(isset($_POST['profile_name'])){
					$profile_name = sanitize_text_field( $_POST['profile_name'] );
					wp_update_user( array( 'ID' => get_current_user_id(  ), 'display_name' => $profile_name ) );
				}
				if(isset($_POST['profile_email'])){
					$profile_email = sanitize_email( $_POST['profile_email'] );
					if($wpdb->get_var("SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = 'recipient_email' AND meta_value = '$profile_email' AND post_id != $recipient_id")){
						if(!empty($profile_email)){
							update_post_meta( $recipient_id, 'urm_error', "<b>$profile_email</b> is already booked for another recipient." );
							delete_post_meta($recipient_id, 'recipient_email');
						}
					}else{
						update_post_meta($recipient_id, 'recipient_email', $profile_email);
					}
				}
				if(isset($_POST['profile_phone'])){
					$profile_phone = intval( $_POST['profile_phone'] );
					update_post_meta($recipient_id, 'recipient_phone', $profile_phone);
				}
				if(isset($_POST['payment_method'])){
					$payment_method = sanitize_text_field( $_POST['payment_method'] );
					update_post_meta($recipient_id, 'payment_way', $payment_method);
				}
				if(isset($_POST['preferred_lang'])){
					$preferred_lang = sanitize_text_field( $_POST['preferred_lang'] );
					update_post_meta($recipient_id, 'preferred_lang', $preferred_lang);
				}
			}
		}
	}

	// Filter documnent
	function filter_document(){
		if(isset($_GET['type']) && isset($_GET['date'])){
			$type = sanitize_text_field( $_GET['type'] );
			$date = sanitize_text_field( $_GET['date'] );
			$date = explode('-', $date);

			$year = $date[0];
			$month = $date[1];
			$day = $date[2];
			
			switch ($type) {
				case 'receipt':
					$args = array(
						'post_type' => 'urmdocument',
						'numberposts' => -1,
						'orderby'          => 'date',
						'order'            => 'DESC',
						'include'          => $docs_ids,
						'meta_key'         => 'docs_type',
						'meta_value'       => 'receipt',
						'fields'           => 'ids',
						'date_query'       => array(
							array(
								'year'  => $year,
								'month' => $month,
								'day'   => $day,
							)
						)
					);
					$document_ids = get_posts($args);
					$data = array();
					if($document_ids){
						foreach($document_ids as $id){
							$doc_file = get_post_meta( $id, 'document_file', true );
							$filename = basename ( get_attached_file( $doc_file ) );
							$fileurl =  wp_get_attachment_url( $doc_file );
							$publish_date = get_the_date( 'm/d/Y', $id );

							$single = array(
								'filename' => $filename,
								'fileurl' => $fileurl,
								'publish_date' => $publish_date
							);

							$data[] = $single;
						}
					}

					echo json_encode(array('success' => $data));
					die;

					break;
				case 'letter':
					$args1 = array(
						'post_type' => 'urmdocument',
						'numberposts' => -1,
						'orderby'          => 'date',
						'order'            => 'DESC',
						'include'          => $docs_ids,
						'meta_key'         => 'docs_type',
						'meta_value'       => 'letters',
						'fields'           => 'ids',
						'date_query'       => array(
							array(
								'year'  => $year,
								'month' => $month,
								'day'   => $day,
							)
						)
					);
					$letters_ids = get_posts($args1);

					$data = array();
					if($letters_ids){
						foreach($letters_ids as $id){
							$doc_file = get_post_meta( $id, 'document_file', true );
							$filename = basename ( get_attached_file( $doc_file ) );
							$fileurl =  wp_get_attachment_url( $doc_file );
							$publish_date = get_the_date( 'm/d/Y', $id );

							$single = array(
								'filename' => $filename,
								'fileurl' => $fileurl,
								'publish_date' => $publish_date
							);

							$data[] = $single;
						}
					}

					echo json_encode(array('success' => $data));
					die;
					break;
				case 'tax':
					$args2 = array(
						'post_type' => 'urmdocument',
						'numberposts' => -1,
						'orderby'          => 'date',
						'order'            => 'DESC',
						'include'          => $docs_ids,
						'meta_key'         => 'docs_type',
						'meta_value'       => 'tax_documents',
						'fields'           => 'ids',
						'date_query'       => array(
							array(
								'year'  => $year,
								'month' => $month,
								'day'   => $day,
							)
						)
					);
					$taxs_ids = get_posts($args2);

					$data = array();
					if($taxs_ids){
						foreach($taxs_ids as $id){
							$doc_file = get_post_meta( $id, 'document_file', true );
							$filename = basename ( get_attached_file( $doc_file ) );
							$fileurl =  wp_get_attachment_url( $doc_file );
							$publish_date = get_the_date( 'm/d/Y', $id );

							$single = array(
								'filename' => $filename,
								'fileurl' => $fileurl,
								'publish_date' => $publish_date
							);

							$data[] = $single;
						}
					}

					echo json_encode(array('success' => $data));
					die;
					break;
				default:
					# code...
					break;
			}
			die;
		}
		die;
	}
}
