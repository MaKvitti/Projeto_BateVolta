<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header('Location: ../index.php');
        exit();
    }
    elseif($_SESSION['cargos']=='gerente')
    {
        header('Location: ../gerente/template.php');
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
        <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script src="../js/receberCotacao.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="js/funcionario.js"></script>

        <title>Bate Volta | Logística</title>
        <link rel="shortcut icon" type="image/icon" href="../src/icon.ico" />
    </head>
   
    <body>
        <header class="bg-info">
        </header>
        <div class="container">
     
            <div class="col-md">
                <br>
                <h4 class="mb-3">Cotação de Envio</h4>
                <br>
                <form>
                    <fieldset>
                        <div class="row g-5">
                                    <div class="col-sm-6">
                                    <a class="my-4">Peso (Kg):</a><br>
                                    <input class="form-control" placeholder="--------------" type="text" id="peso"><br>
                                    </div>
                                    <div class="col-sm-6">
                                    <a class="my-4">Comprimento (cm):</a><br>
                                    <input class="form-control" placeholder="--------------" type="id" id="comprimento"><br>
                                    </div>
                                    <div class="col-sm-6">
                                    <a class="my-4">Largura (cm):</a><br>
                                    <input class="form-control" placeholder="--------------" type="text" id="largura"><br>
                                    </div>
                                    <div class="col-sm-6">
                                    <a class="my-4">Altura (cm):</a><br>
                                    <input class="form-control" placeholder="--------------" type="text" id="altura"><br>
                                    </div>
                                    <div class="col-sm-6">
                                    <a class="my-4">Volume:</a><br>
                                    <a class="my-4" id="volume"></a><br>
                                    </div>
                        </div>
                        <div class="row g-5">
                            <div class="col-sm-6">
                            <a class="my-4">CEP Origem:</a><br>
                            <input class="form-control" placeholder="--------------" type="text" id="cep1"><br>
                            </div>
                            <div class="col-sm-6">
                            <a class="my-4">CEP Destino:</a><br>
                            <input class="form-control" placeholder="--------------" type="text" id="cep2"><br>
                            </div>
                            
                        </div>
                        <div class="row g-5">
                            <div class="col-sm-6">
                            <a class="my-4">Cotação:</a><br>
                            <a class="my-4" id="cotacao"><h3>R$ 0,00</h3></a>
                            </div>
                            <div class="col-sm-6"><br>
                                <button class="w-50 btn btn-primary btn-info" id="but_calcular">Calcular</button><br>
                            </div>
                        </div>
                        

                    </fieldset>
                </form>
                
             </div>                  

        </div>
        <footer style="position: fixed; bottom: 0; width: 100%;" class="navbar-fixed-bottom text-white bg-info text-center">
        </footer>
    </body>
</html>