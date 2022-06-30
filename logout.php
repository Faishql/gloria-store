<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie("key", "", time() - 3600);
setcookie("key_name", "", time() - 3600);

header("Location: index.php");
exit();
?>
