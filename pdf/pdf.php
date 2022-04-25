<?php

  require ("../config/db.php");

  $objDb = new db();
  $link = $objDb->mysqlConnect();

  $buscar = $_POST['pdf'];
  $selectEncomendas = "SELECT enderecos.cep, enderecos.estado, enderecos.cidade, rotas_encomendas.status FROM rotas_encomendas
  INNER JOIN encomendas ON encomendas.idEncomenda = rotas_encomendas.FK_encomendas
  INNER JOIN enderecos ON rotas_encomendas.FK_endereco = enderecos.idEndereco 
  WHERE encomendas.codRastreio = '$buscar'";
  $FK_endereco1 = 'cidade';
  $FK_endereco2 = 'estado';
  $FK_endereco3 = 'cep';
  $FK_status = 'status';

  //SELECT enderecos.cep FROM `rotas_encomendas` INNER JOIN enderecos ON rotas_encomendas.FK_encomendas= enderecos.idEndereco WHERE FK_encomendas=1
  $RSelectBusca = mysqli_query($link,$selectEncomendas) or die("Erro ao retornar dados");


//-----------------------------------------

require_once 'dompdf/autoload.inc.php';

// referenciando o namespace do dompdf

use Dompdf\Dompdf;

// instanciando o dompdf
$dompdf = new Dompdf();


//lendo o arquivo HTML correspondente

$html = "<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #0dcaf0;
}
</style>

<title>Bate Volta | Logística</title>
</head>
<body><center><h1 > Processo de Entrega</h1></center><br><br>
      <center><h4 > Codigo de Rastreio: ".$buscar."</h4></center><br><br><br>";
$html .="<center>__________________________________________________________________________________</center><br><br>";
$html .= "<table border=1>
              <tr>
                 <th>Endereço</th>
                 <th>Status</th>
              </tr>
             </thead>";
 while ($busca = mysqli_fetch_array($RSelectBusca))
     {
       $html .="<tr><td>Cidade: ".$busca[$FK_endereco1]."
                        -".$busca[$FK_endereco2]."<br>Cep: ".$busca[$FK_endereco3]."</td>";
       $html .="<td>".$busca[$FK_status]."</td></tr>";
     }
$html .= "</table></body>
</html>
";

//inserindo o HTML que queremos converter

$dompdf->loadHtml($html);

// Renderizando o HTML como PDF

$dompdf->render();

// Enviando o PDF para o browser

$dompdf->stream(
  "Relatorio.pdf",
  Array(
      "Attachment" => false
    )

 );
