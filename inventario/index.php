<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <?php require_once("php/initialize.php");?>
    <?php
    $postUsername = "username";
    $postPassword = "password";

    //loopback
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST[$postUsername]) && isset($_POST[$postPassword])){
        $sql = "SELECT id
        FROM user
        WHERE username = '" .$_POST[$postUsername] ."' and Password = '" .$_POST[$postPassword] ."'";
        //echo ($sql);
        $result = $conn->query($sql);
        if($result->num_rows == 1){//take user powers
            $_SESSION[SESSION_USERNAME] = $_POST[$postUsername];

            $sql = "SELECT id_potere
            FROM user join potere_user on user.id = potere_user.id_user
            WHERE user.id = " .$result->fetch_assoc()["id"];
            //echo ($sql);
            $result = $conn->query($sql);

            $i = 0;
            //echo($result->num_rows);
            while($row = $result->fetch_assoc()){
                $array[$i] = $row["id_potere"];
                $i++;
            }
            
            if(in_array(2,$array)){
                header("Location: admin_home.php");
                die();
            }
            if (in_array(1, $array)) {
                header("Location: home.php");
                die();
            }
        }
    }
    


    ?>

    <p>login page</p>
    <form action="" method="POST">
        <input type="text" required name="<?php echo($postUsername);?>">
        <input type="password" required name="<?php echo($postPassword);?>">
        <button type="submit">login</button>

    </form>
    <br>
    <form action="register.php" method="GET">
        <button type="submit">create new account</button>

    </form>


    <?php $conn->close()?>
</body>
</html>