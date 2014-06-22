<?php
App::user('AppModel','Model');

class ComentarioModel extends AppModel{
	public $comentario = 'ComentarioModel';

	public $hasOne = array('Usuario');
}