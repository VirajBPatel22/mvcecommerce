<?php 
// $coockie_name = "viraj";
// $coockie_value = "nice person";
// setcookie($coockie_name,$coockie_value,time()+(86400*30),'/');

// if(!isset($_COOKIE[$coockie_name])){
//     echo "Cookie name".$coockie_name." is not set";
// }
// else{
//     echo "Cookie ".$coockie_name." is set ";
//     echo "value is : ".$_COOKIE[$coockie_name];
// }


?>
<?php
$cookie_name = "viraj";
$cookie_value = "nice";
$cookie_value = "nice person";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 
// setcookie($cookie_name, $cookie_value); 

if (!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set.<br>";
    echo "Value: " . $_COOKIE[$cookie_name];
}
?>
