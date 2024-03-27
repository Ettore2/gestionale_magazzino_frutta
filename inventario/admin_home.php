<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin home</title>
</head>
<body>
    <?php require_once("php/initialize.php");
    checkPower($conn, 2);
    ?>
    <p>admin home</p>

    <?php
    $btnSend = "btnSend";
    $comandSeparator = "_";
    //loopback
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST[$btnSend])){
        //echo($_POST[$btnSend]);
        $tmp = explode($comandSeparator, $_POST[$btnSend]);
        $id = $tmp[0];
        $action = $tmp[1];
        //echo ($id . "   " . $action);

        switch($action){
            case 0:
                if($conn->query("SELECT quantita FROM frutto WHERE id = ".$id)->fetch_assoc()["quantita"]>0){
                    $sql = "UPDATE frutto
                    SET quantita = ((SELECT quantita FROM frutto WHERE id = ".$id.")-1)
                    WHERE id = ".$id.";";
                    $conn->query($sql);
                    //echo ("remouve");
                }else{
                    //echo ("too low to remouve");
                }
                break;
            case 1:
                $sql = "UPDATE frutto
                SET quantita = ((SELECT quantita FROM frutto WHERE id = ".$id.")+1)
                WHERE id = ".$id.";";
                $conn->query($sql);
                //echo ("add");
                break;
        }


    }

    $sql = "SELECT id, nome, descr, quantita
    FROM frutto";
    //echo ($sql);
    $result = $conn->query($sql);
    //echo ($result->num_rows);
    ?>
    
    <form action="admin_create_fruit.php" method="POST">
        <button type="submin">create fruit</button>
    </form>
    <br>

    <form action="" method="POST">
    <?php
    //echo($result->num_rows);
    while($row = $result->fetch_assoc()){
        ?>
        <p><?php echo($row["nome"]." | ".$row["quantita"]);?></p>
        <p><?php echo($row["descr"]);?></p>
        <button type="submit" name="<?php echo($btnSend);?>" value="<?php echo($row["id"].$comandSeparator."0");?>">-</button>
        <button type="submit" name="<?php echo($btnSend);?>" value="<?php echo($row["id"].$comandSeparator."1");?>">+</button>
        <br>
        <br>
        <?php
    }
    ?>
    </form>
    <br>
    <?php





    ?>




    <?php $conn->close()?>
</body>
</html>