<?php 
    require_once "config.php";
    $rnd = rand(10, 200);
    for ($i=0; $i < 100; $i++) { 
        $query = "INSERT INTO `User` (first_name, last_name, email, password) VALUES (?, ? , ?, ?)";
        $params = ["firstName0".$i  , "lastName0".$i, "ema".$rnd."i".$i."@domain.com", "firstName0".$i];
        $stmt = $pdo -> prepare($query);
        $stmt -> execute($params);

    }

?>