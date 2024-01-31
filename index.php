<?php 
    function getStringApproved($approved) {
        $string = "";

        if ($approved == "S"){
            $string = "APROVADA";
        }elseif($approved == "E"){
            $string = "EM ANALÍSE";
        } else {
            $string = "DESAPROVADA";
        }

        return $string;
    }

    if (!extension_loaded('mbstring')) {
        die('A extensão mbstring não está habilitada.');
    }

    include('src/backend/connection.php')
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="src/frontend/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <title>Painel de Relatórios</title>
</head>
<body>
    <div class="header">
        <h1 class="logoText">CASHBAPP</h1>
        <img id="logo" src="images/LogoCashbapp.png">
        <h1 class="title">PAINEL DE ADMINISTRADOR</h1>
    </div>
    <div class="break"></div>
    <div class="menuBar">
        <div class="firstComponentMenuBar">
            <img class="iconMenuBar" src="images/solicitacaoImg.png">
            <h1 class="textMenuBar">SOLICITAÇÕES</h1>
            <img class="lineMenuBar" src="images/division-menuBar.png">
        </div>
        <div class="componentMenuBar">
            <img class="iconMenuBar" src="images/monetarioIcon.png">
            <h1 class="textMenuBar">MONETÁRIO</h1>
            <img class="lineMenuBar" src="images/division-menuBar.png">
        </div>
    </div>
    <div class="table">
        <table>
            <tr>
                <th>ID</th>
                <th id="seller">VENDEDOR</th>
                <th id="situation">SITUAÇÃO</th>
            </tr>
            
                <?php
                    $result = $connection->query("SELECT * FROM realeases")->fetchAll();

                    foreach($result as $item) {
                        $id = strtoupper($item['id']);
                        $userName = mb_strtoupper($item['userName']);
                        $approved = getStringApproved($item['approved']);
                        echo "<tr>";
                        echo "<td>$id</td>";
                        echo "<td>$userName</td>";
                        echo "<td>$approved</td>";
                        echo "</tr>";
                    }
                ?>
            </tr>
        </table>
    </div>
</body>
</html>
