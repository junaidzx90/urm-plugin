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
	'am' => 'አማርኛ',
	'ar' => 'العربية',
	'ary' => 'العربية المغربية',
	'as' => 'অসমীয়া',
	'az' => 'Azərbaycan dili',
	'azb' => 'گؤنئی آذربایجان',
	'bel' => 'Беларуская мова',
	'bg_BG' => 'Български',
	'bn_BD' => 'বাংলা',
	'bo' => 'བོད་ཡིག',
	'bs_BA' => 'Bosanski',
	'ca' => 'Català',
	'ceb' => 'Cebuano',
	'cs_CZ' => 'Čeština',
	'cy' => 'Cymraeg',
	'da_DK' => 'Dansk',
	'de_CH_informal' => 'Deutsch (Schweiz, Du)',
	'de_CH' => 'Deutsch (Schweiz)',
	'de_DE' => 'Deutsch',
	'de_DE_formal' => 'Deutsch (Sie)',
	'de_AT' => 'Deutsch (Österreich)',
	'dsb' => 'Dolnoserbšćina',
	'dzo' => 'རྫོང་ཁ',
	'el' => 'Ελληνικά',
	'en_NZ' => 'English (New Zealand)',
	'en_ZA' => 'English (South Africa)',
	'en_GB' => 'English (UK)',
	'en_CA' => 'English (Canada)',
	'en_AU' => 'English (Australia)',
	'eo' => 'Esperanto',
	'es_VE' => 'Español de Venezuela',
	'es_EC' => 'Español de Ecuador',
	'es_MX' => 'Español de México',
	'es_DO' => 'Español de República Dominicana',
	'es_PE' => 'Español de Perú',
	'es_CR' => 'Español de Costa Rica',
	'es_UY' => 'Español de Uruguay',
	'es_CL' => 'Español de Chile',
	'es_PR' => 'Español de Puerto Rico',
	'es_GT' => 'Español de Guatemala',
	'es_AR' => 'Español de Argentina',
	'es_ES' => 'Español',
	'es_CO' => 'Español de Colombia',
	'et' => 'Eesti',
	'eu' => 'Euskara',
	'fa_IR' => 'فارسی',
	'fa_AF' => '(فارسی (افغانستان',
	'fi' => 'Suomi',
	'fr_CA' => 'Français du Canada',
	'fr_FR' => 'Français',
	'fr_BE' => 'Français de Belgique',
	'fur' => 'Friulian',
	'gd' => 'Gàidhlig',
	'gl_ES' => 'Galego',
	'gu' => 'ગુજરાતી',
	'haz' => 'هزاره گی',
	'he_IL' => 'עִבְרִית',
	'hi_IN' => 'हिन्दी',
	'hr' => 'Hrvatski',
	'hsb' => 'Hornjoserbšćina',
	'hu_HU' => 'Magyar',
	'hy' => 'Հայերեն',
	'id_ID' => 'Bahasa Indonesia',
	'is_IS' => 'Íslenska',
	'it_IT' => 'Italiano',
	'ja' => '日本語',
	'jv_ID' => 'Basa Jawa',
	'ka_GE' => 'ქართული',
	'kab' => 'Taqbaylit',
	'kk' => 'Қазақ тілі',
	'km' => 'ភាសាខ្មែរ',
	'kn' => 'ಕನ್ನಡ',
	'ko_KR' => '한국어',
	'ckb' => 'كوردی',
	'lo' => 'ພາສາລາວ',
	'lt_LT' => 'Lietuvių kalba',
	'lv' => 'Latviešu valoda',
	'mk_MK' => 'Македонски јазик',
	'ml_IN' => 'മലയാളം',
	'mn' => 'Монгол',
	'mr' => 'मराठी',
	'ms_MY' => 'Bahasa Melayu',
	'my_MM' => 'ဗမာစာ',
	'nb_N' => 'Norsk bokmål',
	'ne_NP' => 'नेपाली',
	'nl_NL_formal' => 'Nederlands (Formeel)',
	'nl_NL' => 'Nederlands',
	'nl_BE' => 'Nederlands (België)',
	'nn_NO' => 'Norsk nynorsk',
	'oci' => 'Occitan',
	'pa_IN' => 'ਪੰਜਾਬੀ',
	'pl_PL' => 'Polski',
	'ps' => 'پښتو',
	'pt_BR' => 'Português do Brasil',
	'pt_PT' => 'Português',
	'pt_AO' => 'Português de Angola',
	'pt_PT_ao90' => 'Português (AO90)',
	'rhg' => 'Ruáinga',
	'ro_RO' => 'Română',
	'ru_RU' => 'Русский',
	'sah' => 'Сахалыы',
	'snd' => 'سنڌي',
	'si_LK' => 'සිංහල',
	'sk_SK' => 'Slovenčina',
	'skr' => 'سرائیکی',
	'sl_SI' => 'Slovenščina',
	'sq' => 'Shqip',
	'sr_RS' => 'Српски језик',
	'sv_SE' => 'Svenska',
	'sw' => 'Kiswahili',
	'szl' => 'Ślōnskŏ gŏdka',
	'ta_IN' => 'தமிழ்',
	'ta_LK' => 'தமிழ்',
	'te' => 'తెలుగు',
	'th' => 'ไทย',
	'tl' => 'Tagalog',
	'tr_TR' => 'Türkçe',
	'tt_RU' => 'Татар теле',
	'tah' => 'Reo Tahiti',
	'ug_CN' => 'ئۇيغۇرچە',
	'uk' => 'Українська',
	'ur' => 'اردو',
	'uz_UZ' => 'O‘zbekcha',
	'vi' => 'Tiếng Việt',
	'zh_TW' => '繁體中文',
	'zh_CN' => '简体中文',
	'zh_HK' => '香港中文版'
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
