$(document).ready(function(){

    $("#sede").ready(function(){

        $.post('php/selects/sedes.php', function(result){
            
            var objetoJSON = JSON.parse(result);

            $.each(objetoJSON, function(i, value){

                $('#sede').append('<option value="' + value['idSede'] + '">' + value['nome'] + '</option>');
            });
            
        });
    });

    $("#sede").change(function(){
        var FK_sede = $('#sede').val();
        $.post('php/selects/funcionariosDisponiveis.php',{
            FK_sede:FK_sede,
            func:'consultaFuncionariosDisponiveis'
        }, function(result){
            var objetoJSON = JSON.parse(result);
            $("#msgConsulta").empty();
            $("#tabelaConsulta").empty();
            if(result == "erro"){
                $('#msgConsulta').append('<div class=" alert alert-danger alert-dismissible fade show" role="alert"> \
                                        <strong>Erro!</strong> Desculpe, não foi possivel realizar a busca\
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> \
                                        <span aria-hidden="true">&times;</span> \
                                        </button> \
                                        </div> \
                ');
            }
            else if(objetoJSON == ""){
                $('#msgConsulta').append('<div class=" alert alert-warning alert-dismissible fade show" role="alert"> \
                                        <strong>Desculpe!</strong> Sede não possui funcionarios\
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> \
                                        <span aria-hidden="true">&times;</span> \
                                        </button> \
                                        </div> \
                ');
            }
            else{
                $('#tabelaConsulta').append('<table class="table table-striped">\
                                                <thead> \
                                                    <tr> \
                                                        <th scope="col">#</th> \
                                                        <th scope="col">Nome</th> \
                                                        <th scope="col">Cargo</th> \
                                                        <th scope="col">Disponibilidade</th> \
                                                    </tr> \
                                                </thead> \
                                                <tbody id="dadosTabelaConsulta"> \
                                                </tbody> \
                                            </table> \
                ');
                $.each(objetoJSON.funcionario, function(i, value){
                    $('#dadosTabelaConsulta').append('<tr id="novaLinha'+ i +'"></tr>');
                    $('#novaLinha'+ i).append('<th scope="row">'+ (i+1) +'</th>');
                    $('#novaLinha'+ i).append('<td>'+ value['dados']['nome'] +'</td>');
                    $('#novaLinha'+ i).append('<td>'+ value['dados']['cargo'] +'</td>');
                   
                    if(value['ativo']['ativo'])
                    {   
                        $('#novaLinha'+ i).append(
                            '<td><span class="circuloVerde">Disponivel</span></td>'
                        );
                    }
                    else
                    {
                        $('#novaLinha'+ i).append(
                            '<td><span class="circuloVermelho">Indisponível</span></td>'
                        );
                    }
                });
            }
        });
    });
})