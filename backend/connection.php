<?php

try {
    $connection = new PDO('mysql:host=localhost;dbname=cashbapp_prot', 'root', 'root');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $error) {
    echo $error->getMessage();
}

?>