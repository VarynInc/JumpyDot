<?php
/** config.php -- Global app-wide configuration constants for JumpyDot.
 * This file has per-server specific parameters and is not to be checked in for source control.
 * If config.php is not provided then use this file as the guide to setting it up.
 */

define('ENGINESIS_SITE_ID', 107);
define('DEBUG_ACTIVE', false);
define('DEBUG_SESSION', false);
define('PUBLISHING_MASTER_PASSWORD', '');
define('REFRESH_TOKEN_KEY', '');
define('ADMIN_ENCRYPTION_KEY', '');

function setDatabaseConnectionInfo () {
    global $sqlDatabaseConnectionInfo;
    $serverStage = serverStage(null);
    switch($serverStage) {
        case '-d':	// dev
            $sqlDatabaseConnectionInfo = array(
                'host' => '',
                'port' => '3306',
                'user' => 'jumpydot',
                'password' => '',
                'db' => 'jumpydotd');
            break;
        case '-q':	// qa
            $sqlDatabaseConnectionInfo = array(
                'host' => '',
                'port' => '3306',
                'user' => 'jumpydot',
                'password' => '',
                'db' => 'jumpydotq');
            break;
        case '-l':	// localhost
            $sqlDatabaseConnectionInfo = array(
                'host' => '127.0.0.1',
                'port' => '3306',
                'user' => 'jumpydot',
                'password' => '',
                'db' => 'jumpydot');
            break;
        case '-x':	// external dev
            $sqlDatabaseConnectionInfo = array(
                'host' => 'localhost',
                'port' => '3306',
                'user' => 'jumpydot',
                'password' => '',
                'db' => 'jumpydot');
            break;
        default:	// live
            $sqlDatabaseConnectionInfo = array(
                'host' => '',
                'port' => '3306',
                'user' => 'jumpydot',
                'password' => '',
                'db' => 'jumpydot');
            break;
    }
}

function setMailHostsTable ($serverStage) {
    global $_MAIL_HOSTS;
    // Mail/sendmail/Postfix/Mailgun config
    $_MAIL_HOSTS = array(
        '-l' => array('host' => '', 'port' => 25, 'ssl' => true, 'tls' => false, 'user' => '', 'password' => ''),
        '-d' => array('host' => '', 'port' => 25, 'ssl' => false, 'tls' => true, 'user' => '', 'password' => ''),
        '-q' => array('host' => '', 'port' => 25, 'ssl' => false, 'tls' => true, 'user' => '', 'password' => ''),
        '-x' => array('host' => '', 'port' => 25, 'ssl' => false, 'tls' => false, 'user' => '', 'password' => ''),
        ''   => array('host' => '', 'port' => 25, 'ssl' => false, 'tls' => true, 'user' => '', 'password' => '')
    );
    ini_set('SMTP', $_MAIL_HOSTS[$serverStage]['host']);
}

// memcache access global table
$_MEMCACHE_HOSTS = ['-l'  => array('port'=>11215, 'host'=>'www.jumpydot-l.com'),
                    '-d'  => array('port'=>11215, 'host'=>'www.jumpydot-d.com'),
                    '-q'  => array('port'=>11215, 'host'=>'www.jumpydot-q.com'),
                    '-x'  => array('port'=>11215, 'host'=>'www.jumpydot-x.com'),
                    ''    => array('port'=>11215, 'host'=>'www.jumpydot.com')
                   ];

// Define a list of email addresses who will get notifications of internal bug reports
$admin_notification_list = ['support@jumpydot.com'];

// API Keys for the JumpyDot app
$socialServiceKeys = [
    2  => ['service' => 'Facebook', 'app_id' => '', 'app_secret' => '', 'admins' =>''],
    7  => ['service' => 'Google', 'app_id' => '', 'app_secret' => '', 'admins' =>''],
    11 => ['service' => 'Twitter', 'app_id' => '', 'app_secret' => '', 'admins' =>'']
];

// Enginesis developer key for the Enginesis APIs
$developerKey = '';
