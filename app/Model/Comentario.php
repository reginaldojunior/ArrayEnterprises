<?php
class Comentario extends AppModel{
    public $displayField = 'LogComentario';
    
    public $uses = 'comentario';
    public $name = 'Comentarios';

    public $userTable = 'comentarios';

    public $belongsTo = array(
        'Usuario' => array(
            'className' => 'Usuario',
            'foreignKey' => 'usuario_id',
            'conditions' => array(),
            'fields' => array('Usuario.id', 'Usuario.nome', 'Usuario.foto'),
            'counterCache' => 'true',
            'counterScope' => array(),
            'order' => array('Usuario.id' => 'ASC')
	    )
    );

}