<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <style>
            .error {
                color: red;
            }
        </style>

</head>
<body>

<?php

// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if(!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }
}

if(empty($_POST["email"])) {
    $emailErr = "Email is required";
} else {
    $email = test_input($_POST["email"]);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
    }
}

if(empty($_POST["website"])) {
    $website = "";
} else {
    $website = test_input($_POST["website"]);
    if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
        $websiteErr = "Invalid URL";
    }
}

if(empty($_POST["comment"])) {
    $comment = "";
} else {
    $comment = test_input($_POST["comment"]);
}

if(empty($_POST['gender'])) {
    $genderErr = "Select a gender";
} else {
    $gender = test_input($_POST['gender']);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<h2>form validation</h2>

<p> <span class="error"> * required fields </span> </p>

<form method="post" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">

    Name: <input type="text" name="name">
    E-mail: <input type="text" name="email">
    Website: <input type="text" name="website">
    Comment: <textarea name="comment" cols="30" rows="6"></textarea>
    <br><br>

    <input type="radio" name="gender" value="female">Female
    <input type="radio" name="gender" value="female">Male
    <br><br>

    <input type="submit" name="submit" value="Submit">
</form>

<?php

    echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $website;
    echo "<br>";
    echo $comment;
    echo "<br>";
    echo $gender;
    
?>

</body>
</html>