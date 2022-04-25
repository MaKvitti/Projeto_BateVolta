<?php
        

        class db{
            //Parametros de conexão ao SGBD do MySQL
            private $host = 'localhost'; 
            private $username = 'root'; 
            private $password = '';
            private $database = 'batevolta';

            
            public function mysqlConnect(){
                
                $con = mysqli_connect($this->host,
                                      $this->username,
                                      $this->password,
                                      $this->database);

                mysqli_set_charset($con, 'utf-8');

                if (mysqli_connect_errno())
                    echo 'Erro ao se conectar ao banco de dados' .mysqli_connect_error();

                return $con;
            }
        }


?>