<?php

class Ban extends AppModel {

    var $name = 'Ban';
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    function getHost($Address) {
        $parseUrl = parse_url(trim($Address));
        return trim($parseUrl["host"] ? $parseUrl["host"] : array_shift(explode('/', $parseUrl["path"], 2)));
    }

}

?>