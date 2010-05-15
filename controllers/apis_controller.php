<?php
class ApisController extends AppController {

    var $name = "Apis";
    var $uses = array("Murl");

    function beforeRender() {
        $this->layout = "ajax";
        Configure::write('debug',0);
    }

    function random() {

        $this->Murl->recursive = 0;
        $this->set('murls', $this->Murl->find('all', array(
                'limit' => 1,
                'order' => array('rand()'),
        )));
    }

    function create() {
        $this->data['Murl']['remote'] = $this->RequestHandler->getClientIP();
        $this->data['Murl']['referer'] = $this->RequestHandler->getReferer();
        $this->data['Murl']['agent'] = $_SERVER['HTTP_USER_AGENT'];
        $this->data['Murl']['uri'] = base64_decode($this->params["uri"]);

        if(isset($this->params["destruct"])) {
            $this->data['Murl']['destruct'] = $this->params['destruct'];
        }
        if(isset($this->params["protect"])) {
            $this->data['Murl']['protect'] = $this->params["protect"];
        }
        if(isset($this->params["private"])) {
            $this->data['Murl']['private'] = $this->params['private'];
        }

        if ($this->Murl->validates($this->data)) {
            $found = stristr($this->data['Murl']['uri'],'http://murl.net/');
            if ($found) {
                //es una murl
                $this->set('error',1);
            }
            $result = $this->Murl->find('first', array('conditions' => array('Murl.uri =' => $this->data['Murl']['uri'])));
            if ($result) {
                $this->set('code',$result['Murl']['code']);
                $this->set('error',0);
            } else {
                $this->Murl->create();
                if ($this->Murl->save($this->data)) {
                    $id = $this->Murl->getInsertId();
                    $code = $this->Murl->genCode($id);
                    $delta = $this->Murl->getDelta($id);
                    $crunch_msg = $this->Murl->getCrunch($delta);

                    $this->set('code',$code);
                    $this->set('error',0);
                } else {
                    //error en agregar
                    $this->set('error',2);
                }
            }
        }

    }

}

?>
