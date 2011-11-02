<?php
if (!isset($_SESSION)) {
		session_start();
}
$_SESSION['usvsgrupid'] = $_GET['uvgrup'];
?>