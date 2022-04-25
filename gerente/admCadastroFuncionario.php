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

<!DOCTYPE html>
<html lang="pt-br">
  <head>
      <!-- Meta tags Obrigatórias -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
      
      <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
      <script type="text/javascript" src="js/funcionariosDisponiveis.js"></script>
      <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
      <script type="text/javascript" src="../js/viaCep.js"></script>
      <script type="text/javascript" src="js/gerente.js"></script>
      
      <title>Bate Volta | Logística</title>
      <link rel="shortcut icon" type="image/icon" href="../src/icon.ico" />
  </head>
  <body>
  <header class="bg-info"> 
  </header>
  <div>
    <br>
    <form name="insertEmployee" action="../php/inserts/funcionarioEndereco.php" method="POST" class="container">
      <label>Dados:</label>
      <div class="form-row">
        <div class="form-group col-lg-6">
          <label>Nome</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Nome">
        </div>
        <div class="form-group col-lg-6">
          <label>CPF</label>
          <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-lg-3 col-md-6">
          <label>Celular</label>
          <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular">
        </div>
        <div class="form-group col-lg-2 col-md-4">
          <label>Sexo</label>
          <select id="sexo" name="sexo" class="form-control">
            <option></option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Femenino">Outros</option>
            <option value="Femenino">Não defenido</option>
          </select>
        </div>
        <div class="form-group col-lg">
          <label>Cargo</label>
          <select id="cargo" name="cargo" class="form-control">
            <option>------</option>
            <option value="funcionario">Funcionario</option>
            <option value="gerente">Gerente</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-lg-6 col-md-8">
          <label>Senha</label>
          <input type="text" class="form-control" id="senha" name="senha" placeholder="Senha">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-lg-6">
          <label>Sede</label>
          <select id="sede" name="sede" class="form-control">
            <option></option>
          </select>
        </div>
      </div>  
      <hr class="featurette-divider">
      <label>Endereço:</label>
      <form method="get" action=".">
        <div class="form-row">
          <div class="form-group col-lg-3 col-md-4">
            <label>CEP</label>
            <input type="text" onblur="pesquisacep(this.value);" class="form-control" id="cep" name="cep" placeholder="CEP">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-lg-6">
            <label>Rua</label>
            <input type="text" class="form-control" name="rua" id="rua" name="rua" placeholder="Rua"/>
          </div>
          <div class="form-group col-lg-6">
            <label>Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-lg-1 col-md-2 col-3">
            <label>Número</label>
            <input type="text" class="form-control" id="numero" name="numero">
          </div>
          <div class="form-group col-lg-3">
            <label>Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade">
          </div>
          <div class="form-group col-lg-3 col-md-4">
            <label>Estado</label>
            <select id="uf" name="uf" class="form-control">
              <option></option>
              <option value="AC">Acre</option>
              <option value="AL">Alagoas</option>
              <option value="AP">Amapá</option>
              <option value="AM">Amazonas</option>
              <option value="BA">Bahia</option>
              <option value="CE">Ceará</option>
              <option value="DF">Distrito Federal</option>
              <option value="ES">Espírito Santo</option>
              <option value="GO">Goiás</option>
              <option value="MA">Maranhão</option>
              <option value="MT">Mato Grosso</option>
              <option value="MS">Mato Grosso do Sul</option>
              <option value="MG">Minas Gerais</option>
              <option value="PA">Pará</option>
              <option value="PB">Paraíba</option>
              <option value="PR">Paraná</option>
              <option value="PE">Pernambuco</option>
              <option value="PI">Piauí</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RN">Rio Grande do Norte</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="RO">Rondônia</option>
              <option value="RR">Roraima</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>
              <option value="SE">Sergipe</option>
              <option value="TO">Tocantins</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col">
            <label>Complemento</label>
            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento">
          </div>
        </div>
        <button type="submit" name="cadastrar" class="btn btn-info">Cadastrar</button>
      </form>
    </form>
    <br>
  </div>
    <footer style="bottom: 0; width: 100%;" class="navbar-fixed-bottom text-white bg-info text-center">
    </footer>
  </body>
</html>