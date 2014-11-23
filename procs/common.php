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

$isLoggedIn = false;
$server = '';
$stage = '';
$webServer = '';

if (strpos($_SERVER['HTTP_HOST'], ':') !== false ) {
    $host_name = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST'];
    $server = substr($host_name, 0, strpos($host_name, ':'));
} else {
    $server = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST'];
}
$stage = '';
if (strpos($server, '-l.') > 0) {
    $stage = '-l';
} elseif (strpos($server, '-q.') > 0) {
    $stage = '-q';
} elseif (strpos($server, '-d.') > 0) {
    $stage = '-d';
} elseif (strpos($server, '-x.') > 0) {
    $stage = '-x';
} else {
    $stage = '';
}
$enginesisServer = 'http://www.enginesis' . $stage . '.com';
$webServer = 'http://www.jumpydot' . $stage . '.com';

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
