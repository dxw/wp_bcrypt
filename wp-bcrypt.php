<?php
/**
  * Plugin Name: wp-bcrypt
  * Plugin URI:  http://wordpress.org/plugins/wp-bcrypt/
  * Description: wp-bcrypt switches WordPress's password hashes from MD5 to bcrypt, making it harder for them to be brute-forced if they are leaked.
  * Author:      dxw
  * Author URI:  http://dxw.com
  * Version:     1.0.1
  * Licence:     GPL2
  *
  * For more information, consult readme.txt
  */

require_once(ABSPATH . 'wp-includes/class-phpass.php');

class WpBcrypt {
  function __construct() {
    global $wp_hasher;

    // Replace the global wp_hasher class with one that we like.
    $wp_hasher = new PasswordHash(10, false);

    // Add a filter to change passwords when people log in.
    add_filter('check_password', array($this,'check_password'), 10, 4);

    // Check if CRYPT_BLOWFISH is available. If not, warn people.
    if(!defined('CRYPT_BLOWFISH') || CRYPT_BLOWFISH == 0) {
      add_action('admin_notices', array($this, 'dep_notice'));
    }
  }

  function dep_notice() {
    // Warn people that the plugin won't do anything until they upgrade.
    ?>
      <div class="updated"><p><strong>WP bcrypt</strong> requires PHP 5.3 or newer. Your site's passwords will continue to be stored as normal until PHP is upgraded.</p></div>
    <?php
  }

  function check_password($check='', $password='', $hash='', $user_id='') {
    // If the password check succeeded, and the hash is an old-style one, change it.
    if($check && substr($hash, 0, 3) == '$P$') {
      wp_set_password($password, $user_id);
    }

    return $check;
  }

};

new WpBcrypt();
