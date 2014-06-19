<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<?php echo $this->Html->charset(); ?>
	<title>
		ArrayEnterprises
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('');//icone do favicon só coloca o nome nao precisa da extensão
		echo $this->Html->script('jquery');
		echo $this->Html->script('funcoes');
	?>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

</head>
<body>
<div id="container">

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">ArrayEnterprises</a>
    </div>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Ajuda</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sobre <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Documentacao</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
      <div class="navbar-form navbar-left" role="login">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Login" id="login_email">
	        <input type="password" class="form-control" placeholder="Senha" id="login_senha">
        </div>
        <button id="logar" class="btn btn-default">Logar</button>
      </div>
      </ul>

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			Array Enterprises - Todos os Direitos Reservados
		</div>
	</div>	
	</body>
</html>