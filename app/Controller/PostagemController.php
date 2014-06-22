<?php
class PostagemController extends AppController {

	function index(){

	}

	function cadastrar_post(){
		$this->layout = 'ajax';
		$this->loadModel('Comentario');

		$msg = $this->request->data['msg'];
		$fk_id_usuario = $this->Session->read('Usuario.id');
		$data = date('d/m/y');

		$data = array('comentario' => $msg,'criacao' => $data ,'fk_id_usuario' => $fk_id_usuario);

		if($this->Comentario->save($data)){
			$mensagem = '<hr><li><div class="media">';
	        $mensagem .= '<a class="pull-left" href="#">';
	        $mensagem .= '<img class="img-rounded" alt="" src="../img/'.$this->Session->read('Usuario.foto').'" alt="..." width="80" height="80">';
	        $mensagem .= '</a>';
	        $mensagem .= '<div class="media-body">';
	        $mensagem .= '<h4 class="media-heading">'.$this->Session->read('Usuario.nome').'</h4>';
	        $mensagem .= $msg;
	        $mensagem .= '</div>';
	      	$mensagem .= '<button type="button"  class="btn btn-default btn-xs">';
	        $mensagem .= '<a href="/usuario/editar/comentario"><span class="glyphicon glyphicon-pencil"></span></a>';
	        $mensagem .= '</button> ';
	      	$mensagem .= '<button type="button" class="btn btn-default btn-xs">';
	        $mensagem .= '<a href="/usuario/excluir/comentario"><span class="glyphicon glyphicon-remove"></span></a>';
	     	$mensagem .= '</button> ';
	     	$mensagem .= ' <button type="button" class="btn btn-default btn-xs">';
		    $mensagem .= '<span class="glyphicon glyphicon-calendar">'.date('d/m/y').'</span>';
		    $mensagem .= '</button></li>';

			echo json_encode($mensagem);
		}else{
			echo json_encode('Ocorreu algum erro ao cadastrar o comentario');
		}
	}

	function atualizar_posts(){
		$this->layout = 'ajax';
		$this->loadModel('Comentario');
		$this->loadModel('Usuario');

		$resposta = $this->Comentario->find('all',
                array('joins' => array(
                                       array('table' => 'usuarios',
                                             'alias' => 'Usuario',
                                             'type' => 'inner',
                                             'foreignKey' => 'usuario_id',
                                             'conditions'=> array('Comentario.usuario_id = Usuario.id')
                                        )
                                 ),
                       'order'=>array('Comentario.id DESC')
                ));

		$resultado = '';

		foreach ($resposta as $indice => $valor) {
			$mensagem = '<hr><li id='.$valor['Comentario']['id'].'><div class="media">';
	        $mensagem .= '<a class="pull-left" href="#">';
	        $mensagem .= '<img class="img-rounded" alt="" src="../img/" alt="..." width="80" height="80">';
	        $mensagem .= '</a>';
	        $mensagem .= '<div class="media-body">';
	        $mensagem .= '<h4 class="media-heading">Fazer join com fkid do usuario que</h4>';
	        $mensagem .= $valor['Comentario']['comentario'];
	        $mensagem .= '</div>';
	        if($valor['Comentario']['usuario_id'] == $this->Session->read('Usuario.id') || $this->Session->read('Usuario.admin') == 1){
		      	$mensagem .= '<button type="button" class="btn btn-default btn-xs">';
	        	$mensagem .= '<a href="/postagem/editar/'.$valor['Comentario']['id'].'"><span class="glyphicon glyphicon-pencil"></span></a>';
		        $mensagem .= '</button> ';
		      	$mensagem .= ' <button type="button" class="btn btn-default btn-xs">';
	       		$mensagem .= '<a href="/postagem/excluir/'.$valor['Comentario']['id'].'"><span class="glyphicon glyphicon-remove"></span></a>';
		     	$mensagem .= '</button> ';
		    }else{
	        	$mensagem .= '<br>';
		    }
		    $mensagem .= '<button type="button" class="btn btn-default btn-xs" id="">';
		    $mensagem .= '<span class="glyphicon glyphicon-calendar"> '.$valor['Comentario']['criacao'].'</span>';
		   	$mensagem .= '</button></li>';

	     	$resultado .= $mensagem;
		}

	    echo json_encode($resultado);
	}

	function excluir($id){
		$this->loadModel('Comentario');
		
		if($this->Comentario->delete($id)){
			echo '<script>location.href="/home/logado"</script>';
		}
	}

	function editar($id){
		$this->Session->write('Comentario.id', $id);

		echo $this->Session->read('Comentario.id');
	}

	function salvar_edicao(){
		$this->layout = 'ajax';
		$this->loadModel('Comentario');

		$msg = $this->request->data['msg'];
		$data = date('d/m/y');
		$id = $this->Session->read('Comentario.id');

		$dados = array(
				  'comentario' => "'".$msg."'",
				  'atualizado' => "'".$data."'"
		);
		
		$resposta =	$this->Comentario->updateAll(
				$dados,
				array('Comentario.id' => $id)
		);

		echo $resposta;
	}
}