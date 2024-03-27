<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
</head>
<body>
    <?php require_once("php/initialize.php");
    checkPower($conn, 1);
    ?>
    <p>home</p>

    <?php
    $btnSend = "btnSend";
    $comandSeparator = "_";
    //loopback
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST[$btnSend])){
        //echo($_POST[$btnSend]);
        $tmp = explode($comandSeparator, $_POST[$btnSend]);
        $id = $tmp[0];
        $action = $tmp[1];
        echo ($id . "   " . $action);

        


    }

    $sql = "SELECT id, nome, descr, quantita
    FROM frutto";
    //echo ($sql);
    $result = $conn->query($sql);
    //echo ($result->num_rows);
    $i = 0;
    //echo($result->num_rows);
    while($row = $result->fetch_assoc()){
        ?>
        <p><?php echo($row["nome"]." | ".$row["quantita"]);?></p>
        <p><?php echo($row["descr"]);?></p>
        <br>
        <br>
        <?php
        $i++;
    }
    ?>




    <?php $conn->close()?>
</body>
</html>