<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>

    body {
        background-color: silver;
    }

    td {
        border: 1px solid black;
    }

    table {
        border-collapse: collapse;
    }

    td:nth-child(odd) {
        background-color: #f2f2f2;
    }

    a {
        text-decoration: none;
        color: black;
        background-color: aqua;
    }

</style>

<body>

<div class="container">
    <h2>list of clients</h2>
    <a href="/myshop/create.php">new client</a>
    <br>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>address</th>
                <th>created at</th>
                <th>action</th>
            </tr>
        </thead>

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "myshop";

            // Create connection
            $connection = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM clients";
            $result = $connection->query($sql);

            if(!$result) {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["phone"] . "</td>
                            <td>" . $row["address"] . "</td>
                            <td>" . $row["created_at"] . "</td>
                            <td>
                                <a href='/myshop/edit.php?id=" . $row["id"] . "'>edit</a>
                                <a href='/myshop/delete.php?id=" . $row["id"] . "'>delete</a>
                            </td>
                      </tr>";
            }

        ?>

        <tbody>
            
        </tbody>
    </table>

</div>
    
</body>
</html>



