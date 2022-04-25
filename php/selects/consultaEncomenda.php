<?php

        switch($_POST['func']) {
            case 'vereficaEncomendaNull':
                $output = vereficaEncomendaNull();
                break;
            case 'listaEncomenda':
                $output = listaEncomenda();
                break;
        }

        echo $output;
       
        function vereficaEncomendaNull(){

            $codigo = $_POST['codigo'];

            require '../../config/db.php';
    
            $db = new db();
            $link = $db->mysqlConnect();
    
            $query = $link->prepare("SELECT codRastreio FROM encomendas WHERE codRastreio = ?;");
            $query->bind_param("s", $codigo);
            $run = $query->execute();
            $resultCodRastreio = $query->get_result()->fetch_array(MYSQLI_ASSOC);

            if(!$run){
                    echo("erro");
            }
            else{
                    echo $resultCodRastreio["codRastreio"];
            }
        }

        function listaEncomenda(){

            $codigo = $_POST['codigo'];

            require '../../config/db.php';
    
            $db = new db();
            $link = $db->mysqlConnect();

            $list = [];

            $selectEncomenda = $link->prepare("SELECT idEncomenda, codRastreio, FK_enderecoDestinatario, FK_enderecoSede, dataPostagem FROM encomendas WHERE codRastreio = ?;");
            $selectEncomenda->bind_param("s", $codigo);
            $run = $selectEncomenda->execute();

            if(!$run){
                    echo("erro");
            }
            else{
                $encomendaArray = $selectEncomenda->get_result()->fetch_array(MYSQLI_ASSOC);
                $enderecoDestinatarioArray =  selectEnderecoDestinatario($link, (int)$encomendaArray["FK_enderecoDestinatario"]);
                
                if($enderecoDestinatarioArray == "erro"){
                        echo("erro");
                }
                else{
                    $enderecoSedeArray =  selectEnderecoSede($link, (int)$encomendaArray["FK_enderecoSede"]);

                    if($enderecoSedeArray == "erro"){
                            echo("erro");
                    }
                    else{
                        $list['encomenda'] = array("dados"=>$encomendaArray,'enderecoDestinatario'=>$enderecoDestinatarioArray,'enderecoSede'=>$enderecoSedeArray);
                
                        $rotaArray =  selectRota($link, (int)$encomendaArray["idEncomenda"]);
                        $rotaArrayCopy = $rotaArray;

                        if($rotaArray == "erro"){
                                echo("erro");
                        }
                        else{
                            while($result = mysqli_fetch_assoc($rotaArrayCopy)){
                                $enderecoRotaArray =  selectEnderecoRota($link, (int)$result["FK_endereco"]);

                                if($enderecoRotaArray == "erro"){
                                    break;
                                }
                                else{
                                    $list['rota'][] = array("dados"=>$result,'endereco'=>$enderecoRotaArray);
                                }
                            }
                            
                            if($enderecoRotaArray == "erro"){
                                echo("erro");
                            }
                            else{
                                echo json_encode($list);
                            }
                        }
                    }
                }
            }
        }

        function selectEnderecoDestinatario($link, $idEnderecoDestinatario){
            $selectEnderecoDestinatario = $link->prepare("SELECT rua,numero,bairro,cidade,estado,cep,complemento,data FROM enderecos WHERE idEndereco = ? ORDER BY data;");
            $selectEnderecoDestinatario->bind_param("i", $idEnderecoDestinatario);
            $run = $selectEnderecoDestinatario->execute();

            if(!$run){
                return "erro";
            }
            else{
                $enderecoDestinatarioArray = $selectEnderecoDestinatario->get_result()->fetch_array(MYSQLI_ASSOC);
                return $enderecoDestinatarioArray;
            }
        }

        function selectEnderecoSede($link, $idEnderecoSede){
            $selectEnderecoSede = $link->prepare("SELECT rua,numero,bairro,cidade,estado,cep,complemento,data FROM enderecos WHERE idEndereco = ?;");
            $selectEnderecoSede->bind_param("i", $idEnderecoSede);
            $run = $selectEnderecoSede->execute();
            

            if(!$run){
                return "erro";
            }
            else{
                $EnderecoSedeArray = $selectEnderecoSede->get_result()->fetch_array(MYSQLI_ASSOC);;
                return $EnderecoSedeArray;
            }
        }

        function selectRota($link, $idEncomenda){
            $selectRota = $link->prepare("SELECT status, FK_endereco, data FROM rotas_encomendas WHERE FK_encomendas = ?;");
            $selectRota->bind_param("i", $idEncomenda);
            $run = $selectRota->execute();

            if(!$run){
                return "erro";
            }
            else{
                $rotaArray = $selectRota->get_result();
                return $rotaArray;
            }
        }

        function selectEnderecoRota($link, $idEnderecoRota){
            $selectEnderecoRota = $link->prepare("SELECT rua,numero,bairro,cidade,estado,cep,complemento,data FROM enderecos WHERE idEndereco = ?;");
            $selectEnderecoRota->bind_param("i", $idEnderecoRota);
            $run = $selectEnderecoRota->execute();

            if(!$run){
                return "erro";
            }
            else{
                $enderecoRotaArray = $selectEnderecoRota->get_result()->fetch_array(MYSQLI_ASSOC);
                return $enderecoRotaArray;
            }
        }
?>