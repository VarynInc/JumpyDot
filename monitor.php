<?php

// Verify the server is operating correctly
$info = isset($_GET['info']) && $_GET['info'] == 1;

require_once('procs/common.php');

$pageok = false;
$DBConn = dbConnect();
if ($DBConn) {
	$req = dbQuery($DBConn, 'SELECT count(*) from wp_users', array());
	if ($req) {
		$row = $req->fetch();
		if ($row) {
			$pageok = true;
		} else {
			echo('Error in ' . $sqlDatabaseConnectionInfo['db'] . ' data ' . dbError($req));
		}
		$req = null;
	} else {
		echo('Error in ' . $sqlDatabaseConnectionInfo['db'] . ' data ' . dbError($DBConn));
	}
    $DBConn = null;
} else {
	echo("Error connecting to database");
    if ($info) {
        echo("<p>DB=" . $sqlDatabaseConnectionInfo['db'] . "; H=" . $sqlDatabaseConnectionInfo['host'] ." U=" . $sqlDatabaseConnectionInfo['user'] . "</p>\n");
    }
}
if ($pageok) {
	echo "PAGEOK";
}
if ($info) {
	echo("<br/>\n");
	phpinfo();
	var_dump(gd_info());
	echo("<br/>\n");
	$loggedIn = $isLoggedIn ? 'YES' : 'NO';
	echo("Loggedin? $loggedIn<br/>Server $server<br/>Stage $stage<br/>Web server $webServer<br/>Enginesis $enginesisServer<br/>Protocol $serviceProtocol<br/>Database " . $sqlDatabaseConnectionInfo['db']);
}
?>