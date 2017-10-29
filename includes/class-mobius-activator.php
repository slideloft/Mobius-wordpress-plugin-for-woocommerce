<?php

/**
 * Fired during plugin activation
 *
 * @link       http://mwplug.com
 * @since      1.0.0
 *
 * @package    Mobius
 * @subpackage Mobius/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Mobius
 * @subpackage Mobius/includes
 * @author     mwplug.com
 */
class Mobius_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
              global $wpdb;
              $your_db_name="mobius";
 
	// create the ECPT metabox database table
	if($wpdb->get_var("show tables like '$your_db_name'") != $your_db_name) 
	{
		$sql = "CREATE TABLE " . $your_db_name . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`api_key` text NOT NULL,
		`app_uid` text NOT NULL,
		UNIQUE KEY id (id)
		);";
 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
       
	}
        
}
