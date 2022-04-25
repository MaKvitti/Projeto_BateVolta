<?php

    require('../../config/db.php');

    $nome = $_POST['name'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $celular = $_POST['celular'];
    $cargo = $_POST['cargo'];
    $sede = $_POST['sede'];
    $sexo = $_POST['sexo'];

    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $complemento = $_POST['complemento'];
    $ativo = 1;

    $db = new db();
    $link = $db->mysqlConnect();

    $salt = rand(1, 10000);
    $saltHash = md5((string)$salt);
    $senhaHash = md5($senha);
    $fimHash = md5($senhaHash.$saltHash);

    $data = new DateTime();
    $dateTime = $data->format('Y-m-d H:i:s');

    $insertEndereco = $link->prepare("INSERT INTO enderecos(rua,numero,bairro,cidade,estado,cep,complemento,data) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
    $insertEndereco->bind_param("sissssss", $rua, $numero, $bairro, $cidade, $uf, $cep, $complemento, $dateTime);
    $run = $insertEndereco->execute();

    $insertFuncionario = $link->prepare("INSERT INTO funcionarios(nome, cpf, celular, sexo, cargo, senha, salt, FK_enderecos, FK_sedes, data, ativo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
    $insertFuncionario->bind_param("sssssssssss", $nome, $cpf, $celular, $sexo, $cargo, $fimHash, $saltHash, mysqli_insert_id($link), $sede, $dateTime, $ativo);
    $run = $insertFuncionario->execute();

    header('Location: ../../gerente/admCadastroFuncionario.php');

?>