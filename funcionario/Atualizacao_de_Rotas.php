<?php
    /* Este código recebe as informações do HTML e usa a conexão para enviar
    dados para o banco. */

    require ("../config/db.php"); // Chamando o outro arquivo PHP

    // Criando as variáveis para os Inputs recebidos do Form HTML
    $ativo = $_POST['ativo'];
    $idRota = $_POST['idRota'];


    // Vamos criar um objeto da classe de conexão ao banco de dados
    $objDB = new db();
    $linkDeConexao = $objDB->mysqlConnect();

    // Montando a query de atuualização
    $queryUpdate = "UPDATE rotas SET ativo = '$ativo' WHERE idRota = '$idRota'";

    // Executando a query no objeto de conexão
    $runQuery = mysqli_query($linkDeConexao, $queryUpdate);

    

    // Verificando o que aconteceu no código
    if($runQuery)
    {
        // Código funcionando com sucesso
         echo '<h1>Rota atualizado com sucesso!</h1>';
        //header("Location: Atualizacao_de_Rotas.html");
    }


    else
    {
        // Erro no código
         echo '<h1>Erro ao atualizar a rota!</h1>'.mysqli_error($linkDeConexao);
       //header("Location: Atualizacao_de_Rotas.html");

    }
?>