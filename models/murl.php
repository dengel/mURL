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
}
?>
