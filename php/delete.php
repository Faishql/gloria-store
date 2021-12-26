<?php

require 'functions/functions.php';

$id = $_GET['id'];
$db = $_GET['db'];


if ( delete($id, decryptTb($db)) > 0) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }

?>