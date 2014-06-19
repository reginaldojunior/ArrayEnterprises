<?php

class UsuarioController extends AppController{

	//faz o login no sistema, com a função autentica_email
	function login($login_email,$login_senha){
		$this->layout = 'ajax';//chama o layout para executar uma função ajax

		if($this->autentica_email($login_email,$login_senha)){
			//recebe o array com os dados do usuario usando os parametros de email e senha
			$resposta = $this->recuperar_dados($login_email,$login_senha);	
			//destroe alguma session criada anteriomente
			$this->Session->Destroy();
			//faz o foreach com o array de dados do usuario
			foreach($resposta as $valor) {
				//escreve a sessao do usuario
				$this->Session->write('Usuario.id',   $valor['Usuario']['id']);
				$this->Session->write('Usuario.nome', $valor['Usuario']['nome']);//nome do usuario
				$this->Session->write('Usuario.email',$valor['Usuario']['email']);//email do usuario
				$this->Session->write('Usuario.senha',$valor['Usuario']['senha']);//senha do usuario criptografada
			}
			echo json_encode(true);//retorna um true pois tudo ocorreu bem
		}else{
			echo json_encode(false);//retorna um false pois ocorreu algo errado, ou os dados de login estava incorretos
		}
	}

	function logout(){
		$this->Session->Destroy();

		echo '<script>location.href="/winners/framework/"</script>';
	}

	//autentica email verifica se o email e senha existem para efetuar o login, ou outra acao.
	function autentica_email($email,$senha){
		$this->loadModel('Usuario');
		$resposta = $this->Usuario->find('count', 
								array('conditions' => array('AND' => array('Usuario.email' => $email, 'Usuario.senha' => sha1($senha))
										)
									)
								);
		$this->set('resposta', $resposta);

		return $resposta;
	}			

	//se o email estiver livre retorna false, senão retorna true
	function verificar_email_ajax(){
		$this->layout = 'ajax';

		$email = $this->request->data['email'];

		echo  json_encode($this->verificar_email($email));
	}

	function recuperar_dados($email,$senha){
		$this->loadModel('Usuario');
		$resposta = $this->Usuario->find('all', 
								array('conditions' => array('AND' => array('Usuario.email' => $email, 'Usuario.senha' => sha1($senha))
										)
									)
								);

		$this->set('resposta', $resposta);

		return $resposta;
	}

	//efetua um novo cadastro via ajax com os dados passados pelo metodo postS
	function novo_cadastro(){
		$this->layout = 'ajax';

		$nome  = $this->request->data['nome'];
		$email = $this->request->data['email'];
		$senha = sha1($this->request->data['senha']);

		if($this->verificar_email($email) == false){
			$data = array('nome' => $nome, 'email' => $email, 'senha' => $senha);
			if($this->Usuario->save($data)){
				echo true;
			}else{
				echo false;
			}
		}else{
			echo false;
		}
	}
}