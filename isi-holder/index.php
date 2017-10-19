<?php
/*
  Plugin Name: ISI Holder
  Description: Adds a Settings menu item for formatting, saving & retrieval Important Safety Information.
  Author: Fingerpaint Developers <devs@fingerpaintmarketing.com>
  Author URI: http://fingerpaintmarketing.com
  License:      GPLv2 or later
  Text Domain:  Fingerpaint
  Version: 1.0.0
 */

require_once 'class.ISI_Holder.php';

$isi_Holder = new ISI_Holder();

/* Override pluggable function wp_password_change_notification to suppress admin notifications. */
if ( ! function_exists( 'wp_password_change_notification' ) ) {
	function wp_password_change_notification() {
	}
}

