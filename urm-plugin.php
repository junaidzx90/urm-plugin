<?php
ob_start();
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.fiverr.com/junaidzx90
 * @since             1.0.0
 * @package           Urm_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       URM Plugin
 * Plugin URI:        https://www.fiverr.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            junaidzx90
 * Author URI:        https://www.fiverr.com/junaidzx90
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       urm-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'URM_PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-urm-plugin-activator.php
 */
function activate_urm_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-urm-plugin-activator.php';
	Urm_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-urm-plugin-deactivator.php
 */
function deactivate_urm_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-urm-plugin-deactivator.php';
	Urm_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_urm_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_urm_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-urm-plugin.php';
$urmlangs = array(
	'en_US' => 'English (United States)',
	'af' => 'Afrikaans',
	'am' => '????????????',
	'ar' => '??????????????',
	'ary' => '?????????????? ????????????????',
	'as' => '?????????????????????',
	'az' => 'Az??rbaycan dili',
	'azb' => '?????????? ??????????????????',
	'bel' => '???????????????????? ????????',
	'bg_BG' => '??????????????????',
	'bn_BD' => '???????????????',
	'bo' => '?????????????????????',
	'bs_BA' => 'Bosanski',
	'ca' => 'Catal??',
	'ceb' => 'Cebuano',
	'cs_CZ' => '??e??tina',
	'cy' => 'Cymraeg',
	'da_DK' => 'Dansk',
	'de_CH_informal' => 'Deutsch (Schweiz, Du)',
	'de_CH' => 'Deutsch (Schweiz)',
	'de_DE' => 'Deutsch',
	'de_DE_formal' => 'Deutsch (Sie)',
	'de_AT' => 'Deutsch (??sterreich)',
	'dsb' => 'Dolnoserb????ina',
	'dzo' => '??????????????????',
	'el' => '????????????????',
	'en_NZ' => 'English (New Zealand)',
	'en_ZA' => 'English (South Africa)',
	'en_GB' => 'English (UK)',
	'en_CA' => 'English (Canada)',
	'en_AU' => 'English (Australia)',
	'eo' => 'Esperanto',
	'es_VE' => 'Espa??ol de Venezuela',
	'es_EC' => 'Espa??ol de Ecuador',
	'es_MX' => 'Espa??ol de M??xico',
	'es_DO' => 'Espa??ol de Rep??blica Dominicana',
	'es_PE' => 'Espa??ol de Per??',
	'es_CR' => 'Espa??ol de Costa Rica',
	'es_UY' => 'Espa??ol de Uruguay',
	'es_CL' => 'Espa??ol de Chile',
	'es_PR' => 'Espa??ol de Puerto Rico',
	'es_GT' => 'Espa??ol de Guatemala',
	'es_AR' => 'Espa??ol de Argentina',
	'es_ES' => 'Espa??ol',
	'es_CO' => 'Espa??ol de Colombia',
	'et' => 'Eesti',
	'eu' => 'Euskara',
	'fa_IR' => '??????????',
	'fa_AF' => '(?????????? (??????????????????',
	'fi' => 'Suomi',
	'fr_CA' => 'Fran??ais du Canada',
	'fr_FR' => 'Fran??ais',
	'fr_BE' => 'Fran??ais de Belgique',
	'fur' => 'Friulian',
	'gd' => 'G??idhlig',
	'gl_ES' => 'Galego',
	'gu' => '?????????????????????',
	'haz' => '?????????? ????',
	'he_IL' => '????????????????',
	'hi_IN' => '??????????????????',
	'hr' => 'Hrvatski',
	'hsb' => 'Hornjoserb????ina',
	'hu_HU' => 'Magyar',
	'hy' => '??????????????',
	'id_ID' => 'Bahasa Indonesia',
	'is_IS' => '??slenska',
	'it_IT' => 'Italiano',
	'ja' => '?????????',
	'jv_ID' => 'Basa Jawa',
	'ka_GE' => '?????????????????????',
	'kab' => 'Taqbaylit',
	'kk' => '?????????? ????????',
	'km' => '???????????????????????????',
	'kn' => '???????????????',
	'ko_KR' => '?????????',
	'ckb' => '??????????',
	'lo' => '?????????????????????',
	'lt_LT' => 'Lietuvi?? kalba',
	'lv' => 'Latvie??u valoda',
	'mk_MK' => '???????????????????? ??????????',
	'ml_IN' => '??????????????????',
	'mn' => '????????????',
	'mr' => '???????????????',
	'ms_MY' => 'Bahasa Melayu',
	'my_MM' => '???????????????',
	'nb_N' => 'Norsk bokm??l',
	'ne_NP' => '??????????????????',
	'nl_NL_formal' => 'Nederlands (Formeel)',
	'nl_NL' => 'Nederlands',
	'nl_BE' => 'Nederlands (Belgi??)',
	'nn_NO' => 'Norsk nynorsk',
	'oci' => 'Occitan',
	'pa_IN' => '??????????????????',
	'pl_PL' => 'Polski',
	'ps' => '????????',
	'pt_BR' => 'Portugu??s do Brasil',
	'pt_PT' => 'Portugu??s',
	'pt_AO' => 'Portugu??s de Angola',
	'pt_PT_ao90' => 'Portugu??s (AO90)',
	'rhg' => 'Ru??inga',
	'ro_RO' => 'Rom??n??',
	'ru_RU' => '??????????????',
	'sah' => '??????????????',
	'snd' => '????????',
	'si_LK' => '???????????????',
	'sk_SK' => 'Sloven??ina',
	'skr' => '??????????????',
	'sl_SI' => 'Sloven????ina',
	'sq' => 'Shqip',
	'sr_RS' => '???????????? ??????????',
	'sv_SE' => 'Svenska',
	'sw' => 'Kiswahili',
	'szl' => '??l??nsk?? g??dka',
	'ta_IN' => '???????????????',
	'ta_LK' => '???????????????',
	'te' => '??????????????????',
	'th' => '?????????',
	'tl' => 'Tagalog',
	'tr_TR' => 'T??rk??e',
	'tt_RU' => '?????????? ????????',
	'tah' => 'Reo Tahiti',
	'ug_CN' => '????????????????',
	'uk' => '????????????????????',
	'ur' => '????????',
	'uz_UZ' => 'O???zbekcha',
	'vi' => 'Ti???ng Vi???t',
	'zh_TW' => '????????????',
	'zh_CN' => '????????????',
	'zh_HK' => '???????????????'
);

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_urm_plugin() {

	$plugin = new Urm_Plugin();
	$plugin->run();

}
run_urm_plugin();
