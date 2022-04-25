<?php
    
    //Classe que implementará as chamadas da API do google
    class G_API { 

        private $key    = null;
        private $error  = false;

        function __construct ($key = null){
            if (!empty($key)) $this->key = $key;
        }

        function request ($endpopint = '', $params = array()){
            $uri = 'https://maps.googleapis.com/maps/api/'.$endpopint.'json?key=' . $this->key; //url da api sem os parametros de pesquisa
            
            if (is_array($params)){         //Verificando se a URI possui parametros
                
                foreach ($params as $key => $value){
                    if (empty($value)) continue;

                    $uri .= '&' . $key . '=' . urlencode ($value);    //adicionando os parametros na uri
                }
                
                //$uri        = substr($uri, 0, -1); // removendo o ultimo '&'
                $responnse  = @file_get_contents($uri);
                $this->error = false;
                return json_decode($responnse, true);   //retornando o array de respostas

            } else {        // ERRO -> Não foi retornado nada na consulta da api
                $this->error =true;   
                echo("aqui");              
                return false;
            }
        }

        function is_error (){
            return $this->error;
        }

        function distance_calc ($origins, $destinations) {
            $params = array('origins' => $origins, 'destinations' => $destinations); 
            $data   = $this->request('distancematrix/', $params);
            if (!empty($data)){// && is_array($data["destination_addresses"]["origin_addresses"]["rows"]["distance"])){
                $this->error = false;
                return $data["rows"][0]["elements"][0]["distance"]["value"];
            } else {            // ERRO -> Não foi possivel encontrar o array
                $this->error = true;
                echo ("FALHA AO BUSCAR AS INFORMAÇÕES!");
                return false;
            }
        }
    }



    //https://maps.googleapis.com/maps/api/distancematrix/json?key=AIzaSyBjhLpaF8qIzm1ILLfF81yWjFUllm7VdSA&origins=cep%2013504365&destinations=lago%20azul%20rio%20claro%20sp



?>