<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Urm_Plugin
 * @subpackage Urm_Plugin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Urm_Plugin
 * @subpackage Urm_Plugin/includes
 * @author     junaidzx90 <admin@easeare.com>
 */
class Urm_Plugin_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if ( ! wp_next_scheduled( 'urm_reception_cron_hook' ) ) {
			wp_schedule_event( time(), 'once_daily', 'urm_reception_cron_hook');
		}
	}

}
