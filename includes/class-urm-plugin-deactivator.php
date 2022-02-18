<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Urm_Plugin
 * @subpackage Urm_Plugin/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Urm_Plugin
 * @subpackage Urm_Plugin/includes
 * @author     junaidzx90 <admin@easeare.com>
 */
class Urm_Plugin_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		wp_clear_scheduled_hook('urm_reception_cron_hook');
	}

}
