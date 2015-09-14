<!DOCTYPE html>
<head lang="pt">

	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<title>Location Students</title>

	<link rel="stylesheet" type="tex/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" type="tex/css" href="<?php echo base_url('css/custom.css'); ?>">

  <script type="text/javascript"
    src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBMoYehAkIoo86OgFFDMr2vLjOIEzDKH2s&sensor=SET_TO_TRUE_OR_FALSE">
  </script>
  <script type="text/javascript">
    
  </script>
</head>
<body>
  
  <div class="container">
    <h3 class="text-center">Location of students</h3>
    <div class="menu center-block text-center">
      <form class="form-inline">
        <div class="form-group">
          <input id="address" class="form-control" type="textbox" placeholder="Informe o endereço">
          <input type="button" class="btn btn-primary" value="Localizar Endereço" onclick="codeAddress()">
        </div>
      </form>
      <br>
      <form id="buscaform" method="post" class="form-inline">
        <div class="form-group">
          <select name="tipobusca" id="tipobusca" class="form-control">
            <option value="">Selecione o tipo de busca</option>
            <option value="NOME">NOME</option>
            <option value="CPF">CPF</option>
            <option value="MATRICULA">MATRICULA</option>
            <option value="SEXO">SEXO</option>
            <option value="ENDERECO">RUA/AV JOÃO PESSOA, 5050</option>
            <option value="BAIRRO">BAIRRO</option>
            <option value="BAIRRO">CIDADE</option>

          </select>
        </div>
        <div class="form-group">
          <input type="text" id="buscatext" name="busca" class="form-control" placeholder="Buscar...">
        </div>
        <div class="form-group">
          <a href="Javascript:void(0);" onclick="consulta_personalizada();" id="busca" class="btn btn-primary">Buscar</a>
        </div>
        <div class="form-group">
          <a href="#" id="atualizar_lista" value="Lista Alunos" onclick="requisicao();
" class="btn btn-primary">Listar Alunos</a>
        </div>
        <div class="form-group">
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModalAdicionaAluno">+</a>  
        </div>
        <div class="form-group">
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModalCriarRota">Criar Rotas</a>
        </div>
        
        <div class="form-group">
          <a href="http://localhost/location/Aluno" class="btn btn-primary" onclick="clearMap();">Limpar Mapa</a>
        </div>
      </form>
      <div class="resposta-form"></div>
    </div>
    <br>
    
  </div>
  <br>
	
  <div id="map_canvas" style="width:100%; height:100%"></div>

  <hr>
  <!-- Modal -->
<div class="modal fade" id="myModalAdicionaAluno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cadastro de Aluno</h4>
      </div>
      <div class="modal-body">
        
        <form id="novo_registro">

          <div class="form-group">
            <input type="text" id="nome" name="nome" class="form-control" placeholder="*Nome do Aluno">
          </div>
          <div class="form-group">
            <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF">
          </div>
          <label>Endereço:</label>
          <div class="form-group">
            <input type="text" id="endereco" name="endereco" class="form-control" placeholder="*Av. João Pessoa, 5050 " >
          </div>
          <div class="form-group">
            <input type="text" id="bairro" name="bairro" class="form-control" placeholder="*Bairro" >
          </div>
          <div class="form-group">
            <input type="text" id="cidade" name="cidade" class="form-control" placeholder="*Cidade" >
          </div>
          <div class="form-group">
            <input type="text" id="estado" name="estado" class="form-control" placeholder="*Estado" >
          </div>
          <div class="resposta_novo_aluno"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" id="salvar_endereco" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Localização por rotas -->
<div class="modal fade" id="myModalCriarRota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Localização por rotas</h4>
      </div>
      <div class="modal-body">
        <form action="">
          <div class="form-group">
            <input type="text" id="endereco1" class="form-control" placeholder="Endereço de partida">
          </div>
          <div class="form-group">
            <input type="text" id="endereco2" class="form-control" placeholder="Endereço de chegada">
          </div>
        </form>
        <div class="resposta_criar_rota"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <a href="Javascript:void(0);" id="criarRota" class="btn btn-primary">Criar Rota</a>
      </div>
    </div>
  </div>
</div>


  <table id="lista_alunos">
    
  </table>
  <!-- Javascript Bootstrap -->
  <script src="<?php echo base_url('js/jquery-1.11.3.min.js'); ?>"></script>
  <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('js/mapa.js'); ?>"></script>
  <script src="<?php echo base_url('js/functions.js'); ?>"></script>
  <script src="<?php echo base_url('js/markerclusterer.js'); ?>"></script>
  

</body>
</html>