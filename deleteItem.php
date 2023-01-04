<?php
session_start();

$tbl = $_SESSION['products'];
$removeditem = $_GET['name'];

if (isset($_POST['delete'])) {
    foreach ($tbl as $k => $v) {
        if ($v == $removeditem)
            unset($_SESSION['products'][$k]);
    }
}
