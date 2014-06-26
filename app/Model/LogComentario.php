<?php
class LogComentario extends AppModel{

	public $uses = 'log_comentario';
	public $name = 'LogComentarios';


    public $userTable = 'log_comentarios';

    public $belongsTo = array(
        'Comentario' => array(
            'className' => 'Comentario',
            'foreignKey' => 'comentario_id',
            'conditions' => array(),
            'fields' => array('Comentario.id', 'Comentario.criacao'),
            'counterCache' => 'true',
            'counterScope' => array(),
            'order' => array('Comentario.id' => 'ASC')
	    )
    );

}