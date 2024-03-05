<?php

include("auth.php");
$log = new logmein();
$log->encrypt = FALSE; //set encryption
//Log out
$log->logout();
header("Location: http://localhost/Dairy/index.php");
?>
