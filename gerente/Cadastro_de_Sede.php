<?php
    /* Este código recebe as informações do HTML e usa a conexão para enviar
    dados para o banco. */

    require ("../config/db.php"); // Chamando o outro arquivo PHP

    // Criando as variáveis para os Inputs recebidos do Form HTML
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $complemento = $_POST['complemento'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $site = $_POST['site'];
    $nome = $_POST['nome'];


    // Vamos criar um objeto da classe de conexão ao banco de dados
    $objDB = new db();
    $linkDeConexao = $objDB->mysqlConnect();

    // Montando a query de inserção
    $queryInsert = "INSERT INTO enderecos(rua, numero, bairro, cidade, estado, cep, complemento) VALUES ('$rua', '$numero', '$bairro', '$cidade', '$estado', '$cep', '$complemento')";
    $runQuery = mysqli_query($linkDeConexao, $queryInsert);
    
    $idEndereco = mysqli_insert_id($linkDeConexao);

    $queryInsert2 = "INSERT INTO sedes(telefone, email, site, nome, FK_enderecos) VALUES  ('$telefone', '$email', '$site', '$nome', '$idEndereco')";
    $runQuery2 = mysqli_query($linkDeConexao, $queryInsert2);

    // Executando a query no objeto de conexão
    

    // Verificando o que aconteceu no código
    if($runQuery and $runQuery2)
    {
        // Código funcionando com sucesso
         echo '<h1>Sede cadastrado com sucesso!</h1>';
        //header("Location: Cadastro_de_Sedes.html");
    }
    else
    {
        // Erro no código
         echo '<h1>Erro ao cadastrar sede!</h1>';
       //header("Location: Cadastro_de_Sedes.html");

    }
?>