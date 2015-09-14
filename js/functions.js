
function consulta_personalizada(){


  var tipoBusca = $("#tipobusca").val();
  var busca = $("#buscatext").val();

  if(tipoBusca == "" | tipoBusca == null | busca == "" | busca == null){
    $(".resposta-form").html("<p style=\"color: red;\">Por favor, informe o que deseja buscar.</p>");
    return false;
  }

  $.ajax({
              url : 'http://localhost/location/aluno/consulta_json',
              type : 'post',
              data : {'metodo': tipoBusca, 'busca': busca},
              dataType: 'html',

              beforeSend: function(){
                $('#carregando').fadeIn();  
              },
              //timeout: 3000,    
              success: function(retorno){
                  alunos = null;
                  objeto = JSON.parse(retorno);
                  alunos = objeto.alunos;
       
                  initialize();
                  buscarPorEndereco();
              },
              error: function(erro){
                alert("Erro: " + erro);
              }

            });

}



$("#criarRota").click(function(){
  var partida = $("#endereco1").val();
  var chegada = $("#endereco2").val();

  var directionsService = new google.maps.DirectionsService();
  var request = {
    origin: partida,
    destination: chegada,
    travelMode: google.maps.TravelMode.DRIVING
  };

  directionsService.route(request, function(result, status){
    if(status == google.maps.DirectionsStatus.OK){
      $("#myModalCriarRota").modal('hide');
      $("#endereco1").html("");
      $("#endereco2").html("");
      directionsDisplay.setDirections(result);
    } else {
      $(".resposta_criar_rota").html("Erro ao criar rota");
    }

  });

});



$("#salvar_endereco").click(function(){

    var nome = $("#nome").val();
    var cpf =  $("#cpf").val();
    var endereco =  $("#endereco").val();
    var bairro =  $("#bairro").val();
    var cidade =  $("#cidade").val();
    var estado =  $("#estado").val();
    var lat;
    var lng;
    var contextoBox = "dasd";

    if(nome == "" | endereco == "" | bairro == "" | cidade == "" | estado == ""){
      $(".resposta_novo_aluno").html("Preencha todos os campos, somente o cpf pode ficar em branco!");
      return false;
    }

    var endereco_completo = endereco + ' ' + bairro + ' ' + cidade + ' ' + estado;
   
    geocoder.geocode( { 'address': endereco_completo}, function(results, status)
    {  
      if(status == google.maps.GeocoderStatus.OK){
        map.setCenter(results[0].geometry.location);
        
        lat = results[0].geometry.location.lat();
        lng = results[0].geometry.location.lng();

        //Instancia o Marcador
        var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location,
        })

        //Instancia o InfoWindow
        var infowindow = new google.maps.InfoWindow({ content: contextoBox })

          //Colocar as informações junto ao Marker
          google.maps.event.addListener(marker, 'click', function(){
            infowindow.open(map, marker);
          })

          google.maps.event.addListener(marker, 'mouseup', function(){
            infowindow.close(map, marker);
          })

    

            $.ajax({
              url : 'http://localhost/location/aluno/add_novo',
              type : 'post',
              data : {'nome': nome, 'cpf': cpf, 'endereco': endereco, 'bairro': bairro, 'cidade': cidade, 'estado': estado, 'lat': lat, 'lng': lng},
              dataType: 'html',

              beforeSend: function(){
                $('#carregando').fadeIn();  
              },
              //timeout: 3000,    
              success: function(retorno){
                $(".resposta_novo_aluno").html("Lat e Lng encontrado - Aluno adicionado com sucesso!");
              },
              error: function(erro){
                alert("Erro: " + erro);
              }

            });

       } 
      else 
      {
        $(".resposta_novo_aluno").html("Endereço não encontrado!");
        return false;
      }
    
    })    

       
});




