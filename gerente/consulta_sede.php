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
  require("../config/db.php");
  $objDB = new db();
  $linkConexao = $objDB->mysqlConnect();
  $consulta = "SELECT * FROM sedes";
  $con = mysqli_query($linkConexao,$consulta) or die($mysqli->error);
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
        <script type="text/javascript" src="../js/script.js"></script>
        <script src="../js/receberCotacao.js"></script>
        <script type="text/javascript" src="js/gerente.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.win.js"></script>
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">

        <title>Bate Volta | Logística</title>
        <link rel="shortcut icon" type="image/icon" href="src/icon.ico" />
    </head>
    <body>
        <header class="bg-info">

        </header>
        <div class="container">
    
            <table class="table table table-striped" id="tabelaSedes">
                <thead>
                  <tr>
                    
                    <th scope="col">ID</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Site</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                  </tr>
                </thead>
                <tbody>
                <?php while($dado = $con->fetch_array()){ ?>
                    <tr>
                      
                      <td><?php echo $dado["idSede"]; ?></td>
                      <td><?php echo $dado["telefone"]; ?></td>
                      <td><?php echo $dado["email"]; ?></td>
                      <td><?php echo $dado["site"]; ?></td>
                      <td><?php echo $dado["nome"]; ?></td>
                      <td><?php echo $dado["FK_enderecos"]; ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
              
              <script>
              $(document).ready( function () {
                $('#tabelaSedes').DataTable({
                  "language": {
                    "lengthMenu": "Mostrando _MENU_ Registros por pagina",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro disponivel",
                    "infoFiltered": "(filtrado de _MAX_ registro total)"
                  }
                });
              });
              </script>  
        </div>
    </body>
    <footer class="navbar-fixed-bottom text-white bg-info text-center">
    </footer>
</html>
