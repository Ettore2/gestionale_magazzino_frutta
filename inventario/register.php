<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>
<body>
    <?php require("php/initialize.php");?>
    <?php
    $postUsername = "username";
    $postPassword = "password";

    //loopback
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST[$postUsername]) && isset($_POST[$postPassword])){
        $sql = "SELECT id
        FROM user
        WHERE username = '" . $_POST[$postUsername] . "'";
        //echo ($sql);
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {//register user
                //echo ("register");

            $conn->begin_transaction();

            try {// Perform database operations
                $conn->query("INSERT INTO user (username, password) VALUES ('".$_POST[$postUsername]."', '".$_POST[$postPassword]."')");
                $conn->query("INSERT INTO potere_user (id_user, id_potere) SELECT id, 1 FROM user where username = '".$_POST[$postUsername]."'");
                // Commit transaction
                $conn->commit();

                $_SESSION[SESSION_USERNAME] = $_POST[$postUsername];
                header("Location: home.php");
                die();
                //echo ("header");

            } catch (Exception $e) {
                // Rollback on failure
                $conn->rollback();
                //echo ("error");
            }
        }
    }
    

    
    ?>

    <p>rergister page</p>
    <form action="" method="POST">
        <input type="text" required name="<?php echo($postUsername);?>">
        <input type="password" required name="<?php echo($postPassword);?>">
        <button type="submit">register</button>

    </form>
    <br>
    <form action="index.php" method="GET">
        <button type="submit">log in with an account</button>

    </form>

    <?php $conn->close()?>
</body>
</html>