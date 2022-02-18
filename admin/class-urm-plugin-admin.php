<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Urm_Plugin
 * @subpackage Urm_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Urm_Plugin
 * @subpackage Urm_Plugin/admin
 * @author     junaidzx90 <admin@easeare.com>
 */
class Urm_Plugin_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		if ( ! wp_next_scheduled( 'urm_reception_cron_hook' ) ) {
			wp_schedule_event( time(), 'once_daily', 'urm_reception_cron_hook');
		}
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/urm-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/urm-plugin-admin.js', array( 'jquery' ), $this->version, false );
		
	}

	function users_list(){
		$labels = array(
			'name'                  => __( 'Receptions', 'urm-plugin' ),
			'singular_name'         => __( 'Recipient', 'urm-plugin' ),
			'menu_name'             => __( 'Receptions', 'urm-plugin' ),
			'name_admin_bar'        => __( 'Receptions', 'urm-plugin' ),
			'add_new'               => __( 'New recipient', 'urm-plugin' ),
			'add_new_item'          => __( 'New recipient', 'urm-plugin' ),
			'new_item'              => __( 'New recipient', 'urm-plugin' ),
			'edit_item'             => __( 'Edit recipient', 'urm-plugin' ),
			'view_item'             => __( 'View recipient', 'urm-plugin' ),
			'all_items'             => __( 'Recipients', 'urm-plugin' ),
			'search_items'          => __( 'Search recipients', 'urm-plugin' ),
			'parent_item_colon'     => __( 'Parent recipients:', 'urm-plugin' ),
			'not_found'             => __( 'No recipients found.', 'urm-plugin' ),
			'not_found_in_trash'    => __( 'No recipients found in Trash.', 'urm-plugin' )
		);
		$args = array(
			'labels'             => $labels,
			'description'        => 'recipients custom post type.',
			'public'             => true,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'recipients' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 45,
			'menu_icon'      	 => 'dashicons-admin-users',
			'supports'           => array( 'title' ),
			'show_in_rest'       => false
		);
		  
		register_post_type( 'recipient', $args );


		$labels = array(
			'name'                  => __( 'Documents', 'urm-plugin' ),
			'singular_name'         => __( 'Document', 'urm-plugin' ),
			'menu_name'             => __( 'URM Member', 'urm-plugin' ),
			'name_admin_bar'        => __( 'Documents', 'urm-plugin' ),
			'add_new'               => __( 'New document', 'urm-plugin' ),
			'add_new_item'          => __( 'New document', 'urm-plugin' ),
			'new_item'              => __( 'New document', 'urm-plugin' ),
			'edit_item'             => __( 'Edit document', 'urm-plugin' ),
			'view_item'             => __( 'View document', 'urm-plugin' ),
			'all_items'             => __( 'Documents', 'urm-plugin' ),
			'search_items'          => __( 'Search documents', 'urm-plugin' ),
			'parent_item_colon'     => __( 'Parent documents:', 'urm-plugin' ),
			'not_found'             => __( 'No documents found.', 'urm-plugin' ),
			'not_found_in_trash'    => __( 'No documents found in Trash.', 'urm-plugin' )
		);     
		$args = array(
			'labels'             => $labels,
			'description'        => 'documents custom post type.',
			'public'             => true,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => 'edit.php?post_type=recipient',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'documents' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_icon'      	 => '',
			'supports'           => array( 'title' ),
			'show_in_rest'       => false
		);
		
		register_post_type( 'urmdocument', $args );
	}

	// Admin menu
	function urm_admin_menu() {
		add_submenu_page( 'edit.php?post_type=recipient', 'Settings', 'Settings', 'manage_options', 'urm-settings', [$this, 'urm_settings_cb'] );
		add_settings_section( 'recipient_opt_section', '', '', 'recipient_opt_page' );
		// Email Logo
		add_settings_field( 'recipient_email_logo', 'Email Logo', [$this, 'recipient_email_logo_cb'], 'recipient_opt_page','recipient_opt_section' );
		register_setting( 'recipient_opt_section', 'recipient_email_logo' );
		// Email Subject
		add_settings_field( 'recipient_email_subject', 'Email Subject', [$this, 'recipient_email_subject_cb'], 'recipient_opt_page','recipient_opt_section' );
		register_setting( 'recipient_opt_section', 'recipient_email_subject' );
		// Email template
		add_settings_field( 'recipient_email_template', 'Email template', [$this, 'recipient_email_template_cb'], 'recipient_opt_page','recipient_opt_section' );
		register_setting( 'recipient_opt_section', 'recipient_email_template' );
		// Email footer
		add_settings_field( 'recipient_email_footer', 'Email footer', [$this, 'recipient_email_footer_cb'], 'recipient_opt_page','recipient_opt_section' );
		register_setting( 'recipient_opt_section', 'recipient_email_footer' );
		// Profile Shortcode
		add_settings_field( 'recipient_profile_shortcode', 'Profile Shortcode', [$this, 'recipient_profile_shortcode_cb'], 'recipient_opt_page','recipient_opt_section' );
		register_setting( 'recipient_opt_section', 'recipient_profile_shortcode' );
		// Enable login/logout in menu
		add_settings_field( 'enable_login_logout_in_menu', 'Enable login/logout in menu', [$this, 'enable_login_logout_in_menu_cb'], 'recipient_opt_page','recipient_opt_section' );
		register_setting( 'recipient_opt_section', 'enable_login_logout_in_menu' );
	}

	// URM Setting
	function urm_settings_cb(){
		?>
		<div class="recipients-settings">
			<h3>Settings</h3>
			<hr>
            <form method="post" action="options.php">
                <table class="widefat">
                    <?php
                    settings_fields( 'recipient_opt_section' );
                    do_settings_fields('recipient_opt_page', 'recipient_opt_section' );
                    ?>
                </table>
                <?php submit_button(  ); ?>
            </form>		
		</div>
		
		<?php
	}

	// Email logo
	function recipient_email_logo_cb(){
		echo '<input type="url" class="widefat" name="recipient_email_logo" placeholder="Logo URL" value="'.get_option('recipient_email_logo').'">';
	}

	// Email sub
	function recipient_email_subject_cb(){
		echo '<input type="text" name="recipient_email_subject" placeholder="Reception" value="'.get_option('recipient_email_subject').'">';
	}

	// Enable login/logout
	function enable_login_logout_in_menu_cb(){
		echo '<input type="checkbox" name="enable_login_logout_in_menu" '.((get_option('enable_login_logout_in_menu') === 'on') ? 'checked' : '').'>';
	}

	// Email template
	function recipient_email_template_cb(){
		echo wp_editor( wpautop( html_entity_decode(get_option('recipient_email_template')), true ), 'recipient_email_template', array( 
			'media_buttons' => false,
			'editor_height' => 100,
			'textarea_rows' => 20, 
		) );
		echo 'Use these placeholders to show recipients data: <code>%%name%%</code>, <code>%%email%%</code>, <code>%%sponsor_id%%</code>, <code>%%file%%</code>';
	}

	// Email footer
	function recipient_email_footer_cb(){
		echo wp_editor( wpautop( html_entity_decode(get_option('recipient_email_footer')), true ), 'recipient_email_footer', array( 
			'media_buttons' => false,
			'editor_height' => 100,
			'textarea_rows' => 20, 
		) );
	}

	// Profile shortcode
	function recipient_profile_shortcode_cb(){
		echo '<code>[urm_profile]</code>';
	}

	// Overrides predefined texts
	function eser_translation_mangler($translation, $text, $domain) {
        global $post;

		if (get_post_type( $post ) == 'recipient') {
			if ( $text == 'Publish' )
				return 'Save Recipient';
			if ( $text == 'Update' )
				return 'Update Recipient';
			if ( $text == 'Post updated.' )
				return 'Recipient Updated.';
			if ( $text == 'Post published.' )
				return 'Recipient Added.';
			if ( $text == 'Add title' )
				return 'Sponsor ID';
			return $translation;
		}

		if (get_post_type( $post ) == 'urmdocument') {
			if ( $text == 'Publish' )
				return 'Save Document';
			if ( $text == 'Update' )
				return 'Update Document';
			if ( $text == 'Post updated.' )
				return 'Document Updated.';
			if ( $text == 'Post published.' )
				return 'Document Added.';
			if ( $text == 'Add title' )
				return 'Document name';
			return $translation;
		}
	
		return $translation;
	}

	// Manage table columns
	function manage_urmdocument_columns($columns) {
		unset(
			$columns['title'],
			$columns['date']
		);
	
		$new_columns = array(
			'title' => __('Document name', 'urm-plugin'),
			'sponsor_id' => __('Sponsor id', 'urm-plugin'),
			'docs_type' => __('Document Type', 'urm-plugin'),
			'doc_file' => __('Document', 'urm-plugin'),
			'docs_lang' => __('Language', 'urm-plugin'),
			'date' => __('Uploaded', 'urm-plugin'),
		);
	
		return array_merge($columns, $new_columns);
	}

	// View custom column data
	function manage_urmdocument_columns_views($column_id, $post_id){
		$recipient_ids = get_post_meta($post_id, 'docs_recipients');
		switch ($column_id) {
			case 'sponsor_id':
				if(is_array($recipient_ids) && sizeof($recipient_ids) === 1){
					$sponsor_id = get_the_title( $recipient_ids[0] );
					echo $sponsor_id;
				}else{
					if(is_array($recipient_ids) && sizeof($recipient_ids) > 1){
						echo 'Multi reciepts';
					}
				}
				break;
			case 'docs_type':
				$docs_type = get_post_meta($post_id, 'docs_type', true);
				switch ($docs_type) {
					case 'letters':
						echo 'Letter';
						break;
					case 'receipt':
						echo 'Receipt';
						break;
					case 'tax_documents':
						echo 'Tax';
						break;
					
					default:
						# code...
						break;
				}
				
				break;
			case 'doc_file':
				$document_file = get_post_meta($post_id, 'document_file', true);
				if(!empty($document_file)){
					$filename = basename ( get_attached_file( $document_file ) );
					echo '<a target="_blank" href="'.wp_get_attachment_url( $document_file ).'">'.$filename.'</a>';
				}
				break;
			case 'docs_lang':
				global $urmlangs;
				$docs_lang = get_post_meta($post_id, 'docs_lang', true);
				if(array_key_exists($docs_lang, $urmlangs)){
					echo $urmlangs[$docs_lang];
				}
				break;
			default:
				# code...
				break;
		}
	}

	// Manage table columns
	function manage_recipient_columns($columns) {
		unset(
			$columns['title'],
			$columns['date']
		);
	
		$new_columns = array(
			'title' => __('Sponsor ID', 'urm-plugin'),
			'user_account' => __('User Account', 'urm-plugin'),
			'recipient_email' => __('Email', 'urm-plugin'),
			'recipient_phone' => __('Phone', 'urm-plugin'),
			'recipient_payment' => __('Payment', 'urm-plugin'),
			'recipient_lang' => __('Language', 'urm-plugin'),
			'date' => __('Joined', 'urm-plugin'),
		);
	
		return array_merge($columns, $new_columns);
	}

	// View custom column data
	function manage_recipient_columns_views($column_id, $post_id){
		switch ($column_id) {
			case 'user_account':
				$recipient_account = get_post_meta($post_id, 'recipient_account', true);
				if($recipient_account){
					$user = get_user_by( 'ID', $recipient_account );
					echo $user->display_name;
				}
				break;
			case 'recipient_email':
				$recipient_email = get_post_meta($post_id, 'recipient_email', true);
				if($recipient_email){
					echo '<a href="mailto:'.$recipient_email.'">'.$recipient_email.'</a>';
				}else{
					$recipient_account = get_post_meta($post_id, 'recipient_account', true);
					if($recipient_account){
						$user = get_user_by( 'ID', $recipient_account );
						echo '<a href="mailto:'.$user->user_email.'">'.$user->user_email.'</a>';
					}
				}
				break;
			case 'recipient_phone':
				$recipient_phone = get_post_meta($post_id, 'recipient_phone', true);
				echo '<a href="tel:'.$recipient_phone.'">'.$recipient_phone.'</a>';
				break;
			case 'recipient_payment':
				$payment_way = get_post_meta($post_id, 'payment_way', true);
				echo ucfirst($payment_way);
				break;
			case 'recipient_lang':
				global $urmlangs;
				$preferred_lang = get_post_meta($post_id, 'preferred_lang', true);
				if(array_key_exists($preferred_lang, $urmlangs)){
					echo $urmlangs[$preferred_lang];
				}
				break;
			default:
				# code...
				break;
		}
	}
	
	// Add meta boxes
	function urmdocument_meta_boxes(){
		global $wp_meta_boxes;
		unset($wp_meta_boxes['urmdocument']);

		add_meta_box( 'submitdiv', 'Save Member', 'post_submit_meta_box', 'urmdocument', 'side' );
		add_meta_box( 'docs4user', 'Recipients', [$this, 'docs_user_accounts'], 'urmdocument', 'advanced' );
		add_meta_box( 'language', 'Language', [$this, 'language_meta_cb'], 'urmdocument', 'side' );
		add_meta_box( 'doc_type', 'Document type', [$this, 'doc_type_meta_cb'], 'urmdocument', 'side' );
		add_meta_box( 'sent_alert', 'Sent Message', [$this, 'sent_alert_meta_cb'], 'urmdocument', 'side' );
		add_meta_box( 'document', 'Document', [$this, 'document_meta_cb'], 'urmdocument', 'advanced' );

		unset($wp_meta_boxes['recipient']);

		add_meta_box( 'submitdiv', 'Save Member', 'post_submit_meta_box', 'recipient', 'side' );
		add_meta_box( 'user_informations', 'Informations', [$this, 'user_informations_cb'], 'recipient', 'advanced' );
	}


	// Member
	function docs_user_accounts($post){
		$args = array(
			'numberposts'      => -1,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'recipient',
			'post_status' 	   => 'publish'
		);
		$recipients = get_posts($args);
		if($recipients){
			$selected_recipient = get_post_meta($post->ID, 'docs_recipients');
			if(!is_array($selected_recipient)){
				$selected_recipient = array();
			}
			echo '<select name="docs_recipients[]" multiple id="docs_recipients">';
				foreach($recipients as $recipient){
					$account = null;
					$recipient_account = get_post_meta($recipient->ID, 'recipient_account', true);
					if($recipient_account){
						$user = get_user_by( 'ID', $recipient_account );
						$account = $user->display_name;
					}
					echo '<option '.((in_array($recipient->ID, $selected_recipient )) ? 'selected' : '').' value="'.$recipient->ID.'">'.$recipient->post_title.' ( '.$account.' )</option>';
				}
			echo '</select>';
		}
	}
	// Language
	function language_meta_cb($post){
		$selected = get_post_meta($post->ID, 'docs_lang', true);

		$args = array(
            'id'                          => 'docs_lang',
            'name'                        => 'docs_lang',
            'selected'                    => $selected,
            'echo'                        => 1,
            'show_available_translations' => true,
            'show_option_site_default'    => false,
            'show_option_en_us'           => true,
            'explicit_option_en_us'       => true,
        );

		wp_dropdown_languages($args);
		echo '<p>Note: The message will be sent if the document language contains selected recipients.</p>';
	}
	// Recipients
	function doc_type_meta_cb($post){
		$docs_type = get_post_meta($post->ID, 'docs_type', true);
		echo '<select class="widefat" name="docs_type" id="docs_type">';
		echo '<option value="">Select</option>';
		echo '<option '.(($docs_type === 'receipt') ? 'selected' : '').' value="receipt">Receipt</option>';
		echo '<option '.(($docs_type === 'letters') ? 'selected' : '').' value="letters">Letters</option>';
		echo '<option '.(($docs_type === 'tax_documents') ? 'selected' : '').' value="tax_documents">Tax documents</option>';
		echo '</select>';
	}
	// Document
	function document_meta_cb($post){
		wp_enqueue_media(  );
		?>
		<div id="document">
			<div class="filearea">
				<div class="file-input">
					<span class="user_document_btn" for="user_document">
						<svg
						aria-hidden="true"
						focusable="false"
						data-prefix="fas"
						data-icon="upload"
						class="svg-inline--fa fa-upload fa-w-16"
						role="img"
						xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 512 512"
						>
						<path
							fill="currentColor"
							d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"
						></path>
						</svg>
						<span>Upload file</span>
					</span>
				</div>
			</div>

			<?php
			$document_file = get_post_meta($post->ID, 'document_file', true);
			if(!empty($document_file)){
				$filename = basename ( get_attached_file( $document_file ) );
				echo '<div class="file_preview">
					<input type="hidden" value="'.$document_file.'" name="document_file">
					<p><a target="_blank" href="'.wp_get_attachment_url( $document_file ).'">File: '.$filename.'</a></p>
				</div>';
			}
			?>
		</div>
		<?php
	}

	// Sent message
	function sent_alert_meta_cb($post){
		echo '<label for="sentmessage">Sent receipt when update</label>';
		echo '<input style="margin-left: 10px;" type="checkbox" '.((get_post_meta($post->ID, 'sent_message_when_update', true) === 'on') ? 'checked' : '').' name="sent_message_when_update" id="sentmessage">';
	}

	function recipient_errors($post){
		if($post->post_type === 'recipient'){
			if(get_post_meta($post->ID, 'urm_error', true)){
				echo '<div class="recipient_error">
					<span class="error_text">'.get_post_meta($post->ID, 'urm_error', true).'</span>
				</div>';
			}
		}
	
		delete_post_meta( $post->ID, 'urm_error' );
	}

	function user_informations_cb($post){
		
		echo '<div class="urm_user_field">';
		$recipient_account = get_post_meta($post->ID, 'recipient_account', true);
		echo '<label for="recipient_user">Recipient Account</label>';
		wp_dropdown_users( 
			[
				'selected' => $recipient_account,
				'role__not_in' => array('administrator'),
				'name' => 'recipient_user',
				'show_option_none'  => 'Select a user',
				'id' => 'recipient_user'
			] 
		);
		echo '</div>';

		echo '<div class="urm_user_field">';
		echo '<label for="recipient_email">Recipient Email</label>';
		echo '<input type="email" class="widefat" placeholder="Email" name="recipient_email" id="recipient_email" value="'.get_post_meta($post->ID, 'recipient_email', true).'">';
		echo '<p style="margin: 0px">Use this field if you want to send emails to this email. <b>(Default account email)</b></p>';
		echo '</div>';

		echo '<div class="urm_user_field">';
		echo '<label for="recipient_phone">Phone</label>';
		echo '<input type="text" class="widefat" placeholder="Phone" name="recipient_phone" id="recipient_phone" value="'.get_post_meta($post->ID, 'recipient_phone', true).'">';
		echo '</div>';

		echo '<div class="urm_user_field">';
		echo '<label for="payment_way">Payment Method</label>';

		echo '<select name="payment_way" id="payment_way">';
		$method = get_post_meta($post->ID, 'payment_way', true);
		echo '<option value="">Select</option>';
		echo '<option '.(($method === 'card') ? 'selected' : '').' value="card">Card</option>';
		echo '<option '.(($method === 'cash') ? 'selected' : '').' value="cash">Cash</option>';
		echo '<option '.(($method === 'paypal') ? 'selected' : '').' value="paypal">Paypal</option>';
		echo '</select>';

		echo '</div>';

		echo '<div class="urm_user_field">';
		echo '<label for="preferred_lang">Preferred language</label>';
		$selected = get_post_meta($post->ID, 'preferred_lang', true);

		$args = array(
            'id'                          => 'preferred_lang',
            'name'                        => 'preferred_lang',
            'selected'                    => $selected,
            'echo'                        => 1,
            'show_available_translations' => true,
            'show_option_site_default'    => false,
            'show_option_en_us'           => true,
            'explicit_option_en_us'       => true,
        );

		wp_dropdown_languages($args);
		echo '</div>';
		
	}

	// Save recipient post
	function save_recipient_post($post_id, $post){
		global $wpdb;
		if(isset($_POST['recipient_user'])){
			$recipient_account = sanitize_text_field( $_POST['recipient_user'] );
			
			if($wpdb->get_var("SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = 'recipient_account' AND meta_value = $recipient_account AND post_id != $post_id")){
				$username = get_user_by( 'ID', $recipient_account )->display_name;
				update_post_meta( $post_id, 'urm_error', "<b>$username</b> is already booked for another recipient." );
				delete_post_meta($post_id, 'recipient_account');
			}else{
				update_post_meta($post_id, 'recipient_account', $recipient_account);
			}
		}
		if(isset($_POST['recipient_email'])){
			delete_post_meta($post_id, 'recipient_email');
			$recipient_email = sanitize_email( $_POST['recipient_email'] );
			if($wpdb->get_var("SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = 'recipient_email' AND meta_value = '$recipient_email' AND post_id != $post_id")){
				if(!empty($recipient_email)){
					update_post_meta( $post_id, 'urm_error', "<b>$recipient_email</b> is already booked for another recipient." );
					delete_post_meta($post_id, 'recipient_email');
				}
			}else{
				update_post_meta($post_id, 'recipient_email', $recipient_email);
			}
		}
		if(isset($_POST['recipient_phone'])){
			$recipient_phone = intval( $_POST['recipient_phone'] );
			update_post_meta($post_id, 'recipient_phone', $recipient_phone);
		}
		if(isset($_POST['payment_way'])){
			$payment_way = sanitize_text_field( $_POST['payment_way'] );
			update_post_meta($post_id, 'payment_way', $payment_way);
		}
		if(isset($_POST['preferred_lang'])){
			$preferred_lang = sanitize_text_field( $_POST['preferred_lang'] );
			update_post_meta($post_id, 'preferred_lang', $preferred_lang);
		}
	}

	// Email template
	function urm_email_template($data){
		$username = $data['name'];
		$useremail = $data['email'];
		$usersponsorid = $data['sponsor_id'];
		$fileurl = $data['fileurl'];

		$subject = ((get_option('recipient_email_subject')) ? get_option('recipient_email_subject') : 'Reception');

		$contents = get_option('recipient_email_template');
		$contents = str_replace('%%name%%', $username, $contents);
		$contents = str_replace('%%email%%', $useremail, $contents);
		$contents = str_replace('%%sponsor_id%%', $usersponsorid, $contents);
		$contents = str_replace('%%file%%', '<a href="'.$fileurl.'">'.$usersponsorid.'.pdf</a>', $contents);

		$template = '<!DOCTYPE html>
		<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width,initial-scale=1">
			<meta name="x-apple-disable-message-reformatting">
			<title>Reception</title>
			<style>
				table, td, div, h1, p {font-family: Arial, sans-serif;}
			</style>
		</head>
		<body style="margin:0;padding:0;">
			<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
				<tr>
					<td align="center" style="padding:0;">
						<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
							<tr>
								<td align="center" style="padding:40px 0 30px 0;background:#707070;">
									<img src="'.esc_url( get_option('recipient_email_logo') ).'" alt="" width="300" style="height:auto;display:block;" />
								</td>
							</tr>
							<tr>
								<td style="padding:36px 30px 42px 30px;">
									<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
										<tr>
											<td style="padding:0px;color:#153643;">
												<div style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">'.wpautop( html_entity_decode($contents), true ).'</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style="padding:30px;background:#ebeaea;">
									<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:12px;font-family:Arial,sans-serif;">
										<tr>
											<td style="padding:0;width:50%;font-size:12px;line-height:16px;font-family:Arial,sans-serif;color:#373737;">
												'.html_entity_decode(get_option('recipient_email_footer')).'
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</body>
		</html>';

		// Set content-type header for sending HTML email 
		$headers = "MIME-Version: 1.0" . "\r\n"; 
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// Additional headers 
		$headers .= 'From: '.bloginfo( 'title' ).'<'.home_url(  ).'>' . "\r\n";

		if(wp_mail( $useremail, $subject, $template, $headers)){
			return true;
		}
	}
	
	// Save urmdocument post
	function save_urmdocument_post($post_id, $post){
		$docs_recipients = [];
		if(isset($_POST['docs_recipients'])){
			delete_post_meta($post_id, 'docs_recipients', '');
			$docs_recipients = $_POST['docs_recipients'];
			if($docs_recipients){
				foreach($docs_recipients as $recipient_id){
					add_post_meta($post_id, 'docs_recipients', $recipient_id);
				}
			}
		}else{
			delete_post_meta($post_id, 'docs_recipients', '');
		}

		$document_file = null;
		if(isset($_POST['document_file'])){
			$document_file = intval( $_POST['document_file'] );
			update_post_meta($post_id, 'document_file', $document_file);
		}
		
		$docs_lang = null;
		if(isset($_POST['docs_lang'])){
			$docs_lang = sanitize_text_field( $_POST['docs_lang'] );
			update_post_meta($post_id, 'docs_lang', $docs_lang);
		}
		
		if(isset($_POST['docs_type'])){
			$docs_type = sanitize_text_field( $_POST['docs_type'] );
			update_post_meta($post_id, 'docs_type', $docs_type);
		}

		// Sent messages
		if(isset($_POST['sent_message_when_update']) && $_POST['sent_message_when_update'] === 'on'){
			$filename = basename ( get_attached_file( $document_file ) );
			$fileurl = wp_get_attachment_url( $document_file );

			if(is_array($docs_recipients)){
				foreach($docs_recipients as $recipient_id){
					$preferred_lang = get_post_meta($recipient_id, 'preferred_lang', true);
					if($docs_lang === $preferred_lang){ // Matching language
						$recipient_email = get_post_meta($recipient_id, 'recipient_email', true);
						$recipient_account = get_post_meta($recipient_id, 'recipient_account', true);
	
						$uname = null;
						if($recipient_account){
							$user = get_user_by( 'ID', $recipient_account );
							$uname = $user->display_name;
							if(!$recipient_email){
								$recipient_email = $user->user_email;
							}
						}
	
						$sponsor_id = get_the_title( $recipient_id );
						$data = array(
							'name' => $uname,
							'email' => $recipient_email,
							'sponsor_id' => $sponsor_id,
							'fileurl' => $fileurl
						);
	
						if($data['email']){
							if($this->urm_email_template($data)){
								update_post_meta($post_id, 'sent_message_when_update', $_POST['sent_message_when_update']);
							}
						}
					}
				}
			}
		}else{
			delete_post_meta($post_id, 'sent_message_when_update');
		}
	}

	function add_login_logout_link($items, $args) {
		if(get_option('enable_login_logout_in_menu') === 'on'){
			if ( ! is_user_logged_in() ) {
				$items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page"><a class="menu-link" href="' . esc_url( wp_login_url( home_url(  ) ) ) . '">' . __( 'Log in' ) . '</a></li>';
			} else {
				$items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page"><a class="menu-link" href="' . esc_url( wp_logout_url( home_url(  ) ) ) . '">' . __( 'Log out' ) . '</a></li>';
			}
		}
		
		return $items;
	}
}
