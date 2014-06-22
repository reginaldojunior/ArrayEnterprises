<?php
App::user('AppModel','Model');

class UsuarioModel extends AppModel{
	public $usuario = 'Usuario';
	public $hasMany = array('Comentario');
}