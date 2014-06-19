<?php
require 'UsuarioController.php';
class HomeController extends AppController{
	
	//pagina inicial
	function index(){
		$this->Session->destroy();
	}

	function logado(){
		$email = $this->Session->read('Usuario.email');
		$senha = $this->Session->read('Usuario.senha');
		$foto = $this->Session->read('Usuario.foto');

		if(empty($email) && empty($senha)){
			echo 'Você não tem acesso a essa área do sistema, Clique <a href="../">Aqui</a> para fazer login.';
			die;
		}else{

		}
	}

}