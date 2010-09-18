<?php

class BansController extends AppController {

    var $name = 'Bans';

    function beforeRender() {
        $this->layout = "user";
        Configure::write('debug', 2);
    }

    function admin_index() {
        $this->Ban->recursive = 0;
        $this->set('bans', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid ban', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('ban', $this->Ban->read(null, $id));
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Ban->create();
            $this->data["Ban"]["ban"] = $this->Ban->getHost($this->data["Ban"]["ban"]);
            if ($this->Ban->save($this->data)) {
                $this->Session->setFlash(__('The ban has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The ban could not be saved. Please, try again.', true));
            }
        }
        $users = $this->Ban->User->find('list');
        $this->set(compact('users'));
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid ban', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            $this->data["Ban"]["ban"] = $this->Ban->getHost($this->data["Ban"]["ban"]);
            if ($this->Ban->save($this->data)) {
                $this->Session->setFlash(__('The ban has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The ban could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Ban->read(null, $id);
        }
        $users = $this->Ban->User->find('list');
        $this->set(compact('users'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for ban', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Ban->delete($id)) {
            $this->Session->setFlash(__('Ban deleted', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Ban was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }

}

?>