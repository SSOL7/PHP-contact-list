<?php

$name trim($_POST['name']);

if(empty($name)) {
    $nameErr = "Please enter your name.";
} else {
    $name = filterName($name);
    if($name == FALSE) {
        $nameErr = "Please enter a valid name.";
    }
}

?>



