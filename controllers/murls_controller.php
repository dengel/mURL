<?php

class MurlsController extends AppController {

    var $name = 'Murls';
    var $paginate = array(
        'limit' => 10,
        'order' => array(
            'Murl.id' => 'desc'
        )
    );

    function beforeRender() {
        $this->layout = "murl";
        Configure::write('debug',0);
    }

    function add() {
        if ($this->data) {

            $this->data['Murl']['remote'] = $this->RequestHandler->getClientIP();
            $this->data['Murl']['referer'] = $this->RequestHandler->getReferer();
            $this->data['Murl']['agent'] = $_SERVER['HTTP_USER_AGENT'];

            if ($this->Murl->validates($this->data)) {

                /* reverse murl */
                $found = stristr($this->data['Murl']['uri'], 'http://murl.net/');
                if ($found) {
                    $this->redirect("/reverse/" . substr($found, strlen('http://murl.net/')));
                    exit(); // ta de más
                }

                $result = $this->Murl->find('first', array('conditions' => array('Murl.uri =' => $this->data['Murl']['uri'])));
                if ($result) {
                    $this->Session->setFlash('Entry already exists.');
                    $this->set('code', $result['Murl']['code']);
                } else {
                    $this->Murl->create();
                    if ($this->Murl->saveAll($this->data)) {
                        $id = $this->Murl->getInsertId();
                        $code = $this->Murl->genCode($id);
                        $delta = $this->Murl->getDelta($id);
                        $crunch_msg = $this->Murl->getCrunch($delta);
                        $this->Session->setFlash($crunch_msg . ' Savings of ' . $delta . ' characters.');

                        $this->set('code', $code);
                    } else {
                        $this->Session->setFlash("Error: Unable to save");
                    }
                }
            } else {
                $this->Session->setFlash("Error: Invalid parameters");
            }
        }
    }

    function domain() {
        $all_murls = $this->Murl->find('all', array('order' => array('Murl.id DESC')));
        foreach ($all_murls as $one_murl) {
            $durl = urldecode(stripslashes($one_murl['Murl']['uri']));
            $domain = parse_url($durl, PHP_URL_HOST);
            $bits = array_reverse(explode(".", $domain));
            error_reporting(0);
            if ($bits[0] && $bits[1]) {
                $domain = $bits[1] . "." . $bits[0];
                $domain_hash[$domain]++;
            }
            error_reporting(E_ALL & ~E_NOTICE);
        }
        asort($domain_hash, SORT_NUMERIC);
        $domain_hash = array_reverse($domain_hash);
        $this->set('domains', $domain_hash);
    }

    function process() {
        $code = $this->params['url']['url'];
        $this->set('error', 0);
        $this->set('code', $code);
        $result = $this->Murl->find('first', array('conditions' => array('Murl.code =' => $code)));

        if ($result) {
            if ($result['Murl']['destruct'] && $result['Murl']['hits']) {
                $this->Session->setFlash('Expired! This murl has self-destructed');
                $this->set('error', '410');
            } elseif ($result['Murl']['protect'] && !isset($this->data['Murl']['code'])) {
                $this->Session->setFlash('Protected! What\'s the magic word?');
                $this->set('error', '401');
            } elseif ($result['Murl']['protect'] != $this->data['Murl']['protect']) {
                $this->Session->setFlash('Bad Password. Try again?');
                $this->set('error', '401');
            } else {
                $this->Murl->updateAll(array('Murl.hits' => 'Murl.hits+1'), array('Murl.id' => $result['Murl']['id']));

                $this->data['Hit']['murl_id'] = $result['Murl']['id'];
                $this->data['Hit']['remote'] = $this->RequestHandler->getClientIP();
                $this->data['Hit']['referer'] = $this->RequestHandler->getReferer();
                $this->data['Hit']['agent'] = $_SERVER['HTTP_USER_AGENT'];

                $this->Murl->Hit->save($this->data);

                $this->redirect(urldecode(stripslashes($result['Murl']['uri'])));
                exit();
            }
        } else {
            $this->Session->setFlash('What? Not sure what you mean.');
            $this->set('error', '404');
        }
    }

    function random() {
        $this->set('title_for_layout', "Random mURLs");
        $this->Murl->recursive = 0;
        $this->set('murls', $this->Murl->find('all', array(
           'conditions' => array('Murl.Private = ' => 0, 'Murl.Destruct = ' => 0),
           'limit' => 1,
           'order' => array('rand()'),
        )));
    }

    function reverse() {
        $this->set('title_for_layout', "Reverse mURL");
        $this->Murl->recursive = 0;
        $this->set('murls', $this->Murl->find('all', array(
           'conditions' => array('Murl.code = ' => $this->params["code"], 'Murl.Destruct = ' => 0),
           'limit' => 1,
        )));
    }

    function search() {
        $this->set('title_for_layout', "Search mURLs");
        $this->Murl->recursive = 0;
        if ($this->data) {
            # Quiero poner esto en un modelo para poder usar el validate.
            if (strlen($this->data['Murl']['field']) < 3) {
                $this->Session->setFlash('Too short a criteria. Minimum of 3 characters required');
            } else {
                $this->set('murls', $this->Murl->find('all', array(
                            'limit' => 20,
                            'order' => array('Murl.id DESC'),
                            'conditions' => array('Murl.uri LIKE' => '%' . $this->data['Murl']['field'] . '%')
                        )));
            }
        }
    }

    function top() {
        $this->set('title_for_layout', "Top mURLs");
        $this->Murl->recursive = 0;
        $this->set('murls', $this->Murl->find('all', array(
           'conditions' => array('Murl.Private = ' => 0, 'Murl.Destruct = ' => 0),
           'limit' => 20,
           'order' => array('Murl.hits DESC'),
        )));
    }

    function view() {
        $this->set('title_for_layout', "View mURLs");
        $this->Murl->recursive = 0;
        $this->set('murls', $this->paginate('Murl', array('Murl.Private = 0 AND (Murl.Destruct = 0 OR (Murl.Destruct = 1 AND Murl.Hits > 1)) ')));
    }

    function info() {
        $this->set('title_for_layout', "mURL Info");
    }

}
?>
