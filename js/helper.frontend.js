    $("#buscaform").submit(function(){
      var tipoBusca = $("#tipobusca").val();
      var busca = $("#buscatext").val();

      alert(tipobusca  + " " + busca);
      if(tipoBusca == "" | tipoBusca == null | busca == "" | busca == null){
        $(".resposta-form").html("<p style=\"color: red;\">Por favor, informe o que deseja buscar.</p>");
        return false;
      }

    });

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
