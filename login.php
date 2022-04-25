<?php
    session_start();
    if(isset($_SESSION['id'])){
      if($_SESSION['cargos']=='gerente'){
        #********************** LEMBRAR ***************************
        header("Location: gerente/template.php");
        #********************** LEMBRAR ***************************
        exit();
      }
      elseif($_SESSION['cargos']=='funcionario'){

        header("Location: funcionario/templateFun.php");

        exit();
      }
    }
    if(!isset($_POST['usuario'])){

        header("Location: index.php");
        exit();
    }
?>
<?php
    require('config/db.php');

    $username = $_POST['usuario'];
    $password = $_POST['senha'];

    $db = new db();
    $link = $db->mysqlConnect();

    $query = $link->prepare("SELECT idFuncionario, cpf , senha, salt, cargo FROM funcionarios WHERE cpf = ?;");
    $query->bind_param("s", $username);
    $run = $query->execute();
    $result = $query->get_result();

    if($run)
    {       
        if($row = $result->fetch_array(MYSQLI_ASSOC))
        {   
            if($row['senha'] == md5(md5($password).$row['salt']))
            {             

                if($row['cargo'] == 'gerente'){

                    autenticar($row['idFuncionario'],$row['cpf'],$row['cargo']);
                    session_write_close();
                    #echo $_SESSION['cargos'];
                    header("Location: gerente/template.php");
                    exit();
                }

                elseif($row['cargo'] == 'funcionario'){
                    autenticar($row['idFuncionario'],$row['cpf'],$row['cargo']);
                    session_write_close();
                    header("Location: funcionario/templateFun.php");
                    exit();
                }
 

            }
            else
            {                
                session_destroy();
                include 'index.php';                
                echo '<script>erroCadastro();</script>';  
                
                
            }
        }
        else
        {            
            session_destroy();
            include 'index.php';
            echo '<script>erroCadastro();</script>';  
        }
    }
    else
    {
        echo '<script>window.alert("Erro ao executar query! "'.mysqli_error($link).');</script>';  
        include 'index.php';
    }

?>

<?php
    function autenticar($ident,$usuario,$cargo){
        $_SESSION['id'] = $ident;
        $_SESSION['user'] = $usuario;
        $_SESSION['cargos'] = $cargo;
    }
?>