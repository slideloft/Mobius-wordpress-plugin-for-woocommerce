<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://mwplug.com
 * @since      1.0.0
 *
 * @package    Mobius
 * @subpackage Mobius/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Mobius
 * @subpackage Mobius/includes
 * @author     mwplug.com
 */
class Mobius_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
                global $wpdb;
                 $table_name = "mobius";
                 $sql = "DROP TABLE IF EXISTS $table_name;";
                 $wpdb->query($sql);
                 delete_option("my_plugin_db_version");
	}

}
