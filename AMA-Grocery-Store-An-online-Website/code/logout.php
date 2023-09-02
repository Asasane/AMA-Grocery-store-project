<?php

session_start();

unset($_SESSION["uid"]);

unset($_SESSION["name"]);

unset($_SESSION["user_role"]);

header("location:index.php");

?>