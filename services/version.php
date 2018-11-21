<?php /* version.php - define the version of the code base
 * and lock the system if under maintenance.
 */
if ( ! defined('JUMPYDOT_VERSION')) {
    define('JUMPYDOT_VERSION', '0.1.1');
}
define('JUMPYDOT_ADMIN_LOCK', false);
define('ADMIN_LOCK_MESSAGE', '<h3>Jumpy Dot is OFFLINE</h3><p>Jumpy Dot is currently OFFLINE, most probably due to server maintenance.<br/>If you have an immediate need for service please contact Jumpy Dot support <a href="mailto:support@jumpydot.com">support@jumpydot.com</a>.</p>' );
if (JUMPYDOT_ADMIN_LOCK) {
    header ("Location: /offline.html");
    exit(0);
}
