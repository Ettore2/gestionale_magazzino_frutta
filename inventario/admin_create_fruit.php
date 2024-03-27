<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin create fruit</title>
</head>
<body>
    
    <?php require_once("php/initialize.php");
    checkPower($conn, 2);
    ?>
    <p>admin create fruit</p>

    <?php
    $postFruitName = "fruit_name";
    $postFruitDescr = "fruit_descr";
    $postFruitAmount = "fruit_amount";

    //loopback
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST[$postFruitName]) && isset($_POST[$postFruitDescr])){
        if(!isset($_POST[$postFruitAmount]) || $_POST[$postFruitAmount]==""){
            $_POST[$postFruitAmount] = 0;
        }
        //echo ($_POST[$postFruitName]);
        //echo ($_POST[$postFruitDescr]);
        //echo ($_POST[$postFruitAmount]);

        $sql = "INSERT INTO frutto (nome, descr, quantita) values ('".$_POST[$postFruitName]."', '".$_POST[$postFruitDescr]."', ".$_POST[$postFruitAmount].")";
        $conn->query($sql);
        
        header("Location: admin_home.php");
        die();
    }
    ?>
    
    <form action="" method="POST">
        <input type="text" name="<?php echo($postFruitName);?>" required placeholder="name">
        <br>
        <br>
        <input type="text" name="<?php echo($postFruitDescr);?>" required required placeholder="description">
        <br>
        <br>
        <input type="number" min="0" name="<?php echo($postFruitAmount);?>" placeholder="amount">
        <br>
        <br>
        <button type="submin">create fruit</button>
    </form>

    <form action="" method="POST">
    </form>


    <?php $conn->close()?>
</body>
</html>