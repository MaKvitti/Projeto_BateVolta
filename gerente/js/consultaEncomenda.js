$(document).ready(function(){
    $('#btnCodigo').click(function(){
        $("#msgConsulta").empty();
        $("#tabelaConsulta").empty();

        var codigo = $('#txtCodigo').val();

        $.post('../php/selects/consultaEncomenda.php',{
            codigo:codigo,
            func:'vereficaEncomendaNull'
        }, function(result){
            if(result == "erro"){
                $('#msgConsulta').append('<div class=" alert alert-danger alert-dismissible fade show" role="alert"> \
                                        <strong>Erro!</strong> Desculpe, não foi possivel realizar a busca\
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> \
                                        <span aria-hidden="true">&times;</span> \
                                        </button> \
                                        </div> \
                ');
            }
            else if(!result){
                $('#msgConsulta').append('<div class=" alert alert-warning alert-dismissible fade show" role="alert"> \
                                            <strong>Desculpe!</strong> Encomenda não existe \
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> \
                                            <span aria-hidden="true">&times;</span> \
                                            </button> \
                                        </div> \
                ');
            }
            else{
                consultaListaEncomenda(codigo)
            }
        })
    })
})


function consultaListaEncomenda(codigo){
    $.post('../php/selects/consultaEncomenda.php',{
        codigo:codigo,
        func:'listaEncomenda'
    }, function(result){
        if(result == "erro"){
            $('#msgConsulta').append('<div class=" alert alert-danger alert-dismissible fade show" role="alert"> \
                                    <strong>Erro!</strong> Desculpe, não foi possivel realizar a busca\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> \
                                    <span aria-hidden="true">&times;</span> \
                                    </button> \
                                    </div> \
            ');
        }
        else{
            var objetoJSON = JSON.parse(result);
            if(result){
                var codigo = $('#txtCodigo').val();
                $('#tabelaConsulta').append('<form class="" action="../pdf/pdf.php" method="post"> \
                                                <input class="col-10" type="hidden" name="pdf" value="'+codigo+'"> \
                                                <div class="col-4"><input class="w-100 btn btn-info" type="submit" value="Baixar PDF"></div> \
                                            </form> \
                                            <br> \
                                            <table class="table table-striped">\
                                                <thead> \
                                                    <tr> \
                                                        <th scope="col">#</th> \
                                                        <th scope="col">Cidade-UF</th> \
                                                        <th scope="col">Status</th> \
                                                        <th scope="col">Data</th> \
                                                    </tr> \
                                                </thead> \
                                                <tbody id="dadosTabelaConsulta"> \
                                                </tbody> \
                                            </table> \
                ');
                $.each(objetoJSON.rota, function(i, value){
                    $('#dadosTabelaConsulta').append('<tr> \
                                                        <th scope="row">'+ (i+1) +'</th> \
                                                        <td>'+ value['endereco']['cidade'] +' - '+ value['endereco']['estado'] +'</td> \
                                                        <td>'+ value['dados']['status'] +'</td> \
                                                        <td>'+ value['dados']['data'] +'</td> \
                                                    </tr> \
                    ');
                });
            }      
        }
    })
}