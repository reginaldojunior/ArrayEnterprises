<?php
App::user('AppModel','Model');

class ComentarioModel extends AppModel{
	public $comentario = 'Comentario';
	public $belongsTo = array('Usuario');
}