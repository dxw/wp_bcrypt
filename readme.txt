=== Plugin Name ===
Contributors: harrym
Tags: security
Requires at least: 3.4
Tested up to: 3.4
Stable tag: 0.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP bcrypt switches WordPress's password hashes from MD5 to bcrypt, making it harder for them to be brute-forced if they are leaked.

== Description ==

WordPress uses phpass to store passwords. Because WordPress has to work everywere, it uses the portable version of phpass,
which uses MD5 to hash passwords. MD5 is not a very good hashing algorithm for passwords, because it's relatively fast.

This plugin switches over to bcrypt, which is the algorithm recommended by phpass, and is a much better option for password
storage because it is much slower to produce. This makes it much harder for an attacker who's managed to access your hashed 
passwords to obtain plain text passwords by brute-forcing, or by trying passwords from a dictionary.

**Note: this plugin requires PHP 5.3.0 or newer**

Be aware that if you use this plugin and then move to a host that does not support bcrypt, you will need to reset any user
account that you want to log in with.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the `wp_bcrypt` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How do you change the hashes? =

Users' hashes are changed to bcrypt when they first login in after the plugin is activated. All of WordPress's built-in functions
will use bcrypt too, when intially creating an account, changing your password, or adding a password to a post.

= What happens if I deactivate the plugin? =

As long as you have bcrypt support (PHP 5.3.0 or newer) WordPress will happily continue checking passwords that are hashed using
bcrypt. Everything should work fine. But any new passwords you hash (for a new account, or changing an existing account) will be 
made using MD5.

== Changelog ==

= 0.1 =
* Initial release
