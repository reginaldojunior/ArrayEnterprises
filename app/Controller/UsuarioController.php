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
				$this->Session->write('Usuario.foto', $valor['Usuario']['foto']);
			}
			echo json_encode(true);//retorna um true pois tudo ocorreu bem
		}else{
			echo json_encode(false);//retorna um false pois ocorreu algo errado, ou os dados de login estava incorretos
		}
	}

	function logout(){
		$this->Session->Destroy();

		echo '<script>location.href="/ArrayEnterprises/"</script>';
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

	//se o email estiver livre retorna false, senão retorna true
	function verificar_email($email){
		$this->layout = 'ajax';
		
		if(empty($email)){
			$email = $this->request->data['email'];
		}

		$this->loadModel('Usuario');
		$resposta = $this->Usuario->find('count',
											array('conditions' => array('Usuario.email' => $email))
										);
		$this->set('resposta', $resposta);

		if($resposta >= 1){
			return true;
		}else{
			return false;
		}
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

	function salvar_foto(){
		//define o id do usuario que está logado pela session
		$id = $this->Session->read('Usuario.id');
		// Lista de tipos de arquivos permitidos
   		$tiposPermitidos= array('image/jpeg', 'image/pjpeg', 'image/png');
   		// Tamanho máximo (em bytes)
    	$tamanhoPermitido = 7000 * 500; // 1000 Kb

		$arqName = $_FILES['arquivo']['name'];//nome original do arquivo
		$arqType = $_FILES['arquivo']['type'];//formato do arquivo
		$arqSize = $_FILES['arquivo']['size'];//tamanho do arquivo
		$arqTemp = $_FILES['arquivo']['tmp_name'];//nome do arquivo temporario gerado pelo php
		$arqError = $_FILES['arquivo']['error'];//se existir erros, vai ser armazenados nesta variavel

		if($arqError == 0){
			if(array_search($arqType, $tiposPermitidos)){
				echo 'O Tipo de arquivo é invalido';
			}else if($arqSize > $tamanhoPermitido){
				echo 'O tamanho do arquivo deve ser menor';
			}else{
				$pasta = WWW_ROOT.'img/';
				//pega a extensão do arquivo enviando
				$extensao = explode('.', $arqName);
				//define o novo nome do arquivo, [1] representa o indice do array que está a extensão
				$nome = time().'.'.$extensao[1];
				//move o arquivo para a pasta, e guarda o resultado na variavel upload
				$upload = move_uploaded_file($arqTemp, $pasta.$nome);
				if($upload){
					$dados = array(
							  'foto' => "'".$nome."'"
					);
					
					$resposta =	$this->Usuario->updateAll(
							$dados,
							array('Usuario.id' => $id)
					);
					if($resposta){
						$this->Session->write('Usuario.foto', $nome);
						echo 'ocorreu tudo bem';
					}else{
						echo 'Os dados não foram salvos no banco';
					}
				}else{
					echo 'Ocorreu erro ao mover o arquivo para a pasta';
				}
			}
		}else{
			echo 'Ocorreu um erro código do erro: '.$arqError;
		}
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

	function editar_cadastro(){
		$this->layout = 'ajax';

		$email = $this->request->data['email'];
		$nome = $this->request->data['nome'];
		$senha = $this->request->data['senha'];
		$id = $this->Session->read('Usuario.id'); 

		$senhaCrip = sha1($senha);

		$dados = array(
				  'nome' => "'".$nome."'",
				  'senha' => "'".$senhaCrip."'"
		);
		
		$resposta =	$this->Usuario->updateAll(
				$dados,
				array('Usuario.id' => $id)
		);

		if($resposta){
			//recebe o array com os dados do usuario usando os parametros de email e senha
			$resposta = $this->recuperar_dados($email,$senha);	
			//destroe alguma session criada anteriomente
			$this->Session->Destroy();
			//faz o foreach com o array de dados do usuario
			foreach($resposta as $valor) {
				//escreve a sessao do usuario
				$this->Session->write('Usuario.id',   $valor['Usuario']['id']);
				$this->Session->write('Usuario.nome', $valor['Usuario']['nome']);//nome do usuario
				$this->Session->write('Usuario.email',$valor['Usuario']['email']);//email do usuario
				$this->Session->write('Usuario.senha',$valor['Usuario']['senha']);//senha do usuario criptografada
				$this->Session->write('Usuario.foto', $valor['Usuario']['foto']);
			}

			echo true;
		}
	}
}