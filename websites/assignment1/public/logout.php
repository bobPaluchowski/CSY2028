<?php

session_start();// START SESSION
// session_unset();
session_destroy();// DESTROY SESSION
header("location: index.php");// REDIRECT TO LOGIN PAGE
// exit;