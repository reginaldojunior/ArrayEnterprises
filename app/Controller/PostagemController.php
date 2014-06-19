<?php
class PostagemController extends AppController {

	function index(){

	}

	function cadastrar_post(){
		$this->layout = 'ajax';
		$this->loadModel('Comentario');

		$msg = $this->request->data['msg'];
		$fk_id_usuario = $this->Session->read('Usuario.id');

		$data = array('comentario' => $msg, 'fk_id_usuario' => $fk_id_usuario);
		if($this->Comentario->save($data)){
			$mensagem = '<hr><li><div class="media">';
	        $mensagem .= '<a class="pull-left" href="#">';
	        $mensagem .= '<img class="img-rounded" alt="" src="../img/1.png" alt="..." width="80" height="80">';
	        $mensagem .= '</a>';
	        $mensagem .= '<div class="media-body">';
	        $mensagem .= '<h4 class="media-heading">'.$this->Session->read('Usuario.nome').'</h4>';
	        $mensagem .= $msg;
	        $mensagem .= '</div>';
	      	$mensagem .= '<button type="button" class="btn btn-default btn-xs">';
	        $mensagem .= '<span class="glyphicon glyphicon-pencil"></span>';
	        $mensagem .= '</button>';
	      	$mensagem .= '<button type="button" class="btn btn-default btn-xs">';
	        $mensagem .= '<span class="glyphicon glyphicon-remove"></span>';
	     	$mensagem .= '</button> ';
	     	$mensagem .= ' <button type="button" class="btn btn-default btn-xs" id="">';
		    $mensagem .= '<span class="glyphicon glyphicon-calendar"> '.$valor['Comentario']['criacao'].'</span>';
		    $mensagem .= '</button></li>';

			echo json_encode($mensagem);
		}else{
			echo json_encode('Ocorreu algum erro ao cadastrar o comentario');
		}
	}

	function atualizar_posts(){
		$this->layout = 'ajax';
		$this->loadModel('Comentario');

		$resposta = $this->Comentario->find('all');
		$cont = $this->Comentario->find('count');

		$resultado = '';

		foreach ($resposta as $indice => $valor) {
			$mensagem = '<hr><li id='.$valor['Comentario']['id'].'><div class="media">';
	        $mensagem .= '<a class="pull-left" href="#">';
	        $mensagem .= '<img class="img-rounded" alt="" src="../img/1.png" alt="..." width="80" height="80">';
	        $mensagem .= '</a>';
	        $mensagem .= '<div class="media-body">';
	        $mensagem .= '<h4 class="media-heading">Fazer join com fkid do usuario que</h4>';
	        $mensagem .= $valor['Comentario']['comentario'];
	        $mensagem .= '</div>';
	        if($valor['Comentario']['fk_id_usuario'] != $this->Session->read('Usuario.id')){
	        	$mensagem .= '<br>';
	        	//não vai inserir os botões de edição pois o comentario não pentece ao usuario logado.
	        }else{
		      	$mensagem .= '<button type="button" class="btn btn-default btn-xs" fk_id_usuario="'.$valor['Comentario']['fk_id_usuario'].'" id="'.$valor['Comentario']['id'].'">';
		        $mensagem .= '<span class="glyphicon glyphicon-pencil"></span>';
		        $mensagem .= '</button> ';
		      	$mensagem .= ' <button type="button" class="btn btn-default btn-xs" id="'.$valor['Comentario']['id'].'">';
		        $mensagem .= '<span class="glyphicon glyphicon-remove"></span>';
		     	$mensagem .= '</button> ';
		    }
		    $mensagem .= ' <button type="button" class="btn btn-default btn-xs" id="">';
		    $mensagem .= '<span class="glyphicon glyphicon-calendar"> '.$valor['Comentario']['criacao'].'</span>';
		   	$mensagem .= '</button></li>';

	     	$resultado .= $mensagem;
		}

	    echo json_encode($resultado);
	}
}