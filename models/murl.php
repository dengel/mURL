<?php

class Murl extends AppModel {

    var $name = 'Murl';
    var $displayField = 'code';
    var $validate = array(
        'uri' => array(
            'rule' => 'url',
            'required' => 'true',
            'message' => 'Please provide an URL to crunch.'
        )
    );
    var $hasMany = array('Hit');

    function genCode($id) {
        $code = base_convert($id, 10, 36);
        $this->id = $id;
        $this->saveField('code', $code);
        return $code;
    }

    function getCrunch($delta) {
        $crunch_msg = "What's going on?";
        if ($delta < 0) {
            $crunch_msg = "We're ashamed... good for you.";
        } elseif ($delta == 0) {
            $crunch_msg = "Wow, we kinnda broke even, uh?";
        } elseif ($delta == 1) {
            $crunch_msg = "One is better than none.";
        } elseif (($delta > 1) && ($delta < 20)) {
            $crunch_msg = "You got shrunken!";
        } elseif (($delta >= 20) && ($delta < 50)) {
            $crunch_msg = "Now that's good shrinking.";
        } elseif (($delta >= 50) && ($delta < 150)) {
            $crunch_msg = "Massive shrinkage detected!";
        } elseif ($delta >= 150) {
            $crunch_msg = "You are the King of mURL!";
        }
        return $crunch_msg;
    }

    function getDelta($id) {
        $result = $this->find('first', array('conditions' => array('Murl.id' => $id)));

        return strlen($result['Murl']['uri']) - (strlen($result['Murl']['code']) + strlen('http://murl.net/'));
    }

    function getHost($Address) {
        $parseUrl = parse_url(trim($Address));
        return trim(isset($parseUrl["host"]) ? $parseUrl["host"] : array_shift(explode('/', $parseUrl["path"], 2)));
    }

}

?>
