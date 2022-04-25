<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header('Location: ../index.php');
        exit();
    }
    elseif($_SESSION['cargos']=='funcionario')
    {
        header('Location: ../funcionario/templateFun.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>

        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="js/consultaEncomenda.js"></script>
        <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/gerente.js"></script>
        
        <title>Bate Volta | Logística</title>
        <link rel="shortcut icon" type="image/icon" href="../src/icon.ico" />
    </head>
    <body>
        <header class="bg-info">
        </header>
        <br>
        <div class="form-inline container">
            <label class="mr-4">Consulta sua encomenda:</label>
            <input class="form-control mr-sm-2" type="search" name="pdf" id="txtCodigo" placeholder="Código" aria-label="Código">
            <button class="btn btn-info my-2 my-sm-0" id="btnCodigo">Consultar</button>
        </div> 
        <div>
            <div class="container mt-3" id="msgConsulta"></div>
            <div class="container mt-3" id="tabelaConsulta"></div>
        </div>
        <footer style="position: fixed; bottom: 0; width: 100%;" class="navbar-fixed-bottom text-white bg-info text-center">
        </footer>
    </body>
</html>