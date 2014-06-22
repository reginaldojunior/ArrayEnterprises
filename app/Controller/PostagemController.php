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
                                             'foreignKey' => false,
                                             'conditions'=> array('Comentario.fk_id_usuario = Usuario.id')
                                        )
                                 ),
                       'order'=>array('Usuario.id ASC')
                ));

		$cont = $this->Comentario->find('count');

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
	        if($valor['Comentario']['fk_id_usuario'] != $this->Session->read('Usuario.id')){
	        	$mensagem .= '<br>';
	        	//não vai inserir os botões de edição pois o comentario não pentece ao usuario logado.
	        }else{
		      	$mensagem .= '<button type="button" class="btn btn-default btn-xs" id="bteditar">';
	        	$mensagem .= '<a href="/postagem/editar"><span class="glyphicon glyphicon-pencil"></span></a>';
		        $mensagem .= '</button> ';
		      	$mensagem .= ' <button type="button" class="btn btn-default btn-xs" id="'.$valor['Comentario']['id'].'">';
	       		$mensagem .= '<a href="/postagem/excluir"><span class="glyphicon glyphicon-remove"></span></a>';
		     	$mensagem .= '</button> ';
		    }
		    $mensagem .= '<button type="button" class="btn btn-default btn-xs" id="">';
		    $mensagem .= '<span class="glyphicon glyphicon-calendar"> '.$valor['Comentario']['criacao'].'</span>';
		   	$mensagem .= '</button></li>';

	     	$resultado .= $mensagem;
		}

	    echo json_encode($resultado);
	}

	function excluir(){
		$this->loadModel('Comentario');
		
	}
}