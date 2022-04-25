$( document ).ready(function() {
  $('header').append('<div class="container"> \
                        <nav class="navbar navbar-expand-lg navbar-dark bg-info"> \
                            <a href="templateFun.php"><img style="padding-right: 25px; width: 155px;" src="../src/logo.png"/></a> \
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação"> \
                                <span class="navbar-toggler-icon"></span> \
                            </button> \
                            <div class="collapse navbar-collapse" id="navbarNavDropdown"> \
                                <ul class="navbar-nav"> \
                                <li class="nav-item"> \
                                    <a class="nav-link" href="cadastroRota.php">Rotas</a> \
                                </li> \
                                <li class="nav-item"> \
                                    <a class="nav-link" href="cadastro.php">Encomenda</a> \
                                </li> \
                                <li class="nav-item dropdown"> \
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> \
                                    Consultar \
                                    </a> \
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"> \
                                    <a class="dropdown-item" href="consultaEncomenda.php">Encomenda</a> \
                                    <a class="dropdown-item" href="cotacaoFretes.php">Cotação do frete</a> \
                                    </div> \
                                </li> \
                                <li class="nav-item dropdown"> \
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> \
                                Atualizar \
                                </a> \
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"> \
                                <a class="dropdown-item" href="consulta_encomenda.php">Encomenda</a> \
                                <a class="dropdown-item" href="Atualiza_de_Rotas.php">Rota Encomenda</a> \
                                </div> \
                                </li> \
                                <li class="nav-item"> \
                                    <a class="nav-link" href="../logout.php" >Sair</a> \
                                </li> \
                                </ul> \
                            </div> \
                        </nav> \
                      </div> \
  ');
  
  $('footer').append('<div style="padding: 10px 0px 10px 0px;" class="container"> \
                        <p>Desenvoldor por <a href="https://getbootstrap.com/">##</a></p> \
                      </div> \
  ') 
  
})

  