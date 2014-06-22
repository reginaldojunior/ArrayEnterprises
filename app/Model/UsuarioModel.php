<?php
App::user('AppModel','Model');

class UsuarioModel extends AppModel{
	public $usuario = 'UsuarioModel';

	public $belongsTo = array('Comentario');
}