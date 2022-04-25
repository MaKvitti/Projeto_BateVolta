
<?php

    session_start();
    if(!isset($_SESSION['id']))
    {
        header('Location: ../index.php');
        exit();
    }
    elseif($_SESSION['cargos']=='funcionario')
    {
        header('Location: ../funcionario/templateFun.php');
        exit();
    }

?>

<?php

  require ("../config/db.php");

    $objDb = new db();
    $link = $objDb->mysqlConnect();

    $selectSedes = "SELECT sedes.idSede, sedes.nome, enderecos.cep, enderecos.cidade, enderecos.estado FROM sedes INNER JOIN enderecos ON enderecos.idEndereco = sedes.FK_enderecos ORDER BY sedes.nome";
    $idSede = "idSede";
    $NomeSede= "nome";
    $sedeCep = "cep";
    $sedeCidade = "cidade";
    $sedeEstado = "estado";

    $RSelectSedes = mysqli_query($link,$selectSedes);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>

        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script src="../js/receberCotacao.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="js/gerente.js"></script>

        <title>Bate Volta | Logística</title>
        <link rel="shortcut icon" type="image/icon" href="../src/icon.ico" />
    </head>

    <body>
    <header class="bg-info"> 
    </header>
        <div class="container">
        <br>
        <div class="row justify-content-md-center">
              <h2>Encomendas Disponiveis</h2>
        </div>

        <form class="needs-validation" action="buscarDominioSede.php" method="post">

          <br><div class="row justify-content-md-center">

            <div class="col-md-10">
              <select class="form-control" name="idSede" id="remetente">
                      <option>Escolha da sede desejada...</option>
                      <?php while ($result = mysqli_fetch_array($RSelectSedes)) {?>
                        <option value="<?php echo $result[$sedeCep]?>"><?php echo $result[$NomeSede].", ".$result[$sedeCidade]." - ".$result[$sedeEstado]?></option>
                      <?php }?>
              </select>
            </div>
            <div class="col-md-auto"> <input class="w-100 btn btn-primary btn-info" type="submit" value="Buscar"><br><br></div>

          </div><br>

        </form>
        </div>
        <footer style="position: fixed; bottom: 0; width: 100%;" class="navbar-fixed-bottom text-white bg-info text-center">
        </footer>
    </body>
</html>
