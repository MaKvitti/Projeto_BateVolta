<?php
    require('config/db.php');

    $objDB = new db();
    $linkConexao = $objDB->mysqlConnect();


    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];

    
    $querySelect = "SELECT sedes.nome, sedes.site, sedes.telefone, sedes.email, enderecos.cidade, enderecos.estado, enderecos.bairro,
                        enderecos.cep, enderecos.numero, enderecos.rua FROM sedes INNER JOIN enderecos ON sedes.FK_enderecos = enderecos.idEndereco 
                        where enderecos.cidade = '$cidade' and enderecos.estado = '$estado';";

    $runQuery = mysqli_query($linkConexao, $querySelect);

    
    $myArray = array();
    if ($runQuery){

        while($row = $runQuery->fetch_array(MYSQLI_ASSOC))
            $myArray[] = $row;

        echo json_encode($myArray);
    }
    else {
        echo 'Falha ao buscar informações!';
    }


?>