<?php

try {
    $connection = new PDO('mysql:host=localhost;dbname=cashbapp_prot', 'root', 'root');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /*$result = $connection->query("SELECT * FROM realeases")->fetchAll();

    foreach ($result as $item) {
        if ($item['approved'] == 'S') {
            $approved = "Sim";
        } else {
            $approved = "Não";
        }

        echo $item['id'] . ' - ' . $item['userName'] . ' - ' . $approved . '<br />';
    }*/
} catch(PDOException $error) {
    echo $error->getMessage();
}

?>