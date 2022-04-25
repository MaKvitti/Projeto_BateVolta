<?php

    switch($_POST['func']) {
        case 'consultaFuncionariosDisponiveis':
            $output = consultaFuncionariosDisponiveis();
            break;
    }

    echo $output;

    function consultaFuncionariosDisponiveis(){
        $FK_sede = $_POST['FK_sede'];

        require '../../config/db.php';

        $db = new db();
        $link = $db->mysqlConnect();

        $list = [];

        $selectFuncionario = $link->prepare("SELECT idFuncionario, nome, cargo, ativo FROM funcionarios WHERE cargo = 'funcionario' AND FK_sedes = ?;");
        $selectFuncionario->bind_param("i", $FK_sede);
        $run = $selectFuncionario->execute();
        $resultSelectFuncionario = $selectFuncionario->get_result();

        if(!$run){
            echo("erro");
        }
        else{
            while($result = mysqli_fetch_assoc($resultSelectFuncionario)){
                $list['funcionario'][] = array('dados'=>$result);
            }
            echo json_encode($list);
        }
    }

    function selectFuncionarioAtivo($link, $idFuncionario){
        $selectFuncionarioAtivo = $link->prepare("SELECT ativo FROM rotas WHERE FK_funcionario = ?;");
        $selectFuncionarioAtivo->bind_param("i", $idFuncionario);
        $run = $selectFuncionarioAtivo->execute();

        if(!$run){
            return "erro";
        }
        else{
            $funcionarioAtivoArray = $selectFuncionarioAtivo->get_result()->fetch_array(MYSQLI_ASSOC);
            return $funcionarioAtivoArray;
        }
    }
?> 