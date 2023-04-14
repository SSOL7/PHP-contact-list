<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myshop";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);


    $id = "";
    $name = "";
    $email = "";
    $phone = "";
    $address = "";

    $errormessage = "";
    $successmessage = "";

    if( $_SERVER['REQUEST_METHOD'] == 'GET' ) {

        if( !isset($_GET['id']) ) {
            header("location: /myshop/index.php");
            exit;
        }

        $id = $_GET['id'];

        $sql = "SELECT * FROM clients WHERE id = $id";
         $result = $connection->query($sql);
          $row = $result->fetch_assoc();

          if( !$row ) {
              header("location: /myshop/index.php");
              exit;
          }

            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $address = $row['address'];

    } else {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        do {
            if( empty($id) || empty($name) || empty($email) || empty($phone) || empty($address) ) {
                $errormessage = "Please fill all the fields";
                break;
            }

            $sql = "UPDATE clients SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = $id";

            $result = $connection->query($sql);

            if(!$result) {
                $errormessage = "invalid query" . $connection->eror;
                break;
            }

            $successmessage = "Client updated successfully";

            header("Location: /myshop/index.php");

        } while (false);

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>

    <style>

        body {
            background-color: silver;
        }

        .success {
            color: green;
        }

        p {
            color: green;
        }

        h3 {
            color: red;
        }

        a {
            text-decoration: none;
            color: white;
        }

        button {
            background-color: green;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

    </style>

<body>

<div class="container">
    <h2>new client</h2>

    <?php
        if( !empty($errormessage) ) {
            echo "<h3>$errormessage</h3>";
        }
    ?>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">


            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="name" value="<?php echo $name ?>">
            </div>

            <div>
                <label for="name">Email</label>
                <input type="text" name="email" id="name" placeholder="name" value="<?php echo $email ?>">
            </div>

            <div>
                <label for="name">Phone</label>
                <input type="text" name="phone" id="name" placeholder="name" value="<?php echo $phone ?>">
            </div>

            <div>
                <label for="name">Address</label>
                <input type="text" name="address" id="name" placeholder="name" value="<?php echo $address ?>">
            </div>

            <?php
                if( !empty($successmessage) ) {
                    echo "<p>$successmessage</p>";
                }
            ?>

            <div>
                <button type="submit">Submit</button>
            </div>

            <div>
                <a href="/myshop/index.php">Cancel</a>
            </div>
    </form>


</div>
    
</body>
</html>


