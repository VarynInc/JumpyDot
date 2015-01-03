<?php
/**
 * Common utility PHP functions
 *
 *
 *
 */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
error_reporting(E_ALL);

function getServiceProtocol () {
    // return http or https. you should use the result of this and never hard-code http:// into any URLs.
    if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        $protocol = 'https';
    } else {
        $protocol = 'http';
    }
    return $protocol;
}

function encodeURLParams ($data) {
    $encodedURLParams = '';
    foreach ($data as $key => $value) {
        if ($encodedURLParams != '') {
            $encodedURLParams .= '&';
        }
        $encodedURLParams .= urlencode($key) . '=' . urlencode($value);
    }
    return $encodedURLParams;
}

function decodeURLParams ($encodedURLParams) {
    $data = array();
    $arrayOfParameters = explode('&', $encodedURLParams);
    $i = 0;
    while ($i < count($arrayOfParameters))  {
        $parameter = explode('=', $arrayOfParameters[$i]);
        if (count($parameter) > 0) {
            $data[urldecode($parameter[0])] = urldecode($parameter[1]);
        }
        $i ++;
    }
    return $data;
}

function getPostOrRequestVar ($varName, $defaultValue = NULL) {
    if (isset($_POST[$varName])) {
        return($_POST[$varName]);
    } elseif (isset($_REQUEST[$varName])) {
        return($_REQUEST[$varName]);
    } else {
        return $defaultValue;
    }
}

function serverName () {
    if ( strpos( $_SERVER['HTTP_HOST'], ':' ) !== false ) {
        $host_name = isset( $_SERVER['HTTP_X_FORWARDED_HOST'] ) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST'];
        $server    = substr( $host_name, 0, strpos( $host_name, ':' ) );
    } else {
        $server = isset( $_SERVER['HTTP_X_FORWARDED_HOST'] ) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST'];
    }
    return $server;
}

function serverStage ($hostName = null) {
    // return just the -l, -d, -q, -x part, or '' for live.
    $targetPlatform = ''; // assume live until we prove otherwise
    if (strlen($hostName) == 0) {
        $hostName = serverName();
    }
    if (strpos($hostName, '-l.') >= 2) {
        $targetPlatform = '-l';
    } elseif (strpos($hostName, '-d.') >= 2) {
        $targetPlatform = '-d';
    } elseif (strpos($hostName, '-q.') >= 2) {
        $targetPlatform = '-q';
    } elseif (strpos($hostName, '-x.') >= 2) {
        $targetPlatform = '-x';
    }
    return $targetPlatform;
}

function setDatabaseConnectionInfo () {
    global $sqlDatabaseConnectionInfo;
    $serverStage = serverStage(null);
    switch($serverStage) {
        case '-d':	// dev
            $sqlDatabaseConnectionInfo = array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'jumpydot',
                    'password' => 'bOunCy;24',
                    'db' => 'jumpydotd');
            break;
        case '-q':	// qa
            $sqlDatabaseConnectionInfo = array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'jumpydot',
                    'password' => 'bOunCy;24',
                    'db' => 'jumpydotq');
            break;
        case '-l':	// localhost
            $sqlDatabaseConnectionInfo = array(
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'user' => 'jumpydot',
                    'password' => 'bOunCy;24',
                    'db' => 'jumpydot');
            break;
        case '-x':	// external dev
            $sqlDatabaseConnectionInfo = array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'jumpydot',
                    'password' => 'bOunCy;24',
                    'db' => 'jumpydot');
            break;
        default:	// live
            $sqlDatabaseConnectionInfo = array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'jumpydot',
                    'password' => 'bOunCy;24',
                    'db' => 'jumpydot');
            break;
    }
}

function hashPassword ($password) {
    // Call this function to generate a password hash to save in the database instead of the password.
    // Generate random salt, can only be used with the exact password match.
    // This calls PHP's crypt function with the specific setup for blowfish.

    $chars = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $salt = '$2a$10$';
    for ($i = 0; $i < 22; $i ++) {
        $salt .= $chars[mt_rand(0, 63)];
    }
    return crypt($password, $salt);
}

function verifyHashPassword ($pass, $hashStoredInDatabase) {
    // Test a password and the user's stored hash of that password
    return $hashStoredInDatabase == crypt($pass, $hashStoredInDatabase);
}

function dbConnect () {
    global $sqlDatabaseConnectionInfo;

    $dbConnection = null;
    try {
        $dbConnection = new PDO('mysql:host=' . $sqlDatabaseConnectionInfo['host'] . ';dbname=' . $sqlDatabaseConnectionInfo['db'] . ';port=' . $sqlDatabaseConnectionInfo['port'], $sqlDatabaseConnectionInfo['user'], $sqlDatabaseConnectionInfo['password']);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch(PDOException $e) {
        echo('Error connecting to server ' . $sqlDatabaseConnectionInfo['host'] . ' ' . $sqlDatabaseConnectionInfo['db'] . ' user=' . $sqlDatabaseConnectionInfo['user'] . ' ' . $e->getMessage());
    }
    return $dbConnection;
}

function dbQuery ($db, $sqlCommand, $parametersArray) {
    if ($parametersArray == null) {
        $parametersArray = array();
    }
    $sql = $db->prepare($sqlCommand);
    $sql->execute($parametersArray);
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    return $sql;
}

function dbExec ($db, $sqlCommand, $parametersArray) {
    $sql = $db->prepare($sqlCommand);
    $sql->execute($parametersArray);
    return $sql;
}

function dbError ($db) {
    // $db can be either a database handle or a results object
    $errorCode = null; // no error
    if ($db != null) {
        $errorInfo = $db->errorInfo();
        if ($errorInfo != null && count($errorInfo) > 1 && $errorInfo[1] != 0) {
            $errorCode = $errorInfo[2];
        }
    }
    return $errorCode;
}

function callEnginesisAPI ($fn, $serverURL, $paramArray) {
    /**
     * callEnginesisAPI: Make an Enginesis API request over the WWW
     * @param $fn is the API to call
     * @param $serverURL is the URL to contact without any query string (use $paramArray)
     * @param $paramArray key => value array of parameters e.g. array('site_id' => 100);
     */
    if ( ! isset($paramArray['response'])) {
        $paramArray['response'] = 'json';
    }
    $response = $paramArray['response'];
    if ( ! isset($paramArray['state_seq'])) {
        $paramArray['state_seq'] = 1;
    }
    if ( ! isset($paramArray['fn'])) {
        $paramArray['fn'] = $fn;
    }
    $ch = curl_init();
    if ($ch) {
        curl_setopt($ch, CURLOPT_URL, $serverURL);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, encodeURLParams($paramArray));
        $contents = curl_exec($ch);
        curl_close($ch);
        $succeeded = strlen($contents) > 0;
        // TODO: We should verify the response is a valid EnginesisReponse object
        if ( ! $succeeded) {
            $contents = '{"results":{"status":{"success":"0","message":"SYSTEM_ERR","extended_info":"System error: ' . $serverURL . ' replied with no data."},"passthru":{"fn":"' . $fn . '","state_seq":0}}}';
        }
    } else {
        $contents = '{"results":{"status":{"success":"0","message":"SYSTEM_ERR","extended_info":"System error: unable to contact ' . $serverURL . ' or the server did not respond."},"passthru":{"fn":"' . $fn . '","state_seq":0}}}';
    }
    return $contents;
}

$isLoggedIn = false;
$server = '';
$stage = '';
$webServer = '';
$sqlDatabaseConnectionInfo = null;
$server = serverName();
$stage = serverStage($server);
$serviceProtocol = getServiceProtocol();
$enginesisServer = $serviceProtocol . '://enginesis.jumpydot' . $stage . '.com';
$webServer = $serviceProtocol . '://www.jumpydot' . $stage . '.com';
setDatabaseConnectionInfo();
