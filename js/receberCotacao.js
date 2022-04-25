
//Utilizado para retornar os valores do volume do objeto e o custo do frete


/*Requisitos:
    Receber os valores de peso, comprimento, largura, altura, cep de origem e destino em
    campos de texto com os seguintes id's:
        #peso
        #comprimento
        #largura
        #altura
        #cep1
        #cep2
    
    Acionamento: é realizado por onclick em botões, especificar o id do botão
    comforme o retorno esperado.

    id_Acionamento/Retorno: 
        #but_calcular - retorna o volume e o custo em forma de texto nos id's
        volume e cotacao, ambos inseridos com a tag <h3>
        
        #button_calcular - retorna o volume e o custo em forma de texto nos id's
        volume e cotacao que são dois inputs, atualizando o campo .value
*/

$(document).ready(function(){
    $('#but_calcular1').click(function(e){  //acionado pelo botão
        e.preventDefault(); //parando o envio do formulário

        //Recebendo os valores que serão passados por POST para o php
        var peso = $('#peso').val();
        var comprimento = $('#comprimento').val();
        var largura = $('#largura').val();
        var altura = $('#altura').val();
        var origem = $('#cep1').val();
        var destino = $('#cep2').val();

        //passando os valores para o php
        $.post('cotacaoFrete.php', {
            peso:peso,
            comprimento:comprimento,
            largura:largura,
            altura:altura,
            cep1:origem,
            cep2:destino
        }, function(respostaJSON){ //Recebendo a string json de retorno do php

            //alert(respostaJSON)
            var objetoJSON = JSON.parse(respostaJSON); //convertendo a string em um objeto json

            //Mostrando os valores no formulário
            var elemento = document.getElementById("volume");
            elemento.innerHTML = "<h3>" + objetoJSON.volume + "cm<sup>3<sup></h3>";

            var elemento = document.getElementById("cotacao");
            elemento.innerHTML = "<h3>R$ " + parseFloat(objetoJSON.cotacao).toFixed(2) + "</h3>";
            
        });
    });
    //Retorna os dados em texto entre tags <h3>
    $('#but_calcular').click(function(e){  //acionado pelo botão

        e.preventDefault(); //parando o envio do formulário

        //Recebendo os valores que serão passados por POST para o php
        var peso = $('#peso').val();
        var comprimento = $('#comprimento').val();
        var largura = $('#largura').val();
        var altura = $('#altura').val();
        var origem = $('#cep1').val();
        var destino = $('#cep2').val();

        //passando os valores para o php
        $.post('calculoFrete.php', {
            peso:peso,
            comprimento:comprimento,
            largura:largura,
            altura:altura,
            cep1:origem,
            cep2:destino
        }, function(respostaJSON){ //Recebendo a string json de retorno do php

            //alert(respostaJSON)
            var objetoJSON = JSON.parse(respostaJSON); //convertendo a string em um objeto json

            //Mostrando os valores no formulário
            var elemento = document.getElementById("volume");
            elemento.innerHTML = "<h3>" + objetoJSON.volume + "cm<sup>3<sup></h3>";

            var elemento = document.getElementById("cotacao");
            elemento.innerHTML = "<h3>R$ " + parseFloat(objetoJSON.cotacao).toFixed(2) + "</h3>";
            
        });
    });

        //Retorna os dados em texto dentro de um input
        $('#button_calcular').click(function(e){  //acionado pelo botão
            e.preventDefault(); //parando o envio do formulário
            //Recebendo os valores que serão passados por POST para o php
            var peso = $('#peso').val();
            var comprimento = $('#comprimento').val();
            var largura = $('#largura').val();
            var altura = $('#altura').val();
            
            var remetente = $('#remetente').val(); // Id&Cep
            var origem = remetente.split('&'); // [0] = id, [1] = cep

            var destinatario = $('#destino').val(); // Id&Cep
            var destino = destinatario.split('&'); // [0] = id, [1] = cep

            //passando os valores para o php
            $.post('calculoFrete.php', {
                peso:peso,
                comprimento:comprimento,
                largura:largura,
                altura:altura,
                cep1:origem[1],
                cep2:destino[1]
            }, function(respostaJSON){ //Recebendo a string json de retorno do php
                //alert(respostaJSON)
                var objetoJSON = JSON.parse(respostaJSON); //convertendo a string em um objeto json

                var elemento = document.getElementById("volume");
                //$('#03').mask('###0,00', {reverse: true});
                elemento.value = parseFloat(objetoJSON.volume).toFixed(3);
                
                var elemento = document.getElementById("cotacao");
                //$('#04').mask('###0,00', {reverse: true});
                elemento.value = parseFloat(objetoJSON.cotacao).toFixed(3);
                
            });
        });
});
