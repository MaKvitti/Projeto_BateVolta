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
        <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="js/gerente.js"></script>

        <title>Bate Volta | Logística</title>
        <link rel="shortcut icon" type="image/icon" href="../src/icon.ico" />

        <script>
            $(document).ready(function(){
               //Carregando os dados já salvos no banco
                $.getJSON("precosExport.php", function(respostaJSON){
                    
                    $(respostaJSON).each(function(indexJSON, objetoJSON){
                        //Escreve os dados lidos nos inputs
                        var elemento = document.getElementById("km");
                        elemento.value =parseFloat(objetoJSON.precoKm).toFixed(3);
    
                        var elemento = document.getElementById("volume");
                        elemento.value = parseFloat(objetoJSON.precoVolume).toFixed(3);
    
                        var elemento = document.getElementById("peso");
                        elemento.value = parseFloat(objetoJSON.precoPeso).toFixed(3);
                        
                        var elemento = document.getElementById("fixo");
                        elemento.value = parseFloat(objetoJSON.precoFixo).toFixed(3);
                        
                    });
                });
            });
        </script>

    </head>
    <body>
        <header class="bg-info"> 
        </header>
        <div class="container">   
            <div class="col-md">
                <br>
                <h4 class="mb-3">Atualizar preços de Envio</h4>
                <br>     
                    <form method="POST" action="atualizarPreco.php" target="_self">
                        <fieldset>
                            <div class="row g-5">
                                <div class="col-sm-6">
                                    <a class="my-4">Preço do Km:</a><br>
                                    <input class="form-control" placeholder="--------------" type="text" name="km" id="km"><br>
                                </div>
                                <div class="col-sm-6">
                                    <a class="my-4">Preço do volume(cm<sup>3</sup>):</a><br>
                                    <input class="form-control" placeholder="--------------" type="text" name="volume" id="volume"><br>
                                </div>
                                <div class="col-sm-6">
                                    <a class="my-4">Preço do Peso(Kg):</a><br>
                                    <input class="form-control" placeholder="--------------" type="text" name="peso" id="peso"><br>
                                </div>
                                <div class="col-sm-6">
                                    <a class="my-4">Preço Fixo por frete:</a><br>
                                    <input class="form-control" placeholder="--------------" type="text" name="fixo" id="fixo"><br>
                                </div>
                            </div>
                            <br>
                                    <input class="w-100 btn btn-primary btn-info" type="submit" value="Atualizar"><br>
                        </fieldset>
                    </form>
                </div>

        </div>
        <footer style="position: fixed; bottom: 0; width: 100%;" class="navbar-fixed-bottom text-white bg-info text-center">
        </footer>
    </body>
</html>