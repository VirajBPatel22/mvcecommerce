<?php
session_start();
// session_unset();

if (isset($_SESSION['name'])) {
    echo "Session is set. Value: " . $_SESSION['name'] . "<br>";
} else {
    echo "Session is not set.<br>";
}

$cookie_name = "viraj";
if (isset($_COOKIE[$cookie_name])) {
    echo "Cookie is set. Value: " . $_COOKIE[$cookie_name] . "<br>";
} else {
    echo "Cookie is not set.<br>";
}
?>
