<?php
/**
 * Define sensitive data in this configuration file. If serverConfig.php is missing, then it should
 * be setup like this.
 * User: jf
 * Date: Feb-13-2016
 */
date_default_timezone_set('America/New_York');
define('LOGFILE_PREFIX', 'enginesis_php_');
define('SITE_SESSION_COOKIE', 'enguser');
define('ENGINESIS_SITE_NAME', 'Enginesis');
define('ENGINESIS_SITE_ID', 100);
define('DEBUG_ACTIVE', false);
define('DEBUG_SESSION', false);
define('PUBLISHING_MASTER_PASSWORD', '');
define('REFRESH_TOKEN_KEY', '');
define('ADMIN_ENCRYPTION_KEY', '');
define('COREG_TOKEN_KEY', '');
define('ENGINESIS_DEVELOPER_TOKEN', '');
define('SESSION_REFRESH_HOURS', 4380);     // refresh tokens are good for 6 months
define('SESSION_REFRESH_INTERVAL', 'P6M'); // refresh tokens are good for 6 months
define('SESSION_AUTHTOKEN', 'authtok');
define('SESSION_PARAM_CACHE', 'engsession_params');

define('ACTIVE_DATABASE', 'jumpydot');
$serverStage = serverStage(null);
$sqlDBs = null;
switch($serverStage) {
    case '-d':	// dev
        $sqlDBs = [
            ACTIVE_DATABASE => [
                'host' => 'localhost',
                'port' => '3306',
                'user' => 'x',
                'password' => 'x',
                'db' => 'jumpydotd'
                ]
            ];
        break;
    case '-q':	// qa
        $sqlDBs = [
            ACTIVE_DATABASE => [
                'host' => 'LOCALHOST',
                'port' => '3306',
                'user' => 'x',
                'password' => 'x',
                'db' => 'jumpydotq'
                ]
            ];
        break;
    case '-l':	// localhost
        $sqlDBs = [
            ACTIVE_DATABASE => [
                'host' => 'localhost',
                'port' => '3306',
                'user' => 'x',
                'password' => 'x',
                'db' => 'jumpydot'
                ]
            ];
        break;
    case '-x':	// external dev
        $sqlDBs = [
            ACTIVE_DATABASE => [
                'host' => 'localhost',
                'port' => '3306',
                'user' => 'x',
                'password' => 'x',
                'db' => 'jumpydot'
                ]
            ];
        break;
    default:	// live
        $sqlDBs = [
            ACTIVE_DATABASE => [
                'host' => 'localhost',
                'port' => '3306',
                'user' => 'x',
                'password' => 'x',
                'db' => 'jumpydot'
                ]
            ];
        break;
}

// Mail/sendmail/Postfix/Mailgun config
$_MAIL_HOSTS = [
    '-l' => ['host' => '', 'port' => 465, 'ssl' => true, 'tls' => false, 'user' => '', 'password' => ''],
    '-d' => ['host' => 'smtp.mailgun.org', 'port' => 587, 'ssl' => false, 'tls' => true, 'user' => 'postmaster', 'password' => ''],
    '-q' => ['host' => 'smtp.mailgun.org', 'port' => 587, 'ssl' => false, 'tls' => true, 'user' => 'postmaster', 'password' => ''],
    '-x' => ['host' => 'smtpout.secureserver.net', 'port' => 25, 'ssl' => false, 'tls' => false, 'user' => '', 'password' => ''],
    ''   => ['host' => 'smtp.mailgun.org', 'port' => 587, 'ssl' => false, 'tls' => true, 'user' => 'postmaster', 'password' => '']
];
ini_set('SMTP', $_MAIL_HOSTS[$serverStage]['host']);

// memcache access global table
$_MEMCACHE_HOSTS = ['-l'  => array('port'=>11215, 'host'=>'www.enginesis-l.com'),
                    '-d'  => array('port'=>11215, 'host'=>'www.enginesis-d.com'),
                    '-q'  => array('port'=>11215, 'host'=>'www.enginesis-q.com'),
                    '-x'  => array('port'=>11215, 'host'=>'www.enginesis-x.com'),
                    ''    => array('port'=>11215, 'host'=>'www.enginesis.com')
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
$siteId = ENGINESIS_SITE_ID;
$languageCode = 'en';
