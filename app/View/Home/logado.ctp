<?php
  $id = $this->Session->read('Usuario.id');
  $nome = $this->Session->read('Usuario.nome');
  $email = $this->Session->read('Usuario.email');
  $foto = $this->Session->read('Usuario.foto');
?>

<div class="row" style="margin: 20px;">
<div class="col-md-6">

<div class="panel panel-default">
  <div class="panel-heading">Dados - Configurações / Login</div>
  <div class="panel-body">

	<div id="logado">
    <div class="row">
      <div class="col-md-6">
        <a class="pull-left" href="#">
          <img class="img-rounded" alt="" src="../img/<?php echo $foto; ?>" alt="..." width="300" height="250">
        </a>

        <form method="post" action="/usuario/salvar_foto" enctype="multipart/form-data">
          <div class="form-group" style="padding-top: 260px; padding-left: 25px;">
              <input type="file" class="form-control" id="foto" name="arquivo">
              <br>
              <input style="margin-left: 75px;" type="submit" class="btn btn-primary" value="Salvar Foto" />
          </div>
        </form>

      </div>

      <div class="col-md-6">
          <div class="form-group">
            <label for="exampleInputEmail1">Digite seu Nome</label>
            <input type="text" class="form-control" id="nome" placeholder="Digite seu Nome" value="<?php echo $nome; ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Digite seu e-mail</label>
            <input type="text" class="form-control" id="email" disabled="true" value="<?php echo $email; ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Digite sua senha</label>
            <input type="password" class="form-control" id="senha" placeholder="Confirme sua senha antiga, ou digite uma nova">
          </div>

          <button class="btn btn-primary" id="editar">Editar</button>
          <a href="/ArrayEnterprises/usuario/logout"><span class="btn btn-danger" id="sair" >Sair !</span></a>
      </div>
    </div>
	</div>

  </div>
</div>
</div>
	<div class="col-md-6">
<div class="panel panel-default">
  <div class="panel-heading">Postagens</div>
  <div class="panel-body">
<textarea class="form-control" rows="3" placeholder="Digite o que desejar" id="msg"></textarea>
<br>
<button type="button" class="btn btn-primary" id="postar">Postar !</button>


<br>
<hr>

  <ul id="comentarios">
    <!--- aqui vai todos os comentarios montados via jquery e php -->
  </ul>


  </div>
</div>
	</div>
</div>