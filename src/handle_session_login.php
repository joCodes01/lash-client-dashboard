<?php
if (empty($_SESSION['loggedIn'])) {
    header("Location: login.php");
    exit;
}
?>