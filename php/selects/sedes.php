<?php
    require '../../config/db.php';
  
    $db = new db();
    $link = $db->mysqlConnect();
  
    $dbIdSede = "idSede";
    $dbNomeSede = "nome";
  
    $query = $link->prepare("SELECT $dbIdSede , $dbNomeSede FROM sedes ORDER BY nome");
    $run = $query->execute();
    $resultSelectSedes = $query->get_result();

    $list = [];
    
    while($result = mysqli_fetch_assoc($resultSelectSedes)){
        array_push($list, $result);
    }

    echo json_encode($list);
?>