<?php

include("actions/session_db.php");

global $_SESSION_DB;
$_SESSION_DB->session_db_start();


$_SESSION_DB['xyz'] = "test2";
// unset($_SESSION_DB['xyz']);

echo $_SESSION_DB['xyz'];