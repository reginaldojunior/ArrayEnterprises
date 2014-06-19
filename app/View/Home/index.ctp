<div class="row" style="margin: 20px;">
<div class="col-md-6">

<div class="panel panel-default">
  <div class="panel-heading">Dados - Configurações / Login</div>
  <div class="panel-body">

	<div id="deslogado">
    <div class="form-group">
      <label for="exampleInputEmail1">Digite seu Nome</label>
      <input type="text" class="form-control" id="nome" placeholder="Digite seu Nome" >
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Digite seu e-mail</label>
      <input type="email" class="form-control" id="email" placeholder="Digite seu e-mail">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Digite sua senha</label>
      <input type="password" class="form-control" id="senha" placeholder="Digite sua senha">
    </div>
    <button class="btn btn-primary" id="cadastrar">Cadastrar</button>
	</div>


  </div>
</div>
</div>
<div class="col-md-6">
<div class="panel panel-default">
  <div class="panel-heading">Postagens</div>
  <div class="panel-body">
<textarea class="form-control" rows="3" placeholder="Digite o que desejar" id="msg" disabled></textarea>
<br>
<button type="button" class="btn btn-warning" disabled>Voce precisa está logado para fazer postagem !</button>


<br>
<hr>

  <ul id="comentarios">
    <!--- aqui vai todos os comentarios montados via jquery e php -->
  </ul>


  </div>
</div>
  </div>
</div>