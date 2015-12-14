<?php
include('inc/config.php');
include('template/header.php');
if (isset($_GET['q'])) include('modules/'. $_GET['q'] .'.php');
else include('modules/home.php');

include('template/footer.php');
?>