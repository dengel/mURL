<?php

class UsersController extends AppController {

    var $name = 'Users';
    var $displayField = 'username';

    function beforeRender() {
        $this->layout = "user";
        Configure::write('debug', 2);
    }

    function admin_index() {
        
    }

    function login() {

    }

    function logout() {
        $this->redirect($this->Auth->logout());
    }

}

?>