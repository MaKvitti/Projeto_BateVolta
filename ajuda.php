<?php
    $Salt = md5('77');
    $senha = md5('123');
    $senha = md5($senha.$Salt);
    echo 'Senha :'.$senha.'<br> Salt : '.$Salt;

?>