<?php
    include_once('src/backend/connection.php');

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $pdf_path = $connection->query("SELECT nfe_pdf FROM realeases WHERE id = $id")->fetchColumn();
        $pdf_file = basename($pdf_path);
        $final_dir = 'nfe_pdf/' . $pdf_file;
        copy($pdf_path, $final_dir);
    } else {
        echo "Erro: ID Inválido";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../frontend/pdfLoader.css">
    <title>Nota Fiscal Eletrônica</title>
</head>
<body>
    <div class='pdfReader'>
        <?php
        echo "<embed src='../../nfe_pdf/$pdf_file' type='application/pdf' width='100%' height='100%'>";
        ?>
    </div>
</body>
</html>

