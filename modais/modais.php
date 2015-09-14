<!-- Modal -->
<div class="modal fade" id="myModalAdicionaAluno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cadastro de Aluno</h4>
      </div>
      <div class="modal-body">
        <form action="">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Nome do Aluno">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="CPF">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Endereco">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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