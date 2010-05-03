<?php
class MurlsController extends AppController {

	var $name = 'Murls';
   var $helpers = array('Html','Ajax','Javascript');
   var $components = array('RequestHandler');

   function index() {
   }

   function options() {
   }

   function view() {

      if (isset($this->params['url']['search'])) {
         $this->set('murls', $this->Murl->find('all', array(
         'limit' => 20, 
         'order' => array('Murl.id DESC'), 
         'conditions' => array('Murl.url LIKE' => '%'.$this->params['url']['search'].'%')
         )));
      } elseif (isset($this->params['url']['top'])) {
         $this->set('murls', $this->Murl->find('all', array(
         'limit' => 20, 
         'order' => array('Murl.hits DESC'), 
         )));
      } elseif (isset($this->params['url']['random'])) {
         $this->set('murls', $this->Murl->find('all', array(
         'limit' => 20, 
         'order' => array('rand()'), 
         )));
      } elseif (isset($this->params['url']['one'])) {
         $this->set('murls', $this->Murl->find('all', array('conditions' => array('Murl.code =' => $this->params['url']['one']))));
      } else {
         $this->set('murls', $this->Murl->find('all', array('limit' => 20, 'order' => array('Murl.id DESC'))));
      }

      if (isset($this->params['url']['domains'])) {
      $all_murls  = $this->Murl->find('all', array('order' => array('Murl.id DESC')));
      foreach ($all_murls as $one_murl) {
         $durl=urldecode(stripslashes($one_murl['Murl']['uri']));
         $domain=parse_url($durl, PHP_URL_HOST);
         $bits=array_reverse(explode(".", $domain));
         error_reporting (0);
         if ($bits[0] && $bits[1]) {
            $domain=$bits[1] . "." . $bits[0];
            $domain_hash[$domain]++;
         }
         error_reporting (E_ALL  & ~E_NOTICE);
      }
      asort($domain_hash, SORT_NUMERIC);
      $domain_hash=array_reverse($domain_hash);
      $this->set('domains', $domain_hash);
      }
   }

   function process() {
      $this->set('params','None');
      if ($this->data) {
         $code=$this->data['Murl']['code'];
      } else {
         $code=$this->params['url']['url'];
      }
      $this->set('error', 0);
      $this->set('code', $code);
      $this->set('message', $this->params);
      $result=$this->Murl->find('first', array('conditions' => array('Murl.code =' => $code)));
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
            $result['Murl']['hits']++;
            unset($result['Murl']['modified']);
            $this->Murl->save($result);
            $this->redirect(urldecode(stripslashes($result['Murl']['uri'])));
         }
      } else {
         $this->Session->setFlash('What? Not sure what you mean.');
         $this->set('error', '404');
      }
   }

   function create() {
      $this->set('code',0);
      $this->set('params','None');
      if (isset($this->params['url']['uri'])) {
         $this->data['Murl']['uri'] = $this->params['url']['uri'];
         $this->data['Murl']['protect'] = $this->params['url']['protect'];
         $this->data['Murl']['private'] = $this->params['url']['private'];
         $this->data['Murl']['destruct'] = $this->params['url']['destruct'];
      }
      if ($this->data['Murl']['uri']) {
         $this->data['Murl']['remote']=$this->RequestHandler->getClientIP();
         $this->data['Murl']['referer']=$this->RequestHandler->getReferer();
         $this->data['Murl']['agent']=$_SERVER['HTTP_USER_AGENT'];
         $this->Murl->set( $this->data );
         if ($this->Murl->validates()) {
            $found=stristr($this->data['Murl']['uri'],'http://murl.net/');
            if ($found) {
                  $this->redirect(array('action' => 'view?one='.substr($found, strlen('http://murl.net/'))));
            } 
            $result=$this->Murl->find('first', array('conditions' => array('Murl.uri =' => $this->data['Murl']['uri'])));
            if ($result) {
               $this->Session->setFlash('Entry already exists.');
               $this->set('code',$result['Murl']['code']);
               $this->set('params',$result['Murl']['code']);
            } else {
               if ($this->Murl->save($this->data)) {
                  $id=$this->Murl->getInsertId();
                  $code = base_convert($id,10,36);
                  $this->data['Murl']['code']=$code;

                  $this->Murl->save($this->data);

                  //$delta=strlen($this->data['Murl']['uri'])-(strlen($this->data['Murl']['code'])+strlen('http://murl.net/'));

                  $code = $this->Murl->getCode();
                  $delta = $this->Murl->getDelta();
                  $crunch_msg = $this->Murl->getCrunch($delta);

                  $this->Session->setFlash($crunch_msg.' Savings of '.$delta.' characters.');
                  #$this->redirect(array('action' => 'index'));
                  $this->set('params', 'Saved');
                  $this->set('code',$code);
               } else {
                  $this->set('params', "No save");
               }
            }
         } else {
            $this->set('params', "Bad");
         }
      }

   }
}
?>
