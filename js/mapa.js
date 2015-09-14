var objeto;
var alunos;
var pontos;
//Variável de instancia geocoder para busca endereço e transformar em lantLong
var markerClusters;
//Agrupa vários marcadores conforme o zoom
var markers = [];
var geocoder;
//Var map, é o objeto do mapa
var map;
//Var para carregar as rotas na var map.
var directionsDisplay;
var Lat = [];
var Lng = [];
var contador = 0;


/*
* Método de inicialização do map
* void
* Autor - Haelio Márcio
*/
function initialize() {
    //Rodas
    directionsDisplay = new google.maps.DirectionsRenderer();
    geocoder = new google.maps.Geocoder();
    
    //Configurações Iniciais do Mapa
    var mapOptions = {
        center: new google.maps.LatLng(-3.7913514, -38.5192009),
        zoom: 11,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

      directionsDisplay.setMap(map);
}

initialize();

function requisicao(){

    var metodo = $("#tipobusca").val();
    var busca = $("#buscatext").val();
    var url_caminho;
    if(metodo == 'null' | metodo == "" | busca == "" | busca == null){
      url_caminho = "http://localhost/location/Aluno/consulta_json";
    } else {
      url_caminho = "http://localhost/location/Aluno/consulta_json";
    }

   $.ajax({
      url : url_caminho,
      type : 'post',
      data : {'metodo': metodo, 'busca': busca},
      dataType: 'html',
      beforeSend: function(){
        $('#carregando').fadeIn();  
      },
      //timeout: 3000,    
      success: function(retorno){
        objeto = JSON.parse(retorno);
        alunos = objeto.alunos;
        //
        buscarPorEndereco();

      },
      error: function(erro){
        alert(erro);
      }

    });
  



}

/*
* Método jogar todas as informações dos alunos na infoWindow.
* void
* Autor - Haelio Márcio
*/

function listarInfoBox(marker_ponto, cont){
      
  var infowindow = new google.maps.InfoWindow({
    content: cont
  });

  google.maps.event.addListener(marker, 'click', function(){
    infowindow.open(map, marker)
  });

}
      
/*
* Método de consulta de enderecos.
* Retornar o LatLong para Map
* Autor - Haelio Márcio
*/

function listarTodosOsAlunos(id, endereco, contentBox){

  geocoder.geocode( { 'address': endereco }, function(results, status){  

  if(status == google.maps.GeocoderStatus.OK){
    
    map.setCenter(results[0].geometry.location);

    Lat.push(results[0].geometry.location.lat());
    Lng.push(results[0].geometry.location.lng());

    //Instancia o Marcador
    var marker = new google.maps.Marker({
      map: map,
      position: results[0].geometry.location
    });

    //Instancia o InfoWindow
    var infowindow = new google.maps.InfoWindow({
      content: contentBox
                });

                //Colocar as informações junto ao Marker
                google.maps.event.addListener(marker, 'click', function(){
                  infowindow.open(map, marker)
                });

                google.maps.event.addListener(marker, 'mouseup', function(){
                  infowindow.close(map, marker)
                });


    } else {
        $("#lista_alunos").append("<tr><td>"+contentBox+"</td></tr>");
        //alert("Geocode was status: " + status);
    }

    });

}

function listaPorLatLng(lat, lng, contentBox){

  var latlng = new google.maps.LatLng(lat, lng);

  //Instancia o Marcador
    var marker = new google.maps.Marker({
      //map: map,
      position: latlng,
      icon: 'http://localhost/location/images/aluno.png',
    });
    
    markers.push(marker);

    //Instancia o InfoWindow
    var infowindow = new google.maps.InfoWindow({
      content: contentBox
                });

                //Colocar as informações junto ao Marker
                google.maps.event.addListener(marker, 'click', function(){
                  infowindow.open(map, marker)
                });

                google.maps.event.addListener(marker, 'mouseup', function(){
                  infowindow.close(map, marker)
                });
}

/*
* Método para lista todos os alunos no Mapa.
* Faz um for com todos os registros Json
* Autor - Haelio Márcio
*/

function buscarPorEndereco(){

  for(var i = 0; i < alunos.length; i++){
    var content = "<strong>"+alunos[i].NOME+"</strong><br>" + "<p>"+alunos[i].ENDERECO+" - "+ alunos[i].BAIRRO;
    listaPorLatLng(alunos[i].LAT, alunos[i].LNG, content);
  }
  markerClusters = new MarkerClusterer(map, markers);

}


//Função para Localizar endereço
function codeAddress() {
  var address = document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
    } else {
      alert('Não foi possível localizar o endereço informado!: ' + status);
    }
  });
}