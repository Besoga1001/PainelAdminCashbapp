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

    include('src/backend/connection.php');

    $result = $connection->query("SELECT * FROM realeases")->fetchAll();

    function approvesRequest($id, $connection) {
        $erro = 0;
        $approved = $connection->query("SELECT approved FROM realeases WHERE id = '$id';")->fetchColumn();
        if ($approved == 'E') {
            $connection->query("UPDATE realeases SET approved = 'S' WHERE id = '$id';");
        } else {
            $erro = 1;
        }
        return $erro;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["approvesRequest"])) {
        $erro = approvesRequest($_POST['id'], $connection);
        if ($erro == 0) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="src/frontend/style.css">
    <link rel="stylesheet" type="text/css" href="src/frontend/header.css">
    <link rel="stylesheet" type="text/css" href="src/frontend/menuBar.css">
    <link rel="stylesheet" type="text/css" href="src/frontend/realeases.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <title>Painel de Relatórios</title>
</head>
<body>
    <div class="container">
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
        </div>
        <div id="realeases">
            <table>
                <caption>SOLICITAÇÕES</caption>
                <tr>
                    <th class='rowTable'>ID</th>
                    <th class='rowTable' id='seller'>VENDEDOR</th>
                    <th class='rowTable' id='situation'>SITUAÇÃO</th>
                    <th class='rowTable' >PDF</th>
                </tr>
                    <?php
                        foreach($result as $item) {
                            $id = strtoupper($item['id']);
                            $userName = mb_strtoupper($item['userName']);
                            $approved = getStringApproved($item['approved']);
                            echo 
                            "<tr>
                                <td name='id' class='rowTable'>$id</td>
                                <td class='rowTable'>$userName</td>
                                <td class='rowTable'>$approved</td>
                                <form action='pdf-loader.php' method='get'>
                                    <td class='pdfIcon'>
                                        <a href='src/backend/pdf-loader.php?id=$id' target='_blank'>
                                            <img class='icon' src='images/pdf-icon.png'>
                                        </a>
                                    </td>
                                </form>
                                <form method='POST'>
                                    <td class='buttonTable'>
                                        <input type='hidden' name='id' value='$id'>
                                        <input type='hidden' name='approvesRequest' value='1'>
                                        <input id='buttonToApprove' type='submit' value='APROVAR'>
                                    </td>
                                </form>
                            </tr>";
                        }
                    ?>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
