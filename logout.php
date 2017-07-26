<?php

session_start();
session_destroy();
session_unset();
echo "<h1>You have logged out</h1>";

?>