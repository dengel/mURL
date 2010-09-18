<?php

class ApisController extends AppController {

    var $name = "Apis";
    var $uses = array("Murl", "Ban");
    var $errors_msg = array(
        "0" => "No error",
        "1" => "Bad params",
        "2" => "Error ",
        "3" => "Domain banned"
    );

    function beforeRender() {
        $this->layout = "ajax";
        Configure::write('debug', 0);
    }

    function random() {

        $this->Murl->recursive = 0;
        $this->set('murls', $this->Murl->find('all', array(
                    'limit' => 1,
                    'order' => array('rand()'),
                )));
    }

    function last() {

        $this->Murl->recursive = 0;
        $this->set('murls', $this->Murl->find('all', array(
                    'limit' => 1,
                    'order' => array('Murl.id DESC'),
                )));
    }

    function create() {
        $this->data['Murl']['remote'] = $this->RequestHandler->getClientIP();
        $this->data['Murl']['referer'] = $this->RequestHandler->getReferer();
        $this->data['Murl']['agent'] = $_SERVER['HTTP_USER_AGENT'];
        $this->data['Murl']['uri'] = base64_decode($this->params["uri"]);
        $this->data['Murl']['private'] = 1;

        if (isset($this->params["destruct"])) {
            $this->data['Murl']['destruct'] = $this->params['destruct'];
        }
        if (isset($this->params["protect"])) {
            $this->data['Murl']['protect'] = $this->params["protect"];
        }
        if (isset($this->params["private"])) {
            $this->data['Murl']['private'] = $this->params['private'];
        }

        if ($this->Murl->validates($this->data)) {

            $domain = $this->Murl->getHost($this->data['Murl']['uri']);
            $domain_banned = $this->Ban->find('first', array('conditions' => array('Ban.ban' => $domain)));
            
            if (count($domain_banned) > 0) {
                /* stats */
                $this->Ban->updateAll(array('Ban.hits' => 'Ban.hits+1'), array('Ban.id' => $domain_banned["Ban"]["id"]));

                $this->set('error', 1);
                $this->set('error_msg', $errors_msg["3"]);
            } else {

                $result = $this->Murl->find('first', array('conditions' => array('Murl.uri =' => $this->data['Murl']['uri'])));
                if ($result) {

                    $this->set('error', 0);
                    $this->set('code', $result['Murl']['code']);

                } else {
                    $this->Murl->create();
                    if ($this->Murl->save($this->data)) {

                        $id = $this->Murl->getInsertId();
                        $code = $this->Murl->genCode($id);
                        $delta = $this->Murl->getDelta($id);
                        $crunch_msg = $this->Murl->getCrunch($delta);

                        $this->set('error', 0);
                        $this->set('code', $code);
                        
                    } else {

                        $this->set('error', 1);
                        $this->set('error_msg', $errors_msg["2"]);
                    }
                }
            }
        }
    }

}

?>
